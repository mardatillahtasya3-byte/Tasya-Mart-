


<?php $__env->startSection('content'); ?>
<div class="tm-page">

    
    <div class="tm-heading">
        <div>
            <h1>Daftar Supplier</h1>
            <p>Kelola data pemasok barang Tasya Mart.</p>
        </div>

        <a href="<?php echo e(route('suppliers.create')); ?>" class="tm-btn tm-btn-primary">
            <span class="tm-plus">+</span> Tambah Supplier
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="tm-alert tm-alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="tm-alert tm-alert-error">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="tm-alert tm-alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="tm-card">

        <div class="tm-card-header">
            <div>
                <h2>Data Supplier</h2>
                <p>Daftar pemasok yang terdaftar di Tasya Mart.</p>
            </div>

            <span class="tm-total">
                <?php echo e($suppliers->total()); ?> Supplier
            </span>
        </div>

        <div class="tm-table-wrap">
            <table class="tm-table">
                <thead>
                    <tr>
                        <th class="tm-no">No.</th>
                        <th>Nama Supplier</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Jumlah Pembelian</th>
                        <th class="tm-action-heading">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="tm-center">
                                <?php echo e($suppliers->firstItem() + $loop->index); ?>

                            </td>

                            <td>
                                <strong class="tm-supplier-name">
                                    <?php echo e($supplier->name); ?>

                                </strong>
                            </td>

                            <td>
                                <?php echo e($supplier->phone ?: '-'); ?>

                            </td>

                            <td>
                                <?php echo e($supplier->email ?: '-'); ?>

                            </td>

                            <td>
                                <span class="tm-count">
                                    <?php echo e($supplier->purchases_count ?? 0); ?>

                                    transaksi
                                </span>
                            </td>

                            <td>
                                <div class="tm-actions">

                                    <a
                                        href="<?php echo e(route('suppliers.edit', $supplier)); ?>"
                                        class="tm-btn tm-btn-secondary">
                                        Edit
                                    </a>

                                    <form
                                        action="<?php echo e(route('suppliers.destroy', $supplier)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="tm-btn tm-btn-danger">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="tm-empty">
                                <div class="tm-empty-content">
                                    <h3>Belum Ada Supplier</h3>
                                    <p>
                                        Silakan tambahkan supplier untuk
                                        mulai mencatat pemasok barang.
                                    </p>
                                    <a
                                        href="<?php echo e(route('suppliers.create')); ?>"
                                        class="tm-btn tm-btn-primary">
                                        + Tambah Supplier
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <?php if(method_exists($suppliers, 'links') && $suppliers->hasPages()): ?>
            <div class="tm-pagination">
                <?php echo e($suppliers->links()); ?>

            </div>
        <?php endif; ?>

    </div>
</div>

