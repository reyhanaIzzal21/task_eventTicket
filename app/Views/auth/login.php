<?php
// app/Views/auth/login.php
// variabel yang mungkin tersedia: $loginErrors (array)
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Login - EventTicket</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bs-primary: #0D6EFD;
            --bs-primary-rgb: 13, 110, 253;
            --bs-dark-blue: #0B2A4F;
            --bs-gradient: linear-gradient(45deg, #0D6EFD, #3C82F7);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #F0F7FF, #E7F0FF);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-container {
            background: #fff;
            width: 100%;
            max-width: 400px;
            padding: 2.5rem 2rem;
            border-radius: 1.25rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            text-align: center;
            box-sizing: border-box;
        }

        .login-header {
            margin-bottom: 2rem;
        }

        .login-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 0.8rem;
            background: var(--bs-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.4rem;
            box-shadow: 0 5px 15px rgba(var(--bs-primary-rgb), 0.2);
        }

        .login-header h2 {
            font-weight: 700;
            color: var(--bs-dark-blue);
            font-size: 1.5rem;
            margin: 0;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .field {
            width: 100%;
            text-align: left;
            margin-bottom: 1.2rem;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 600;
            color: #444;
            font-size: 0.9rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #dcdcdc;
            border-radius: 0.6rem;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: #fafbff;
            box-sizing: border-box;
        }

        input:focus {
            border-color: var(--bs-primary);
            outline: none;
            box-shadow: 0 0 0 0.15rem rgba(var(--bs-primary-rgb), 0.15);
            background-color: #fff;
        }

        .errors {
            background: rgba(255, 0, 0, 0.05);
            border: 1px solid rgba(255, 0, 0, 0.15);
            color: #b30000;
            padding: 0.8rem 1rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            text-align: left;
            font-size: 0.9rem;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-primary {
            background: var(--bs-gradient);
            border: none;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 50rem;
            padding: 0.85rem;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 0.3rem;
            box-shadow: 0 6px 20px rgba(var(--bs-primary-rgb), 0.25);
            box-sizing: border-box;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(var(--bs-primary-rgb), 0.35);
        }

        .register-link {
            margin-top: 1.3rem;
            display: inline-block;
            color: var(--bs-primary);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link:hover {
            color: #084298;
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
                border-radius: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">E</div>
            <h2>Masuk ke EventTicket</h2>
        </div>

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
                <input id="email" name="email" type="email" placeholder="Masukkan email anda" required>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Masukkan password" required>
            </div>

            <button class="btn-primary" type="submit">Login</button>

            <a class="register-link" href="/register">Belum punya akun? Daftar sekarang</a>
        </form>
    </div>
</body>

</html>
