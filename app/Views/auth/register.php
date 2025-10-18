<?php
// app/Views/auth/register.php
// variabel yang mungkin tersedia: $registerErrors (array), $old (array)
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Register - EventTicket</title>
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
            --dark-blue: #1f2937;
            --gradient: linear-gradient(45deg, #0D6EFD, #3C82F7);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
            
            /* Hapus align-items: center saat tinggi konten melebihi viewport */
            /* Kita pertahankan min-height dan flex untuk sentering di layar besar */
            display: flex;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            
            /* 💡 SOLUSI: Terapkan padding vertikal (py-12 = 3rem) pada body */
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        
        /* Ikon Lucide untuk digunakan dalam HTML */
        .icon {
            width: 1.25rem;
            height: 1.25rem;
            stroke-width: 2;
            margin-right: 0.5rem;
        }

        .register-card {
            background: #fff;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem 2rem;
            border-radius: 1.25rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            text-align: center;
            box-sizing: border-box;
            
            /* 💡 SOLUSI: Atur margin vertikal secara otomatis dan aligment */
            margin-left: auto;
            margin-right: auto;
            /* Pastikan form berada di tengah jika ada ruang lebih, jika tidak, biarkan padding body yang bekerja */
            align-self: center; 
        }

        .register-logo {
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

        input:focus {
            border-color: var(--primary-color) !important;
            outline: none;
            box-shadow: 0 0 0 0.15rem rgba(var(--primary-rgb), 0.15) !important;
            background-color: #fff !important;
        }

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
            .register-card {
                padding: 2rem 1.5rem;
                border-radius: 1rem;
            }
        }

    </style>
</head>

<body>
    <div class="register-card">
        <div class="mb-8">
            <div class="register-logo">E</div>
            <h2 class="text-xl font-bold text-gray-800 mt-2 mb-0">Buat Akun Baru</h2>
        </div>

        <?php if (!empty($registerErrors)): ?>
            <div class="errors">
                <div class="flex items-start">
                    <i data-lucide="alert-circle" class="icon text-red-700 mt-0.5"></i>
                    <ul class="list-none p-0 m-0">
                        <?php foreach ($registerErrors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <form method="post" action="/register" class="flex flex-col items-center">
            
            <div class="field w-full text-left mb-5">
                <label for="name" class="block mb-1 font-semibold text-gray-600 text-sm">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="<?= htmlspecialchars($old['name'] ?? '') ?>" placeholder="Masukkan nama lengkap" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition-all bg-gray-50 focus:bg-white">
            </div>

            <div class="field w-full text-left mb-5">
                <label for="occupation" class="block mb-1 font-semibold text-gray-600 text-sm">Pekerjaan</label>
                <input id="occupation" name="occupation" type="text" value="<?= htmlspecialchars($old['occupation'] ?? '') ?>" placeholder="Masukkan pekerjaan"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition-all bg-gray-50 focus:bg-white">
            </div>

            <div class="field w-full text-left mb-5">
                <label for="email" class="block mb-1 font-semibold text-gray-600 text-sm">Email</label>
                <input id="email" name="email" type="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" placeholder="Masukkan email anda" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition-all bg-gray-50 focus:bg-white">
            </div>

            <div class="field w-full text-left mb-5">
                <label for="password" class="block mb-1 font-semibold text-gray-600 text-sm">Password</label>
                <input id="password" name="password" type="password" placeholder="Masukkan password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition-all bg-gray-50 focus:bg-white">
            </div>

            <div class="field w-full text-left mb-5">
                <label for="password_confirm" class="block mb-1 font-semibold text-gray-600 text-sm">Konfirmasi Password</label>
                <input id="password_confirm" name="password_confirm" type="password" placeholder="Ulangi password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg text-base transition-all bg-gray-50 focus:bg-white">
            </div>

            <button class="btn-primary-custom" type="submit">
                <span class="flex items-center justify-center">
                    <i data-lucide="user-plus" class="icon w-5 h-5 mr-2"></i>
                    Register
                </span>
            </button>

            <a class="mt-4 inline-block text-blue-600 font-medium text-sm hover:text-blue-800 hover:underline transition-colors" href="/login">
                Sudah punya akun? Login
            </a>
        </form>
    </div>
    
    <script>
        lucide.createIcons();
    </script>
</body>

</html>