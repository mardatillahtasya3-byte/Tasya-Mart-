<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::withCount('items')
            ->latest('sale_date')
            ->latest('id')
            ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:5000'],
            'product_id' => ['required', 'array', 'min:1', 'max:50'],
            'product_id.*' => [
                'required', 'integer', 'distinct', 'exists:products,id',
            ],
            'quantity' => ['required', 'array', 'min:1', 'max:50'],
            'quantity.*' => [
                'required', 'integer', 'min:1', 'max:1000000',
            ],
        ]);

        if (count($validated['product_id']) !== count($validated['quantity'])) {
            throw ValidationException::withMessages([
                'product_id' => 'Rincian barang tidak lengkap.',
            ]);
        }

        try {
            $sale = DB::transaction(function () use ($validated) {
                $ids = array_map('intval', $validated['product_id']);
                $quantities = array_map('intval', $validated['quantity']);

                // Kunci produk sesuai urutan ID untuk menghindari
                // konflik ketika beberapa transaksi berjalan bersamaan.
                $sortedIds = $ids;
                sort($sortedIds);

                $products = Product::whereIn('id', $sortedIds)
                    ->orderBy('id')
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                $sale = Sale::create([
                    'invoice_number' => 'TMS-'
                        . now()->format('YmdHis')
                        . '-' . Str::upper(Str::random(5)),
                    'sale_date' => $validated['sale_date'],
                    'total' => 0,
                    'notes' => $validated['notes'] ?? null,
                ]);

                $total = 0;

                foreach ($ids as $index => $productId) {
                    $product = $products->get($productId);
                    $quantity = $quantities[$index];

                    if (!$product) {
                        throw ValidationException::withMessages([
                            'product_id' => 'Produk tidak ditemukan.',
                        ]);
                    }

                    if ($product->stock < $quantity) {
                        throw ValidationException::withMessages([
                            'quantity.' . $index =>
                                "Stok {$product->name} tidak mencukupi. "
                                . "Stok tersedia: {$product->stock}.",
                        ]);
                    }

                    $unitPrice = (float) $product->price;
                    $subtotal = round($unitPrice * $quantity, 2);
                    $total = round($total + $subtotal, 2);

                    SaleItem::create([
                        'sale_id' => $sale->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                        'subtotal' => $subtotal,
                    ]);

                    $product->decrement('stock', $quantity);
                }

                $sale->update(['total' => $total]);

                return $sale;
            }, 3);

            return redirect()
                ->route('sales.show', $sale)
                ->with(
                    'success',
                    'Penjualan berhasil disimpan dan stok diperbarui.'
                );
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Penjualan gagal disimpan. Periksa log Laravel.'
                );
        }
    }

    public function show(Sale $sale)
    {
        $sale->load('items.product');

        return view('sales.show', compact('sale'));
    }
}
