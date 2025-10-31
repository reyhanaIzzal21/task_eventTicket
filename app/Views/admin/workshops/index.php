<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';

$i = 1;
?>

<style>
    .workshop-card {
        transition: all 0.3s ease;
        border: none !important;
        overflow: hidden;
    }

    .workshop-card:hover {
        transform: translateY(-8px);
    }

    .workshop-card-img {
        height: 220px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .workshop-card:hover .workshop-card-img {
        transform: scale(1.05);
    }

    .workshop-card-overlay {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    }
</style>

<div class="admin-main-content">
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1 fw-bold">Workshop Management</h3>
                <p class="text-muted mb-0 small">
                    <i class="bi bi-collection me-1"></i>
                    <?= count($workshops ?? []) ?> Total Workshops
                </p>
            </div>

            <div class="d-flex gap-2">
                <a class="btn btn-outline-secondary btn-sm d-none d-md-inline-flex align-items-center"
                    href="/admin/workshops">
                    <i class="bi bi-arrow-clockwise me-2"></i> Refresh
                </a>
                <a class="btn btn-primary btn-sm d-flex align-items-center shadow-sm"
                    href="/admin/workshops/create">
                    <i class="bi bi-plus-circle me-2"></i> Add Workshop
                </a>
            </div>
        </div>

        <?php if (empty($workshops)): ?>
            <div class="text-center py-4">
                <img src="/assets/images/empty-data.jpg" alt="empty data" class="img-fluid mb-3" style="max-width:200px;">
                <p class="mb-2">empty data</p>
            </div>
        <?php else: ?>
            <!-- Workshop Cards Grid -->
            <div class="row g-4">
                <?php foreach ($workshops as $workshop): ?>
                    <div class="col-sm-6 col-lg-4 col-xl-4">
                        <div class="card workshop-card h-100 shadow">
                            <!-- Image Section -->
                            <div class="position-relative overflow-hidden">
                                <?php if (!empty($workshop['thumbnail'])): ?>
                                    <img src="<?= htmlspecialchars($workshop['thumbnail']) ?>"
                                        class="card-img-top workshop-card-img"
                                        alt="<?= htmlspecialchars($workshop['name']) ?>">
                                <?php else: ?>
                                    <div class="bg-gradient d-flex align-items-center justify-content-center workshop-card-img"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="bi bi-image text-white" style="font-size: 3rem; opacity: 0.5;"></i>
                                    </div>
                                <?php endif; ?>

                                <!-- Gradient Overlay -->
                                <div class="position-absolute bottom-0 start-0 end-0 p-3 workshop-card-overlay">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <span class="badge bg-light text-dark fw-semibold px-3 py-2 rounded-pill">
                                                <i class="bi bi-tag-fill me-1"></i>
                                                Rp <?= number_format($workshop['price'], 0, ',', '.') ?>
                                            </span>
                                        </div>
                                        <div>
                                            <?php if ($workshop['is_open']): ?>
                                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                                    <i class="bi bi-door-open me-1"></i>Open
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                                    <i class="bi bi-lock-fill me-1"></i>Closed
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column p-3">
                                <!-- Title -->
                                <h5 class="card-title fw-bold mb-3 text-truncate"
                                    title="<?= htmlspecialchars($workshop['name']) ?>">
                                    <?= htmlspecialchars($workshop['name']) ?>
                                </h5>

                                <!-- Info Items -->
                                <div class="mb-3 flex-grow-1">
                                    <!-- Date & Time -->
                                    <div class="d-flex align-items-start mb-2 small">
                                        <div class="bg-primary bg-opacity-10 rounded p-2 me-2">
                                            <i class="bi bi-calendar-check text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold text-dark">
                                                <?= date('d M Y', strtotime($workshop['started_at'])) ?>
                                            </div>
                                            <?php if (!empty($workshop['time_at'])): ?>
                                                <small class="text-muted">
                                                    <i class="bi bi-clock me-1"></i><?= htmlspecialchars($workshop['time_at']) ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div class="d-flex align-items-center mb-2 small">
                                        <div class="bg-danger bg-opacity-10 rounded p-2 me-2">
                                            <i class="bi bi-geo-alt-fill text-danger"></i>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <p class="fw-semibold m-0 text-dark"
                                                style="max-width: 200px;"
                                                title="<?= htmlspecialchars($workshop['address'] ?? 'No address') ?>">
                                                <?= htmlspecialchars($workshop['address'] ?? 'No address') ?>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Map Link (if available) -->
                                    <?php if (!empty($workshop['bg_map'])): ?>
                                        <div class="mt-2">
                                            <a href="<?= htmlspecialchars($workshop['bg_map']) ?>"
                                                target="_blank"
                                                class="btn btn-sm btn-outline-secondary w-100 rounded-pill">
                                                <i class="bi bi-map me-1"></i>View on Map
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Action Buttons -->
                                <div class="border-top pt-3 mt-auto">
                                    <div class="d-flex gap-2 mb-2">
                                        <a href="/workshops/<?= htmlspecialchars($workshop['slug']) ?>"
                                            class="btn btn-sm btn-outline-primary flex-fill rounded-pill">
                                            <i class="bi bi-eye me-1"></i>View
                                        </a>
                                        <a href="/admin/workshops/edit/<?= $workshop['id'] ?>"
                                            class="btn btn-sm btn-warning flex-fill rounded-pill text-white">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                    </div>

                                    <form method="post"
                                        action="/admin/workshops/delete/<?= $workshop['id'] ?>"
                                        onsubmit="return confirm('⚠️ Are you sure you want to delete this workshop?\n\nWorkshop: <?= htmlspecialchars($workshop['name']) ?>');"
                                        class="mb-0">
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 rounded-pill">
                                            <i class="bi bi-trash3 me-1"></i>Delete Workshop
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>