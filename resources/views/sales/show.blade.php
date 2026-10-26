
@extends('layouts.app')

@section('content')
<div class="container" style="max-width:1100px; margin:auto; padding:30px 20px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:15px; flex-wrap:wrap; margin-bottom:25px;">
        <div>
            <h1 style="color:#4b3022; margin:0 0 8px;">Detail Penjualan</h1>
            <p style="color:#846c5b; margin:0;">Invoice: {{ $sale->invoice_number }}</p>
        </div>
        <a href="{{ route('sales.index') }}"
           style="background:#674630; color:white; padding:12px 18px; border-radius:8px; text-decoration:none;">
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div style="background:#e4f4e5; color:#245b2b; padding:14px; border-radius:8px; margin-bottom:18px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:#fffaf4; border:1px solid #ead8c5; border-radius:14px; padding:22px; margin-bottom:22px;">
        <p><strong>Nomor Invoice:</strong> {{ $sale->invoice_number }}</p>
        <p><strong>Tanggal:</strong> {{ $sale->sale_date->format('d-m-Y') }}</p>
        <p><strong>Catatan:</strong> {{ $sale->notes ?: '-' }}</p>
    </div>

    <div style="overflow-x:auto; background:#fffaf4; border:1px solid #ead8c5; border-radius:14px;">
        <table style="width:100%; border-collapse:collapse; min-width:600px;">
            <thead style="background:#efe0ce;">
                <tr>
                    <th style="padding:15px; text-align:left;">Nama Produk</th>
                    <th style="padding:15px; text-align:right;">Harga Satuan</th>
                    <th style="padding:15px; text-align:center;">Jumlah</th>
                    <th style="padding:15px; text-align:right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                    <tr style="border-top:1px solid #eadfd3;">
                        <td style="padding:15px;">
                            {{ $item->product->name ?? 'Produk tidak tersedia' }}
                        </td>
                        <td style="padding:15px; text-align:right;">
                            Rp {{ number_format((float)$item->unit_price, 0, ',', '.') }}
                        </td>
                        <td style="padding:15px; text-align:center;">
                            {{ $item->quantity }}
                        </td>
                        <td style="padding:15px; text-align:right;">
                            Rp {{ number_format((float)$item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background:#efe0ce;">
                    <th colspan="3" style="padding:17px; text-align:right;">TOTAL</th>
                    <th style="padding:17px; text-align:right; color:#4b3022;">
                        Rp {{ number_format((float)$sale->total, 0, ',', '.') }}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
