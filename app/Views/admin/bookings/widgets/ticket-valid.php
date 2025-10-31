<?php
// app/Views/bookings/widgets/ticket-valid.php
// Mengharapkan variabel $booking (array) tersedia dari controller

// fallback jika $booking tidak ada
if (!isset($booking) || !is_array($booking)) {
    echo '<div class="alert alert-danger">No booking data provided.</div>';
    return;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Ticket Valid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            padding: 30px;
        }

        .ticket-card {
            max-width: 540px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="ticket-card">
        <div class="card border-success shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-success"><i class="bi bi-ticket-perforated-fill"></i> Ticket Valid</h4>
                <p class="text-muted small">Tiket berhasil diverifikasi dan ditandai sebagai dipakai.</p>

                <dl class="row">
                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($booking['name']); ?></dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($booking['email']); ?></dd>

                    <dt class="col-sm-4">Workshop ID</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($booking['workshop_id']); ?></dd>

                    <dt class="col-sm-4">Quantity</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($booking['quantity']); ?></dd>

                    <dt class="col-sm-4">Booking Trx</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($booking['booking_trx_id']); ?></dd>

                    <dt class="col-sm-4">Marked used at</dt>
                    <dd class="col-sm-8"><?= htmlspecialchars($booking['marked_used_at'] ?? $booking['used_at'] ?? date('Y-m-d H:i:s')); ?></dd>
                </dl>

                <div class="mt-3">
                    <a href="/admin/bookings" class="btn btn-outline-secondary btn-sm">Back to Bookings</a>
                    <button onclick="window.print()" class="btn btn-success btn-sm">Print</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>