@extends('layouts.app')

@section('content')
<div class="tm-page">
    <div class="tm-heading">
        <div>
            <h1>Edit Supplier</h1>
            <p>Perbarui informasi pemasok barang Tasya Mart.</p>
        </div>

        <a href="{{ route('suppliers.index') }}" class="tm-btn secondary">
            Kembali
        </a>
    </div>

    <div class="tm-form-card">
        <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="tm-form-group">
                <label for="name">Nama Supplier *</label>
                <input
                    class="tm-input"
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $supplier->name) }}"
                    required
                    maxlength="150"
                >
                @error('name')
                    <p class="tm-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="tm-form-group">
                <label for="phone">Nomor Telepon</label>
                <input
                    class="tm-input"
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $supplier->phone) }}"
                    maxlength="30"
                >
                @error('phone')
                    <p class="tm-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="tm-form-group">
                <label for="email">Email</label>
                <input
                    class="tm-input"
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $supplier->email) }}"
                    maxlength="255"
                >
                @error('email')
                    <p class="tm-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="tm-form-group">
                <label for="address">Alamat</label>
                <textarea
                    class="tm-input"
                    id="address"
                    name="address"
                    rows="4"
                    maxlength="5000"
                >{{ old('address', $supplier->address) }}</textarea>
                @error('address')
                    <p class="tm-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="tm-actions">
                <button type="submit" class="tm-btn">
                    Simpan Perubahan
                </button>

                <a href="{{ route('suppliers.index') }}" class="tm-btn secondary">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
