<?php
$pageTitle = $pageTitle ?? 'Admin - Dashboard';
$adminName = $adminName ?? 'Admin';
$siteLogoPath = $siteLogoPath ?? '/assets/images/logo.png';
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">

    <!-- Optional: Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- custom CSS  -->
    <link href="/assets/admin.css" rel="stylesheet">

    <style>
        @media (min-width: 768px) {
            .admin-navbar {
                margin-left: 250px;
                /* harus sama dengan sidebar width */
            }

            .admin-navbar .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Sedikit style agar avatar tidak terlalu besar */
        .admin-avatar {
            width: 36px;
            height: 36px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

    <!-- Bootstrap JS (bundle) - dimuat dengan defer agar tidak blok rendering -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer integrity="" crossorigin="anonymous"></script>
</head>

<body class="bg-light">

    <!-- Top navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom admin-navbar">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <!-- Logo (klik untuk ke dashboard) -->
                <!-- <a class="navbar-brand d-flex align-items-center me-3" href="/admin/dashboard">
                    <img src="<?php echo htmlspecialchars($siteLogoPath); ?>" alt="Logo" width="36" height="36" class="me-2">
                    <span class="fw-semibold d-none d-md-inline">Admin Panel</span>
                </a> -->

                <!-- Toggle sidebar (mobile) - tombol ini memicu offcanvas sidebar -->
                <button class="btn btn-outline-secondary d-md-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-label="Open sidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <!-- Collapse untuk search / menu kanan -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbarContent" aria-controls="adminNavbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="adminNavbarContent">

                <!-- Right side: notifications + profile -->
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Notifications -->
                    <!-- <li class="nav-item dropdown me-2">
                        <a class="nav-link position-relative" href="#" id="navbarNotifications" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: .6rem;">
                                3
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start shadow" aria-labelledby="navbarNotifications" style="min-width: 300px;">
                            <li class="dropdown-header">Notifications</li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="/admin/notifications/1">
                                    <div class="small">New booking received</div>
                                    <div class="text-muted small">5 minutes ago</div>
                                </a>
                            </li>
                            <li><a class="dropdown-item text-center small text-muted" href="/admin/notifications">See all</a></li>
                        </ul>
                    </li> -->

                    <!-- Quick links (opsional) -->
                    <li class="nav-item d-none d-lg-block me-2">
                        <a class="nav-link" href="/" target="_blank" title="View site">
                            <i class="bi bi-box-arrow-up-right fs-5"></i>
                        </a>
                    </li>

                    <!-- Profile dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center" href="#" id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- <img src="<?php echo htmlspecialchars($adminAvatar); ?>" alt="Avatar" class="admin-avatar me-2"> -->
                            <span class="d-none d-md-inline"><?php echo htmlspecialchars($adminName); ?></span>
                            <i class="bi bi-chevron-down ms-1"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarProfile">
                            <li><a class="dropdown-item" href="/admin/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="/admin/settings">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <!-- Jika Anda menggunakan POST untuk logout, gunakan form -->
                                <form action="/logout" method="POST" class="m-0">
                                    <?php if (! empty($csrfToken)): ?>
                                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
                                    <?php endif; ?>
                                    <button type="submit" class="dropdown-item">Sign out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>