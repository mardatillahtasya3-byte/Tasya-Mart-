<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Throwable;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')
            ->withCount('items')
            ->latest('purchase_date')
            ->latest('id')
            ->paginate(10);

        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('purchases.create', compact(
            'suppliers',
            'products'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => [
                'required',
                'integer',
                'exists:suppliers,id',
            ],
            'purchase_date' => [
                'required',
                'date',
            ],
            'notes' => ['nullable', 'string', 'max:5000'],
            'product_id' => ['required', 'array', 'min:1', 'max:50'],
            'quantity' => ['required', 'array', 'max:50'],
            'unit_cost' => ['required', 'array', 'max:50'],
        ]);

        $productIds = $request->input('product_id', []);
        $quantities = $request->input('quantity', []);
        $unitCosts = $request->input('unit_cost', []);

        if (
            count($productIds) !== count($quantities) ||
            count($productIds) !== count($unitCosts)
        ) {
            throw ValidationException::withMessages([
                'product_id' => 'Rincian barang tidak lengkap.',
            ]);
        }

        $rows = [];
        $errors = [];

        foreach ($productIds as $i => $productId) {
            $quantity = $quantities[$i] ?? null;
            $unitCost = $unitCosts[$i] ?? null;

            if (
                ($productId === null || $productId === '') &&
                ($quantity === null || $quantity === '') &&
                ($unitCost === null || $unitCost === '')
            ) {
                continue;
            }

            $validator = Validator::make([
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_cost' => $unitCost,
            ], [
                'product_id' => [
                    'required',
                    'integer',
                    'exists:products,id',
                ],
                'quantity' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:1000000',
                ],
                'unit_cost' => [
                    'required',
                    'numeric',
                    'min:0',
                    'max:999999999999.99',
                ],
            ]);

            if ($validator->fails()) {
                foreach ($validator->errors()->all() as $message) {
                    $errors[] = 'Baris ' . ($i + 1) . ': ' . $message;
                }

                continue;
            }

            $rows[] = [
                'product_id' => (int) $productId,
                'quantity' => (int) $quantity,
                'unit_cost' => round((float) $unitCost, 2),
            ];
        }

        if (count($rows) === 0) {
            $errors[] = 'Masukkan minimal satu barang yang valid.';
        }

        $ids = array_column($rows, 'product_id');

        if (count($ids) !== count(array_unique($ids))) {
            $errors[] = 'Produk yang sama tidak boleh dimasukkan dua kali.';
        }

        if ($errors) {
            throw ValidationException::withMessages([
                'product_id' => $errors,
            ]);
        }

        try {
            $purchase = DB::transaction(function () use ($request, $rows) {
                $supplier = Supplier::whereKey(
                    $request->integer('supplier_id')
                )->lockForUpdate()->firstOrFail();

                $invoiceNumber = 'TM-' . now()->format('YmdHis')
                    . '-' . Str::upper(Str::random(5));

                $purchase = Purchase::create([
                    'supplier_id' => $supplier->id,
                    'invoice_number' => $invoiceNumber,
                    'purchase_date' => $request->input('purchase_date'),
                    'total' => 0,
                    'notes' => $request->input('notes'),
                ]);

                $total = 0;

                foreach ($rows as $row) {
                    $product = Product::whereKey($row['product_id'])
                        ->lockForUpdate()
                        ->firstOrFail();

                    $quantity = $row['quantity'];
                    $unitCost = $row['unit_cost'];
                    $subtotal = round($quantity * $unitCost, 2);

                    $total = round($total + $subtotal, 2);

                    PurchaseItem::create([
                        'purchase_id' => $purchase->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unit_cost' => $unitCost,
                        'subtotal' => $subtotal,
                    ]);

                    $product->increment('stock', $quantity);
                }

                $purchase->update(['total' => $total]);

                return $purchase;
            }, 3);

            return redirect()
                ->route('purchases.show', $purchase)
                ->with('success', 'Pembelian berhasil disimpan dan stok diperbarui.');
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Pembelian gagal disimpan. Periksa log Laravel untuk mengetahui penyebabnya.'
                );
        }
    }

    public function show(Purchase $purchase)
    {
        $purchase->load(['supplier', 'items.product']);

        return view('purchases.show', compact('purchase'));
    }
}
