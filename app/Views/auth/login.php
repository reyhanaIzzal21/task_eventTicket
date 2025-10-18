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

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            /* Warna kustom untuk konsistensi */
            --primary-color: #0D6EFD;
            --primary-rgb: 13, 110, 253;
            --dark-blue: #1f2937; /* Mengganti dark-blue agar lebih sesuai dengan tema Inter/modern */
            --gradient: linear-gradient(45deg, #0D6EFD, #3C82F7);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa; /* Latar belakang lebih cerah (dari tema) */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Ikon Lucide untuk digunakan dalam HTML */
        .icon {
            width: 1.25rem;
            height: 1.25rem;
            stroke-width: 2;
            margin-right: 0.5rem;
        }

        /* Kelas kustom untuk mempermudah transisi dari CSS lama ke Tailwind */

        /* Login Container - Mengganti .login-container dengan kelas Tailwind */
        .login-card {
            background: #fff;
            width: 100%;
            max-width: 400px;
            padding: 2.5rem 2rem;
            border-radius: 1.25rem; /* rounded-2xl */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            text-align: center;
            box-sizing: border-box;
        }

        /* Login Logo */
        .login-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 0.8rem;
            background: var(--gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.4rem;
            box-shadow: 0 5px 15px rgba(var(--primary-rgb), 0.2);
        }

        /* Input Focus Shadow */
        input:focus {
            border-color: var(--primary-color) !important;
            outline: none;
            box-shadow: 0 0 0 0.15rem rgba(var(--primary-rgb), 0.15) !important;
            background-color: #fff !important;
        }

        /* Button Primary */
        .btn-primary-custom {
            background: var(--gradient);
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
            box-shadow: 0 6px 20px rgba(var(--primary-rgb), 0.25);
            box-sizing: border-box;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(var(--primary-rgb), 0.35);
        }

        /* Errors */
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

        @media (max-width: 480px) {
            .login-card {
                padding: 2rem 1.5rem;
                border-radius: 1rem;
            }
        }

    </style>
</head>

<body>
    <div class="login-card">
        <div class="mb-8">
            <div class="login-logo">E</div>
            <h2 class="text-xl font-bold text-gray-800 mt-2 mb-0">Masuk ke EventTicket</h2>
        </div>

        <?php if (!empty($loginErrors)): ?>
            <div class="errors">
                <div class="flex items-start">
                    <i data-lucide="alert-circle" class="icon text-red-700 mt-0.5"></i>
                    <ul class="list-none p-0 m-0">
                        <?php foreach ($loginErrors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <form method="post" action="/login" class="flex flex-col items-center">
            <div class="field w-full text-left mb-5">
                <label for="email" class="block mb-1 font-semibold text-gray-600 text-sm">Email</label>
                <input id="email" name="email" type="email" placeholder="Masukkan email anda" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition-all bg-gray-50 focus:bg-white">
            </div>

            <div class="field w-full text-left mb-5">
                <label for="password" class="block mb-1 font-semibold text-gray-600 text-sm">Password</label>
                <input id="password" name="password" type="password" placeholder="Masukkan password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition-all bg-gray-50 focus:bg-white">
            </div>

            <button class="btn-primary-custom" type="submit">
                <span class="flex items-center justify-center">
                    <i data-lucide="log-in" class="icon w-5 h-5 mr-2"></i>
                    Login
                </span>
            </button>

            <a class="mt-4 inline-block text-blue-600 font-medium text-sm hover:text-blue-800 hover:underline transition-colors" href="/register">
                Belum punya akun? Daftar sekarang
            </a>
        </form>
    </div>
    
    <script>
        lucide.createIcons();
    </script>
</body>

</html>