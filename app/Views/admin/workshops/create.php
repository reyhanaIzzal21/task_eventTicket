<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="admin-main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">Create Workshop</h4>
                <small class="text-muted">Tambah data workshop baru</small>
            </div>
            <a href="/admin/workshops" class="btn btn-outline-secondary btn-sm">Back to list</a>
        </div>

        <div class="card form-card">
            <div class="card-body">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post" action="/admin/workshops/store" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label">Name</label>
                            <input name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required class="form-control form-control-sm">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Price (IDR)</label>
                            <input type="number" name="price" value="<?= htmlspecialchars($old['price'] ?? 0) ?>" required class="form-control form-control-sm">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" accept="image/*" class="form-control form-control-sm" id="thumbnailInput">
                            <img id="thumbnailPreview" class="image-preview mt-2 d-none" alt="preview">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Venue Thumbnail</label>
                            <input type="file" name="venue_thumbnail" accept="image/*" class="form-control form-control-sm" id="venueInput">
                            <img id="venuePreview" class="image-preview mt-2 d-none" alt="preview">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Background Map (URL)</label>
                            <input type="url" name="bg_map" placeholder="https://maps.google.com/..." value="<?= htmlspecialchars($old['bg_map'] ?? '') ?>" class="form-control form-control-sm">
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="started_at" value="<?= htmlspecialchars($old['started_at'] ?? '') ?>" class="form-control form-control-sm">
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Time</label>
                            <input type="time" name="time_at" value="<?= htmlspecialchars($old['time_at'] ?? '') ?>" class="form-control form-control-sm">
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Is Open</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_open" id="isOpenSwitch" <?= (!empty($old['is_open']) ? 'checked' : '') ?>>
                                <label class="form-check-label" for="isOpenSwitch"><?= (!empty($old['is_open']) ? 'Open' : 'Closed') ?></label>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control form-control-sm" rows="2"><?= htmlspecialchars($old['address'] ?? '') ?></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">About</label>
                            <textarea name="about" class="form-control form-control-sm" rows="4"><?= htmlspecialchars($old['about'] ?? '') ?></textarea>
                        </div>

                        <div class="col-12 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Create Workshop</button>
                            <a href="/admin/workshops" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- small JS for image preview -->
<script>
    function previewImage(inputEl, previewElId) {
        const file = inputEl.files && inputEl.files[0];
        const img = document.getElementById(previewElId);
        if (!file) {
            img.classList.add('d-none');
            img.src = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            img.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }

    document.getElementById('thumbnailInput')?.addEventListener('change', function() {
        previewImage(this, 'thumbnailPreview');
    });
    document.getElementById('venueInput')?.addEventListener('change', function() {
        previewImage(this, 'venuePreview');
    });
</script>