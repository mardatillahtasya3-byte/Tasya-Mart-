
@extends('layouts.app')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    .product-page {
        width: 100%;
        max-width: 1250px;
        margin: 0 auto;
        padding: 30px 20px;
        color: #263746;
        font-family: Arial, sans-serif;
    }

    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
    }

    .page-header h1 {
        margin: 0 0 8px;
        color: #34465a;
        font-size: 28px;
    }

    .page-header p {
        margin: 0;
        color: #718096;
        font-size: 14px;
    }

    /* Panel pencarian: setiap elemen memiliki kolom tersendiri */
    .filter-panel {
        display: grid;
        grid-template-columns:
            minmax(0, 1.25fr)
            minmax(0, 1fr)
            auto
            auto;
        align-items: end;
        gap: 14px;
        width: 100%;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #dce4ec;
        border-radius: 12px;
        background: #fff;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        min-width: 0;
        width: 100%;
    }

    .filter-group label {
        display: block;
        margin: 0;
        color: #475569;
        font-size: 12px;
        font-weight: bold;
    }

    .filter-group input,
    .filter-group select {
        display: block;
        width: 100%;
        min-width: 0;
        min-height: 44px;
        margin: 0;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background: #f8fafc;
        color: #334155;
        font-family: inherit;
        font-size: 13px;
        outline: none;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        border-color: #647f9e;
        box-shadow: 0 0 0 3px rgba(100, 127, 158, .12);
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        min-height: 40px;
        padding: 10px 14px;
        border: none;
        border-radius: 7px;
        background: #455a70;
        color: #fff;
        font-family: inherit;
        font-size: 12px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
        transition: background .2s;
    }

    .btn:hover {
        background: #34465a;
    }

    .btn-primary {
        background: #455a70;
        color: #fff;
    }

    .btn-primary:hover {
        background: #34465a;
    }

    .btn-light {
        background: #e2e8f0;
        color: #334155;
    }

    .btn-light:hover {
        background: #cbd5e1;
    }

    .btn-edit {
        background: #64748b;
        color: #fff;
    }

    .btn-edit:hover {
        background: #475569;
    }

    .btn-delete {
        background: #dc2626;
        color: #fff;
    }

    .btn-delete:hover {
        background: #b91c1c;
    }

    .alert {
        padding: 13px 16px;
        margin-bottom: 18px;
        border-radius: 8px;
        font-size: 13px;
    }

    .alert-success {
        border: 1px solid #bbf7d0;
        background: #f0fdf4;
        color: #166534;
    }

    .alert-error {
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #991b1b;
    }

    .error-list {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    .summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        padding: 18px 20px;
        border: 1px solid #dce4ec;
        border-radius: 12px 12px 0 0;
        background: #fff;
    }

    .summary h2 {
        margin: 0 0 5px;
        color: #34465a;
        font-size: 17px;
    }

    .summary p {
        margin: 0;
        color: #718096;
        font-size: 12px;
    }

    .count-badge {
        padding: 7px 12px;
        border-radius: 20px;
        background: #eaf0f5;
        color: #34465a;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #dce4ec;
        border-top: 0;
        border-radius: 0 0 12px 12px;
        background: #fff;
    }

    .product-table {
        width: 100%;
        border-collapse: collapse;
    }

    .product-table th {
        padding: 14px;
        background: #34465a;
        color: #fff;
        text-align: left;
        font-size: 11px;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .product-table td {
        padding: 14px;
        border-bottom: 1px solid #e2e8f0;
        color: #475569;
        text-align: left;
        vertical-align: middle;
        font-size: 13px;
    }

    .product-table tbody tr:hover {
        background: #f8fafc;
    }

    .product-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .product-name {
        min-width: 140px;
        color: #1e293b !important;
        font-weight: bold;
    }

    .sku {
        display: inline-block;
        padding: 5px 8px;
        border-radius: 6px;
        background: #f1f5f9;
        color: #475569;
        white-space: nowrap;
    }

    .price {
        color: #34465a;
        font-weight: bold;
        white-space: nowrap;
    }

    .stock-badge,
    .status-badge {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .stock-normal,
    .status-normal {
        background: #dcfce7;
        color: #166534;
    }

    .stock-low,
    .status-low {
        background: #fef2f2;
        color: #b91c1c;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }

    .action-buttons form {
        margin: 0;
    }

    .empty-state {
        padding: 40px 20px !important;
        color: #718096 !important;
        text-align: center !important;
    }

    .pagination-wrapper {
        padding: 18px 20px;
        border-top: 1px solid #e2e8f0;
        background: #fff;
    }

    .pagination-info {
        margin-bottom: 12px;
        color: #718096;
        font-size: 12px;
    }

    @media (max-width: 900px) {
        .filter-panel {
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        }

        .filter-panel .btn {
            width: 100%;
        }
    }

    @media (max-width: 600px) {
        .product-page {
            padding: 20px 10px;
        }

        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-header h1 {
            font-size: 24px;
        }

        .filter-panel {
            grid-template-columns: minmax(0, 1fr);
            gap: 14px;
            padding: 15px;
        }

        .filter-group {
            width: 100%;
        }

        .filter-panel .btn {
            width: 100%;
        }

        .product-table th,
        .product-table td {
            padding: 12px;
        }
    }
</style>

<div class="product-page">

    {{-- Header halaman --}}
    <header class="page-header">
        <div>
            <h1>Daftar Produk</h1>
            <p>Kelola produk dan pantau persediaan inventaris.</p>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Tambah Produk
        </a>
    </header>

    {{-- Notifikasi berhasil --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi gagal --}}
    @if (session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    {{-- Pesan validasi --}}
    @if ($errors->any())
        <div class="alert alert-error">
            <strong>Periksa kembali data yang dimasukkan:</strong>

            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form pencarian dan filter --}}
    <form
        method="GET"
        action="{{ route('products.index') }}"
        class="filter-panel"
    >

        <div class="filter-group">
            <label for="search">Cari Produk</label>

            <input
                type="text"
                id="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Nama produk atau SKU..."
            >
        </div>

        <div class="filter-group">
            <label for="category_id">Kategori</label>

            <select id="category_id" name="category_id">
                <option value="">Semua Kategori</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(
                            (string) request('category_id') ===
                            (string) $category->id
                        )
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">
            Cari
        </button>

        <a href="{{ route('products.index') }}" class="btn btn-light">
            Reset
        </a>

    </form>

    {{-- Ringkasan jumlah produk --}}
    <section class="summary">
        <div>
            <h2>Daftar Produk</h2>
            <p>Informasi produk yang tersimpan di database.</p>
        </div>

        <span class="count-badge">
            {{ $products->total() }} Produk
        </span>
    </section>

    {{-- Tabel produk --}}
    <div class="table-wrapper">

        <table class="product-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>SKU</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Stok Minimum</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            {{ $products->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <span class="sku">
                                {{ $product->sku ?: '-' }}
                            </span>
                        </td>

                        <td class="product-name">
                            {{ $product->name }}
                        </td>

                        <td>
                            {{ $product->category?->name ?? '-' }}
                        </td>

                        <td class="price">
                            Rp {{ number_format((float) $product->price, 0, ',', '.') }}
                        </td>

                        <td>
                            @if ((int) $product->stock <= (int) $product->minimum_stock)
                                <span class="stock-badge stock-low">
                                    {{ number_format((int) $product->stock) }}
                                </span>
                            @else
                                <span class="stock-badge stock-normal">
                                    {{ number_format((int) $product->stock) }}
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ number_format((int) $product->minimum_stock) }}
                        </td>

                        <td>
                            @if ((int) $product->stock <= (int) $product->minimum_stock)
                                <span class="status-badge status-low">
                                    Stok Menipis
                                </span>
                            @else
                                <span class="status-badge status-normal">
                                    Tersedia
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="action-buttons">

                                <a
                                    href="{{ route('products.show', $product) }}"
                                    class="btn"
                                >
                                    Detail
                                </a>

                                <a
                                    href="{{ route('products.edit', $product) }}"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('products.destroy', $product) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-delete">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="9" class="empty-state">
                            @if (request('search') || request('category_id'))
                                Produk tidak ditemukan.
                                Coba ubah kata pencarian atau kategori.
                            @else
                                Belum ada data produk.
                                Klik tombol Tambah Produk untuk memulai.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        @if ($products->hasPages())
            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Menampilkan {{ $products->firstItem() }}–{{ $products->lastItem() }}
                    dari {{ $products->total() }} produk
                </div>

                {{ $products->links() }}
            </div>
        @endif

    </div>

</div>
@endsection
