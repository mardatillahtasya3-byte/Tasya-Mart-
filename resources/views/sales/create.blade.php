<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan - Tasya Mart</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f7f0e7;
            color: #513a2b;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: min(1100px, calc(100% - 32px));
            margin: 32px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 22px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .card {
            padding: 28px;
            border: 1px solid #ead9c4;
            border-radius: 17px;
            background: #fffaf5;
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-height: 48px;
            padding: 12px 20px;
            border: 0;
            border-radius: 9px;
            background: #68462f;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-light {
            background: #ead9c4;
            color: #513a2b;
        }

        .btn-danger {
            width: 100%;
            height: 50px;
            padding: 10px 8px;
            background: #b44636;
            color: #fff;
        }

        .form-group {
            margin-bottom: 26px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-size: 17px;
            font-weight: 700;
        }

        input,
        select,
        textarea {
            display: block;
            width: 100%;
            min-width: 0;
            height: 50px;
            margin: 0;
            padding: 12px 14px;
            border: 1px solid #dfcbb8;
            border-radius: 10px;
            background: #fff;
            color: #30251e;
            font: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: 2px solid #c9a987;
            border-color: #8a6549;
        }

        input[type="date"] {
            max-width: 420px;
        }

        textarea {
            height: 85px;
            resize: vertical;
        }

        h2 {
            margin: 0 0 20px;
            font-size: 21px;
        }

        /*
         * Baris Produk, Jumlah, dan Hapus.
         * Label berada di atas input dengan jarak konsisten.
         */
        .item-row {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(150px, 0.9fr) 76px;
            column-gap: 14px;
            align-items: start;
            margin-bottom: 17px;
            padding-bottom: 17px;
            border-bottom: 1px solid #eadfd2;
        }

        .item-field {
            min-width: 0;
            margin: 0;
            padding: 0;
        }

        .item-field label {
            display: flex;
            align-items: flex-start;
            height: 24px;
            margin: 0 0 9px;
            padding: 0;
            line-height: 24px;
        }

        .item-field select,
        .item-field input {
            width: 100%;
            height: 50px;
            margin: 0;
        }

        .product-info {
            min-height: 21px;
            margin-top: 7px;
            color: #92745d;
            font-size: 14px;
            line-height: 21px;
        }

        .remove-column {
            min-width: 0;
            margin: 33px 0 0;
            padding: 0;
        }

        .remove-column button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 50px;
            margin: 0;
        }

        .add-button {
            margin-top: 2px;
        }

        .total-box {
            margin-top: 28px;
            padding: 21px;
            border-radius: 13px;
            background: #efe0cd;
        }

        .total-label {
            margin-bottom: 7px;
            color: #92745d;
            font-size: 17px;
        }

        .total-value {
            font-size: 30px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .total-note {
            margin-top: 6px;
            color: #92745d;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .alert {
            margin-bottom: 20px;
            padding: 15px 18px;
            border-radius: 9px;
            background: #fbe4e0;
            color: #8f2f24;
        }

        .alert ul {
            margin-bottom: 0;
        }

        @media (max-width: 700px) {
            .container {
                width: calc(100% - 20px);
                margin: 18px auto;
            }

            .card {
                padding: 18px;
            }

            .header {
                align-items: flex-start;
                flex-direction: column;
            }

            .header h1 {
                font-size: 24px;
            }

            .item-row {
                grid-template-columns: minmax(0, 1fr) minmax(100px, 0.65fr);
                column-gap: 12px;
                row-gap: 12px;
            }

            .product-field {
                grid-column: 1 / -1;
            }

            .remove-column {
                margin-top: 33px;
            }

            .total-value {
                font-size: 25px;
            }
        }

        @media (max-width: 380px) {
            .item-row {
                grid-template-columns: minmax(0, 1fr);
            }

            .product-field {
                grid-column: auto;
            }

            .remove-column {
                margin-top: 0;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <h1>Tambah Penjualan</h1>

        <a href="{{ route('sales.index') }}" class="btn btn-light">
            &larr; Kembali
        </a>
    </div>

    <div class="card">

        @if ($errors->any())
            <div class="alert">
                <strong>Penjualan belum berhasil disimpan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST" id="saleForm">
            @csrf

            <div class="form-group">
                <label for="sale_date">Tanggal Penjualan</label>
                <input
                    type="date"
                    id="sale_date"
                    name="sale_date"
                    value="{{ old('sale_date', date('Y-m-d')) }}"
                    required
                >
            </div>

            <h2>Daftar Barang</h2>

            <div id="itemsContainer"></div>

            <button
                type="button"
                class="btn btn-light add-button"
                id="addItem"
            >
                + Tambah Barang
            </button>

            <div class="form-group" style="margin-top: 28px;">
                <label for="notes">Catatan (opsional)</label>
                <textarea
                    name="notes"
                    id="notes"
                    maxlength="5000"
                    placeholder="Masukkan catatan penjualan..."
                >{{ old('notes') }}</textarea>
            </div>

            <div class="total-box">
                <div class="total-label">Perkiraan total penjualan</div>
                <div class="total-value" id="grandTotal">Rp 0</div>
                <div class="total-note">
                    Total akhir dihitung kembali oleh server saat transaksi disimpan.
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn" id="submitButton">
                    Simpan Penjualan
                </button>

                <a href="{{ route('sales.index') }}" class="btn btn-light">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const products = {{ Illuminate\Support\Js::from(
        $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'stock' => (int) $product->stock,
            ];
        })->values()
    ) }};

    const oldProductIds = {{ Illuminate\Support\Js::from(old('product_id', [])) }};
    const oldQuantities = {{ Illuminate\Support\Js::from(old('quantity', [])) }};

    const container = document.getElementById('itemsContainer');
    const totalElement = document.getElementById('grandTotal');
    const addButton = document.getElementById('addItem');
    const saleForm = document.getElementById('saleForm');

    const rupiah = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0
    });

    function createItem(selectedId = '', quantity = 1) {
        const row = document.createElement('div');
        row.className = 'item-row';

        // Kolom Produk
        const productField = document.createElement('div');
        productField.className = 'item-field product-field';

        const productLabel = document.createElement('label');
        productLabel.textContent = 'Produk';

        const select = document.createElement('select');
        select.name = 'product_id[]';
        select.required = true;

        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = 'Pilih produk';
        select.appendChild(placeholder);

        products.forEach(product => {
            const option = document.createElement('option');
            option.value = product.id;
            option.textContent = `${product.name} — Stok: ${product.stock}`;

            if (String(product.id) === String(selectedId)) {
                option.selected = true;
            }

            select.appendChild(option);
        });

        const info = document.createElement('div');
        info.className = 'product-info';

        productField.appendChild(productLabel);
        productField.appendChild(select);
        productField.appendChild(info);

        // Kolom Jumlah
        const quantityField = document.createElement('div');
        quantityField.className = 'item-field quantity-field';

        const quantityLabel = document.createElement('label');
        quantityLabel.textContent = 'Jumlah';

        const input = document.createElement('input');
        input.type = 'number';
        input.name = 'quantity[]';
        input.min = '1';
        input.step = '1';
        input.max = '1000000';
        input.value = Math.max(1, Number(quantity) || 1);
        input.required = true;
        input.setAttribute('aria-label', 'Jumlah barang');

        quantityField.appendChild(quantityLabel);
        quantityField.appendChild(input);

        // Kolom Hapus
        const removeColumn = document.createElement('div');
        removeColumn.className = 'remove-column';

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.className = 'btn btn-danger';
        removeButton.textContent = 'Hapus';

        removeButton.addEventListener('click', () => {
            if (container.querySelectorAll('.item-row').length > 1) {
                row.remove();
            } else {
                select.value = '';
                input.value = '1';
                updateInfo();
            }

            updateTotal();
        });

        removeColumn.appendChild(removeButton);

        row.appendChild(productField);
        row.appendChild(quantityField);
        row.appendChild(removeColumn);

        function updateInfo() {
            const product = products.find(
                item => String(item.id) === String(select.value)
            );

            if (!product) {
                info.textContent = 'Pilih produk untuk melihat harga dan stok.';
                input.removeAttribute('max');
                return;
            }

            info.textContent =
                `Harga: ${rupiah.format(product.price)} | Stok tersedia: ${product.stock}`;

            input.max = String(product.stock);
        }

        select.addEventListener('change', () => {
            updateInfo();
            updateTotal();
        });

        input.addEventListener('input', updateTotal);

        container.appendChild(row);

        updateInfo();
        updateTotal();
    }

    function updateTotal() {
        let total = 0;

        container.querySelectorAll('.item-row').forEach(row => {
            const productId = row.querySelector('select').value;
            const quantity = Number(row.querySelector('input').value) || 0;

            const product = products.find(
                item => String(item.id) === String(productId)
            );

            if (product && quantity > 0) {
                total += product.price * quantity;
            }
        });

        totalElement.textContent = rupiah.format(total);
    }

    addButton.addEventListener('click', () => {
        createItem();
    });

    saleForm.addEventListener('submit', event => {
        const rows = container.querySelectorAll('.item-row');
        const selectedIds = [];

        if (rows.length === 0) {
            event.preventDefault();
            alert('Tambahkan minimal satu barang.');
            return;
        }

        for (const row of rows) {
            const select = row.querySelector('select');
            const input = row.querySelector('input');
            const productId = select.value;
            const quantity = Number(input.value);

            const product = products.find(
                item => String(item.id) === String(productId)
            );

            if (!product) {
                event.preventDefault();
                alert('Silakan pilih produk pada setiap baris.');
                select.focus();
                return;
            }

            if (selectedIds.includes(String(productId))) {
                event.preventDefault();
                alert('Produk yang sama dipilih lebih dari sekali. Gabungkan jumlahnya dalam satu baris.');
                select.focus();
                return;
            }

            selectedIds.push(String(productId));

            if (!Number.isInteger(quantity) || quantity < 1) {
                event.preventDefault();
                alert('Jumlah harus bilangan bulat minimal 1.');
                input.focus();
                return;
            }

            if (quantity > product.stock) {
                event.preventDefault();
                alert(`Stok ${product.name} hanya tersedia ${product.stock}.`);
                input.focus();
                return;
            }
        }
    });

    // Pulihkan isian lama jika validasi gagal.
    if (oldProductIds.length > 0) {
        oldProductIds.forEach((productId, index) => {
            createItem(productId, oldQuantities[index] ?? 1);
        });
    } else {
        createItem();
    }
</script>
</body>
</html>
