<?php
// booking/show.php (Bootstrap 5 version)
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Booking</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Optional: Bootstrap Icons (jika ingin ganti ikon nanti) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Lucide (dipertahankan seperti semula) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="stylesheet" href="/assets/landing.css">

    <style>
        :root {
            --brand-blue: #0b5ed7;
            --card-radius: 14px;
        }

        body {
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background-color: #f7fafc;
        }

        .panel-card {
            border-radius: var(--card-radius);
            background: #fff;
            border: 1px solid rgba(11, 94, 215, 0.06);
            box-shadow: 0 10px 30px rgba(11, 94, 215, 0.06);
        }

        .header-banner {
            background: var(--brand-blue);
            color: #fff;
            padding: 1.5rem;
            border-top-left-radius: var(--card-radius);
            border-top-right-radius: var(--card-radius);
        }

        .summary-panel {
            background: #f1f7ff;
            border-left: 4px solid var(--brand-blue);
            padding: 1rem;
            border-radius: 8px;
        }

        .muted-small {
            color: #6c757d;
            font-size: .95rem;
        }

        .info-item {
            padding: .7rem 0;
            border-bottom: 1px solid #e9eef8;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .proof-img {
            max-height: 400px;
            width: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        @media (max-width: 576px) {
            .header-banner {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <?php require __DIR__ . '/../components/header.php'; ?>

    <main class="container my-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="panel-card overflow-hidden">
                    <div class="header-banner text-center">
                        <h2 class="h5 mb-1 fw-bold">Detail Booking</h2>
                        <div class="small text-white-50">Informasi lengkap transaksi Anda.</div>
                    </div>

                    <div class="p-4 p-md-5">
                        <!-- Ringkasan Pesanan -->
                        <div class="mb-4 summary-panel">
                            <h6 class="mb-3 fw-bold d-flex align-items-center">
                                <i data-lucide="ticket" class="me-2" style="width:1.1rem;height:1.1rem;"></i>
                                Ringkasan Pesanan
                            </h6>

                            <div class="info-item">
                                <div class="muted-small">Kode Ticket</div>
                                <div class="fw-semibold"><?= htmlspecialchars($booking['booking_trx_id'] ?? '-') ?></div>
                            </div>

                            <!-- generate QR code -->
                            <div class="info-item">
                                <div class="muted-small">QR Ticket</div>
                                <div class="fw-semibold">
                                    <div id="qrcode"></div>
                                    <div class="muted-small mt-1">Tunjukkan QR ini saat masuk.</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="muted-small">Nama Workshop</div>
                                <div class="text-primary fw-semibold"><?= htmlspecialchars($booking['workshop_name'] ?? '-') ?></div>
                            </div>

                            <div class="info-item">
                                <div class="muted-small">Jumlah Tiket</div>
                                <div class="fw-semibold"><?= htmlspecialchars($booking['quantity'] ?? 1) ?></div>
                            </div>

                            <div class="info-item mt-3 pt-2 border-top">
                                <div class="fw-bold">Total Pembayaran</div>
                                <div class="fs-5 fw-extrabold text-primary">Rp<?= number_format($booking['total_amount'] ?? 0, 0, ',', '.') ?></div>
                            </div>
                        </div>

                        <!-- Status Pembayaran -->
                        <div class="mb-4">
                            <h6 class="mb-3 fw-bold d-flex align-items-center">
                                <i data-lucide="shield-check" class="me-2" style="width:1.1rem;height:1.1rem;"></i>
                                Status Pembayaran
                            </h6>

                            <?php if (!empty($booking['is_paid'])): ?>
                                <div class="p-3 rounded text-center fw-bold text-success bg-success bg-opacity-10 border border-success">
                                    <i data-lucide="check-circle" class="me-2" style="width:1.05rem;height:1.05rem;"></i>
                                    PEMBAYARAN SUDAH DITERIMA
                                </div>
                            <?php else: ?>
                                <div class="p-3 rounded text-center fw-bold text-warning bg-warning bg-opacity-10 border border-warning">
                                    <i data-lucide="clock" class="me-2" style="width:1.05rem;height:1.05rem;"></i>
                                    MENUNGGU PEMBAYARAN
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Detail Pemesan -->
                        <div class="mb-4 panel-card p-3">
                            <h6 class="mb-3 fw-bold d-flex align-items-center">
                                <i data-lucide="user" class="me-2" style="width:1.1rem;height:1.1rem;"></i>
                                Detail Pemesan
                            </h6>

                            <div class="mb-2 d-flex justify-content-between">
                                <div class="muted-small">Nama</div>
                                <div class="fw-medium"><?= htmlspecialchars($booking['name'] ?? '-') ?></div>
                            </div>

                            <div class="mb-2 d-flex justify-content-between">
                                <div class="muted-small">Email</div>
                                <div class="fw-medium"><?= htmlspecialchars($booking['email'] ?? '-') ?></div>
                            </div>

                            <div class="mb-2 d-flex justify-content-between">
                                <div class="muted-small">Telepon</div>
                                <div class="fw-medium"><?= htmlspecialchars($booking['phone'] ?? '-') ?></div>
                            </div>

                            <div class="pt-2 mt-2 border-top d-flex justify-content-between">
                                <div class="muted-small">Transfer Dari</div>
                                <div class="fw-medium"><?= htmlspecialchars($booking['customer_bank_name'] ?? '-') ?> (<?= htmlspecialchars($booking['customer_bank_account'] ?? '-') ?>)</div>
                            </div>
                        </div>

                        <!-- Bukti Transfer -->
                        <?php if (!empty($booking['proof'])): ?>
                            <div class="mb-4">
                                <h6 class="mb-3 fw-bold text-center">Bukti Transfer</h6>

                                <div class="bg-light p-3 rounded">
                                    <a href="<?= htmlspecialchars($booking['proof']) ?>" target="_blank" class="d-block">
                                        <img
                                            src="<?= htmlspecialchars($booking['proof']) ?>"
                                            alt="Bukti Pembayaran"
                                            class="proof-img mx-auto d-block shadow-sm"
                                            onerror="this.onerror=null; this.src='https://placehold.co/400x400/cccccc/333333?text=BUKTI+TIDAK+DITEMUKAN';">
                                    </a>
                                    <p class="text-center text-muted small mt-2 mb-0">Klik gambar untuk melihat lebih jelas</p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Tombol Kembali -->
                        <div class="text-center mt-4">
                            <a href="/workshops/<?= htmlspecialchars($booking['workshop_slug'] ?? '') ?>" class="btn btn-primary btn-lg rounded-pill d-inline-flex align-items-center">
                                <i data-lucide="arrow-left" class="me-2" style="width:1.05rem;height:1.05rem;"></i>
                                Kembali ke Workshop
                            </a>
                        </div>

                    </div> <!-- p-4 -->
                </div> <!-- panel-card -->
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        // Variabel berikut diisi dari PHP (server-side) saat rendering view
        const bookingTransactionId = '<?php echo addslashes($booking["booking_trx_id"] ?? ""); ?>';
        const expiryTimestamp = <?php echo isset($qrExpiry) ? (int)$qrExpiry : 0; ?>;
        const token = '<?php echo addslashes($qrToken ?? ""); ?>';

        // Bangun URL verify (gunakan path sesuai Opsi A atau B)
        const verifyUrl = window.location.protocol + '//' + window.location.host +
            '/booking/verify?trx=' + encodeURIComponent(bookingTransactionId) +
            (expiryTimestamp ? '&exp=' + expiryTimestamp : '') +
            (token ? '&token=' + encodeURIComponent(token) : '');

        // Render QR
        new QRCode(document.getElementById('qrcode'), {
            text: verifyUrl,
            width: 160,
            height: 160
        });
    </script>

    <?php require __DIR__ . '/../components/footer.php'; ?>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Init Lucide icons -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>