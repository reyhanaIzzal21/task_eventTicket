<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';

$i = 1;
?>

<div class="admin-main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="mb-0">Admin - Workshops</h3>
                <small class="text-muted">Manage your workshops</small>
            </div>

            <div class="actions-toolbar">
                <a class="btn btn-outline-secondary btn-sm d-none d-md-inline" href="/admin/workshops">
                    <i class="bi bi-arrow-clockwise"></i> Refresh
                </a>
                <a class="btn btn-primary btn-sm" href="/admin/workshops/create">
                    <i class="bi bi-plus-lg"></i> Create New Workshop
                </a>
            </div>
        </div>

        <div class="card section-card mb-4">
            <div class="card-body">
                <?php if (empty($workshops)): ?>
                    <div class="text-center py-4">
                        <p class="mb-2">No workshops yet.</p>
                        <a href="/admin/workshops/create" class="btn btn-outline-primary btn-sm">Create first workshop</a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px;">No</th>
                                    <th>Thumbnail</th>
                                    <th>Venue</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Start Date</th>
                                    <th>Bg Map</th>
                                    <th>Is Open</th>
                                    <th>Address</th>
                                    <th style="width:170px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($workshops as $workshop): ?>
                                    <tr>
                                        <!-- number -->
                                        <td><?= $i++ ?></td>

                                        <td>
                                            <?php if (!empty($workshop['thumbnail'])): ?>
                                                <img src="<?= htmlspecialchars($workshop['thumbnail']) ?>" alt="thumb" class="img-thumb">
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if (!empty($workshop['venue_thumbnail'])): ?>
                                                <img src="<?= htmlspecialchars($workshop['venue_thumbnail']) ?>" alt="venue" class="img-thumb">
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <strong><?= htmlspecialchars($workshop['name']) ?></strong><br>
                                        </td>

                                        <td>Rp <?= number_format($workshop['price'], 0, ',', '.') ?></td>
                                        <td><?= htmlspecialchars($workshop['started_at'] ?? '-') ?> <br><small class="text-muted"><?= htmlspecialchars($workshop['time_at'] ?? '') ?></small></td>

                                        <td>
                                            <?php if (!empty($workshop['bg_map'])): ?>
                                                <a href="<?= htmlspecialchars($workshop['bg_map']) ?>" target="_blank" class="small">View Map</a>
                                            <?php else: ?>
                                                <span class="text-muted small">-</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if ($workshop['is_open']): ?>
                                                <span class="badge bg-success">Open</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Closed</span>
                                            <?php endif; ?>
                                        </td>

                                        <td style="max-width:240px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            <?= htmlspecialchars($workshop['address'] ?? '-') ?>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-outline-primary" href="/admin/workshops/show/<?= $workshop['id'] ?>">Show</a>
                                            <a class="btn btn-sm btn-outline-warning" href="/admin/workshops/edit/<?= $workshop['id'] ?>">Edit</a>

                                            <form method="post" action="/admin/workshops/delete/<?= $workshop['id'] ?>" style="display:inline;">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this workshop?');">Delete</button>
                                            </form>
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