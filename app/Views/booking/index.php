<?php
// app/Views/booking/index.php
// Variabel yang tersedia: $bookings (array)
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Daftar Booking Saya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/assets/landing.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
        body {
            background: #f5f7fb;
        }

        .card-booking {
            border-radius: 12px;
            transition: transform .12s ease, box-shadow .12s ease;
            overflow: hidden;
            position: relative;
        }

        .card-booking:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 40px rgba(2, 6, 23, .08);
        }

        .thumb {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
        }

        .status-paid {
            color: #198754;
            font-weight: 700;
        }

        .status-unpaid {
            color: #dc3545;
            font-weight: 700;
        }

        .small-muted {
            color: #6c757d;
            font-size: .95rem;
        }

        .meta-pill {
            font-size: .85rem;
            padding: .25rem .6rem;
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.04);
        }

        .stretched-card {
            display: block;
            color: inherit;
            text-decoration: none;
        }

        .card-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 3;
        }

        .card-footer-compact {
            font-size: .9rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <?php require __DIR__ . '/../components/header.php'; ?>

    <main class="container py-4">
        <div class="mx-auto">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h4 mb-0">Workshop yang Anda ikuti</h1>
            </div>

            <?php if (empty($bookings)): ?>
                <div class="text-center py-4">
                    <img src="/assets/images/empty-data.jpg" alt="empty data" class="img-fluid mb-3" style="max-width:200px;">
                    <p class="mb-2">empty data</p>
                </div>
            <?php else: ?>
                <div class="row g-3">
                    <?php foreach ($bookings as $booking): ?>
                        <?php
                        // Safe helpers (tetap pakai nama variable yang kamu punya)
                        $workshopThumbnail = !empty($booking['workshop_thumbnail']) ? $booking['workshop_thumbnail'] : '/assets/default-thumb.png';
                        $workshopName = $booking['workshop_name'] ?? '';
                        $bookingTrxId = $booking['booking_trx_id'] ?? '';
                        $isPaid = (int)($booking['is_paid'] ?? 0);
                        $workshopStartedAtRaw = $booking['workshop_started_at'] ?? null;
                        $workshopTimeAtRaw = $booking['workshop_time_at'] ?? null;
                        $bookingCreatedAtRaw = $booking['booking_created_at'] ?? null;

                        // Format tanggal/waktu
                        $workshopDate = '';
                        if (!empty($workshopStartedAtRaw)) {
                            $ts = strtotime($workshopStartedAtRaw);
                            $workshopDate = $ts !== false ? date('d M Y', $ts) : htmlspecialchars((string)$workshopStartedAtRaw, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                        }

                        $workshopTime = '';
                        if (!empty($workshopTimeAtRaw)) {
                            $ts2 = strtotime($workshopTimeAtRaw);
                            $workshopTime = $ts2 !== false ? date('H:i', $ts2) : htmlspecialchars((string)$workshopTimeAtRaw, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                        }

                        $bookingCreatedAt = '';
                        if (!empty($bookingCreatedAtRaw)) {
                            $ts3 = strtotime($bookingCreatedAtRaw);
                            $bookingCreatedAt = $ts3 !== false ? date('d M Y H:i', $ts3) : htmlspecialchars((string)$bookingCreatedAtRaw, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                        }

                        $quantity = (int)($booking['quantity'] ?? 0);
                        $totalAmount = (int)($booking['total_amount'] ?? 0);
                        $workshopPrice = (int)($booking['workshop_price'] ?? 0);
                        ?>

                        <div class="col-12 col-md-6">
                            <!-- whole card clickable to booking show (use booking_trx_id) -->
                            <a href="/booking/show/<?= urlencode($bookingTrxId) ?>" class="stretched-card">
                                <div class="card card-booking p-3">
                                    <!-- paid/unpaid badge -->
                                    <div class="card-badge">
                                        <?php if ($isPaid): ?>
                                            <span class="badge bg-success">Paid</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Not paid</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="d-flex gap-3">
                                        <img src="<?= htmlspecialchars($workshopThumbnail, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" alt="thumb" class="thumb flex-shrink-0">

                                        <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                            <div>
                                                <h5 class="mb-1" style="line-height:1.05;">
                                                    <?= htmlspecialchars($workshopName, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                                                </h5>

                                                <div class="d-flex flex-wrap gap-2 mb-2 align-items-center">
                                                    <div class="meta-pill">
                                                        <i class="bi bi-calendar-event me-1"></i>
                                                        <?= $workshopDate ?: '-' ?>
                                                    </div>
                                                    <?php if ($workshopTime): ?>
                                                        <div class="meta-pill">Jam: <?= htmlspecialchars($workshopTime, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></div>
                                                    <?php endif; ?>
                                                    <div class="meta-pill">Qty: <?= $quantity ?></div>
                                                    <div class="meta-pill">Harga: Rp <?= number_format($workshopPrice, 0, ',', '.') ?></div>
                                                </div>

                                                <p class="mb-0 small-muted">
                                                    Total: <strong>Rp <?= number_format($totalAmount, 0, ',', '.') ?></strong>
                                                </p>
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div class="card-footer-compact">
                                                    <small>Booked at</small><br>
                                                    <small class="text-muted"><?= $bookingCreatedAt ?: '-' ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php require __DIR__ . '/../components/footer.php'; ?>

    <!-- Bootstrap JS bundle & optional icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>