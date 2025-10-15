<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <h1>Edit Workshop</h1>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="/admin/workshops/update/<?= $workshop['id'] ?>" enctype="multipart/form-data">
        <div class="field">
            <label>Name</label>
            <input name="name" value="<?= htmlspecialchars($workshop['name'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label>Thumbnail (leave empty to keep old)</label>
            <?php if (!empty($workshop['thumbnail'])): ?>
                <div><img src="<?= htmlspecialchars($workshop['thumbnail']) ?>" style="height:60px;border-radius:8px;">
                </div>
            <?php endif; ?>
            <input type="file" name="thumbnail" accept="image/*">
        </div>

        <div class="field">
            <label>Venue Thumbnail (leave empty to keep old)</label>
            <?php if (!empty($workshop['venue_thumbnail'])): ?>
                <div><img src="<?= htmlspecialchars($workshop['venue_thumbnail']) ?>"
                        style="height:60px;border-radius:8px;"></div>
            <?php endif; ?>
            <input type="file" name="venue_thumbnail" accept="image/*">
        </div>

        <div class="field">
            <label>Background Map URL</label>
            <input type="text" name="bg_map" placeholder="https://maps.google.com/..."
                value="<?= htmlspecialchars($workshop['bg_map'] ?? '') ?>">
        </div>

        <div class="field">
            <label>Price</label>
            <input type="number" name="price" value="<?= htmlspecialchars($workshop['price'] ?? 0) ?>" required>
        </div>

        <div class="field">
            <label>Start Date</label>
            <input type="date" name="started_at" value="<?= htmlspecialchars($workshop['started_at'] ?? '') ?>">
        </div>

        <div class="field">
            <label>Time</label>
            <input type="time" name="time_at" value="<?= htmlspecialchars($workshop['time_at'] ?? '') ?>">
        </div>

        <div class="field">
            <label>Address</label>
            <textarea name="address"><?= htmlspecialchars($workshop['address'] ?? '') ?></textarea>
        </div>

        <div class="field">
            <label>About</label>
            <textarea name="about"><?= htmlspecialchars($workshop['about'] ?? '') ?></textarea>
        </div>

        <div class="field">
            <label>Is Open</label>
            <input type="checkbox" name="is_open" <?= ($workshop['is_open'] ? 'checked' : '') ?>>
        </div>

        <div class="actions">
            <button type="submit">Update</button>
            <a href="/admin/workshops">Cancel</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>