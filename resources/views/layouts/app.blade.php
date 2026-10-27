<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Tasya Mart')</title>

    <style>
        :root {
            --cokelat: #5b3927;
            --cokelat-muda: #79543e;
            --krem: #f7f2e9;
            --krem-tabel: #efe3d0;
            --putih: #ffffff;
            --garis: #eadbc8;
            --teks: #33271f;
            --merah: #a83d2c;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--krem);
            color: var(--teks);
            font-size: 16px;
            line-height: 1.6;
        }

        /* NAVIGASI */
        .navbar {
            background: var(--cokelat);
            color: white;
            padding: 16px 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }

        .brand {
            font-size: 27px;
            font-weight: bold;
            color: white;
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 9px;
            transition: background 0.2s;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background: var(--cokelat-muda);
            color: white;
        }

        .nav-menu form {
            margin: 0;
        }

        .nav-menu .logout-button {
            border: 1px solid #d8c4b3;
            border-radius: 9px;
            padding: 10px 17px;
            background: transparent;
            color: white;
            cursor: pointer;
            font-size: 15px;
        }

        .nav-menu .logout-button:hover {
            background: #75472f;
        }

        /* KONTEN */
        .container {
            width: min(1400px, 100%);
            margin: 0 auto;
            padding: 42px 30px;
            min-height: 65vh;
        }

        h1, h2, h3 {
            color: var(--cokelat);
            line-height: 1.3;
        }

        h1 {
            font-size: 34px;
            margin: 12px 0;
        }

        h2 {
            font-size: 26px;
        }

        p {
            margin-top: 8px;
            margin-bottom: 18px;
        }

        /* TAUTAN */
        a {
            color: var(--cokelat-muda);
        }

        a:hover {
            color: var(--cokelat);
        }

        /* TOMBOL */
        .btn,
        button,
        input[type="submit"] {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 11px 17px;
            font-size: 15px;
            font-family: inherit;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary,
        .btn-success,
        button[type="submit"],
        input[type="submit"] {
            background: var(--cokelat-muda);
            color: white;
        }

        .btn-primary:hover,
        .btn-success:hover,
        button[type="submit"]:hover,
        input[type="submit"]:hover {
            background: var(--cokelat);
            color: white;
        }

        .btn-secondary {
            background: var(--krem-tabel);
            color: var(--cokelat);
        }

        .btn-secondary:hover {
            background: #e3d1b9;
            color: var(--cokelat);
        }

        .btn-danger {
            background: #f6e0da;
            color: #a83d2c;
        }

        .btn-danger:hover {
            background: #ecc8be;
            color: #862c20;
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 14px;
        }

        /* KARTU DAN PANEL */
        .card,
        .panel {
            background: #fffaf3;
            border: 1px solid var(--garis);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        /* TABEL */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            margin-top: 24px;
            background: white;
            border: 1px solid var(--garis);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: var(--krem-tabel);
            color: var(--teks);
            font-weight: bold;
            text-align: left;
        }

        th, td {
            padding: 14px 15px;
            border: 1px solid var(--garis);
            vertical-align: middle;
        }

        tbody tr:nth-child(even) {
            background: #faf6ef;
        }

        tbody tr:hover {
            background: #f5ecdf;
        }

        td form {
            display: inline-block;
            margin: 0;
        }

        td .btn {
            margin: 2px;
        }

        /* FORM TAMBAH / EDIT DATA */
        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: var(--cokelat);
        }

        input:not([type="checkbox"]):not([type="radio"]):not([type="submit"]),
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d9c6b2;
            border-radius: 8px;
            background: white;
            color: var(--teks);
            font-size: 15px;
            font-family: inherit;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--cokelat-muda);
            box-shadow: 0 0 0 3px rgba(121, 84, 62, 0.12);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 24px;
        }

        .alert {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #e7f3e6;
            color: #285b2d;
            border: 1px solid #c7e3c5;
        }

        .alert-danger {
            background: #f8e5e1;
            color: #912f24;
            border-color: #ebc6bf;
        }

        /* FOOTER */
        footer {
            text-align: center;
            color: #856d5b;
            padding: 28px 15px;
            margin-top: 15px;
        }

        /* TAMPILAN HP */
        @media (max-width: 900px) {
            .navbar {
                padding: 15px 20px;
                align-items: flex-start;
                flex-direction: column;
                gap: 12px;
            }

            .nav-menu {
                width: 100%;
                gap: 4px;
            }

            .nav-menu a {
                padding: 9px 11px;
            }

            .container {
                padding: 25px 16px;
            }

            h1 {
                font-size: 28px;
            }

            .card,
            .panel {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="brand">
            Tasya Mart
        </a>

        <div class="nav-menu">
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('products.index') }}"
               class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
                Produk
            </a>

            <a href="{{ route('categories.index') }}"
               class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                Kategori
            </a>

            <a href="{{ route('suppliers.index') }}"
               class="{{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                Supplier
            </a>

            <a href="{{ route('purchases.index') }}"
               class="{{ request()->routeIs('purchases.*') ? 'active' : '' }}">
                Pembelian
            </a>

            <a href="{{ route('sales.index') }}"
               class="{{ request()->routeIs('sales.*') ? 'active' : '' }}">
                Penjualan
            </a>

            <a href="{{ route('reports.index') }}"
               class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                Search / Report
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="container">

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data yang dimasukkan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

    <footer>
        &copy; {{ date('Y') }} Tasya Mart.
        Sistem Informasi Persediaan Barang.
    </footer>

</body>
</html>
