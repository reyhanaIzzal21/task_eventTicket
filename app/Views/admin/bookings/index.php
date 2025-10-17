<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';

$i = 1;
?>

<div class="admin-main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">Bookings</h4>
                <small class="text-muted">Manage booking transactions</small>
            </div>
            <div>
                <a href="/admin/bookings" class="btn btn-outline-secondary btn-sm me-1 d-none d-md-inline">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </a>
            </div>
        </div>

        <div class="card section-card">
            <div class="card-body">
                <?php if (empty($bookings)): ?>
                    <div class="text-center py-4">
                        <p class="mb-2">No bookings yet.</p>
                        <a href="/admin/workshops" class="btn btn-outline-primary btn-sm">Create workshop</a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px">No</th>
                                    <th class="d-none d-sm-table-cell">Ticket Code</th>
                                    <th>Name</th>
                                    <th class="d-none d-md-table-cell">Workshop</th>
                                    <th class="text-end">Total</th>
                                    <th class="d-none d-sm-table-cell">Proof</th>
                                    <th class="text-center">Is Paid</th>
                                    <th style="width:120px">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>

                                        <td class="d-none d-sm-table-cell">
                                            <small class="text-muted"><?= htmlspecialchars($booking['booking_trx_id']) ?></small>
                                        </td>

                                        <td>
                                            <div class="fw-semibold"><?= htmlspecialchars($booking['name']) ?></div>
                                            <small class="text-muted"><?= htmlspecialchars($booking['email'] ?? '') ?></small>
                                        </td>

                                        <td class="d-none d-md-table-cell"><?= htmlspecialchars($booking['workshop_name'] ?? '-') ?></td>

                                        <td class="text-end">Rp <?= number_format($booking['total_amount'], 0, ',', '.') ?></td>

                                        <td class="d-none d-sm-table-cell">
                                            <?php if (!empty($booking['proof'])): ?>
                                                <!-- thumbnail proof jika image, atau link jika bukan image -->
                                                <?php
                                                $proofUrl = htmlspecialchars($booking['proof']);
                                                $isImage = preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $booking['proof']);
                                                ?>
                                                <?php if ($isImage): ?>
                                                    <a href="#" class="proof-preview-link" data-proof="<?= $proofUrl ?>" title="View proof">
                                                        <img src="<?= $proofUrl ?>" alt="proof" class="image-preview" style="max-width:80px;max-height:60px;">
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= $proofUrl ?>" target="_blank" class="small">View proof</a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <?php if (!empty($booking['is_paid'])): ?>
                                                <span class="badge bg-success">Paid</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <div class="d-flex gap-1">
                                                <a class="btn btn-sm btn-outline-primary" href="/admin/booking/show/<?= htmlspecialchars($booking['booking_trx_id']) ?>">
                                                    <i class="bi bi-eye"></i> View
                                                </a>

                                                <!-- contoh button mark-as-paid (pastikan route tersedia di backend) -->
                                                <?php if (empty($booking['is_paid'])): ?>
                                                    <form method="post" action="/admin/bookings/mark-paid/<?= $booking['id'] ?>" class="m-0">
                                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Mark booking as paid?');">
                                                            <i class="bi bi-cash-stack"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk preview bukti pembayaran (proof) -->
<div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proofModalLabel">Proof of Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="proofModalImage" src="" alt="proof" style="max-width:100%; height:auto; border-radius:8px;">
            </div>
            <div class="modal-footer">
                <a id="proofModalLink" href="#" target="_blank" class="btn btn-outline-secondary">Open in new tab</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // buka modal dan set gambar proof jika thumbnail diklik
    document.querySelectorAll('.proof-preview-link').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            const proof = this.getAttribute('data-proof');
            const img = document.getElementById('proofModalImage');
            const link = document.getElementById('proofModalLink');
            img.src = proof;
            link.href = proof;
            var modal = new bootstrap.Modal(document.getElementById('proofModal'));
            modal.show();
        });
    });
</script>