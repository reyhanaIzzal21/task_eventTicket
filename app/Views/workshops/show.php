<!-- app/Views/workshops/show.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($workshop['name']) ?></title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: #f4f6f8;
        }

        .workshop-detail {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        img {
            max-width: 100%;
            border-radius: 10px;
        }

        .meta {
            color: #555;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 15px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 16px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="workshop-detail">
        <h1><?= htmlspecialchars($workshop['name']) ?></h1>
        <img src="<?= htmlspecialchars($workshop['thumbnail']) ?>" alt="Workshop Thumbnail">

        <p class="meta">
            <strong>Tanggal:</strong> <?= htmlspecialchars($workshop['started_at']) ?><br>
            <strong>Jam:</strong> <?= htmlspecialchars($workshop['time_at']) ?><br>
            <strong>Harga:</strong> Rp<?= number_format($workshop['price'], 0, ',', '.') ?>
        </p>

        <p><?= nl2br(htmlspecialchars($workshop['about'])) ?></p>

        <a href="/booking/create/<?= htmlspecialchars($workshop['slug']) ?>"
            style="display:inline-block; background:#007bff; color:#fff; padding:10px 20px; border-radius:5px; text-decoration:none;">
            Booking Sekarang
        </a>
    </div>
</body>

</html>