<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThreeTix - <?= htmlspecialchars($workshop['name']) ?></title>

    <!-- Font (opsional) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/landing.css">

    <!-- Lucide (dipakai untuk icon seperti semula) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --brand-blue: #0b5ed7;
            /* sesuaikan kalau mau warna lain */
            --brand-blue-600: #0a58c7;
            --card-radius: 12px;
        }

        body {
            font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #f8fbff;
        }

        .workshop-card {
            border-radius: var(--card-radius);
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.06);
            border: 1px solid rgba(13, 110, 253, 0.06);
            background: #ffffff;
        }

        .workshop-thumb {
            width: 100%;
            height: 320px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
        }

        .image-map {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }

        .info-card {
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(2, 6, 23, 0.04);
        }

        /* sticky helper: gunakan position: sticky agar kolom kanan 'mengikuti' saat scroll */
        .sticky-card {
            position: sticky;
            top: 2rem;
        }

        .icon {
            width: 1.1rem;
            height: 1.1rem;
            margin-right: .5rem;
        }

        .muted-small {
            color: #6c757d;
            font-size: .95rem;
        }

        /* responsif kecil: perkecil tinggi gambar */
        @media (max-width: 576px) {
            .workshop-thumb {
                height: 220px;
            }

            .image-map {
                height: 140px;
            }
        }
    </style>
</head>

<body>
    <!-- header component (jika Anda punya shared header) -->
    <?php require __DIR__ . '/../components/header.php'; ?>

    <main class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-14">
                <div class="workshop-card overflow-hidden">
                    <div class="row g-0">
                        <!-- Left: detail -->
                        <div class="col-12 col-md-7 p-4 p-md-5">
                            <!-- Back button -->
                            <a href="/workshops" class="d-inline-flex align-items-center text-decoration-none text-primary mb-3">
                                <i data-lucide="arrow-left" class="icon text-primary"></i>
                                <span class="fw-semibold">Kembali ke Daftar Workshop</span>
                            </a>

                            <!-- Thumbnail -->
                            <img
                                src="<?= htmlspecialchars($workshop['thumbnail']) ?>"
                                alt="Workshop Thumbnail"
                                class="workshop-thumb mb-4"
                                onerror="this.onerror=null; this.src='https://placehold.co/1200x400/1e3a8a/ffffff?text=WORKSHOP';">

                            <h1 class="h3 fw-bold mb-2"><?= htmlspecialchars($workshop['name']) ?></h1>

                            <div class="d-flex flex-wrap align-items-center gap-3 mb-4 text-muted">
                                <div class="d-flex align-items-center">
                                    <i data-lucide="calendar" class="icon"></i>
                                    <small><?= htmlspecialchars($workshop['started_at'] ?? '-') ?></small>
                                </div>

                                <div class="d-flex align-items-center">
                                    <i data-lucide="clock" class="icon"></i>
                                    <small><?= htmlspecialchars($workshop['time_at'] ?? '-') ?></small>
                                </div>

                                <div class="d-flex align-items-center">
                                    <i data-lucide="wallet" class="icon text-success"></i>
                                    <small class="fw-semibold text-success">Rp<?= number_format($workshop['price'] ?? 0, 0, ',', '.') ?></small>
                                </div>
                            </div>

                            <div class="mt-3 border-top pt-4">
                                <h2 class="h5 fw-semibold mb-3">Deskripsi Workshop</h2>
                                <div class="text-muted" style="line-height:1.6;">
                                    <p class="mb-3"><?= nl2br(htmlspecialchars($workshop['about'] ?? '-')) ?></p>

                                    <div class="pt-3 border-top mt-3">
                                        <h3 class="h6 fw-semibold mb-3 d-flex align-items-center">
                                            <i data-lucide="map-pin" class="icon"></i>
                                            <?= htmlspecialchars($workshop['address'] ?? 'Alamat tidak tersedia.') ?>
                                        </h3>

                                        <div class="">
                                            <p class="m-0 p-0">Vanue:</p>
                                            <?php
                                            $location_image = !empty($workshop['venue_thumbnail']) ? $workshop['venue_thumbnail'] : (!empty($workshop['bg_map']) ? $workshop['bg_map'] : null);
                                            $alt_text = !empty($workshop['venue_thumbnail']) ? 'Venue Thumbnail' : 'Background Map';
                                            ?>
                                        </div>

                                        <?php if (!empty($location_image)): ?>
                                            <img
                                                src="<?= htmlspecialchars($location_image) ?>"
                                                alt="<?= htmlspecialchars($alt_text) ?>"
                                                class="image-map mb-3"
                                                onerror="this.onerror=null; this.src='https://placehold.co/800x200/4c7c8c/ffffff?text=LOKASI+ACARA';">
                                        <?php endif; ?>

                                        <?php if (!empty($workshop['bg_map'])): ?>
                                            <a href="<?= htmlspecialchars($workshop['bg_map']) ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i data-lucide="external-link" class="icon"></i> Lihat di Google Maps
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Right: info & booking -->
                        <div class="col-12 col-md-5 p-3 p-md-4 bg-light border-start">
                            <div class="info-card p-3 sticky-card">
                                <h4 class="h6 fw-semibold mb-3">Informasi Event</h4>

                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <div class="d-flex align-items-center text-muted">
                                        <i data-lucide="check-circle" class="icon"></i>
                                        <small>Status Pendaftaran</small>
                                    </div>
                                    <?php $isOpen = !empty($workshop['is_open']); ?>
                                    <?php if ($isOpen): ?>
                                        <span class="badge bg-success">DIBUKA</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">DITUTUP</span>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <div class="d-flex align-items-center text-muted">
                                        <i data-lucide="tag" class="icon"></i>
                                        <small>Kategori</small>
                                    </div>
                                    <div class="small fw-medium text-dark">Teknologi & Bisnis</div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <div class="d-flex align-items-center text-muted">
                                        <i data-lucide="users" class="icon"></i>
                                        <small>Penyelenggara</small>
                                    </div>
                                    <div class="small fw-medium text-dark">ThreeTix</div>
                                </div>

                                <div class="mt-4">
                                    <p class="mb-1 muted-small">Harga Tiket</p>
                                    <p class="h4 fw-bold text-primary mb-0">Rp<?= number_format($workshop['price'] ?? 0, 0, ',', '.') ?></p>
                                </div>

                                <?php if ($isOpen): ?>
                                    <a href="/booking/create/<?= htmlspecialchars($workshop['slug']) ?>" class="btn btn-primary btn-lg w-100 mt-4 d-flex align-items-center justify-content-center">
                                        <i data-lucide="ticket" class="icon me-2"></i>
                                        Booking Sekarang
                                    </a>
                                <?php else: ?>
                                    <button disabled class="btn btn-secondary btn-lg w-100 mt-4">
                                        Pendaftaran Ditutup
                                    </button>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div> <!-- row g-0 -->
                </div> <!-- workshop-card -->
            </div>
        </div>
    </main>

    <?php require __DIR__ . '/../components/footer.php'; ?>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Init Lucide icons (sama seperti sebelumnya) -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>