


<?php $__env->startSection('content'); ?>

<div class="purchase-page">

    
    <div class="purchase-heading">
        <div>
            <h1>Data Pembelian</h1>
            <p>Riwayat pembelian stok Tasya Mart.</p>
        </div>

        <a href="<?php echo e(route('purchases.create')); ?>" class="purchase-add-btn">
            <span class="purchase-plus">+</span>
            Pembelian Baru
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="purchase-alert purchase-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="purchase-alert purchase-error">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="purchase-alert purchase-error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="purchase-card">

        <div class="purchase-card-header">
            <div>
                <h2>Riwayat Pembelian</h2>
                <p>Informasi transaksi pembelian barang Tasya Mart.</p>
            </div>
        </div>

        <div class="purchase-table-wrap">
            <table class="purchase-table">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Jenis Barang</th>
                        <th>Total</th>
                        <th class="purchase-detail-heading">Detail</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <span class="purchase-invoice">
                                    <?php echo e($purchase->invoice_number ?? $purchase->invoice ?? '-'); ?>

                                </span>
                            </td>

                            <td>
                                <?php if($purchase->date ?? false): ?>
                                    <?php echo e(\Carbon\Carbon::parse($purchase->date)->format('d-m-Y')); ?>

                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php echo e($purchase->supplier?->name ?? '-'); ?>

                            </td>

                            <td>
                                <?php
                                    $jumlahBarang = 0;

                                    if (isset($purchase->details)) {
                                        $jumlahBarang = $purchase->details?->count() ?? 0;
                                    } elseif (isset($purchase->items)) {
                                        $jumlahBarang = $purchase->items?->count() ?? 0;
                                    }
                                ?>

                                <?php echo e($jumlahBarang); ?>

                            </td>

                            <td>
                                <span class="purchase-total">
                                    Rp <?php echo e(number_format((float) ($purchase->total ?? 0), 0, ',', '.')); ?>

                                </span>
                            </td>

                            <td class="purchase-detail-cell">
                                <a
                                    href="<?php echo e(route('purchases.show', $purchase)); ?>"
                                    class="purchase-detail-btn">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6">
                                <div class="purchase-empty">
                                    <div class="purchase-empty-icon">+</div>

                                    <h3>Belum Ada Pembelian</h3>

                                    <p>
                                        Belum ada transaksi pembelian barang.
                                        Silakan tambahkan pembelian baru.
                                    </p>

                                    <a
                                        href="<?php echo e(route('purchases.create')); ?>"
                                        class="purchase-add-btn">
                                        <span class="purchase-plus">+</span>
                                        Pembelian Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(method_exists($purchases, 'links') && $purchases->hasPages()): ?>
            <div class="purchase-pagination">
                <?php echo e($purchases->links()); ?>

            </div>
        <?php endif; ?>

    </div>
</div>

