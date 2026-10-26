@extends('layouts.app')

@section('title', 'Dashboard - Tasya Mart')

@section('content')
<style>
    .dashboard {
        color: #4b3628;
    }

    .dashboard-header {
        margin-bottom: 24px;
    }

    .dashboard-header h1 {
        margin: 0 0 8px;
        color: #5b3926;
        font-size: 28px;
        font-weight: 700;
    }

    .dashboard-header p {
        margin: 0;
        color: #806b5b;
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 28px;
    }

    .dashboard-card {
        padding: 22px;
        background: #fffaf3;
        border: 1px solid #eadbc9;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(91, 57, 38, 0.06);
    }

    .dashboard-card .card-icon {
        margin-bottom: 12px;
        font-size: 28px;
    }

    .dashboard-card .card-label {
        margin-bottom: 8px;
        color: #806b5b;
        font-size: 14px;
    }

    .dashboard-card .card-value {
        color: #5b3926;
        font-size: 30px;
        font-weight: 700;
    }

    .dashboard-section {
        margin-bottom: 24px;
        padding: 22px;
        background: #fffaf3;
        border: 1px solid #eadbc9;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(91, 57, 38, 0.06);
    }

    .dashboard-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
    }

    .dashboard-section-header h2 {
        margin: 0;
        color: #5b3926;
        font-size: 20px;
        font-weight: 700;
    }

    .dashboard-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 24px;
    }

    .dashboard-btn {
        display: inline-block;
        padding: 10px 16px;
        border: 1px solid #70482f;
        border-radius: 8px;
        background: #70482f;
        color: #fffaf3;
        font-size: 14px;
        text-decoration: none;
        transition: background 0.2s ease;
    }

    .dashboard-btn:hover {
        background: #563522;
        color: #fff;
    }

    .dashboard-btn-secondary {
        background: #f3e7d7;
        color: #5b3926;
    }

    .dashboard-btn-secondary:hover {
        background: #e8d5bd;
        color: #4b3628;
    }

    .dashboard-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
    }

    .dashboard-table th,
    .dashboard-table td {
        padding: 13px 12px;
        border-bottom: 1px solid #eadbc9;
        text-align: left;
        white-space: nowrap;
    }

    .dashboard-table th {
        background: #f3e7d7;
        color: #5b3926;
        font-size: 13px;
    }

    .dashboard-table td {
        color: #604a3a;
        font-size: 14px;
    }

    .dashboard-table tbody tr:hover {
        background: #fff4e5;
    }

    .stock-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        background: #e1f2df;
        color: #27632a;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-badge-low {
        background: #ffeadc;
        color: #a3421c;
    }

    .dashboard-empty {
        padding: 24px;
        color: #806b5b;
        text-align: center;
    }

    @media (max-width: 1000px) {
        .dashboard-cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .dashboard-cards {
            grid-template-columns: 1fr;
        }

        .dashboard-card {
            padding: 18px;
        }

        .dashboard-section {
            padding: 16px;
        }

        .dashboard-header h1 {
            font-size: 24px;
        }
    }
</style>

<div class="dashboard">
    <div class="dashboard-header">
        <h1>Dashboard Tasya Mart</h1>
        <p>Selamat datang! Berikut ringkasan data inventaris toko kamu.</p>
    </div>

    <div class="dashboard-cards">
        <div class="dashboard-card">
            <div class="card-icon">&#128230;</div>
            <div class="card-label">Total Produk</div>
            <div class="card-value">{{ $totalProduk }}</div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">&#128450;</div>
            <div class="card-label">Total Kategori</div>
            <div class="card-value">{{ $totalKategori }}</div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">&#128202;</div>
            <div class="card-label">Total Stok</div>
            <div class="card-value">{{ $totalStok }}</div>
        </div>

        <div class="dashboard-card">
            <div class="card-icon">&#9888;</div>
            <div class="card-label">Stok Menipis</div>
            <div class="card-value">{{ $stokMenipis }}</div>
        </div>
    </div>

    <div class="dashboard-actions">
        <a href="{{ route('products.create') }}" class="dashboard-btn">
            + Tambah Produk
        </a>

        <a href="{{ route('products.index') }}" class="dashboard-btn dashboard-btn-secondary">
            Lihat Semua Produk
        </a>

        <a href="{{ route('categories.index') }}" class="dashboard-btn dashboard-btn-secondary">
            Kelola Kategori
        </a>
    </div>

    <div class="dashboard-section">
        <div class="dashboard-section-header">
            <h2>Produk Terbaru</h2>
            <a href="{{ route('products.index') }}" class="dashboard-btn dashboard-btn-secondary">
                Lihat Semua
            </a>
        </div>

        <div class="dashboard-table-wrapper">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Stok Minimum</th>
                        <th>Status Stok</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($produkTerbaru as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category?->name ?? 'Tanpa kategori' }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->minimum_stock }}</td>
                            <td>
                                @if ($product->stock <= $product->minimum_stock)
                                    <span class="stock-badge stock-badge-low">
                                        Stok Menipis
                                    </span>
                                @else
                                    <span class="stock-badge">
                                        Stok Aman
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="dashboard-empty">
                                Belum ada produk. Silakan tambahkan produk terlebih dahulu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
