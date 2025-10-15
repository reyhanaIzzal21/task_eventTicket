<!-- app/Views/booking/booking_form.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking Workshop - <?= htmlspecialchars($workshop['name']) ?></title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            padding: 30px;
        }

        .container {
            max-width: 700px;
            background: #fff;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Booking Workshop</h2>
        <p><strong>Workshop:</strong> <?= htmlspecialchars($workshop['name']) ?></p>
        <p><strong>Harga:</strong> Rp<?= number_format($workshop['price'], 0, ',', '.') ?></p>

        <form action="/booking/store" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="workshop_slug" value="<?= htmlspecialchars($workshop['slug']) ?>">

            <label>Nama Lengkap</label>
            <input type="text" name="name" required>

            <label>No. HP</label>
            <input type="text" name="phone" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Nama Bank</label>
            <input type="text" name="customer_bank_name" required>

            <label>Nama Pemilik Rekening</label>
            <input type="text" name="customer_bank_account" required>

            <label>Nomor Rekening</label>
            <input type="text" name="customer_bank_number" required>

            <label>Jumlah Tiket</label>
            <input type="number" name="quantity" min="1" value="1" required>

            <label>Bukti Transfer (JPG, PNG)</label>
            <input type="file" name="proof" accept=".jpg,.jpeg,.png">

            <button type="submit">Kirim Booking</button>
        </form>

        <p><a href="/workshops" style="color:#007bff;">← Kembali ke daftar workshop</a></p>
    </div>
</body>

</html>