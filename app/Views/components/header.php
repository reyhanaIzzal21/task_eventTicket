<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand text-primary" href="#">ThreeTix</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/workshops">Workshops</a></li>
                <li class="nav-item"><a class="nav-link" href="/bookings">View My Bookings</a></li>
            </ul>
            <?php if (!empty($_SESSION['user_id'])): ?>
                <div class="dropdown">
                    <a class="btn btn-outline-primary dropdown-toggle rounded-pill px-4" href="#" role="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?= htmlspecialchars($_SESSION['user_name'] ?? 'Account') ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="/bookings">My Bookings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            <?php else: ?>
                <a href="/login" class="btn btn-outline-primary rounded-pill px-4 me-2">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>