<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <h1>Create Workshop</h1>
    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li><?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="/admin/workshops/store" enctype="multipart/form-data">
        <div class="field">
            <label>Name</label>
            <input name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail" accept="image/*">
        </div>

        <div class="field">
            <label>Venue Thumbnail</label>
            <input type="file" name="venue_thumbnail" accept="image/*">
        </div>

        <div class="field">
            <label>Background Map (URL)</label>
            <input type="url" name="bg_map" placeholder="https://maps.google.com/..."
                value="<?= htmlspecialchars($old['bg_map'] ?? '') ?>">
        </div>

        <div class="field">
            <label>Price</label>
            <input type="number" name="price" value="<?= htmlspecialchars($old['price'] ?? 0) ?>" required>
        </div>

        <div class="field">
            <label>Start Date</label>
            <input type="date" name="started_at" value="<?= htmlspecialchars($old['started_at'] ?? '') ?>">
        </div>

        <div class="field">
            <label>Time</label>
            <input type="time" name="time_at" value="<?= htmlspecialchars($old['time_at'] ?? '') ?>">
        </div>

        <div class="field">
            <label>Address</label>
            <textarea name="address"><?= htmlspecialchars($old['address'] ?? '') ?></textarea>
        </div>

        <div class="field">
            <label>About</label>
            <textarea name="about"><?= htmlspecialchars($old['about'] ?? '') ?></textarea>
        </div>

        <div class="field">
            <label>Is Open</label>
            <input type="checkbox" name="is_open" <?= (!empty($old['is_open']) ? 'checked' : '') ?>>
        </div>

        <div class="actions">
            <button type="submit">Create</button>
            <a href="/admin/workshops">Cancel</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>