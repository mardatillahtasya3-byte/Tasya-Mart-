


<?php $__env->startSection('title', 'Daftar Produk - Tasya Mart'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .products-page {
        color: #49372b;
        width: 100%;
    }

    .products-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 24px;
    }

    .products-heading h1 {
        margin: 0 0 8px;
        font-size: 28px;
        color: #5b4032;
    }

    .products-heading p {
        margin: 0;
        color: #887665;
        line-height: 1.6;
    }

    .tm-button {
        display: inline-block;
        border: none;
        border-radius: 8px;
        padding: 10px 15px;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
        cursor: pointer;
        white-space: nowrap;
        transition: background .2s, transform .2s;
    }

    .tm-button:hover {
        transform: translateY(-1px);
    }

    .tm-primary {
        background: #76513d;
        color: #fffaf2;
    }

    .tm-primary:hover {
        background: #5b4032;
        color: #fffaf2;
    }

    .tm-secondary {
        background: #eee3d1;
        color: #5b4032;
    }

    .tm-secondary:hover {
        background: #e3d1b8;
        color: #49372b;
    }

    .tm-danger {
        background: #f5e0d9;
        color: #963f2d;
    }

    .tm-danger:hover {
        background: #edc9bd;
        color: #7c3022;
    }

    .tm-alert {
        margin-bottom: 18px;
        padding: 14px 17px;
        border-radius: 9px;
        line-height: 1.6;
    }

    .tm-success {
        background: #e5efdf;
        color: #355b35;
        border: 1px solid #c8ddbe;
    }

    .tm-error {
        background: #f5e0d9;
        color: #963f2d;
        border: 1px solid #e8c5b9;
    }

    .tm-error ul {
        margin: 8px 0 0;
        padding-left: 22px;
    }

    .tm-summary {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .tm-summary-card {
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #eadcc8;
        background: #faf5eb;
    }

    .tm-summary-label {
        font-size: 13px;
        color: #887665;
        margin-bottom: 10px;
    }

    .tm-summary-number {
        font-size: 25px;
        font-weight: bold;
        color: #5b4032;
    }

    .tm-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        margin-bottom: 22px;
        padding: 18px;
        background: #faf5eb;
        border: 1px solid #eadcc8;
        border-radius: 10px;
    }

    .tm-filters input,
    .tm-filters select {
        flex: 1;
        min-width: 170px;
        padding: 11px 12px;
        border: 1px solid #d9c8b3;
        border-radius: 7px;
        background: #fffdf8;
        color: #49372b;
        font-size: 14px;
        outline: none;
    }

    .tm-filters input:focus,
    .tm-filters select:focus {
        border-color: #987252;
        box-shadow: 0 0 0 3px rgba(118, 81, 61, .10);
    }

    .tm-table-card {
        background: #fffdf8;
        border: 1px solid #eadcc8;
        border-radius: 12px;
        overflow: hidden;
    }

    .tm-table-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        padding: 20px;
        border-bottom: 1px solid #eee5d8;
    }

    .tm-table-top h2 {
        margin: 0;
        font-size: 19px;
        color: #5b4032;
    }

    .tm-table-top p {
        margin: 6px 0 0;
        color: #887665;
        font-size: 13px;
    }

    .tm-table-wrap {
        overflow-x: auto;
        width: 100%;
    }

    .tm-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .tm-table th {
        padding: 14px 12px;
        text-align: left;
        background: #eee3d1;
        color: #5b4032;
        font-size: 12px;
        white-space: nowrap;
    }

    .tm-table td {
        padding: 14px 12px;
        border-bottom: 1px solid #eee5d8;
        font-size: 13px;
        vertical-align: middle;
    }

    .tm-table tbody tr:hover {
        background: #fdf9f1;
    }

    .tm-table tbody tr:last-child td {
        border-bottom: none;
    }

    .tm-product-name {
        color: #49372b;
        font-weight: bold;
    }

    .tm-sku {
        color: #887665;
        font-size: 12px;
    }

    .tm-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        background: #eee3d1;
        color: #674932;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .tm-low-stock {
        background: #f5e0d9;
        color: #963f2d;
    }

    .tm-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
    }

    .tm-actions form {
        margin: 0;
    }

    .tm-empty {
        text-align: center;
        padding: 38px 15px !important;
        color: #887665;
        line-height: 1.8;
    }

    .tm-pagination {
        padding: 18px;
        border-top: 1px solid #eee5d8;
        overflow-x: auto;
    }

    .tm-count {
        color: #887665;
        font-size: 13px;
    }

    .tm-pagination nav p {
        color: #887665;
        font-size: 13px;
    }

    @media (max-width: 768px) {
        .products-heading h1 {
            font-size: 24px;
        }

        .tm-summary {
            grid-template-columns: 1fr;
        }

        .tm-filters {
            padding: 14px;
        }

        .tm-filters input,
        .tm-filters select {
            flex-basis: 100%;
        }

        .tm-table-top {
            padding: 16px;
        }
    }
