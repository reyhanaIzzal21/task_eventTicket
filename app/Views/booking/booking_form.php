<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Workshop - <?= htmlspecialchars($workshop['name']) ?></title>
    <!-- Memuat Tailwind CSS untuk styling modern dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Memuat Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc; /* Latar belakang sangat cerah */
        }
        .icon-md {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: 0.5rem;
            stroke-width: 2;
        }
    </style>
</head>

<body class="p-4 md:p-8 min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full mx-auto bg-white rounded-2xl shadow-2xl shadow-blue-500/10 overflow-hidden">
        
        <header class="p-6 md:p-8 bg-blue-600 rounded-t-2xl text-white">
            <h1 class="text-3xl font-extrabold text-center">Booking Workshop</h1>
            <p class="text-center mt-1 text-blue-200">Isi formulir untuk mengamankan tempat Anda.</p>
        </header>

        <main class="p-6 md:p-8">

            <!-- Card Ringkasan Workshop -->
            <div class="mb-8 p-4 bg-blue-50 border-l-4 border-blue-600 rounded-lg shadow-inner">
                <p class="text-sm text-blue-700 font-semibold mb-1 flex items-center">
                    <i data-lucide="calendar-check" class="icon-md w-4 h-4 mr-1"></i>
                    Workshop yang Dipilih
                </p>
                <p class="text-xl font-bold text-gray-900"><?= htmlspecialchars($workshop['name']) ?></p>
                <div class="mt-2 pt-2 border-t border-blue-200 flex justify-between items-center">
                    <span class="text-sm text-gray-600">Harga Tiket</span>
                    <span class="text-xl font-extrabold text-green-600">
                        Rp<?= number_format($workshop['price'], 0, ',', '.') ?>
                    </span>
                </div>
            </div>

            <form action="/booking/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="workshop_slug" value="<?= htmlspecialchars($workshop['slug']) ?>">

                <!-- Bagian 1: Detail Pemesan -->
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4 flex items-center">
                    <i data-lucide="user-circle" class="icon-md text-blue-600"></i>
                    Detail Pemesan
                </h3>

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 shadow-sm"
                               placeholder="Contoh: Budi Santoso">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                        <input type="tel" name="phone" id="phone" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 shadow-sm"
                               placeholder="Contoh: 081234567890">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 shadow-sm"
                               placeholder="Contoh: nama@example.com">
                    </div>
                </div>

                <!-- Bagian 2: Detail Pembayaran -->
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2 pt-4 mb-4 flex items-center">
                    <i data-lucide="banknote" class="icon-md text-blue-600"></i>
                    Detail Pembayaran
                </h3>

                <div class="space-y-4">
                    <div>
                        <label for="customer_bank_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Bank Transfer</label>
                        <input type="text" name="customer_bank_name" id="customer_bank_name" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 shadow-sm"
                               placeholder="Contoh: Bank BCA">
                    </div>

                    <div>
                        <label for="customer_bank_account" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                        <input type="text" name="customer_bank_account" id="customer_bank_account" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 shadow-sm"
                               placeholder="Sesuai nama di rekening">
                    </div>

                    <div>
                        <label for="customer_bank_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                        <input type="text" name="customer_bank_number" id="customer_bank_number" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 shadow-sm"
                               placeholder="Nomor rekening Anda">
                    </div>
                </div>

                <!-- Bagian 3: Tiket & Bukti -->
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2 pt-4 mb-4 flex items-center">
                    <i data-lucide="list-checks" class="icon-md text-blue-600"></i>
                    Tiket & Bukti
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Tiket</label>
                        <input type="number" name="quantity" id="quantity" min="1" value="1" required 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 shadow-sm">
                    </div>

                    <div>
                        <label for="proof" class="block text-sm font-medium text-gray-700 mb-1">Bukti Transfer (JPG, PNG)</label>
                        <input type="file" name="proof" id="proof" accept=".jpg,.jpeg,.png" 
                               class="w-full text-gray-700 border border-gray-300 p-2 rounded-lg bg-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition duration-150">
                        <p class="text-xs text-gray-500 mt-1">Opsional: Bukti dapat diunggah nanti melalui halaman detail booking.</p>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4">
                    <button type="submit" 
                            class="w-full flex items-center justify-center bg-blue-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg shadow-blue-500/40 hover:bg-blue-700 transition duration-300 transform hover:scale-[1.01] focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                        <i data-lucide="send" class="icon-md mr-2 w-5 h-5"></i>
                        Kirim Booking
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <a href="/workshops" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition duration-150">
                    <i data-lucide="arrow-left" class="icon-md w-4 h-4 mr-1"></i>
                    Kembali ke daftar workshop
                </a>
            </div>
        </main>
    </div>

    <!-- Script untuk menginisialisasi ikon Lucide -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
