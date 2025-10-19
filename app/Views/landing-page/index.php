<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThreeTix - Gateway to New Experiences</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/landing.css">
</head>

<body>

    <?php require __DIR__ . '/../components/header.php'; ?>

    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="display-4">More Than Just a Ticket, It's the Start of Your Adventure.</h1>
                    <p class="lead my-4">Discover workshops, seminars, and exclusive events designed to inspire and elevate your skills. ThreeTix is your gateway to new experiences.</p>
                    <div class="d-flex flex-column flex-sm-row gap-3">
                        <a href="/workshops" class="btn btn-primary btn-lg px-5 py-3">Explore Events</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-image-grid">
                        <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=2012&auto=format&fit=crop" alt="Seminar" class="hero-image hero-image-1">
                        <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=2070&auto=format&fit=crop" alt="Concert" class="hero-image hero-image-2">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2070&auto=format&fit=crop" alt="Workshop" class="hero-image hero-image-3">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="events" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Explore Featured Events</h2>
                <p class="text-muted">Find the events that are perfect for you.</p>
            </div>

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
                            Belum ada workshop yang tersedia saat ini.
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="text-center mt-5">
                <a href="/workshops" class="btn btn-outline-primary btn-lg rounded-pill px-5">View All Events</a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <h2 class="section-title">It's That Easy!</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-search-heart"></i>
                    </div>
                    <h4 class="fw-bold">1. Find Events</h4>
                    <p class="text-muted">Search from thousands of workshops and events based on your interests, location, and preferred dates.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>
                    <h4 class="fw-bold">2. Book Securely</h4>
                    <p class="text-muted">Choose your ticket and make payment with various easy and verified methods.</p>
                </div>
                <div class="col-md-4">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h4 class="fw-bold">3. Enjoy the Experience</h4>
                    <p class="text-muted">Your e-ticket will be sent directly to your email. Show it and enjoy your new experience!</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Browse by Category</h2>
                <p class="text-muted">Explore an unlimited world of knowledge and entertainment.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <a href="#" class="category-card">
                        <img src="https://images.unsplash.com/photo-1455849318743-b2233052fcff?q=80&w=2070&auto=format&fit=crop" alt="Business & Career">
                        <h4>Business & Career</h4>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="#" class="category-card">
                        <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2070&auto=format&fit=crop" alt="Technology">
                        <h4>Technology</h4>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="#" class="category-card">
                        <img src="https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=2070&auto=format&fit=crop" alt="Music & Entertainment">
                        <h4>Music & Entertainment</h4>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="#" class="category-card">
                        <img src="https://images.unsplash.com/photo-1496644254382-7f55b9a8a2a8?q=80&w=2070&auto=format&fit=crop" alt="Arts & Culture">
                        <h4>Arts & Culture</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center">What They Say</h2>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="testimonial-card text-center">
                        <img src="https://i.pravatar.cc/150?img=1" alt="User Avatar" class="testimonial-avatar mb-3 mx-auto">
                        <p class="text-muted"><i>"The ticket buying process was super easy! E-ticket came straight to my email. The event was awesome too. Will definitely use ThreeTix again."</i></p>
                        <h6 class="fw-bold mt-3 mb-0">Rina S.</h6>
                        <small>Student</small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card text-center">
                        <img src="https://i.pravatar.cc/150?img=32" alt="User Avatar" class="testimonial-avatar mb-3 mx-auto">
                        <p class="text-muted"><i>"The workshop selection is diverse and high-quality. It really helped me upgrade my skills. Highly recommended!"</i></p>
                        <h6 class="fw-bold mt-3 mb-0">Budi Setiawan</h6>
                        <small>Software Engineer</small>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card text-center">
                        <img src="https://i.pravatar.cc/150?img=5" alt="User Avatar" class="testimonial-avatar mb-3 mx-auto">
                        <p class="text-muted"><i>"As an event enthusiast, ThreeTix is my go-to for finding exciting events on weekends. The interface is clean and easy to use."</i></p>
                        <h6 class="fw-bold mt-3 mb-0">Ahmad Prasetyo</h6>
                        <small>Content Creator</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>