<style>
    /* Halaman utama */
    .tm-page {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
        padding: 36px 32px;
        box-sizing: border-box;
        color: #49372a;
    }

    /* Judul halaman */
    .tm-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 34px;
    }

    .tm-heading h1 {
        margin: 0 0 10px;
        color: #593824;
        font-size: 36px;
        line-height: 1.25;
        font-weight: 700;
    }

    .tm-heading p {
        margin: 0;
        color: #856c58;
        font-size: 16px;
        line-height: 1.6;
    }

    /* Semua tombol */
    .tm-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        min-height: 42px;
        padding: 10px 17px;
        box-sizing: border-box;
        border: 1px solid transparent;
        border-radius: 9px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
        text-align: center;
        text-decoration: none !important;
        white-space: nowrap;
        cursor: pointer;
        transition: background-color .2s, border-color .2s;
    }

    .tm-btn-primary {
        background: #79543e;
        color: #ffffff !important;
        border-color: #79543e;
    }

    .tm-btn-primary:hover {
        background: #593824;
        color: #ffffff !important;
        border-color: #593824;
    }

    .tm-plus {
        font-size: 20px;
        line-height: 1;
    }

    /* Tombol Edit: krem dan cokelat */
    .tm-btn-secondary {
        background: #efe2ce;
        color: #593824 !important;
        border-color: #e5d5c0;
    }

    .tm-btn-secondary:hover {
        background: #e5d2b7;
        color: #593824 !important;
        border-color: #d9c3a5;
    }

    /* Tombol Hapus: cokelat, bukan merah */
    .tm-btn-danger {
        background: #79543e;
        color: #ffffff !important;
        border-color: #79543e;
    }

    .tm-btn-danger:hover {
        background: #593824;
        color: #ffffff !important;
        border-color: #593824;
    }

    /* Kartu data */
    .tm-card {
        width: 100%;
        overflow: hidden;
        background: #fffdf9;
        border: 1px solid #eadbc8;
        border-radius: 15px;
        box-shadow: 0 6px 22px rgba(89, 56, 36, .06);
    }

    .tm-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        padding: 25px 28px;
        background: #fffdf9;
        border-bottom: 1px solid #eadbc8;
    }

    .tm-card-header h2 {
        margin: 0 0 7px;
        color: #593824;
        font-size: 21px;
        font-weight: 700;
    }

    .tm-card-header p {
        margin: 0;
        color: #856c58;
        font-size: 14px;
        line-height: 1.5;
    }

    .tm-total {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 16px;
        border-radius: 9px;
        background: #efe2ce;
        color: #593824;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* Tabel */
    .tm-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .tm-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: auto;
    }

    .tm-table thead th {
        padding: 19px 21px;
        background: #efe2ce;
        color: #593824;
        font-size: 14px;
        font-weight: 700;
        text-align: left;
        white-space: nowrap;
        border-right: 1px solid #e5d5c0;
        border-bottom: 1px solid #e5d5c0;
    }

    .tm-table thead th:last-child {
        border-right: none;
    }

    .tm-table tbody td {
        padding: 19px 21px;
        color: #49372a;
        font-size: 14px;
        line-height: 1.6;
        vertical-align: middle;
        border-right: 1px solid #eadbc8;
        border-bottom: 1px solid #eadbc8;
    }

    .tm-table tbody td:last-child {
        border-right: none;
    }

    .tm-table tbody tr:nth-child(even) {
        background: #fcf8f2;
    }

    .tm-table tbody tr:hover {
        background: #f7efe4;
    }

    .tm-table tbody tr:last-child td {
        border-bottom: none;
    }

    .tm-no {
        width: 60px;
        text-align: center !important;
    }

    .tm-center {
        text-align: center;
    }

    .tm-supplier-name {
        color: #593824;
        font-weight: 700;
    }

    .tm-action-heading {
        width: 190px;
        text-align: center !important;
    }

    /* Tombol aksi tidak bertumpuk */
    .tm-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: nowrap;
        gap: 8px;
    }

    .tm-actions form {
        display: inline-flex;
        margin: 0;
        padding: 0;
    }

    .tm-actions .tm-btn {
        min-width: 72px;
        min-height: 42px;
        padding: 9px 14px;
    }

    /* Label jumlah transaksi */
    .tm-count {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 7px;
        background: #f3e8d8;
        color: #79543e;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* Notifikasi */
    .tm-alert {
        margin-bottom: 22px;
        padding: 15px 18px;
        border-radius: 9px;
        font-size: 14px;
        line-height: 1.6;
    }

    .tm-alert ul {
        margin: 8px 0 0;
        padding-left: 22px;
    }

    .tm-alert-success {
        background: #edf4e9;
        border: 1px solid #d5e4ca;
        color: #45613a;
    }

    .tm-alert-error {
        background: #f7eee4;
        border: 1px solid #e5d5c0;
        color: #593824;
    }

    /* Tampilan jika data kosong */
    .tm-empty {
        padding: 55px 20px !important;
        text-align: center;
    }

    .tm-empty-content h3 {
        margin: 0 0 9px;
        color: #593824;
        font-size: 20px;
    }

    .tm-empty-content p {
        margin: 0 0 20px;
        color: #856c58;
        font-size: 14px;
    }

    /* Pagination */
    .tm-pagination {
        padding: 20px 25px;
        border-top: 1px solid #eadbc8;
        background: #fffdf9;
    }

    .tm-pagination nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 768px) {
        .tm-page {
            padding: 24px 16px;
        }

        .tm-heading {
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .tm-heading h1 {
            font-size: 28px;
        }

        .tm-heading p {
            font-size: 14px;
        }

        .tm-card-header {
            padding: 20px;
        }

        .tm-table {
            min-width: 950px;
        }

        .tm-table thead th,
        .tm-table tbody td {
            padding: 15px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory-laravel\resources\views/suppliers/index.blade.php ENDPATH**/ ?>