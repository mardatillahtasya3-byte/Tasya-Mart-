
@extends('layouts.app')

@section('content')
<div class="tm-page">
    <div class="tm-heading">
        <div>
            <h1>Detail Pembelian</h1>
            <p>Invoice: {{ $purchase->invoice_number }}</p>
        </div>
        <a class="tm-btn secondary" href="{{ route('purchases.index') }}">
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="tm-alert success">{{ session('success') }}</div>
    @endif

    <div class="tm-card tm-form-card">
        <p><strong>Invoice:</strong> {{ $purchase->invoice_number }}</p>
        <p><strong>Supplier:</strong> {{ $purchase->supplier->name }}</p>
        <p>
            <strong>Tanggal:</strong>
            {{ $purchase->purchase_date->format('d-m-Y') }}
        </p>
        <p><strong>Catatan:</strong> {{ $purchase->notes ?: '-' }}</p>

        <div class="tm-table-wrap">
            <table class="tm-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchase->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                Rp {{ number_format((float) $item->unit_cost, 2, ',', '.') }}
                            </td>
                            <td>
                                Rp {{ number_format((float) $item->subtotal, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total Pembelian</th>
                        <th>
                            Rp {{ number_format((float) $purchase->total, 2, ',', '.') }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
