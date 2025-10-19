<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThreeTix - Workshops</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/landing.css">
</head>

<body>

    <?php require __DIR__ . '/../components/header.php'; ?>

    <section id="events" class="py-5 bg-light">
        <div class="container">

            <!-- search bar dan filter -->
            <form method="get" action="" class="mb-4">
                <div class="row g-2">
                    <div class="col-md-4">
                        <input
                            type="search"
                            name="q"
                            class="form-control rounded-pill"
                            placeholder="Search workshops..."
                            value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                    </div>

                    <div class="col-md-2">
                        <select name="filter" class="form-select  rounded-pill">
                            <?php $currentFilter = $_GET['filter'] ?? 'all'; ?>
                            <option value="all" <?= $currentFilter === 'all' ? 'selected' : '' ?>>All</option>
                            <option value="upcoming" <?= $currentFilter === 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
                            <option value="past" <?= $currentFilter === 'past' ? 'selected' : '' ?>>Past</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex">
                        <button type="submit" class="btn btn-primary me-2  rounded-pill">Search</button>
                        <a href="<?= strtok($_SERVER["REQUEST_URI"], '?') ?>" class="btn btn-outline-secondary  rounded-pill">Reset</a>
                    </div>
                </div>
            </form>

            <div class="row g-4">
                <?php if (!empty($workshops)): ?>
                    <?php foreach ($workshops as $workshop): ?>
                        <div class="col-md-6 col-lg-4">
                            <a href="/workshops/<?= htmlspecialchars($workshop['slug']) ?>" class="text-decoration-none">
                                <div class="card event-card h-100">
                                    <img src="<?= htmlspecialchars($workshop['thumbnail'] ?? 'https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?q=80&w=2070&auto=format&fit=crop') ?>"
                                        class="card-img-top"
                                        alt="<?= htmlspecialchars($workshop['name']) ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= htmlspecialchars($workshop['name']) ?></h5>
                                        <p class="text-muted mb-2">
                                            <i class="bi bi-calendar3 me-2"></i>
                                            <?= date('M d, Y', strtotime($workshop['started_at'])) ?>
                                        </p>
                                        <p class="text-muted">
                                            <i class="bi bi-geo-alt me-2"></i>
                                            <?= htmlspecialchars($workshop['address']) ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada workshop yang sesuai kriteria pencarian.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>


    <?php require __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>