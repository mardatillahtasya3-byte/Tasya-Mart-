
@extends('layouts.app')

@section('content')
<div class="supplier-page">

    {{-- HEADER --}}
    <div class="supplier-heading">
        <div>
            <h1>Tambah Supplier</h1>
            <p>Tambahkan data pemasok baru ke sistem Tasya Mart.</p>
        </div>

        <a href="{{ route('suppliers.index') }}" class="supplier-btn supplier-btn-light">
            Kembali
        </a>
    </div>

    {{-- PESAN BERHASIL --}}
    @if(session('success'))
        <div class="supplier-alert supplier-alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- PESAN ERROR: DITAMPILKAN SATU KALI --}}
    @if($errors->any())
        <div class="supplier-alert supplier-alert-error">
            <strong>Periksa kembali data yang dimasukkan.</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM TAMBAH SUPPLIER --}}
    <div class="supplier-card">

        <div class="supplier-card-header">
            <h2>Informasi Supplier</h2>
            <p>Lengkapi informasi supplier dengan benar.</p>
        </div>

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="supplier-form-body">

                <div class="supplier-form-grid">

                    {{-- NAMA --}}
                    <div class="supplier-form-group">
                        <label for="name">
                            Nama Supplier <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: PT Sumber Rezeki"
                            maxlength="255"
                            required
                            autofocus
                            class="@error('name') is-invalid @enderror"
                        >

                        @error('name')
                            <small class="supplier-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- TELEPON --}}
                    <div class="supplier-form-group">
                        <label for="phone">Nomor Telepon</label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Contoh: 081234567890"
                            maxlength="30"
                            class="@error('phone') is-invalid @enderror"
                        >

                        @error('phone')
                            <small class="supplier-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="supplier-form-group">
                        <label for="email">Email</label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Contoh: supplier@gmail.com"
                            maxlength="255"
                            class="@error('email') is-invalid @enderror"
                        >

                        @error('email')
                            <small class="supplier-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- ALAMAT --}}
                    <div class="supplier-form-group supplier-full-width">
                        <label for="address">Alamat Supplier</label>

                        <textarea
                            id="address"
                            name="address"
                            rows="4"
                            maxlength="1000"
                            placeholder="Masukkan alamat lengkap supplier"
                            class="@error('address') is-invalid @enderror"
                        >{{ old('address') }}</textarea>

                        @error('address')
                            <small class="supplier-field-error">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <p class="supplier-note">
                    <span class="required">*</span> Wajib diisi.
                </p>

            </div>

            {{-- TOMBOL --}}
            <div class="supplier-card-footer">
                <a href="{{ route('suppliers.index') }}"
                   class="supplier-btn supplier-btn-light">
                    Batal
                </a>

                <button type="submit" class="supplier-btn supplier-btn-primary">
                    Simpan Supplier
                </button>
            </div>

        </form>
    </div>

</div>

