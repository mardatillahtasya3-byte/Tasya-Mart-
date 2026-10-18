
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Inventory App</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef4ff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: white;
            width: 360px;
            max-width: 92%;
            padding: 32px;
            border-radius: 14px;
            box-shadow: 0 8px 30px #00000012;
        }
        h2 { color: #0b3d91; text-align: center; }
        p { text-align: center; color: #666; }
        label { display: block; margin: 16px 0 6px; }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccd5e2;
            border-radius: 7px;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 22px;
            border: 0;
            border-radius: 7px;
            background: #0b3d91;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover { background: #1565c0; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Inventory App</h2>
        <p>Silakan masuk ke akun Anda</p>

        <form method="POST" action="/login">
            @csrf

            <label for="username">Username</label>
            <input id="username" type="text"
                   name="username" required>

            <label for="password">Password</label>
            <input id="password" type="password"
                   name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
