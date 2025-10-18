<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($workshop['name']) ?></title>
    <!-- Memuat Tailwind CSS untuk styling modern dan responsif -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <!-- Memuat Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa; /* Latar belakang lebih cerah */
        }
        /* Ikon Lucide untuk digunakan dalam HTML */
        .icon {
            width: 1.25rem;
            height: 1.25rem;
            stroke-width: 2;
            margin-right: 0.5rem;
        }
    </style>
</head>

<body class="p-4 md:p-8">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="md:flex">
            <!-- Kolom Kiri: Detail Workshop (Gambar & Deskripsi) -->
            <div class="md:w-3/5 p-4 md:p-6 lg:p-8">
                
                <!-- Tombol Kembali yang baru ditambahkan -->
                <a href="/workshops" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition duration-150 p-2 -ml-2 rounded-lg hover:bg-blue-50">
                    <i data-lucide="arrow-left" class="w-5 h-5 mr-1"></i>
                    Kembali ke Daftar Workshop
                </a>

                <!-- Gambar Utama / Thumbnail Workshop -->
                <img class="w-full h-80 object-cover rounded-lg shadow-md mb-6" 
                     src="<?= htmlspecialchars($workshop['thumbnail']) ?>" 
                     alt="Workshop Thumbnail"
                     onerror="this.onerror=null; this.src='https://placehold.co/1200x400/1e3a8a/ffffff?text=WORKSHOP';" 
                >

                <!-- Judul dan Meta Info Cepat (Tanggal, Waktu, Lokasi) -->
                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">
                    <?= htmlspecialchars($workshop['name']) ?>
                </h1>
                
                <!-- Tanggal, Waktu, dan Harga di atas -->
                <div class="text-sm text-gray-600 mb-6 flex flex-wrap gap-4">
                    <span class="flex items-center">
                        <i data-lucide="calendar" class="icon text-blue-600"></i>
                        <?= htmlspecialchars($workshop['started_at']) ?>
                    </span>
                    <span class="flex items-center">
                        <i data-lucide="clock" class="icon text-blue-600"></i>
                        <?= htmlspecialchars($workshop['time_at']) ?>
                    </span>
                    <span class="flex items-center font-semibold text-green-600">
                        <i data-lucide="wallet" class="icon"></i>
                        Rp<?= number_format($workshop['price'], 0, ',', '.') ?>
                    </span>
                </div>

                <!-- Konten: Deskripsi -->
                <div class="mt-6 border-t pt-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Workshop</h2>
                    <div class="text-gray-700 leading-relaxed space-y-4">
                        <p><?= nl2br(htmlspecialchars($workshop['about'])) ?></p>
                        
                        <!-- Detail Lokasi dengan Gambar Peta/Venue -->
                        <div class="pt-4 border-t mt-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <i data-lucide="map-pin" class="icon text-blue-600"></i>
                                Lokasi Acara
                            </h3>
                            
                            <!-- Gambar Venue Thumbnail atau BG Map (jika ada) -->
                            <?php 
                                $location_image = !empty($workshop['venue_thumbnail']) ? $workshop['venue_thumbnail'] : 
                                                  (!empty($workshop['bg_map']) ? $workshop['bg_map'] : null);
                                $alt_text = !empty($workshop['venue_thumbnail']) ? 'Venue Thumbnail' : 'Background Map';
                            ?>

                            <?php if (!empty($location_image)): ?>
                                <img class="w-full h-48 object-cover rounded-lg shadow-sm mb-4" 
                                     src="<?= htmlspecialchars($location_image) ?>" 
                                     alt="<?= htmlspecialchars($alt_text) ?>"
                                     onerror="this.onerror=null; this.src='https://placehold.co/800x200/4c7c8c/ffffff?text=LOKASI+ACARA';" 
                                >
                            <?php endif; ?>
                            
                            <p class="text-gray-700 mb-3"><?= htmlspecialchars($workshop['address']) ?? 'Alamat tidak tersedia.' ?></p>
                            
                            <!-- Tombol Google Maps (jika 'bg_map' ada) -->
                            <?php if (!empty($workshop['gmaps'])): ?>
                                <a href="<?= htmlspecialchars($workshop['gmaps']) ?>" 
                                   target="_blank" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 transition duration-150 font-medium">
                                    <i data-lucide="external-link" class="w-4 h-4 mr-1"></i>
                                    Lihat di Google Maps
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Informasi Event & Tombol (Floating Card) -->
            <div class="md:w-2/5 p-4 md:p-6 lg:p-8 bg-gray-50 border-l">
                <div class="sticky top-8 bg-white p-6 rounded-lg shadow-xl border border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Event</h2>
                    
                    <!-- Status Pendaftaran (is_open) -->
                    <div class="flex justify-between items-center py-2 border-b">
                        <span class="text-gray-600 flex items-center">
                            <i data-lucide="check-circle" class="icon text-gray-500"></i>
                            Status Pendaftaran
                        </span>
                        <span class="font-bold 
                            <?php 
                                // Asumsi kolom 'is_open' adalah boolean (true/false) atau integer (1/0)
                                echo ($workshop['is_open'] ?? false) ? 'text-green-600' : 'text-red-600'; 
                            ?>">
                            <?php 
                                echo ($workshop['is_open'] ?? false) ? 'DIBUKA' : 'DITUTUP'; 
                            ?>
                        </span>
                    </div>

                    <!-- Kategori (Placeholder) -->
                    <div class="flex justify-between items-center py-2 border-b">
                        <span class="text-gray-600 flex items-center">
                            <i data-lucide="tag" class="icon text-gray-500"></i>
                            Kategori
                        </span>
                        <span class="font-medium text-gray-800">Teknologi & Bisnis</span>
                    </div>

                    <!-- Penyelenggara (Placeholder) -->
                    <div class="flex justify-between items-center py-2 border-b">
                        <span class="text-gray-600 flex items-center">
                            <i data-lucide="users" class="icon text-gray-500"></i>
                            Penyelenggara
                        </span>
                        <span class="font-medium text-gray-800">Your Company Name</span>
                    </div>

                    <!-- Harga (Ringkasan) -->
                    <div class="mt-6 pt-4 border-t-2 border-blue-500/20">
                        <p class="text-lg text-gray-600 mb-1">Harga Tiket</p>
                        <p class="text-3xl font-bold text-blue-700">
                            Rp<?= number_format($workshop['price'], 0, ',', '.') ?>
                        </p>
                    </div>

                    <!-- Tombol Booking (Tergantung Status) -->
                    <?php if ($workshop['is_open'] ?? false): ?>
                        <a href="/booking/create/<?= htmlspecialchars($workshop['slug']) ?>"
                            class="w-full mt-6 flex items-center justify-center bg-blue-600 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 transform hover:scale-[1.01] focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                            <i data-lucide="ticket" class="icon mr-2"></i>
                            Booking Sekarang
                        </a>
                    <?php else: ?>
                        <button disabled
                            class="w-full mt-6 flex items-center justify-center bg-gray-400 text-white font-bold py-3 px-4 rounded-lg cursor-not-allowed">
                            Pendaftaran Ditutup
                        </button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
    
    <!-- Script untuk menginisialisasi ikon Lucide -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
