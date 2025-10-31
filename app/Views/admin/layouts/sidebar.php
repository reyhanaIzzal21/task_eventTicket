<?php
$adminName = $adminName ?? 'Admin';
$sidebarWidth = 250;

ob_start();
?>
<div class="d-flex flex-column h-100">
    <a href="/" class="mb-4 text-center d-flex align-items-center justify-content-center text-decoration-none mb-0">
        <h2 class="fs-3 fw-bold text-center">ThreeTix</h2>
    </a>

    <ul class="nav nav-pills flex-column mb-auto">
        <h2 class="fs-6 text-muted ms-3">HOME</h2>
        <li class="nav-item mb-1">
            <a href="#" class="nav-link d-flex align-items-center <?php echo ($currentPage ?? '') === 'workshops' ? 'active' : 'text-dark'; ?>">
                <svg class="bi me-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M13.45 11.55l2.05 -2.05" />
                    <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                </svg>
                Dashboard
            </a>
        </li>

        <hr>
        <h2 class="fs-6 text-muted ms-3">MAIN</h2>
        <li class="nav-item mb-2">
            <a href="/admin/workshops" class="nav-link d-flex align-items-center <?php echo ($currentPage ?? '') === 'workshops' ? 'active' : 'text-dark'; ?>">
                <svg class="bi me-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-calendar-event">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M16 2a1 1 0 0 1 .993 .883l.007 .117v1h1a3 3 0 0 1 2.995 2.824l.005 .176v12a3 3 0 0 1 -2.824 2.995l-.176 .005h-12a3 3 0 0 1 -2.995 -2.824l-.005 -.176v-12a3 3 0 0 1 2.824 -2.995l.176 -.005h1v-1a1 1 0 0 1 1.993 -.117l.007 .117v1h6v-1a1 1 0 0 1 1 -1m3 7h-14v9.625c0 .705 .386 1.286 .883 1.366l.117 .009h12c.513 0 .936 -.53 .993 -1.215l.007 -.16z" />
                    <path d="M8 14h2v2h-2z" />
                </svg>
                Workshops
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="/admin/bookings" class="nav-link d-flex align-items-center <?php echo ($currentPage ?? '') === 'workshops' ? 'active' : 'text-dark'; ?>">
                <svg class="bi me-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-booking">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 18v-9.5a4.5 4.5 0 0 1 4.5 -4.5h7a4.5 4.5 0 0 1 4.5 4.5v7a4.5 4.5 0 0 1 -4.5 4.5h-9.5a2 2 0 0 1 -2 -2z" />
                    <path d="M8 12h3.5a2 2 0 1 1 0 4h-3.5v-7a1 1 0 0 1 1 -1h1.5a2 2 0 1 1 0 4h-1.5" />
                    <path d="M16 16l.01 0" />
                </svg>
                Manage Bookings
            </a>
        </li>

        <li class="nav-item mb-2">
            <a href="users" class="nav-link d-flex align-items-center <?php echo ($currentPage ?? '') === 'users' ? 'active' : 'text-dark'; ?>">
                <svg class="bi me-3" class="bi me-2" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM2 13s1-1 6-1 6 1 6 1v1H2v-1z" />
                </svg>
                Users
            </a>
        </li>
    </ul>
</div>
<?php
$sidebarInnerHtml = ob_get_clean();
?>

<!-- Desktop sidebar (md ke atas) -->
<aside id="adminSidebarDesktop" class="bg-light border-end d-none d-md-block" style="width: <?php echo (int)$sidebarWidth; ?>px; position: fixed; top: 0; left: 0; bottom: 0; padding: 1rem;">
    <?php echo $sidebarInnerHtml; ?>
</aside>

<!-- Offcanvas sidebar (sm) -->
<div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Admin Panel</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php echo $sidebarInnerHtml; ?>
    </div>
</div>

<!-- Small helper CSS: beri main content margin di md+ -->
<style>
    @media (min-width: 768px) {

        /* kalau main content pakai container-fluid, tambahkan margin-left: sidebarWidth */
        .admin-main-content {
            margin-left: <?php echo (int)$sidebarWidth; ?>px;
            padding: 1.5rem;
        }
    }

    @media (max-width: 767.98px) {
        .admin-main-content {
            padding: 1rem;
        }
    }
</style>