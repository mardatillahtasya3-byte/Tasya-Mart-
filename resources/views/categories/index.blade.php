
@extends('layouts.app')

@section('content')
<div class="container" style="padding-top:24px; padding-bottom:24px;">

    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:20px;">
        <div>
            <h1>Daftar Produk TasyaShop</h1>
            <p>Kelola produk, kategori, harga, dan stok.</p>
        </div>

        <a href="{{ route('products.create') }}"
           style="background:#455a70; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
            + Tambah Produk
        </a>
    </div>

    @if (session('success'))
        <div style="padding:12px; margin-bottom:16px; background:#e7f7ed; color:#216e39; border-radius:8px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="padding:12px; margin-bottom:16px; background:#fff0f0; color:#b42318; border-radius:8px;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="padding:12px; margin-bottom:16px; background:#fff0f0; color:#b42318; border-radius:8px;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="GET"
          action="{{ route('products.index') }}"
          style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px;">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama atau SKU produk..."
            style="flex:1; min-width:200px; padding:10px; border:1px solid #cbd5e0; border-radius:8px;"
        >

        <select
            name="category_id"
            style="min-width:180px; padding:10px; border:1px solid #cbd5e0; border-radius:8px;">

            <option value="">Semua Kategori</option>

            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit"
                style="padding:10px 16px; background:#455a70; color:white; border:0; border-radius:8px; cursor:pointer;">
            Cari / Filter
        </button>

        <a href="{{ route('products.index') }}"
           style="padding:10px 16px; background:#eaf0f5; color:#34465a; border-radius:8px; text-decoration:none;">
            Reset
        </a>
    </form>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; background:white;">
            <thead>
                <tr style="background:#edf2f7; text-align:left;">
                    <th style="padding:12px; border:1px solid #dce4ec;">No.</th>
                    <th style="padding:12px; border:1px solid #dce4ec;">SKU</th>
                    <th style="padding:12px; border:1px solid #dce4ec;">Nama Produk</th>
                    <th style="padding:12px; border:1px solid #dce4ec;">Kategori</th>
                    <th style="padding:12px; border:1px solid #dce4ec;">Harga</th>
                    <th style="padding:12px; border:1px solid #dce4ec;">Stok</th>
                    <th style="padding:12px; border:1px solid #dce4ec;">Status</th>
                    <th style="padding:12px; border:1px solid #dce4ec;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td style="padding:12px; border:1px solid #dce4ec;">
                            {{ $products->firstItem() + $loop->index }}
                        </td>

                        <td style="padding:12px; border:1px solid #dce4ec;">
                            {{ $product->sku }}
                        </td>

                        <td style="padding:12px; border:1px solid #dce4ec;">
                            {{ $product->name }}
                        </td>

                        <td style="padding:12px; border:1px solid #dce4ec;">
                            {{ $product->category->name ?? '-' }}
                        </td>

                        <td style="padding:12px; border:1px solid #dce4ec;">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td style="padding:12px; border:1px solid #dce4ec;">
                            {{ $product->stock }}
                        </td>

                        <td style="padding:12px; border:1px solid #dce4ec;">
                            @if ($product->stock <= $product->minimum_stock)
                                <span style="color:#b42318;">Stok Menipis</span>
                            @else
                                <span style="color:#216e39;">Stok Aman</span>
                            @endif
                        </td>

                        <td style="padding:12px; border:1px solid #dce4ec; white-space:nowrap;">
                            <a href="{{ route('products.show', $product->id) }}">Detail</a>
                            |
                            <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                            |
                            <form
                                action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        style="background:none; border:none; color:#b42318; cursor:pointer;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8"
                            style="padding:20px; text-align:center; border:1px solid #dce4ec;">
                            Tidak ada produk yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        <p>
            Menampilkan {{ $products->firstItem() ?? 0 }}
            sampai {{ $products->lastItem() ?? 0 }}
            dari {{ $products->total() }} produk.
        </p>

        {{ $products->links() }}
    </div>

</div>
@endsection
