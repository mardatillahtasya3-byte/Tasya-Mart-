
@extends('layouts.app')

@section('content')
<div style="max-width:900px; margin:0 auto; padding:24px;">

    <div style="margin-bottom:24px;">
        <h1 style="margin:0 0 8px; color:#34465a;">Edit Produk</h1>
        <p style="margin:0; color:#718096;">
            Perbarui informasi produk TasyaShop.
        </p>
    </div>

    @if ($errors->any())
        <div style="padding:14px; margin-bottom:20px; background:#fff0f0; color:#b42318; border-radius:8px;">
            <strong>Periksa kembali data yang diisi:</strong>
            <ul style="margin-bottom:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          style="background:white; border:1px solid #dce4ec; border-radius:12px; padding:24px;">

        @csrf
        @method('PUT')

        <div style="margin-bottom:18px;">
            <label for="sku" style="display:block; margin-bottom:8px; color:#34465a; font-weight:600;">
                SKU Produk
            </label>
            <input
                type="text"
                id="sku"
                name="sku"
                value="{{ old('sku', $product->sku) }}"
                required
                maxlength="50"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e0; border-radius:8px;"
            >
        </div>

        <div style="margin-bottom:18px;">
            <label for="name" style="display:block; margin-bottom:8px; color:#34465a; font-weight:600;">
                Nama Produk
            </label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $product->name) }}"
                required
                maxlength="150"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e0; border-radius:8px;"
            >
        </div>

        <div style="margin-bottom:18px;">
            <label for="category_id" style="display:block; margin-bottom:8px; color:#34465a; font-weight:600;">
                Kategori
            </label>
            <select
                id="category_id"
                name="category_id"
                required
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e0; border-radius:8px;"
            >
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ (string) old('category_id', $product->category_id) === (string) $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:18px;">
            <label for="price" style="display:block; margin-bottom:8px; color:#34465a; font-weight:600;">
                Harga (Rp)
            </label>
            <input
                type="number"
                id="price"
                name="price"
                value="{{ old('price', $product->price) }}"
                required
                min="0"
                step="0.01"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e0; border-radius:8px;"
            >
        </div>

        <div style="margin-bottom:18px;">
            <label for="stock" style="display:block; margin-bottom:8px; color:#34465a; font-weight:600;">
                Stok
            </label>
            <input
                type="number"
                id="stock"
                name="stock"
                value="{{ old('stock', $product->stock) }}"
                required
                min="0"
                step="1"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e0; border-radius:8px;"
            >
        </div>

        <div style="margin-bottom:24px;">
            <label for="minimum_stock" style="display:block; margin-bottom:8px; color:#34465a; font-weight:600;">
                Minimum Stok
            </label>
            <input
                type="number"
                id="minimum_stock"
                name="minimum_stock"
                value="{{ old('minimum_stock', $product->minimum_stock) }}"
                required
                min="0"
                step="1"
                style="width:100%; box-sizing:border-box; padding:12px; border:1px solid #cbd5e0; border-radius:8px;"
            >
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <button
                type="submit"
                style="padding:12px 20px; border:0; border-radius:8px; background:#455a70; color:white; cursor:pointer;"
            >
                Simpan Perubahan
            </button>

            <a
                href="{{ route('products.show', $product->id) }}"
                style="padding:12px 20px; border-radius:8px; background:#eaf0f5; color:#34465a; text-decoration:none;"
            >
                Batal
            </a>
        </div>

    </form>
</div>
@endsection