</style>

<div class="products-page">

    
    <div class="products-heading">
        <div>
            <h1>Daftar Produk</h1>
            <p>Kelola produk dan pantau persediaan Tasya Mart.</p>
        </div>

        <a href="<?php echo e(route('products.create')); ?>"
           class="tm-button tm-primary">
            + Tambah Produk
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="tm-alert tm-success">
            ✓ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="tm-alert tm-error">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="tm-alert tm-error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="tm-summary">
        <div class="tm-summary-card">
            <div class="tm-summary-label">Total Produk</div>
            <div class="tm-summary-number">
                <?php echo e(number_format($products->total(), 0, ',', '.')); ?>

            </div>
        </div>

        <div class="tm-summary-card">
            <div class="tm-summary-label">Produk dengan Stok Menipis</div>
            <div class="tm-summary-number">
                <?php echo e(\App\Models\Product::whereColumn('stock', '<=', 'minimum_stock')->count()); ?>

            </div>
        </div>

        <div class="tm-summary-card">
            <div class="tm-summary-label">Total Stok Seluruh Produk</div>
            <div class="tm-summary-number">
                <?php echo e(number_format(\App\Models\Product::sum('stock'), 0, ',', '.')); ?>

            </div>
        </div>
    </div>

    
    <form action="<?php echo e(route('products.index')); ?>"
          method="GET"
          class="tm-filters">

        <input
            type="search"
            name="search"
            placeholder="Cari nama produk atau SKU..."
            value="<?php echo e(request('search')); ?>"
            aria-label="Cari produk"
        >

        <select name="category_id" aria-label="Filter kategori">
            <option value="">Semua Kategori</option>

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    value="<?php echo e($category->id); ?>"
                    <?php echo e((string) request('category_id') === (string) $category->id ? 'selected' : ''); ?>

                >
                    <?php echo e($category->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <button type="submit" class="tm-button tm-primary">
            Cari / Filter
        </button>

        <a href="<?php echo e(route('products.index')); ?>"
           class="tm-button tm-secondary">
            Reset
        </a>
    </form>

    
    <div class="tm-table-card">

        <div class="tm-table-top">
            <div>
                <h2>Data Inventaris Produk</h2>
                <p>Informasi produk yang tersimpan di Tasya Mart.</p>
            </div>

            <span class="tm-count">
                <?php echo e($products->count()); ?> data di halaman ini
            </span>
        </div>

        <div class="tm-table-wrap">
            <table class="tm-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>SKU</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Status Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php echo e($products->firstItem() + $loop->index); ?>

                            </td>

                            <td>
                                <span class="tm-sku">
                                    <?php echo e($product->sku); ?>

                                </span>
                            </td>

                            <td>
                                <span class="tm-product-name">
                                    <?php echo e($product->name); ?>

                                </span>
                            </td>

                            <td>
                                <?php echo e($product->category?->name ?? 'Tanpa kategori'); ?>

                            </td>

                            <td>
                                Rp <?php echo e(number_format((float) $product->price, 0, ',', '.')); ?>

                            </td>

                            <td>
                                <strong><?php echo e(number_format($product->stock, 0, ',', '.')); ?></strong>
                            </td>

                            <td>
                                <?php if($product->stock <= $product->minimum_stock): ?>
                                    <span class="tm-badge tm-low-stock">
                                        ⚠ Stok Menipis
                                    </span>
                                <?php else: ?>
                                    <span class="tm-badge">
                                        ✓ Stok Aman
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <div class="tm-actions">
                                    <a
                                        href="<?php echo e(route('products.show', $product)); ?>"
                                        class="tm-button tm-secondary"
                                    >
                                        Detail
                                    </a>

                                    <a
                                        href="<?php echo e(route('products.edit', $product)); ?>"
                                        class="tm-button tm-primary"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="<?php echo e(route('products.destroy', $product)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk <?php echo e($product->name); ?>?')"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button type="submit"
                                                class="tm-button tm-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="tm-empty">
                                <strong>Belum ada produk ditemukan.</strong>
                                <br>
                                Coba ubah kata pencarian atau pilih kategori lain.
                                <br><br>

                                <a href="<?php echo e(route('products.create')); ?>"
                                   class="tm-button tm-primary">
                                    + Tambah Produk
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="tm-pagination">
            <div class="tm-count">
                <?php if($products->total() > 0): ?>
                    Menampilkan <?php echo e($products->firstItem()); ?>

                    sampai <?php echo e($products->lastItem()); ?>

                    dari <?php echo e($products->total()); ?> produk.
                <?php else: ?>
                    Belum ada data produk.
                <?php endif; ?>
            </div>

            <div style="margin-top: 16px;">
                <?php echo e($products->withQueryString()->links()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory-laravel\resources\views/products/index.blade.php ENDPATH**/ ?>