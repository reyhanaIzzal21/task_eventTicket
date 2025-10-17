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

    <style>
        :root {
            --bs-primary: #0D6EFD;
            --bs-primary-rgb: 13, 110, 253;
            --bs-dark-blue: #0B2A4F;
            --bs-gradient: linear-gradient(45deg, #0D6EFD, #3C82F7);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FDFEFF;
        }

        /* Navbar */
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        /* Hero Section */
        .hero-section {
            padding: 100px 0;
            background-color: #F0F7FF;
            overflow: hidden;
        }

        .hero-section .display-4 {
            font-weight: 800;
            color: var(--bs-dark-blue);
        }

        .hero-section .lead {
            color: #555;
        }
        
        .hero-image-grid {
            position: relative;
            min-height: 400px;
        }

        .hero-image {
            position: absolute;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .hero-image:hover {
            transform: scale(1.05) rotate(3deg);
            z-index: 10;
        }

        .hero-image-1 {
            width: 60%;
            top: 0;
            left: 5%;
            transform: rotate(-5deg);
        }
        .hero-image-2 {
            width: 45%;
            top: 100px;
            right: 0;
            transform: rotate(4deg);
        }
         .hero-image-3 {
            width: 40%;
            bottom: -20px;
            left: 20%;
            transform: rotate(2deg);
        }

        /* General Styling */
        .section-title {
            font-weight: 700;
            color: var(--bs-dark-blue);
        }

        .btn-primary {
            background: var(--bs-gradient);
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(var(--bs-primary-rgb), 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(var(--bs-primary-rgb), 0.4);
        }

        /* Trusted by Section */
        .trusted-by-section img {
            max-height: 35px;
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s ease;
        }
        .trusted-by-section img:hover {
            filter: grayscale(0%);
            opacity: 1;
        }

        /* Event Card */
        .event-card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        .event-card .card-body {
            padding: 1.5rem;
        }
        .event-card .card-title {
            font-weight: 600;
            color: var(--bs-dark-blue);
        }
        .event-card-tag {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
            color: var(--bs-primary);
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        /* Category Filter Pills */
        .nav-pills .nav-link {
            border-radius: 50rem;
            font-weight: 500;
            color: #555;
        }
        .nav-pills .nav-link.active {
            background: var(--bs-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(var(--bs-primary-rgb), 0.3);
        }
        
        /* Category Section */
        .category-card {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            min-height: 250px;
            display: flex;
            align-items: flex-end;
            padding: 1.5rem;
            color: white;
            transition: transform 0.3s ease;
        }
        .category-card:hover {
             transform: scale(1.05);
        }
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            z-index: 1;
        }
        .category-card h4 {
            position: relative;
            z-index: 2;
            font-weight: 600;
        }
        .category-card img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .feature-icon {
            font-size: 3rem;
            color: #0D6EFD;
        }
        .testimonial-card {
            background-color: #fff;
            border: 1px solid #e9ecef;
            padding: 2rem;
            border-radius: 15px;
        }
        .testimonial-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
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
                         <a href="#events" class="btn btn-primary btn-lg px-5 py-3">Explore Events</a>
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
                <div class="col-md-6 col-lg-4">
                    <div class="card event-card h-100">
                        <img src="https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?q=80&w=2070&auto=format&fit=crop" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <span class="badge rounded-pill event-card-tag mb-2">Business</span>
                            <h5 class="card-title">Startup Pitching Night 2025</h5>
                            <p class="text-muted mb-2"><i class="bi bi-calendar3 me-2"></i> Nov 20, 2025</p>
                            <p class="text-muted"><i class="bi bi-geo-alt me-2"></i> WeWork Tower, Jakarta</p>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-lg-4">
                    <div class="card event-card h-100">
                        <img src="https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?q=80&w=2070&auto=format&fit=crop" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <span class="badge rounded-pill event-card-tag mb-2">Technology</span>
                            <h5 class="card-title">AI & The Future of Work</h5>
                            <p class="text-muted mb-2"><i class="bi bi-calendar3 me-2"></i> Nov 25, 2025</p>
                            <p class="text-muted"><i class="bi bi-geo-alt me-2"></i> Bali</p>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6 col-lg-4">
                    <div class="card event-card h-100">
                        <img src="https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?q=80&w=2070&auto=format&fit=crop" class="card-img-top" alt="Event Image">
                        <div class="card-body">
                            <span class="badge rounded-pill event-card-tag mb-2">Creative</span>
                            <h5 class="card-title">Street Photography Workshop</h5>
                            <p class="text-muted mb-2"><i class="bi bi-calendar3 me-2"></i> Dec 2, 2025</p>
                            <p class="text-muted"><i class="bi bi-geo-alt me-2"></i> Kota Tua, Jakarta</p>
                        </div>
                    </div>
                </div>
            </div>
             <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary btn-lg rounded-pill px-5">View All Events</a>
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