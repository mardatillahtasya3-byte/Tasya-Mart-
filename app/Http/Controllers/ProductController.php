<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = trim($request->input('search'));

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('sku', 'like', '%' . $search . '%');
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name', 'asc')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'sku' => trim((string) $request->input('sku')),
        ]);

        $validated = $request->validate([
            'sku' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:150'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
        ]);

        $skuExists = Product::whereRaw(
            'LOWER(sku) = ?',
            [strtolower($validated['sku'])]
        )->exists();

        if ($skuExists) {
            return back()
                ->withErrors(['sku' => 'SKU sudah digunakan oleh produk lain.'])
                ->withInput();
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'asc')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->merge([
            'sku' => trim((string) $request->input('sku')),
        ]);

        $validated = $request->validate([
            'sku' => ['required', 'string', 'max:50'],
            'name' => ['required', 'string', 'max:150'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'minimum_stock' => ['required', 'integer', 'min:0'],
        ]);

        $skuExists = Product::whereRaw(
            'LOWER(sku) = ?',
            [strtolower($validated['sku'])]
        )
            ->where('id', '!=', $product->id)
            ->exists();

        if ($skuExists) {
            return back()
                ->withErrors(['sku' => 'SKU sudah digunakan oleh produk lain.'])
                ->withInput();
        }

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()
                ->route('products.index')
                ->with('success', 'Produk berhasil dihapus.');
        } catch (\Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Produk gagal dihapus. Silakan periksa log Laravel.'
            );
        }
    }
}