<style>
    .purchase-page {
        width: 100%;
        max-width: 1500px;
        margin: 0 auto;
        padding: 32px 28px;
        box-sizing: border-box;
        color: #49372a;
    }

    .purchase-page * {
        box-sizing: border-box;
    }

    /* JUDUL DAN DESKRIPSI */
    .purchase-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 28px;
    }

    .purchase-heading h1 {
        margin: 0 0 8px;
        color: #593824;
        font-size: 34px;
        font-weight: 700;
        line-height: 1.3;
    }

    .purchase-heading p {
        margin: 0;
        color: #856c58;
        font-size: 15px;
        line-height: 1.6;
    }

    /* TOMBOL TAMBAH */
    .purchase-add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 46px;
        padding: 12px 20px;
        background: #79543e;
        border: 1px solid #79543e;
        border-radius: 9px;
        color: #fff !important;
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
        text-decoration: none !important;
        white-space: nowrap;
        box-shadow: 0 3px 8px rgba(89, 56, 36, .10);
        transition: all .2s ease;
    }

    .purchase-add-btn:hover {
        background: #593824;
        border-color: #593824;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(89, 56, 36, .16);
    }

    .purchase-plus {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        border-radius: 6px;
        background: rgba(255, 255, 255, .18);
        color: #fff;
        font-size: 20px;
        line-height: 1;
    }

    /* KARTU */
    .purchase-card {
        width: 100%;
        overflow: hidden;
        background: #fffdf9;
        border: 1px solid #eadbc8;
        border-radius: 13px;
        box-shadow: 0 4px 16px rgba(89, 56, 36, .05);
    }

    .purchase-card-header {
        padding: 22px 24px;
        background: #fffdf9;
        border-bottom: 1px solid #eadbc8;
    }

    .purchase-card-header h2 {
        margin: 0 0 5px;
        color: #593824;
        font-size: 18px;
        font-weight: 700;
    }

    .purchase-card-header p {
        margin: 0;
        color: #856c58;
        font-size: 13px;
        line-height: 1.6;
    }

    /* TABEL */
    .purchase-table-wrap {
        width: 100%;
        overflow-x: auto;
    }

    .purchase-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: auto;
    }

    .purchase-table thead th {
        padding: 16px 18px;
        background: #efe2ce;
        color: #593824;
        border-bottom: 1px solid #e5d5c0;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
        white-space: nowrap;
    }

    .purchase-table tbody td {
        padding: 17px 18px;
        background: #fffdf9;
        color: #49372a;
        border-bottom: 1px solid #f0e5d8;
        font-size: 13px;
        line-height: 1.5;
        vertical-align: middle;
    }

    .purchase-table tbody tr:nth-child(even) td {
        background: #fcf8f2;
    }

    .purchase-table tbody tr:hover td {
        background: #f7efe4;
    }

    .purchase-table tbody tr:last-child td {
        border-bottom: none;
    }

    .purchase-invoice {
        color: #593824;
        font-weight: 600;
        white-space: nowrap;
    }

    .purchase-total {
        color: #593824;
        font-weight: 700;
        white-space: nowrap;
    }

    .purchase-detail-heading,
    .purchase-detail-cell {
        width: 110px;
        text-align: center !important;
    }

    /* TOMBOL DETAIL */
    .purchase-detail-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 65px;
        min-height: 36px;
        padding: 8px 13px;
        background: #efe2ce;
        border: 1px solid #e5d5c0;
        border-radius: 7px;
        color: #593824 !important;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none !important;
        transition: background .2s ease;
    }

    .purchase-detail-btn:hover {
        background: #e5d2b7;
        color: #593824 !important;
    }

    /* NOTIFIKASI */
    .purchase-alert {
        margin-bottom: 22px;
        padding: 14px 18px;
        border-radius: 9px;
        font-size: 14px;
        line-height: 1.6;
    }

    .purchase-alert ul {
        margin: 8px 0 0;
        padding-left: 22px;
    }

    .purchase-success {
        color: #236b43;
        background: #eaf7ef;
        border: 1px solid #c6e8d1;
    }

    .purchase-error {
        color: #a83e2b;
        background: #fff0ec;
        border: 1px solid #f1d0c7;
    }

    /* DATA KOSONG */
    .purchase-empty {
        padding: 48px 20px;
        text-align: center;
    }

    .purchase-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        margin: 0 auto 14px;
        border-radius: 50%;
        background: #efe2ce;
        color: #79543e;
        font-size: 28px;
    }

    .purchase-empty h3 {
        margin: 0 0 8px;
        color: #593824;
        font-size: 18px;
    }

    .purchase-empty p {
        margin: 0 0 20px;
        color: #856c58;
        font-size: 14px;
        line-height: 1.6;
    }

    /* PAGINATION */
    .purchase-pagination {
        padding: 18px 22px;
        border-top: 1px solid #eadbc8;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .purchase-page {
            padding: 22px 14px;
        }

        .purchase-heading {
            align-items: flex-start;
        }

        .purchase-heading h1 {
            font-size: 28px;
        }

        .purchase-card-header {
            padding: 18px;
        }

        .purchase-table {
            min-width: 800px;
        }
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory-laravel\resources\views/purchases/index.blade.php ENDPATH**/ ?>