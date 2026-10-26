


<?php $__env->startSection('content'); ?>
<div class="container" style="max-width:1200px; margin:auto; padding:30px 20px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:15px; flex-wrap:wrap; margin-bottom:25px;">
        <div>
            <h1 style="color:#4b3022; margin:0 0 8px;">Data Penjualan</h1>
            <p style="color:#846c5b; margin:0;">Kelola transaksi penjualan Tasya Mart.</p>
        </div>
        <a href="<?php echo e(route('sales.create')); ?>"
           style="background:#674630; color:white; padding:12px 18px; border-radius:9px; text-decoration:none; font-weight:bold;">
            + Tambah Penjualan
        </a>
    </div>

    <?php if(session('success')): ?>
        <div style="background:#e4f4e5; color:#245b2b; padding:14px; border-radius:8px; margin-bottom:18px;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div style="background:#fbe7e3; color:#9b3328; padding:14px; border-radius:8px; margin-bottom:18px;">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div style="background:#fbe7e3; color:#9b3328; padding:14px; border-radius:8px; margin-bottom:18px;">
            <strong>Periksa kembali data:</strong>
            <ul style="margin-bottom:0;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

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
                <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="border-top:1px solid #eadfd3;">
                        <td style="padding:16px;"><?php echo e($sale->invoice_number); ?></td>
                        <td style="padding:16px;"><?php echo e($sale->sale_date->format('d-m-Y')); ?></td>
                        <td style="padding:16px;"><?php echo e($sale->items_count); ?></td>
                        <td style="padding:16px; text-align:right;">
                            Rp <?php echo e(number_format((float)$sale->total, 0, ',', '.')); ?>

                        </td>
                        <td style="padding:16px; text-align:center;">
                            <a href="<?php echo e(route('sales.show', $sale)); ?>"
                               style="display:inline-block; background:#eadbc9; color:#4b3022; padding:9px 13px; border-radius:7px; text-decoration:none; font-weight:bold;">
                                Detail
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" style="padding:30px; text-align:center; color:#846c5b;">
                            Belum ada transaksi penjualan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        <?php echo e($sales->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory-laravel\resources\views/sales/index.blade.php ENDPATH**/ ?>