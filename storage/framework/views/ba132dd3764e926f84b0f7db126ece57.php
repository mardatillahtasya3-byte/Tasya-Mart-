<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tasya Mart</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #f7f0e5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: #fffaf2;
            width: 390px;
            max-width: 100%;
            padding: 34px;
            border: 1px solid #eadcc8;
            border-radius: 16px;
            box-shadow: 0 10px 30px #49372b14;
        }

        .brand-icon {
            width: 66px;
            height: 66px;
            margin: 0 auto 16px;
            border-radius: 18px;
            background: #76513d;
            color: #fffaf2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }

        h1 {
            margin: 0;
            color: #49372b;
            text-align: center;
            font-size: 28px;
        }

        .subtitle {
            text-align: center;
            color: #887665;
            margin: 10px 0 26px;
            line-height: 1.5;
            font-size: 14px;
        }

        label {
            display: block;
            margin: 16px 0 7px;
            color: #49372b;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d9c8b3;
            border-radius: 8px;
            background: #fffdf9;
            color: #49372b;
            font-size: 15px;
        }

        input:focus {
            outline: 2px solid #b9977b;
            border-color: #76513d;
        }

        button {
            width: 100%;
            padding: 13px;
            margin-top: 24px;
            border: 0;
            border-radius: 8px;
            background: #76513d;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #5b4032;
        }

        .error {
            color: #963f2d;
            background: #f5e0d9;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .success {
            color: #28633a;
            background: #e5f3e7;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .footer-text {
            text-align: center;
            margin: 22px 0 0;
            color: #887665;
            font-size: 12px;
        }

        @media (max-width: 420px) {
            .login-box {
                padding: 26px 22px;
            }
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="brand-icon" aria-hidden="true">🛒</div>

        <h1>Tasya Mart</h1>
        <p class="subtitle">
            Sistem Informasi Inventaris<br>
            Silakan masuk ke akun Anda
        </p>

        <?php if(session('status')): ?>
            <div class="success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="error">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login.process')); ?>">
            <?php echo csrf_field(); ?>

            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="<?php echo e(old('email')); ?>"
                autocomplete="username"
                required
                autofocus
            >

            <label for="password">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                autocomplete="current-password"
                required
            >

            <button type="submit">Login</button>
        </form>

        <p class="footer-text">
            &copy; <?php echo e(date('Y')); ?> Tasya Mart
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\inventory-laravel\resources\views/auth/login.blade.php ENDPATH**/ ?>