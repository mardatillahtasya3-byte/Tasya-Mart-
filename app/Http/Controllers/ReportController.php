<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $search = $filters['search'] ?? null;
        $startDate = $filters['start_date'] ?? null;
        $endDate = $filters['end_date'] ?? null;

        $sales = Sale::query()
            ->when($search, fn ($q) =>
                $q->where('invoice_number', 'like', "%{$search}%")
            )
            ->when($startDate, fn ($q) =>
                $q->whereDate('sale_date', '>=', $startDate)
            )
            ->when($endDate, fn ($q) =>
                $q->whereDate('sale_date', '<=', $endDate)
            )
            ->latest('sale_date')
            ->paginate(10, ['*'], 'sales_page')
            ->withQueryString();

        $purchases = Purchase::with('supplier')
            ->when($search, fn ($q) =>
                $q->where('invoice_number', 'like', "%{$search}%")
            )
            ->when($startDate, fn ($q) =>
                $q->whereDate('purchase_date', '>=', $startDate)
            )
            ->when($endDate, fn ($q) =>
                $q->whereDate('purchase_date', '<=', $endDate)
            )
            ->latest('purchase_date')
            ->paginate(10, ['*'], 'purchases_page')
            ->withQueryString();

        $products = Product::with('category')
            ->when($search, fn ($q) =>
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                })
            )
            ->orderBy('name')
            ->paginate(10, ['*'], 'products_page')
            ->withQueryString();

        $salesTotal = Sale::query()
            ->when($startDate, fn ($q) =>
                $q->whereDate('sale_date', '>=', $startDate)
            )
            ->when($endDate, fn ($q) =>
                $q->whereDate('sale_date', '<=', $endDate)
            )
            ->sum('total');

        $purchasesTotal = Purchase::query()
            ->when($startDate, fn ($q) =>
                $q->whereDate('purchase_date', '>=', $startDate)
            )
            ->when($endDate, fn ($q) =>
                $q->whereDate('purchase_date', '<=', $endDate)
            )
            ->sum('total');

        return view('reports.index', compact(
            'sales',
            'purchases',
            'products',
            'salesTotal',
            'purchasesTotal',
            'search',
            'startDate',
            'endDate'
        ));
    }

    public function export(Request $request, string $type): StreamedResponse
    {
        abort_unless(
            in_array($type, ['sales', 'purchases', 'stock'], true),
            404
        );

        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        $search = $filters['search'] ?? null;
        $startDate = $filters['start_date'] ?? null;
        $endDate = $filters['end_date'] ?? null;

        $filename = $type . '-report-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () use (
            $type, $search, $startDate, $endDate
        ) {
            $out = fopen('php://output', 'w');

            // BOM agar karakter UTF-8 terbaca baik oleh Excel.
            fwrite($out, "\xEF\xBB\xBF");

            if ($type === 'sales') {
                fputcsv($out, ['Invoice', 'Tanggal', 'Total', 'Catatan']);

                Sale::query()
                    ->when($search, fn ($q) =>
                        $q->where('invoice_number', 'like', "%{$search}%")
                    )
                    ->when($startDate, fn ($q) =>
                        $q->whereDate('sale_date', '>=', $startDate)
                    )
                    ->when($endDate, fn ($q) =>
                        $q->whereDate('sale_date', '<=', $endDate)
                    )
                    ->orderBy('sale_date')
                    ->chunk(500, function ($rows) use ($out) {
                        foreach ($rows as $sale) {
                            fputcsv($out, [
                                $sale->invoice_number,
                                $sale->sale_date?->format('Y-m-d'),
                                $sale->total,
                                $sale->notes,
                            ]);
                        }
                    });
            } elseif ($type === 'purchases') {
                fputcsv($out, [
                    'Invoice', 'Tanggal', 'Pemasok', 'Total', 'Catatan'
                ]);

                Purchase::with('supplier')
                    ->when($search, fn ($q) =>
                        $q->where('invoice_number', 'like', "%{$search}%")
                    )
                    ->when($startDate, fn ($q) =>
                        $q->whereDate('purchase_date', '>=', $startDate)
                    )
                    ->when($endDate, fn ($q) =>
                        $q->whereDate('purchase_date', '<=', $endDate)
                    )
                    ->orderBy('purchase_date')
                    ->chunk(500, function ($rows) use ($out) {
                        foreach ($rows as $purchase) {
                            fputcsv($out, [
                                $purchase->invoice_number,
                                $purchase->purchase_date?->format('Y-m-d'),
                                $purchase->supplier?->name,
                                $purchase->total,
                                $purchase->notes,
                            ]);
                        }
                    });
            } else {
                fputcsv($out, [
                    'SKU', 'Nama Produk', 'Kategori',
                    'Stok', 'Stok Minimum', 'Harga'
                ]);

                Product::with('category')
                    ->when($search, fn ($q) =>
                        $q->where(function ($sub) use ($search) {
                            $sub->where('name', 'like', "%{$search}%")
                                ->orWhere('sku', 'like', "%{$search}%");
                        })
                    )
                    ->orderBy('name')
                    ->chunk(500, function ($rows) use ($out) {
                        foreach ($rows as $product) {
                            fputcsv($out, [
                                $product->sku,
                                $product->name,
                                $product->category?->name,
                                $product->stock,
                                $product->minimum_stock,
                                $product->price,
                            ]);
                        }
                    });
            }

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
