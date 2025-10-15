<?php
// app/Views/auth/login.php
// variabel yang mungkin tersedia: $loginErrors (array)
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f4f4f4;
        }

        .card {
            background: white;
            padding: 20px;
            max-width: 420px;
            margin: 30px auto;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .field {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .errors {
            background: #ffe6e6;
            border: 1px solid #ffcccc;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 4px;
        }

        button {
            padding: 10px 14px;
            border: none;
            border-radius: 4px;
            background: #333;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Login</h2>

        <?php if (!empty($loginErrors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($loginErrors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="/login">
            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" required>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
            </div>

            <div class="field">
                <button type="submit">Login</button>
            </div>

            <div>
                <a href="/register">Belum punya akun? Register</a>
            </div>
        </form>
    </div>
</body>

</html>