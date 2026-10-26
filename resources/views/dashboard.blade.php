<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Tasya Mart</title>

    <style>
        :root {
            --cream: #f8f1e7;
            --cream-dark: #eee1cf;
            --brown: #65452f;
            --brown-dark: #422b20;
            --brown-light: #a77b58;
            --white: #fffdf9;
            --text: #45362d;
            --muted: #89796d;
            --danger: #b94b3b;
            --border: #eadbc9;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--cream);
            color: var(--text);
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 240px;
            background: var(--brown-dark);
            color: white;
            padding: 28px 18px;
        }

        .brand {
            font-size: 27px;
            font-weight: 800;
            margin: 5px 10px 6px;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            color: #dfc5ac;
            font-size: 12px;
            margin: 0 10px 35px;
        }

        .nav-label {
            color: #cbb29b;
            font-size: 11px;
            letter-spacing: 2px;
            margin: 20px 10px 12px;
        }

        .nav-link {
            display: block;
            text-decoration: none;
            color: #f8eade;
            padding: 13px 14px;
            margin: 6px 0;
            border-radius: 10px;
            transition: .2s;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #79563e;
            color: white;
        }

        .logout {
            position: absolute;
            bottom: 25px;
            left: 18px;
            right: 18px;
        }

        .logout button {
            width: 100%;
            border: 1px solid #96775f;
            background: transparent;
            color: white;
            padding: 12px;
            border-radius: 9px;
            cursor: pointer;
        }

        .logout button:hover {
            background: #79563e;
        }

        .main {
            margin-left: 240px;
            padding: 32px;
            max-width: 1700px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 28px;
        }

        .topbar h1 {
            margin: 0 0 8px;
            color: var(--brown-dark);
            font-size: 29px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 14px;
        }

        .date {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 16px;
            color: var(--brown);
            font-size: 13px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: var(--white);
            border: 1px solid var(--border);
            padding: 23px;
            border-radius: 15px;
            box-shadow: 0 5px 18px #65452f08;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .stat-title {
            font-size: 13px;
            color: var(--muted);
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: var(--cream);
            font-size: 21px;
        }

        .stat-number {
            font-size: 31px;
            font-weight: 800;
            color: var(--brown-dark);
            margin: 16px 0 7px;
        }

        .stat-note {
            font-size: 12px;
            color: var(--muted);
        }

        .stat-card.warning .stat-number {
            color: var(--danger);
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.5fr) minmax(280px, 1fr);
            gap: 22px;
            align-items: start;
        }

        .panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 15px;
            padding: 24px;
            margin-bottom: 22px;
            min-width: 0;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .panel h2 {
            margin: 0;
            color: var(--brown-dark);
            font-size: 18px;
        }

        .panel-description {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 25px;
        }

        .chart-item {
            margin: 20px 0;
        }

        .chart-labels {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-size: 13px;
            margin-bottom: 9px;
        }

        .chart-name {
            overflow-wrap: anywhere;
            padding-right: 8px;
        }

        .chart-value {
            font-weight: 700;
            color: var(--brown);
            white-space: nowrap;
        }

        .bar-track {
            width: 100%;
            height: 12px;
            border-radius: 20px;
            background: var(--cream-dark);
            overflow: hidden;
        }

        .bar {
            height: 100%;
            border-radius: 20px;
            background: linear-gradient(
                90deg,
                var(--brown-light),
                var(--brown-dark)
            );
            min-width: 0;
            transition: width .3s;
        }

        .warning-item {
            padding: 15px 0;
            border-bottom: 1px solid var(--border);
        }

        .warning-item:last-child {
            border-bottom: none;
        }

        .warning-name {
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 8px;
            overflow-wrap: anywhere;
        }

        .warning-detail {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--muted);
        }

        .stock-badge {
            background: #fce9e5;
            color: #a3372c;
            padding: 5px 9px;
            border-radius: 20px;
            font-weight: 700;
            white-space: nowrap;
        }

        .success-state {
            text-align: center;
            padding: 24px 10px;
            color: #53734a;
            background: #f0f5e9;
            border-radius: 11px;
            line-height: 1.8;
        }

        .success-icon {
            font-size: 30px;
            margin-bottom: 6px;
        }

        .shortcut {
            display: block;
            text-decoration: none;
            background: var(--cream);
            color: var(--brown);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 13px;
            margin-top: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .shortcut:hover {
            background: var(--cream-dark);
        }

        .alert {
            padding: 14px 17px;
            margin-bottom: 20px;
            border-radius: 10px;
            background: #e9f4e5;
            color: #3e6937;
        }

        .alert-error {
            background: #fce9e5;
            color: #9f352b;
        }

        .empty {
            color: var(--muted);
            text-align: center;
            padding: 25px 10px;
            font-size: 13px;
        }

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: static;
                width: 100%;
                padding: 18px;
            }

            .brand-subtitle {
                margin-bottom: 15px;
            }

            .logout {
                position: static;
                margin-top: 15px;
            }

            .main {
                margin-left: 0;
                padding: 20px 14px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar h1 {
                font-size: 25px;
            }

            .stats {
                gap: 10px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-number {
                font-size: 25px;
            }

            .stat-title {
                font-size: 12px;
            }

            .stat-icon {
                width: 34px;
                height: 34px;
                font-size: 17px;
            }

            .panel {
                padding: 17px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="brand">Tasya Mart</div>
        <div class="brand-subtitle">INVENTORY MANAGEMENT</div>

        <div class="nav-label">MENU UTAMA</div>

        <a href="{{ route('dashboard') }}" class="nav-link active">
            ▦ &nbsp; Dashboard
        </a>

        <a href="{{ route('products.index') }}" class="nav-link">
            ▤ &nbsp; Data Produk
        </a>

        <a href="{{ route('categories.index') }}" class="nav-link">
            ▧ &nbsp; Kategori
        </a>

        <form action="{{ route('logout') }}" method="POST" class="logout">
            @csrf
            <button type="submit">⇥ &nbsp; Logout</button>
        </form>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Dashboard</h1>
                <div class="subtitle">
                    Selamat datang di sistem inventaris Tasya Mart.
                </div>
            </div>

            <div class="date">
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </header>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <section class="stats">

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-title">Total Produk</div>
                    <div class="stat-icon">📦</div>
                </div>
                <div class="stat-number">
                    {{ number_format($totalProducts, 0, ',', '.') }}
                </div>
                <div class="stat-note">Jenis produk terdaftar</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-title">Total Kategori</div>
                    <div class="stat-icon">🗂️</div>
                </div>
                <div class="stat-number">
                    {{ number_format($totalCategories, 0, ',', '.') }}
                </div>
                <div class="stat-note">Kategori produk</div>
            </div>

            <div class="stat-card">
                <div class="stat-top">
                    <div class="stat-title">Total Stok</div>
                    <div class="stat-icon">📊</div>
                </div>
                <div class="stat-number">
                    {{ number_format($totalStock, 0, ',', '.') }}
                </div>
                <div class="stat-note">Total unit semua produk</div>
            </div>

            <div class="stat-card warning">
                <div class="stat-top">
                    <div class="stat-title">Stok Menipis</div>
                    <div class="stat-icon">⚠️</div>
                </div>
                <div class="stat-number">
                    {{ number_format($lowStockProducts->count(), 0, ',', '.') }}
                </div>
                <div class="stat-note">Produk perlu diperiksa</div>
            </div>

        </section>

        <section class="content-grid">

            <div class="panel">
                <div class="panel-heading">
                    <h2>Grafik Stok Produk</h2>
                </div>

                <div class="panel-description">
                    Perbandingan stok hingga 8 produk dengan stok terbanyak.
                </div>

                @if ($chartProducts->isNotEmpty())

                    @php
                        $maxStock = max(
                            1,
                            (int) $chartProducts->max('stock')
                        );
                    @endphp

                    @foreach ($chartProducts as $product)
                        @php
                            $percentage = (
                                (int) $product->stock / $maxStock
                            ) * 100;
                        @endphp

                        <div class="chart-item">
                            <div class="chart-labels">
                                <span class="chart-name">
                                    {{ $product->name }}
                                </span>

                                <span class="chart-value">
                                    {{ number_format($product->stock, 0, ',', '.') }}
                                    unit
                                </span>
                            </div>

                            <div
                                class="bar-track"
                                role="img"
                                aria-label="Stok {{ $product->name }}: {{ $product->stock }} unit"
                            >
                                <div
                                    class="bar"
                                    style="width: {{ $percentage }}%;"
                                ></div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="empty">
                        Belum ada produk untuk ditampilkan.
                        <br>
                        Tambahkan produk agar grafik muncul.
                    </div>
                @endif
            </div>

            <div>

                <div class="panel">
                    <div class="panel-heading">
                        <h2>⚠️ Notifikasi Stok</h2>
                    </div>

                    <div class="panel-description">
                        Produk dengan stok sama dengan atau di bawah batas minimum.
                    </div>

                    @forelse ($lowStockProducts as $product)
                        <div class="warning-item">

                            <div class="warning-name">
                                {{ $product->name }}
                            </div>

                            <div class="warning-detail">
                                <span>
                                    Batas minimum:
                                    {{ $product->minimum_stock }}
                                </span>

                                <span class="stock-badge">
                                    Stok: {{ $product->stock }}
                                </span>
                            </div>

                        </div>
                    @empty
                        <div class="success-state">
                            <div class="success-icon">✓</div>
                            <strong>Stok aman!</strong>
                            <br>
                            Tidak ada produk yang mencapai batas minimum.
                        </div>
                    @endforelse

                    @if ($lowStockProducts->isNotEmpty())
                        <a
                            href="{{ route('products.index') }}"
                            class="shortcut"
                        >
                            Lihat data produk →
                        </a>
                    @endif
                </div>

                <div class="panel">
                    <h2>Akses Cepat</h2>

                    <div class="panel-description">
                        Kelola inventaris dengan mudah.
                    </div>

                    <a
                        href="{{ route('products.index') }}"
                        class="shortcut"
                    >
                        📦 &nbsp; Kelola Produk
                    </a>

                    <a
                        href="{{ route('categories.index') }}"
                        class="shortcut"
                    >
                        🗂️ &nbsp; Kelola Kategori
                    </a>
                </div>

            </div>

        </section>

        <div class="subtitle" style="text-align:center; padding:15px;">
            © {{ date('Y') }} Tasya Mart · Inventory Management
        </div>

    </main>

</body>
</html>