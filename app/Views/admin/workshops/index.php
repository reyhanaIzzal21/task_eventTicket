<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <h1>Admin - Workshops</h1>
    <div class="actions">
        <a class="button" href="/admin/workshops/create">Create New Workshop</a>
    </div>

    <?php if (empty($workshops)): ?>
        <p>No workshops yet.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Thumbnail</th>
                    <th>Venue Thumbnail</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Start Date</th>
                    <th>Background Map</th>
                    <th>Is Open</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($workshops as $workshop): ?>
                    <tr>
                        <td><?= $workshop['id'] ?></td>

                        <td>
                            <?php if (!empty($workshop['thumbnail'])): ?>
                                <img src="<?= htmlspecialchars($workshop['thumbnail']) ?>" alt="thumb" style="height:48px;">
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if (!empty($workshop['venue_thumbnail'])): ?>
                                <img src="<?= htmlspecialchars($workshop['venue_thumbnail']) ?>" alt="venue" style="height:48px;">
                            <?php endif; ?>
                        </td>

                        <td><?= htmlspecialchars($workshop['name']) ?></td>
                        <td><?= number_format($workshop['price']) ?></td>
                        <td><?= htmlspecialchars($workshop['started_at']) ?></td>

                        <td>
                            <?php if (!empty($workshop['bg_map'])): ?>
                                <a href="<?= htmlspecialchars($workshop['bg_map']) ?>" target="_blank">View Map</a>
                            <?php else: ?>
                                <span style="color:gray;">-</span>
                            <?php endif; ?>
                        </td>

                        <td><?= $workshop['is_open'] ? 'Yes' : 'No' ?></td>

                        <td>
                            <a href="/admin/workshops/show/<?= $workshop['id'] ?>">Show</a> |
                            <a href="/admin/workshops/edit/<?= $workshop['id'] ?>">Edit</a> |
                            <form method="post" action="/admin/workshops/delete/<?= $workshop['id'] ?>" style="display:inline"
                                onsubmit="return confirm('Delete this workshop?');">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>