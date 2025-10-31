<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';

$i = 1;
?>

<div class="admin-main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="mb-0">Manege User</h3>
                <small class="text-muted">Manage your users</small>
            </div>
        </div>

        <div class="card section-card mb-4">
            <div class="card-body">
                <?php if (empty($userRecords)): ?>
                    <div class="text-center py-4">
                        <img src="/assets/images/empty-data.jpg" alt="empty data" class="img-fluid mb-3" style="max-width:200px;">
                        <p class="mb-2">empty data</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px;">No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th style="width:170px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($userRecords as $user): ?>
                                    <tr>
                                        <!-- number -->
                                        <td><?= $i++ ?></td>

                                        <td>
                                            <?= htmlspecialchars($user['name'] ?? '-') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($user['email'] ?? '-') ?>
                                        </td>

                                        <td>
                                            <?= htmlspecialchars($user['role'] ?? '-') ?>
                                        </td>

                                        <td class="d-flex gap-2">
                                            <a class="btn btn-sm btn-outline-primary" href="/admin/users/show/<?= $user['id'] ?>">Show</a>
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