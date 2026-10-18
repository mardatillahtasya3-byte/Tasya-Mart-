
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-header">
        <div>
            <h1>Tambah Produk</h1>
            <p>Masukkan informasi produk baru ke inventaris.</p>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            Kembali ke Produk
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            <strong>Periksa kembali input kamu:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="sku">SKU Produk</label>
                <input
                    type="text"
                    id="sku"
                    name="sku"
                    value="{{ old('sku') }}"
                    maxlength="50"
                    required
                >
                @error('sku')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    maxlength="150"
                    required
                >
                @error('name')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select id="category_id" name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id') == $category->id)
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Harga Produk (Rp)</label>
                <input
                    type="number"
                    id="price"
                    name="price"
                    value="{{ old('price') }}"
                    min="0"
                    step="0.01"
                    required
                >
                @error('price')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock">Jumlah Stok</label>
                <input
                    type="number"
                    id="stock"
                    name="stock"
                    value="{{ old('stock', 0) }}"
                    min="0"
                    step="1"
                    required
                >
                @error('stock')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="minimum_stock">Stok Minimum</label>
                <input
                    type="number"
                    id="minimum_stock"
                    name="minimum_stock"
                    value="{{ old('minimum_stock', 5) }}"
                    min="0"
                    step="1"
                    required
                >
                @error('minimum_stock')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan Produk
            </button>
        </form>
    </div>
</div>

<style>
.container {
    max-width: 850px;
    margin: 0 auto;
    padding: 30px 20px;
    font-family: Arial, sans-serif;
    color: #263746;
}
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 24px;
}
.page-header h1 {
    margin: 0 0 8px;
    color: #34465a;
}
.page-header p {
    margin: 0;
    color: #718096;
}
.card {
    padding: 25px;
    background: white;
    border: 1px solid #dce4ec;
    border-radius: 14px;
}
.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 20px;
}
.form-group label {
    font-size: 14px;
    font-weight: bold;
}
.form-group input,
.form-group select {
    width: 100%;
    box-sizing: border-box;
    min-height: 42px;
    padding: 10px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    background: #f8fafc;
}
.btn {
    display: inline-block;
    padding: 11px 16px;
    border: none;
    border-radius: 8px;
    background: #455a70;
    color: white;
    text-decoration: none;
    font-size: 13px;
    font-weight: bold;
    cursor: pointer;
}
.btn:hover {
    background: #34465a;
}
.btn-secondary {
    background: #e2e8f0;
    color: #334155;
}
.btn-secondary:hover {
    background: #cbd5e1;
}
.alert-error {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #fecaca;
    border-radius: 8px;
    background: #fef2f2;
    color: #991b1b;
}
.field-error {
    color: #b91c1c;
}
</style>
@endsection
