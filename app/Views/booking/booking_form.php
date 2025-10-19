<?php
// booking/create.php (Bootstrap 5 version)
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Workshop - <?= htmlspecialchars($workshop['name']) ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Bootstrap Icons (opsional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Lucide (dipertahankan dari original untuk ikon) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Optional custom CSS -->
    <link rel="stylesheet" href="/assets/landing.css">

    <style>
        :root {
            --brand-blue: #0b5ed7;
            --card-radius: 16px;
        }

        body {
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background-color: #f7fafc;
        }

        .booking-card {
            border-radius: var(--card-radius);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(11, 94, 215, 0.06);
            border: 1px solid rgba(11, 94, 215, 0.06);
            background: #fff;
        }

        .booking-header {
            background: var(--brand-blue);
            color: #fff;
            padding: 1.5rem 1.5rem;
        }

        .workshop-summary {
            background: #f1f7ff;
            border-left: 4px solid var(--brand-blue);
            padding: 1rem;
            border-radius: 8px;
        }

        .icon-md {
            width: 1.25rem;
            height: 1.25rem;
            margin-right: .5rem;
        }

        /* file input styling helper (bootstrap default is okay, add small touch) */
        .form-file-label {
            display: inline-block;
        }

        .bank-card {
            transition: all 0.3s ease;

        }

        .bank-card:hover {
            transform: translateY(-3px);
        }

        .bank-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }

        .account-number {
            letter-spacing: 2px;
        }

        @media (max-width: 576px) {
            .booking-header h1 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body>
    <?php require __DIR__ . '/../components/header.php'; ?>
    <main class="container d-flex justify-content-center py-4">
        <div class="w-100" style="max-width: 720px;">
            <div class="booking-card">
                <!-- Header -->
                <div class="booking-header text-center">
                    <h1 class="h4 mb-1 fw-bold">Booking Workshop <?= htmlspecialchars($workshop['name']) ?></h1>
                    <p class="mb-0 text-white-50">Isi formulir untuk mengamankan tempat Anda.</p>
                </div>

                <div class="p-4 p-md-5">
                    <!-- Workshop summary -->
                    <div class="workshop-summary mb-4">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start gap-2">
                            <div>
                                <div class="text-primary small mb-1 d-flex align-items-center">
                                    <i data-lucide="calendar-check" class="icon-md"></i>
                                    <strong class="small">Workshop yang Dipilih</strong>
                                </div>
                                <div class="h6 fw-bold mb-1"><?= htmlspecialchars($workshop['name']) ?></div>
                            </div>

                            <div class="text-sm-end mt-2 mt-sm-0">
                                <div class="small text-muted">Harga Tiket</div>
                                <div class="h5 fw-bold text-success">Rp<?= number_format($workshop['price'] ?? 0, 0, ',', '.') ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form action="/booking/store" method="POST" enctype="multipart/form-data" class="row g-3">
                        <input type="hidden" name="workshop_slug" value="<?= htmlspecialchars($workshop['slug']) ?>">

                        <!-- Section: Detail Pemesan -->
                        <div class="col-12">
                            <h3 class="h6 fw-semibold border-bottom pb-2 mb-3 d-flex align-items-center">
                                <i data-lucide="user-circle" class="icon-md me-2 text-primary"></i>
                                Detail Pemesan
                            </h3>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" required class="form-control form-control-sm" placeholder="Contoh: Budi Santoso">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="phone" class="form-label">No. HP</label>
                            <input type="tel" name="phone" id="phone" required class="form-control form-control-sm" placeholder="Contoh: 081234567890">
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" required class="form-control form-control-sm" placeholder="Contoh: nama@example.com">
                        </div>

                        <!-- Section: Detail Pembayaran -->
                        <div class="col-12">
                            <h3 class="h6 fw-semibold border-bottom pb-2 pt-3 mb-3 d-flex align-items-center">
                                <i data-lucide="banknote" class="icon-md me-2 text-primary"></i>
                                Detail Pembayaran
                            </h3>
                        </div>

                        <!-- tranfer ke bank di dibawah ini -->
                        <h3 class="h6 fw-semibold p-0 m-0 text-center">
                            Tranfer ke Rekening Berikut:
                        </h3>
                        <!-- BCA -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card bank-card border-2 h-100 shadow-sm" role="button" onclick="selectBank(this, 'bca')">
                                <div class="card-body p-0 pb-3 position-relative">
                                    <i class="bi bi-check-circle-fill text-primary fs-4 position-absolute top-0 end-0 m-3 d-none"></i>

                                    <div class="text-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png"
                                            alt="BCA" class="bank-logo">
                                        <h5 class="fw-semibold mb-1">Bank BCA</h5>
                                        <small class="text-muted">No Rekening: 1234567890</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BNI -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card bank-card border-2 h-100 shadow-sm" role="button" onclick="selectBank(this, 'bni')">
                                <div class="card-body p-0 pb-3 position-relative">
                                    <i class="bi bi-check-circle-fill text-primary fs-4 position-absolute top-0 end-0 m-3 d-none"></i>

                                    <div class="text-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Bank_Negara_Indonesia_logo_%282004%29.svg/2560px-Bank_Negara_Indonesia_logo_%282004%29.svg.png"
                                            alt="BNI" class="bank-logo">
                                        <h5 class="fw-semibold mb-1">Bank BNI</h5>
                                        <small class="text-muted">No Rekening: 1234567890</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BRI -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card bank-card border-2 h-100 shadow-sm" role="button" onclick="selectBank(this, 'bri')">
                                <div class="card-body p-0 pb-3 position-relative">
                                    <i class="bi bi-check-circle-fill text-primary fs-4 position-absolute top-0 end-0 m-3 d-none"></i>

                                    <div class="text-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/BRI_2020.svg/2560px-BRI_2020.svg.png"
                                            alt="BRI" class="bank-logo">
                                        <h5 class="fw-semibold mb-1">Bank BRI</h5>
                                        <small class="text-muted">No Rekening: 1234567890</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MANDIRI -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card bank-card border-2 h-100 shadow-sm" role="button" onclick="selectBank(this, 'mandiri')">
                                <div class="card-body p-0 pb-3 position-relative">
                                    <i class="bi bi-check-circle-fill text-primary fs-4 position-absolute top-0 end-0 m-3 d-none"></i>

                                    <div class="text-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png"
                                            alt="MANDIRI" class="bank-logo">
                                        <h5 class="fw-semibold mb-1">Bank MANDIRI</h5>
                                        <small class="text-muted">No Rekening: 1234567890</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CIMB NIAGA -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card bank-card border-2 h-100 shadow-sm" role="button" onclick="selectBank(this, 'cimb')">
                                <div class="card-body p-0 pb-3 position-relative">
                                    <i class="bi bi-check-circle-fill text-primary fs-4 position-absolute top-0 end-0 m-3 d-none"></i>

                                    <div class="text-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/3/38/CIMB_Niaga_logo.svg"
                                            alt="CIMB" class="bank-logo">
                                        <h5 class="fw-semibold mb-1">Bank CIMB Niaga</h5>
                                        <small class="text-muted">No Rekening: 123456789034</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- BSI -->
                        <div class="col-md-6 col-lg-4">
                            <div class="card bank-card border-2 h-100 shadow-sm" role="button" onclick="selectBank(this, 'bsi')">
                                <div class="card-body p-0 pb-3 position-relative">
                                    <i class="bi bi-check-circle-fill text-primary fs-4 position-absolute top-0 end-0 m-3 d-none"></i>

                                    <div class="text-center">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Bank_Syariah_Indonesia.svg/2560px-Bank_Syariah_Indonesia.svg.png"
                                            alt="BSI" class="bank-logo">
                                        <h5 class="fw-semibold mb-1">Bank BSI</h5>
                                        <small class="text-muted">No Rekening: 1234567890</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="customer_bank_name" class="form-label">Nama Bank Transfer</label>
                            <input type="text" name="customer_bank_name" id="customer_bank_name" required class="form-control form-control-sm" placeholder="Contoh: Bank BCA">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="customer_bank_account" class="form-label">Nama Pemilik Rekening</label>
                            <input type="text" name="customer_bank_account" id="customer_bank_account" required class="form-control form-control-sm" placeholder="Sesuai nama di rekening">
                        </div>

                        <div class="col-12">
                            <label for="customer_bank_number" class="form-label">Nomor Rekening</label>
                            <input type="text" name="customer_bank_number" id="customer_bank_number" required class="form-control form-control-sm" placeholder="Nomor rekening Anda">
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="quantity" class="form-label">Jumlah Tiket</label>
                            <input type="number" name="quantity" id="quantity" min="1" value="1" required class="form-control form-control-sm">
                        </div>

                        <div class="col-12">
                            <label for="proof" class="form-label">Bukti Transfer</label>
                            <input type="file" name="proof" id="proof" accept=".jpg,.jpeg,.png" class="form-control form-control-sm" required>
                        </div>

                        <!-- Submit -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center">
                                <i data-lucide="send" class="icon-md me-2"></i>
                                Kirim Booking
                            </button>
                        </div>

                        <div class="col-12 text-center mt-2">
                            <a href="/workshops" class="text-primary text-decoration-none">
                                <i data-lucide="arrow-left" class="icon-md me-1"></i>
                                Kembali ke daftar workshop
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php  require __DIR__ . '/../components/footer.php'; ?>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Init Lucide icons -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>