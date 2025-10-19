<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="admin-main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">Booking Detail</h4>
                <small class="text-muted">Transaction detail & approval</small>
            </div>

            <div class="d-flex gap-2">
                <a href="/admin/bookings" class="btn btn-outline-secondary btn-sm">Back to bookings</a>
                <?php if (!empty($booking['booking_trx_id'])): ?>
                    <a href="/admin/bookings/<?= htmlspecialchars($booking['booking_trx_id']) ?>/print" target="_blank" class="btn btn-outline-primary btn-sm">Print</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row g-3">
            <!-- Left: Booking & User Info -->
            <div class="col-12 col-md-6">
                <div class="card section-card mb-3">
                    <div class="card-body">
                        <h6 class="mb-3">Booking Information</h6>

                        <dl class="row">
                            <dt class="col-sm-4 text-muted">Ticket Code</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['booking_trx_id'] ?? '-') ?></dd>

                            <dt class="col-sm-4 text-muted">Booked At</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['created_at'] ?? '-') ?></dd>

                            <dt class="col-sm-4 text-muted">Total</dt>
                            <dd class="col-sm-8">Rp <?= number_format($booking['total_amount'] ?? 0, 0, ',', '.') ?></dd>

                            <dt class="col-sm-4 text-muted">Status Transaction</dt>
                            <dd class="col-sm-8">
                                <?php if (!empty($booking['is_paid'])): ?>
                                    <span class="badge bg-success">Paid</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                <?php endif; ?>
                            </dd>

                            <dt class="col-sm-4 text-muted">Bank Name</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['customer_bank_name'] ?? '-') ?></dd>

                            <dt class="col-sm-4 text-muted">Bank Account</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['customer_bank_account'] ?? '-') ?></dd>

                            <dt class="col-sm-4 text-muted">Bank Number</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['customer_bank_number'] ?? '-') ?></dd>
                        </dl>

                        <!-- Approve form -->
                        <div class="mt-3">
                            <?php if (empty($booking['is_paid'])): ?>
                                <form method="post" action="/admin/bookings/approve/<?= $booking['id'] ?>" onsubmit="return confirm('Approve this booking and mark as paid?');" class="d-inline">
                                    <?php if (!empty($csrfToken)): ?>
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle"></i> Approve Payment
                                    </button>
                                </form>

                                <!-- Optional: decline/cancel button -->
                                <!-- <form method="post" action="/admin/bookings/cancel/<?= $booking['id'] ?>" onsubmit="return confirm('Cancel this booking?');" class="d-inline ms-2">
                                    <?php if (!empty($csrfToken)): ?>
                                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken) ?>">
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-outline-danger">Cancel Booking</button>
                                </form> -->
                            <?php else: ?>
                                <span class="text-success"><i class="bi bi-check-circle"></i> This booking is approved</span>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>

                <div class="card section-card">
                    <div class="card-body">
                        <h6 class="mb-3">User Information</h6>
                        <dl class="row">
                            <dt class="col-sm-4 text-muted">Name</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['name'] ?? '-') ?></dd>

                            <dt class="col-sm-4 text-muted">Email</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['email'] ?? '-') ?></dd>

                            <dt class="col-sm-4 text-muted">Phone</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['phone'] ?? '-') ?></dd>

                            <dt class="col-sm-4 text-muted">Quantity Ticket</dt>
                            <dd class="col-sm-8"><?= htmlspecialchars($booking['quantity'] ?? 1) ?></dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Right: Workshop info & Proof -->
            <div class="col-12 col-md-6">
                <div class="card section-card mb-3">
                    <div class="card-body">
                        <h6 class="mb-3">Workshop</h6>
                        <div class="d-flex gap-3 align-items-start">
                            <?php if (!empty($booking['workshop_thumbnail'])): ?>
                                <img src="<?= htmlspecialchars($booking['workshop_thumbnail']) ?>" class="image-preview" alt="workshop-thumb" style="width:120px;height:80px;object-fit:cover;">
                            <?php endif; ?>

                            <div>
                                <div class="fw-semibold"><?= htmlspecialchars($booking['workshop_name'] ?? '-') ?></div>
                                <div class="text-muted small">
                                    <?= htmlspecialchars($booking['workshop_started_at'] ?? '-') ?> <?= htmlspecialchars($booking['workshop_time_at'] ?? '') ?>
                                </div>
                                <div class="mt-2 small text-muted" style="max-width:380px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                    <?= htmlspecialchars($booking['workshop_address'] ?? '-') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card section-card">
                    <div class="card-body">
                        <h6 class="mb-3">Proof of Payment</h6>

                        <?php if (!empty($booking['proof'])): ?>
                            <?php
                            $proofUrl = htmlspecialchars($booking['proof']);
                            $isImage = preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $booking['proof']);
                            ?>
                            <?php if ($isImage): ?>
                                <div class="mb-2">
                                    <a href="#" id="proofThumb" data-proof="<?= $proofUrl ?>" class="d-inline-block">
                                        <img src="<?= $proofUrl ?>" alt="proof" class="image-preview" style="max-width:260px;max-height:180px;">
                                    </a>
                                </div>
                                <div>
                                    <a id="openProofLink" href="<?= $proofUrl ?>" target="_blank" class="btn btn-sm btn-outline-primary">Open full image</a>
                                </div>
                            <?php else: ?>
                                <p class="small"><a href="<?= $proofUrl ?>" target="_blank">Open proof file</a></p>
                            <?php endif; ?>
                        <?php else: ?>
                            <p class="text-muted small mb-0">No proof uploaded.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for proof preview -->
<div class="modal fade" id="proofModal" tabindex="-1" aria-labelledby="proofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="proofModalLabel">Proof of Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="proofModalImage" src="" alt="proof" style="max-width:100%; height:auto; border-radius:8px;">
            </div>
            <div class="modal-footer">
                <a id="proofModalOpen" href="#" target="_blank" class="btn btn-outline-secondary">Open in new tab</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // preview modal for proof image (bindings on thumbnail)
    document.getElementById('proofThumb')?.addEventListener('click', function(e) {
        e.preventDefault();
        const proof = this.getAttribute('data-proof');
        if (!proof) return;
        document.getElementById('proofModalImage').src = proof;
        document.getElementById('proofModalOpen').href = proof;
        const modal = new bootstrap.Modal(document.getElementById('proofModal'));
        modal.show();
    });
</script>