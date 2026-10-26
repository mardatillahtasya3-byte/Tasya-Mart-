
@extends('layouts.app')

@section('content')
<div class="container" style="max-width:1200px; margin:auto; padding:30px 20px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:15px; flex-wrap:wrap; margin-bottom:25px;">
        <div>
            <h1 style="color:#4b3022; margin:0 0 8px;">Data Penjualan</h1>
            <p style="color:#846c5b; margin:0;">Kelola transaksi penjualan Tasya Mart.</p>
        </div>
        <a href="{{ route('sales.create') }}"
           style="background:#674630; color:white; padding:12px 18px; border-radius:9px; text-decoration:none; font-weight:bold;">
            + Tambah Penjualan
        </a>
    </div>

    @if(session('success'))
        <div style="background:#e4f4e5; color:#245b2b; padding:14px; border-radius:8px; margin-bottom:18px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#fbe7e3; color:#9b3328; padding:14px; border-radius:8px; margin-bottom:18px;">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fbe7e3; color:#9b3328; padding:14px; border-radius:8px; margin-bottom:18px;">
            <strong>Periksa kembali data:</strong>
            <ul style="margin-bottom:0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="overflow-x:auto; background:#fffaf4; border:1px solid #ead8c5; border-radius:14px;">
        <table style="width:100%; border-collapse:collapse; min-width:700px;">
            <thead style="background:#efe0ce;">
                <tr>
                    <th style="padding:16px; text-align:left;">No. Invoice</th>
                    <th style="padding:16px; text-align:left;">Tanggal</th>
                    <th style="padding:16px; text-align:left;">Jumlah Jenis Barang</th>
                    <th style="padding:16px; text-align:right;">Total</th>
                    <th style="padding:16px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr style="border-top:1px solid #eadfd3;">
                        <td style="padding:16px;">{{ $sale->invoice_number }}</td>
                        <td style="padding:16px;">{{ $sale->sale_date->format('d-m-Y') }}</td>
                        <td style="padding:16px;">{{ $sale->items_count }}</td>
                        <td style="padding:16px; text-align:right;">
                            Rp {{ number_format((float)$sale->total, 0, ',', '.') }}
                        </td>
                        <td style="padding:16px; text-align:center;">
                            <a href="{{ route('sales.show', $sale) }}"
                               style="display:inline-block; background:#eadbc9; color:#4b3022; padding:9px 13px; border-radius:7px; text-decoration:none; font-weight:bold;">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding:30px; text-align:center; color:#846c5b;">
                            Belum ada transaksi penjualan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $sales->links() }}
    </div>
</div>
@endsection
