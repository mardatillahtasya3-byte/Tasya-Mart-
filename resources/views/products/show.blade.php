
@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 24px;">

    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:24px;">
        <div>
            <h1 style="margin:0 0 8px; color:#34465a;">Detail Produk</h1>
            <p style="margin:0; color:#718096;">
                Informasi lengkap produk TasyaShop.
            </p>
        </div>

        <div style="display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('products.index') }}"
               style="padding:10px 16px; background:#eaf0f5; color:#34465a; text-decoration:none; border-radius:8px;">
                Kembali
            </a>

            <a href="{{ route('products.edit', $product->id) }}"
               style="padding:10px 16px; background:#455a70; color:white; text-decoration:none; border-radius:8px;">
                Edit Produk
            </a>
        </div>
    </div>

    @if (session('success'))
        <div style="padding:12px; margin-bottom:16px; background:#e7f7ed; color:#216e39; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:white; border:1px solid #dce4ec; border-radius:12px; padding:24px;">
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:24px;">

            <div>
                <p style="color:#718096; margin-bottom:6px;">SKU</p>
                <h3 style="margin:0; color:#263746;">
                    {{ $product->sku }}
                </h3>
            </div>

            <div>
                <p style="color:#718096; margin-bottom:6px;">Nama Produk</p>
                <h3 style="margin:0; color:#263746;">
                    {{ $product->name }}
                </h3>
            </div>

            <div>
                <p style="color:#718096; margin-bottom:6px;">Kategori</p>
                <h3 style="margin:0; color:#263746;">
                    {{ $product->category->name ?? 'Tidak ada kategori' }}
                </h3>
            </div>

            <div>
                <p style="color:#718096; margin-bottom:6px;">Harga</p>
                <h3 style="margin:0; color:#263746;">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </h3>
            </div>

            <div>
                <p style="color:#718096; margin-bottom:6px;">Stok Saat Ini</p>
                <h3 style="margin:0; color:#263746;">
                    {{ $product->stock }}
                </h3>
            </div>

            <div>
                <p style="color:#718096; margin-bottom:6px;">Minimum Stok</p>
                <h3 style="margin:0; color:#263746;">
                    {{ $product->minimum_stock }}
                </h3>
            </div>

            <div>
                <p style="color:#718096; margin-bottom:6px;">Status Stok</p>

                @if ($product->stock <= $product->minimum_stock)
                    <span style="display:inline-block; padding:6px 12px; border-radius:20px; background:#fff0f0; color:#b42318;">
                        Stok Menipis
                    </span>
                @else
                    <span style="display:inline-block; padding:6px 12px; border-radius:20px; background:#e7f7ed; color:#216e39;">
                        Stok Aman
                    </span>
                @endif
            </div>

            <div>
                <p style="color:#718096; margin-bottom:6px;">Terakhir Diperbarui</p>
                <p style="margin:0; color:#263746;">
                    {{ $product->updated_at?->format('d-m-Y H:i') ?? '-' }}
                </p>
            </div>

        </div>
    </div>

</div>
@endsection
