

<?php $__env->startSection('title', 'Daftar Kategori - Tasya Mart'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .category-page {
        color: #49372b;
        padding: 24px;
    }

    .category-card {
        background: #fffaf2;
        border: 1px solid #eadcc8;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .category-table {
        width: 100%;
        border-collapse: collapse;
        background: #fffaf2;
    }

    .category-table th {
        background: #eee3d1;
        color: #49372b;
        text-align: left;
    }

    .category-table th,
    .category-table td {
        padding: 12px;
        border: 1px solid #eadcc8;
    }

    .category-btn {
        display: inline-block;
        padding: 9px 13px;
        border-radius: 7px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .category-btn-primary {
        background: #76513d;
        color: white;
    }

    .category-btn-secondary {
        background: #eee3d1;
        color: #49372b;
    }

    .category-btn-danger {
        background: #f5e0d9;
        color: #963f2d;
    }

    .category-alert {
        padding: 12px;
        margin-bottom: 16px;
        border-radius: 8px;
    }

    @media (max-width: 600px) {
        .category-page {
            padding: 12px;
        }
    }
</style>

<div class="category-page">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:20px;">
        <div>
            <h1 style="margin-bottom:6px;">Daftar Kategori</h1>
            <p style="margin:0; color:#887665;">
                Kelola kategori produk Tasya Mart.
            </p>
        </div>

        <a href="<?php echo e(route('categories.create')); ?>"
           class="category-btn category-btn-primary">
            + Tambah Kategori
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="category-alert"
             style="background:#e5f3e7; color:#28633a;">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="category-alert"
             style="background:#f5e0d9; color:#963f2d;">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="category-alert"
             style="background:#f5e0d9; color:#963f2d;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><?php echo e($error); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="category-card">
        <div style="overflow-x:auto;">
            <table class="category-table">
                <thead>
                    <tr>
                        <th style="width:70px;">No.</th>
                        <th>Nama Kategori</th>
                        <th style="width:150px;">Jumlah Produk</th>
                        <th style="width:230px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php echo e($categories->firstItem() + $loop->index); ?>

                            </td>

                            <td>
                                <strong><?php echo e($category->name); ?></strong>
                            </td>

                            <td>
                                <?php echo e($category->products_count); ?> produk
                            </td>

                            <td style="white-space:nowrap;">
                                <a href="<?php echo e(route('categories.show', $category->id)); ?>"
                                   class="category-btn category-btn-secondary">
                                    Detail
                                </a>

                                <a href="<?php echo e(route('categories.edit', $category->id)); ?>"
                                   class="category-btn category-btn-primary">
                                    Edit
                                </a>

                                <form action="<?php echo e(route('categories.destroy', $category->id)); ?>"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button type="submit"
                                            class="category-btn category-btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" style="text-align:center; padding:24px;">
                                Belum ada kategori. Klik tombol
                                <strong>Tambah Kategori</strong> untuk membuat kategori pertama.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top:20px;">
            <p>
                Menampilkan <?php echo e($categories->firstItem() ?? 0); ?>

                sampai <?php echo e($categories->lastItem() ?? 0); ?>

                dari <?php echo e($categories->total()); ?> kategori.
            </p>

            <?php echo e($categories->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory-laravel\resources\views/categories/index.blade.php ENDPATH**/ ?>