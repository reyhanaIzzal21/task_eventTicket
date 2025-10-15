<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f8fa;
            margin: 0;
            padding: 30px;
        }
        .container {
            background: #fff;
            max-width: 700px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 10px;
        }
        .info p {
            margin: 6px 0;
        }
        .proof {
            margin-top: 20px;
        }
        .proof img {
            max-width: 100%;
            border-radius: 8px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        .back {
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail Booking</h1>
        <p><strong>Kode Transaksi:</strong> <?= htmlspecialchars($booking['booking_trx_id']) ?></p>

        <div class="info">
            <p><strong>Workshop:</strong> <?= htmlspecialchars($booking['workshop_name']) ?></p>
            <p><strong>Jumlah Tiket:</strong> <?= htmlspecialchars($booking['quantity']) ?></p>
            <p><strong>Total Pembayaran:</strong> Rp<?= number_format($booking['total_amount'], 0, ',', '.') ?></p>
            <p><strong>Status Pembayaran:</strong> <?= $booking['is_paid'] ? 'Sudah Dibayar' : 'Belum Dibayar' ?></p>
            <p><strong>Nama Pemesan:</strong> <?= htmlspecialchars($booking['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
            <p><strong>No. Telepon:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
            <p><strong>Bank:</strong> <?= htmlspecialchars($booking['customer_bank_name']) ?> (<?= htmlspecialchars($booking['customer_bank_account']) ?>)</p>
        </div>

        <?php if (!empty($booking['proof'])): ?>
            <div class="proof">
                <h3>Bukti Transfer:</h3>
                <img src="<?= htmlspecialchars($booking['proof']) ?>" alt="Bukti Pembayaran">
            </div>
        <?php endif; ?>

        <a href="/workshops/<?= htmlspecialchars($booking['workshop_slug']) ?>" class="back">← Kembali ke Workshop</a>
    </div>
</body>
</html>
