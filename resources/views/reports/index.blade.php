
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search / Report - Tasya Mart</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #f8f0e5;
            color: #40291e;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            max-width: 1250px;
            margin: auto;
        }

        .header {
            background: #40291e;
            color: #fffdf9;
            padding: 28px;
            border-radius: 16px;
            margin-bottom: 24px;
            border-top: 6px solid #bda58d;
        }

        .header h1 {
            margin: 0 0 10px;
            font-size: 30px;
        }

        .header p {
            margin: 0;
            color: #eadbc9;
            line-height: 1.6;
        }

        .card {
            background: #fffdf9;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid #eadbc9;
            border-radius: 14px;
            box-shadow: 0 4px 12px rgba(64, 41, 30, 0.06);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 21px;
            color: #40291e;
        }

        .filters {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 16px;
            align-items: end;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d9c5ad;
            border-radius: 8px;
            background: #ffffff;
            color: #40291e;
            font-size: 14px;
        }

        input:focus {
            outline: 2px solid #bda58d;
            border-color: #805b42;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 8px;
            background: #805b42;
            color: #ffffff;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            background: #40291e;
            color: #ffffff;
        }

        .btn-light {
            background: #eadbc9;
            color: #40291e;
        }

        .btn-light:hover {
            background: #d9c5ad;
            color: #40291e;
        }

        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: #fffdf9;
            border: 1px solid #eadbc9;
            border-left: 6px solid #805b42;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(64, 41, 30, 0.05);
        }

        .summary-label {
            color: #806b59;
            font-size: 14px;
            font-weight: bold;
        }

        .summary-value {
            margin-top: 14px;
            font-size: 27px;
            font-weight: bold;
            color: #40291e;
            overflow-wrap: anywhere;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid #eadbc9;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #efe2d1;
            color: #40291e;
            font-weight: bold;
        }

        tbody tr:hover {
            background: #fbf4eb;
        }

        .empty {
            padding: 24px;
            text-align: center;
            color: #806b59;
        }

        .pagination {
            margin-top: 20px;
            overflow-x: auto;
        }

        .pagination nav > div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination a,
        .pagination span {
            color: #805b42;
        }

        .alert {
            padding: 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #f7e5df;
            color: #8b3024;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #806b59;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .header,
            .card,
            .summary-card {
                padding: 18px;
            }

            .header h1 {
                font-size: 25px;
            }

            .summary-value {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <h1>Search / Report</h1>
        <p>Tasya Mart — Inventory Management</p>
        <p>Pencarian transaksi, laporan penjualan, pembelian, dan stok barang.</p>
    </div>

    @if ($errors->any())
        <div class="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- PENCARIAN DAN FILTER --}}
    <div class="card">
        <h2>Pencarian dan Filter Laporan</h2>

        <form action="{{ route('reports.index') }}" method="GET">
            <div class="filters">
                <div>
                    <label for="search">Nomor invoice / SKU / nama produk</label>
                    <input
                        id="search"
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Masukkan kata kunci"
                    >
                </div>

                <div>
                    <label for="start_date">Tanggal awal</label>
                    <input
                        id="start_date"
                        type="date"
                        name="start_date"
                        value="{{ $startDate }}"
                    >
                </div>

                <div>
                    <label for="end_date">Tanggal akhir</label>
                    <input
                        id="end_date"
                        type="date"
                        name="end_date"
                        value="{{ $endDate }}"
                    >
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn">Cari Data</button>
                    <a href="{{ route('reports.index') }}"
                       class="btn btn-light">Reset</a>
                </div>
            </div>
        </form>
    </div>

    {{-- RINGKASAN --}}
    <div class="summary">
        <div class="summary-card">
            <div class="summary-label">Total Penjualan</div>
            <div class="summary-value">
                Rp {{ number_format((float) $salesTotal, 0, ',', '.') }}
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Total Pembelian</div>
            <div class="summary-value">
                Rp {{ number_format((float) $purchasesTotal, 0, ',', '.') }}
            </div>
        </div>
    </div>

    {{-- LAPORAN PENJUALAN --}}
    <div class="card">
        <h2>Laporan Penjualan</h2>

        <div class="btn-group">
            <a class="btn"
               href="{{ route('reports.export', [
                   'type' => 'sales',
                   'search' => $search,
                   'start_date' => $startDate,
                   'end_date' => $endDate
               ]) }}">
                Unduh CSV Penjualan
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Invoice</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Catatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sales as $sale)
                        <tr>
                            <td>{{ $sales->firstItem() + $loop->index }}</td>
                            <td>{{ $sale->invoice_number }}</td>
                            <td>{{ $sale->sale_date?->format('d-m-Y') }}</td>
                            <td>
                                Rp {{ number_format((float) $sale->total, 0, ',', '.') }}
                            </td>
                            <td>{{ $sale->notes ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">
                                Belum ada data penjualan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">{{ $sales->links() }}</div>
    </div>

    {{-- LAPORAN PEMBELIAN --}}
    <div class="card">
        <h2>Laporan Pembelian</h2>

        <div class="btn-group">
            <a class="btn"
               href="{{ route('reports.export', [
                   'type' => 'purchases',
                   'search' => $search,
                   'start_date' => $startDate,
                   'end_date' => $endDate
               ]) }}">
                Unduh CSV Pembelian
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Invoice</th>
                        <th>Tanggal</th>
                        <th>Pemasok</th>
                        <th>Total</th>
                        <th>Catatan</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($purchases as $purchase)
                        <tr>
                            <td>{{ $purchases->firstItem() + $loop->index }}</td>
                            <td>{{ $purchase->invoice_number }}</td>
                            <td>{{ $purchase->purchase_date?->format('d-m-Y') }}</td>
                            <td>{{ $purchase->supplier?->name ?? '-' }}</td>
                            <td>
                                Rp {{ number_format((float) $purchase->total, 0, ',', '.') }}
                            </td>
                            <td>{{ $purchase->notes ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada data pembelian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">{{ $purchases->links() }}</div>
    </div>

    {{-- LAPORAN STOK --}}
    <div class="card">
        <h2>Laporan Stok Barang</h2>

        <div class="btn-group">
            <a class="btn"
               href="{{ route('reports.export', [
                   'type' => 'stock',
                   'search' => $search
               ]) }}">
                Unduh CSV Stok
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Stok Minimum</th>
                        <th>Harga</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $products->firstItem() + $loop->index }}</td>
                            <td>{{ $product->sku }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category?->name ?? '-' }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->minimum_stock }}</td>
                            <td>
                                Rp {{ number_format((float) $product->price, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty">
                                Belum ada data produk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">{{ $products->links() }}</div>
    </div>

    <div class="btn-group">
        <a href="{{ route('dashboard') }}" class="btn btn-light">
            Kembali ke Dashboard
        </a>
    </div>

    <div class="footer">
        © {{ date('Y') }} Tasya Mart — Inventory Management
    </div>

</div>
</body>
</html>