<style>
    .supplier-page {
        width: 100%;
        max-width: 1400px;
        margin: 0 auto;
        padding: 36px 32px 48px;
        box-sizing: border-box;
        color: #49372a;
    }

    .supplier-page * {
        box-sizing: border-box;
    }

    .supplier-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 30px;
    }

    .supplier-heading h1 {
        margin: 0 0 10px;
        color: #593824;
        font-size: 36px;
        line-height: 1.25;
        font-weight: 700;
    }

    .supplier-heading p {
        margin: 0;
        color: #856c58;
        font-size: 16px;
        line-height: 1.6;
    }

    .supplier-card {
        overflow: hidden;
        background: #fffdf9;
        border: 1px solid #eadbc8;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(89, 56, 36, 0.06);
    }

    .supplier-card-header {
        padding: 25px 30px;
        background: #efe2ce;
        border-bottom: 1px solid #e5d5c0;
    }

    .supplier-card-header h2 {
        margin: 0 0 8px;
        color: #593824;
        font-size: 23px;
        font-weight: 700;
    }

    .supplier-card-header p {
        margin: 0;
        color: #856c58;
        font-size: 15px;
        line-height: 1.6;
    }

    .supplier-form-body {
        padding: 30px;
    }

    .supplier-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 25px 28px;
    }

    .supplier-form-group {
        display: flex;
        flex-direction: column;
        min-width: 0;
        gap: 9px;
    }

    .supplier-full-width {
        grid-column: 1 / -1;
    }

    .supplier-form-group label {
        color: #593824;
        font-size: 15px;
        font-weight: 600;
    }

    .required {
        color: #79543e;
        font-weight: 700;
    }

    .supplier-form-group input,
    .supplier-form-group textarea {
        display: block;
        width: 100%;
        min-height: 48px;
        padding: 12px 15px;
        border: 1px solid #e2cfba;
        border-radius: 9px;
        outline: none;
        background: #fff;
        color: #49372a;
        font-family: inherit;
        font-size: 14px;
        line-height: 1.5;
        transition: border-color .2s, box-shadow .2s;
    }

    .supplier-form-group textarea {
        min-height: 110px;
        resize: vertical;
    }

    .supplier-form-group input::placeholder,
    .supplier-form-group textarea::placeholder {
        color: #aa9a8a;
    }

    .supplier-form-group input:focus,
    .supplier-form-group textarea:focus {
        border-color: #a78262;
        box-shadow: 0 0 0 3px rgba(121, 84, 62, 0.10);
    }

    .supplier-form-group .is-invalid {
        border-color: #c6a58a;
    }

    .supplier-field-error {
        color: #79543e;
        font-size: 13px;
        line-height: 1.5;
    }

    .supplier-note {
        margin: 24px 0 0;
        color: #856c58;
        font-size: 13px;
    }

    .supplier-card-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 22px 30px;
        background: #fcf8f2;
        border-top: 1px solid #eadbc8;
    }

    .supplier-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-height: 44px;
        padding: 11px 21px;
        border: 1px solid transparent;
        border-radius: 9px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
        text-decoration: none !important;
        cursor: pointer;
        transition: background .2s, border-color .2s, transform .2s;
    }

    .supplier-btn:hover {
        transform: translateY(-1px);
    }

    .supplier-btn-primary {
        background: #79543e;
        border-color: #79543e;
        color: #fff !important;
    }

    .supplier-btn-primary:hover {
        background: #593824;
        border-color: #593824;
    }

    .supplier-btn-light {
        background: #efe2ce;
        border-color: #e5d5c0;
        color: #593824 !important;
    }

    .supplier-btn-light:hover {
        background: #e5d2b7;
    }

    .supplier-alert {
        margin-bottom: 24px;
        padding: 17px 20px;
        border-radius: 10px;
        font-size: 14px;
        line-height: 1.7;
    }

    .supplier-alert ul {
        margin: 8px 0 0;
        padding-left: 22px;
    }

    .supplier-alert li + li {
        margin-top: 4px;
    }

    .supplier-alert-error {
        color: #79543e;
        background: #f7eee3;
        border: 1px solid #e5d2b7;
    }

    .supplier-alert-success {
        color: #365b43;
        background: #edf5ed;
        border: 1px solid #d2e4d2;
    }

    @media (max-width: 768px) {
        .supplier-page {
            padding: 24px 16px 36px;
        }

        .supplier-heading {
            align-items: flex-start;
        }

        .supplier-heading h1 {
            font-size: 28px;
        }

        .supplier-card-header,
        .supplier-form-body {
            padding: 22px 18px;
        }

        .supplier-form-grid {
            grid-template-columns: 1fr;
            gap: 22px;
        }

        .supplier-full-width {
            grid-column: auto;
        }

        .supplier-card-footer {
            padding: 18px;
        }

        .supplier-card-footer .supplier-btn {
            flex: 1;
        }
    }
</style>
@endsection
