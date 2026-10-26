<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalStock = Product::sum('stock');

        // Produk dengan stok menipis
        $lowStockProducts = Product::query()
            ->whereColumn('stock', '<=', 'minimum_stock')
            ->orderBy('stock', 'asc')
            ->get();

        $lowStockCount = $lowStockProducts->count();

        // Data grafik: maksimal 8 produk
        $chartProducts = Product::query()
            ->select('id', 'name', 'stock', 'minimum_stock')
            ->orderBy('name', 'asc')
            ->limit(8)
            ->get();

        // Produk terbaru
        $latestProducts = Product::with('category')
            ->latest('id')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'lowStockProducts',
            'lowStockCount',
            'chartProducts',
            'latestProducts'
        ));
    }
}