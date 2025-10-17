<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
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
        .icon-sm {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-item:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body class="p-4 md:p-8 min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full mx-auto bg-white rounded-2xl shadow-2xl shadow-blue-500/10 overflow-hidden">
        
        <header class="p-6 md:p-8 bg-blue-600 rounded-t-2xl text-white">
            <h1 class="text-3xl font-extrabold text-center">Detail Booking</h1>
            <p class="text-center mt-1 text-blue-200">Informasi lengkap transaksi Anda.</p>
        </header>

        <main class="p-6 md:p-8">

            <!-- Card Ringkasan Workshop & Transaksi -->
            <div class="mb-8 p-5 bg-blue-50 border-l-4 border-blue-600 rounded-lg shadow-inner">
                <h3 class="text-xl font-bold text-blue-800 mb-4 flex items-center">
                    <i data-lucide="ticket" class="icon-sm text-blue-600 mr-2 w-5 h-5"></i>
                    Ringkasan Pesanan
                </h3>

                <div class="info-item">
                    <span class="text-gray-600 font-medium">Kode Transaksi</span>
                    <span class="font-semibold text-gray-900"><?= htmlspecialchars($booking['booking_trx_id']) ?></span>
                </div>
                
                <div class="info-item">
                    <span class="text-gray-600 font-medium">Nama Workshop</span>
                    <span class="font-semibold text-blue-600"><?= htmlspecialchars($booking['workshop_name']) ?></span>
                </div>

                <div class="info-item">
                    <span class="text-gray-600 font-medium">Jumlah Tiket</span>
                    <span class="font-semibold text-gray-900"><?= htmlspecialchars($booking['quantity']) ?></span>
                </div>
                
                <!-- Total Pembayaran dengan highlight -->
                <div class="info-item border-b-2 border-blue-200 mt-4 pt-4">
                    <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                    <span class="text-2xl font-extrabold text-blue-700">
                        Rp<?= number_format($booking['total_amount'], 0, ',', '.') ?>
                    </span>
                </div>
            </div>
            
            <!-- Status Pembayaran -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-gray-800 mb-3 flex items-center">
                    <i data-lucide="shield-check" class="icon-sm text-gray-600 mr-2 w-5 h-5"></i>
                    Status Pembayaran
                </h3>
                <div class="p-4 rounded-lg text-center font-bold text-lg shadow-md 
                    <?php if ($booking['is_paid']): ?>
                        bg-green-100 text-green-700 border border-green-300
                    <?php else: ?>
                        bg-yellow-100 text-yellow-700 border border-yellow-300
                    <?php endif; ?>">
                    <?php if ($booking['is_paid']): ?>
                        <i data-lucide="check-circle" class="inline-block icon-sm w-5 h-5"></i>
                        PEMBAYARAN SUDAH DITERIMA
                    <?php else: ?>
                        <i data-lucide="clock" class="inline-block icon-sm w-5 h-5"></i>
                        MENUNGGU PEMBAYARAN
                    <?php endif; ?>
                </div>
            </div>

            <!-- Detail Pemesan -->
            <div class="mb-8 p-5 border rounded-lg shadow-sm">
                 <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i data-lucide="user" class="icon-sm text-gray-600 mr-2 w-5 h-5"></i>
                    Detail Pemesan
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Nama</span>
                        <span class="font-medium text-gray-900"><?= htmlspecialchars($booking['name']) ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Email</span>
                        <span class="font-medium text-gray-900"><?= htmlspecialchars($booking['email']) ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Telepon</span>
                        <span class="font-medium text-gray-900"><?= htmlspecialchars($booking['phone']) ?></span>
                    </div>
                    <div class="flex justify-between pt-2 border-t mt-2">
                        <span class="text-gray-500">Transfer Dari</span>
                        <span class="font-medium text-gray-900"><?= htmlspecialchars($booking['customer_bank_name']) ?> (<?= htmlspecialchars($booking['customer_bank_account']) ?>)</span>
                    </div>
                </div>
            </div>

            <!-- Bukti Transfer -->
            <?php if (!empty($booking['proof'])): ?>
                <div class="mt-8 pt-4 border-t">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Bukti Transfer</h3>
                    <div class="bg-gray-100 p-4 rounded-xl shadow-inner">
                         <a href="<?= htmlspecialchars($booking['proof']) ?>" target="_blank" class="block">
                            <img src="<?= htmlspecialchars($booking['proof']) ?>" 
                                 alt="Bukti Pembayaran"
                                 class="w-full h-auto object-contain rounded-lg shadow-lg transition duration-300 hover:opacity-90 cursor-pointer"
                                 style="max-height: 400px;"
                                 onerror="this.onerror=null; this.src='https://placehold.co/400x400/cccccc/333333?text=BUKTI+TIDAK+DITEMUKAN';"
                            >
                        </a>
                        <p class="text-center text-sm text-gray-500 mt-2">Klik gambar untuk melihat lebih jelas</p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tombol Kembali -->
            <div class="text-center mt-10">
                <a href="/workshops/<?= htmlspecialchars($booking['workshop_slug']) ?>" 
                   class="inline-flex items-center bg-blue-600 text-white font-semibold py-3 px-6 rounded-full shadow-lg shadow-blue-500/40 hover:bg-blue-700 transition duration-300 transform hover:scale-[1.02]">
                    <i data-lucide="arrow-left" class="icon-sm w-5 h-5 mr-2"></i>
                    Kembali ke Workshop
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
