
@extends('layouts.app')

@section('content')
<div class="tm-page">
    <div class="tm-heading">
        <div>
            <h1>Pembelian Baru</h1>
            <p>Stok bertambah setelah transaksi tersimpan.</p>
        </div>
        <a class="tm-btn secondary" href="{{ route('purchases.index') }}">
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="tm-alert error">
            <strong>Periksa data berikut:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="tm-alert error">{{ session('error') }}</div>
    @endif

    @if($suppliers->isEmpty())
        <div class="tm-alert error">
            Tambahkan supplier terlebih dahulu.
            <a href="{{ route('suppliers.create') }}">Tambah supplier</a>
        </div>
    @elseif($products->isEmpty())
        <div class="tm-alert error">
            Tambahkan produk terlebih dahulu di menu Produk.
        </div>
    @else
        <div class="tm-card tm-form-card">
            <form action="{{ route('purchases.store') }}" method="POST">
                @csrf

                <label class="tm-label" for="supplier_id">Supplier *</label>
                <select class="tm-input" id="supplier_id" name="supplier_id" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}"
                            @selected(old('supplier_id') == $supplier->id)>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>

                <label class="tm-label" for="purchase_date">
                    Tanggal Pembelian *
                </label>
                <input class="tm-input" type="date" id="purchase_date"
                       name="purchase_date"
                       value="{{ old('purchase_date', now()->toDateString()) }}"
                       required>

                <label class="tm-label" for="notes">Catatan</label>
                <textarea class="tm-input" id="notes" name="notes"
                          rows="3">{{ old('notes') }}</textarea>

                <h2 class="tm-subheading">Rincian Barang</h2>

                <div class="tm-table-wrap">
                    <table class="tm-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Beli / Unit (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>
                                        <select class="tm-input" name="product_id[]">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}"
                                                    @selected(old('product_id.'.$i) == $product->id)>
                                                    {{ $product->name }}
                                                    (stok: {{ $product->stock }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="tm-input" type="number"
                                               name="quantity[]" min="1" max="1000000"
                                               value="{{ old('quantity.'.$i) }}"
                                               placeholder="0">
                                    </td>
                                    <td>
                                        <input class="tm-input" type="number"
                                               name="unit_cost[]" min="0"
                                               max="999999999999.99" step="0.01"
                                               value="{{ old('unit_cost.'.$i) }}"
                                               placeholder="0">
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <p class="tm-help">
                    Isi minimal satu baris lengkap. Baris kosong boleh dibiarkan.
                    Setiap produk hanya boleh dipilih satu kali per transaksi.
                </p>

                <button class="tm-btn" type="submit"
                        onclick="return confirm('Simpan pembelian dan tambahkan stok?')">
                    Simpan Pembelian
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
