<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>


<div class="admin-main-content">
<h1><?= htmlspecialchars($workshop['name']) ?></h1>
<?php if (!empty($workshop['thumbnail'])): ?>
<img src="<?= htmlspecialchars($workshop['thumbnail']) ?>" style="max-width:320px; display:block; margin-bottom:12px;">
<?php endif; ?>


<p><strong>Price:</strong> <?= number_format($workshop['price']) ?></p>
<p><strong>Start:</strong> <?= htmlspecialchars($workshop['started_at']) ?> <?= htmlspecialchars($workshop['time_at']) ?></p>
<p><strong>Address:</strong> <?= nl2br(htmlspecialchars($workshop['address'])) ?></p>
<p><?= nl2br(htmlspecialchars($workshop['about'])) ?></p>


<div class="actions">
<a href="/admin/workshops/edit/<?= $workshop['id'] ?>">Edit</a> |
<a href="/admin/workshops">Back</a>
</div>
</div>


