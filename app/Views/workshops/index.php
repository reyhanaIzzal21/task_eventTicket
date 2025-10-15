<!-- app/Views/workshops/index.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Workshop</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f8fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .workshop-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .workshop-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .workshop-card:hover {
            transform: translateY(-3px);
        }

        .workshop-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .workshop-content {
            padding: 15px;
        }

        .workshop-content h3 {
            margin: 0 0 10px;
            color: #2c3e50;
        }

        .workshop-content p {
            font-size: 14px;
            color: #555;
        }

        .workshop-meta {
            font-size: 13px;
            color: #777;
            margin-top: 10px;
        }

        .btn-detail {
            display: inline-block;
            margin-top: 12px;
            padding: 8px 14px;
            background: #007bff;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-detail:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

    <h1>Daftar Workshop</h1>

    <?php if (empty($workshops)): ?>
        <p>Tidak ada workshop yang tersedia saat ini.</p>
    <?php else: ?>
        <div class="workshop-list">
            <?php foreach ($workshops as $workshop): ?>
                <div class="workshop-card">
                    <img src="<?= htmlspecialchars($workshop['thumbnail'] ?: '/public/images/no-image.jpg') ?>" alt="Thumbnail Workshop">
                    <div class="workshop-content">
                        <h3><?= htmlspecialchars($workshop['name']) ?></h3>
                        <p><?= substr(strip_tags($workshop['about']), 0, 100) ?>...</p>
                        <div class="workshop-meta">
                            <strong>Tanggal:</strong> <?= htmlspecialchars($workshop['started_at']) ?><br>
                            <strong>Harga:</strong> Rp<?= number_format($workshop['price'], 0, ',', '.') ?>
                        </div>
                        <a href="/workshops/<?= htmlspecialchars($workshop['slug']) ?>">Lihat Detail</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</body>

</html>