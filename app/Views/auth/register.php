<?php
// app/Views/auth/register.php
// variabel yang mungkin tersedia: $registerErrors (array), $old (array)
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        /* simple styling, ubah sesuai need */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f4f4f4;
        }

        .card {
            background: white;
            padding: 20px;
            max-width: 480px;
            margin: 30px auto;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .field {
            margin-bottom: 12px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .errors {
            background: #ffe6e6;
            border: 1px solid #ffcccc;
            padding: 10px;
            margin-bottom: 12px;
            border-radius: 4px;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        button {
            padding: 10px 14px;
            border: none;
            border-radius: 4px;
            background: #333;
            color: white;
            cursor: pointer;
        }

        .note {
            font-size: 13px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Register</h2>

        <?php if (!empty($registerErrors)): ?>
            <div class="errors">
                <ul>
                    <?php foreach ($registerErrors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="/register">
            <div class="field">
                <label for="name">Name</label>
                <input id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" required>
            </div>

            <div class="field">
                <label for="occupation">Occupation</label>
                <input id="occupation" name="occupation" value="<?= htmlspecialchars($old['occupation'] ?? '') ?>">
            </div>

            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
            </div>

            <div class="field">
                <label for="password_confirm">Confirm Password</label>
                <input id="password_confirm" name="password_confirm" type="password" required>
            </div>

            <div class="field">
                <label for="role">Register as</label>
                <select id="role" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin (requires admin code)</option>
                </select>
            </div>

            <div class="field">
                <label for="admin_secret">Admin Secret (only if registering as admin)</label>
                <input id="admin_secret" name="admin_secret" type="text" placeholder="Masukkan kode admin jika ada">
                <div class="note">Jika ingin membuat akun admin, set ADMIN_SECRET di config/includes/config.php, atau minta kode admin.</div>
            </div>

            <div class="actions">
                <button type="submit">Register</button>
                <a href="/login" style="text-decoration:none; margin-left:8px;">Login</a>
            </div>
        </form>
    </div>
</body>

</html>