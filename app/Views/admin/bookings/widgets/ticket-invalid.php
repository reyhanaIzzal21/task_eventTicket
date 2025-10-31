<?php
// app/Views/bookings/widgets/ticket-invalid.php
// Mengharapkan variabel $reason (string) atau $usedAt tersedia dari controller

$reason = isset($reason) ? $reason : 'Invalid ticket.';
$usedAt = isset($usedAt) ? $usedAt : null;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Ticket Invalid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff6f6;
            padding: 30px;
        }

        .box {
            max-width: 540px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="box">
        <div class="card border-danger shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-danger"><i class="bi bi-x-circle-fill"></i> Ticket Invalid</h4>
                <p class="text-muted small">Tiket tidak dapat diverifikasi.</p>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($reason); ?>
                    <?php if ($usedAt): ?>
                        <div class="mt-2"><strong>Used at:</strong> <?= htmlspecialchars($usedAt); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mt-3">
                    <a href="/admin/bookings" class="btn btn-outline-secondary btn-sm">Back to Bookings</a>
                    <a href="javascript:history.back()" class="btn btn-danger btn-sm">Scan Again</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>