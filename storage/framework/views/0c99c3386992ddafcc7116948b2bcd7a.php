


<?php $__env->startSection('content'); ?>
<style>
.category-form{max-width:700px;margin:auto;padding:30px 20px;font-family:Arial,sans-serif;color:#263746}
.category-form h1{color:#34465a}
.card{padding:25px;border:1px solid #dce4ec;border-radius:12px;background:#fff}
.group{display:flex;flex-direction:column;gap:8px;margin-bottom:20px}
label{font-size:13px;font-weight:bold}
input{width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px}
.btn{display:inline-block;padding:11px 15px;border:0;border-radius:7px;background:#455a70;color:#fff;text-decoration:none;font-weight:bold;cursor:pointer}
.btn-light{background:#e2e8f0;color:#334155}
.alert{padding:12px;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;color:#991b1b;margin-bottom:15px}
.field-error{color:#b91c1c;font-size:12px}
</style>

<div class="category-form">
    <h1>Edit Kategori</h1>
    <p>Perbarui nama kategori.</p>

    <?php if($errors->any()): ?>
        <div class="alert">
            <strong>Periksa kembali data:</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <form action="<?php echo e(route('categories.update', $category)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="group">
                <label for="name">Nama Kategori</label>
                <input id="name" name="name" type="text"
                       value="<?php echo e(old('name', $category->name)); ?>"
                       maxlength="100" required>

                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="field-error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-light">Kembali</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory-laravel\resources\views/categories/edit.blade.php ENDPATH**/ ?>