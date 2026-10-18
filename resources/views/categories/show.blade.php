
@extends('layouts.app')

@section('content')
<style>
.category-page{max-width:1000px;margin:auto;padding:30px 20px;font-family:Arial,sans-serif;color:#263746}
.card{margin-bottom:20px;padding:22px;border:1px solid #dce4ec;border-radius:12px;background:#fff}
h1,h2{color:#34465a}
.muted{color:#718096;font-size:13px}
.btn{display:inline-block;padding:10px 14px;border:0;border-radius:7px;background:#455a70;color:#fff;text-decoration:none;font-size:12px;font-weight:bold}
.btn-light{background:#e2e8f0;color:#334155}
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse}
th,td{padding:13px;border-bottom:1px solid #e2e8f0;text-align:left;font-size:13px}
th{background:#34465a;color:#fff}
</style>

<div class="category-page">
    <a href="{{ route('categories.index') }}" class="btn btn-light">← Kembali</a>

    <section class="card">
        <h1>{{ $category->name }}</h1>
        <p class="muted">Detail kategori dan daftar produk yang terkait.</p>
        <p><strong>Jumlah produk:</strong> {{ $category->products()->count() }}</p>
        <a href="{{ route('categories.edit', $category) }}" class="btn">Edit Kategori</a>
    </section>

    <section class="card">
        <h2>Produk dalam Kategori Ini</h2>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->sku ?: '-' }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Belum ada produk dalam kategori ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $products->links() }}
    </section>
</div>
@endsection
