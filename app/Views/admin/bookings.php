<?php require __DIR__ . '/../layouts/header.php'; ?>
<h1>Bookings</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>TRX</th>
            <th>Name</th>
            <th>Workshop</th>
            <th>Total</th>
            <th>Proof</th>
            <th>Is Paid</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= $booking['id'] ?></td>
                <td><?= htmlspecialchars($booking['booking_trx_id']) ?></td>
                <td><?= htmlspecialchars($booking['name']) ?></td>
                <td><?= htmlspecialchars($booking['workshop_name'] ?? '') ?></td>
                <td><?= number_format($booking['total_amount']) ?></td>
                <td>
                    <?php if ($booking['proof']): ?>
                        <a href="<?= $booking['proof'] ?>" target="_blank">View proof</a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?= $booking['is_paid'] ? 'Yes' : 'No' ?></td>
                <td>
                    <?php if (!$booking['is_paid']): ?>
                        <form method="post" action="/admin/bookings/approve/<?= $booking['id'] ?>" style="display:inline">
                            <button type="submit">Approve</button>
                        </form>
                    <?php else: ?>
                        Approved
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require __DIR__ . '/../layouts/footer.php'; ?>