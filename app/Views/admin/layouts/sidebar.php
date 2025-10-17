<?php
$adminName = $adminName ?? 'Admin';
$sidebarWidth = 250;

ob_start();
?>
<div class="d-flex flex-column h-100">
    <a href="/admin/dashboard" class="d-flex align-items-center mb-3 text-decoration-none">
        <!-- <img src="/assets/images/logo.png" alt="Logo" width="38" height="38" class="me-2"> -->
        <h2 class="fs-3 fw-bold">ThreeTix</h2>
    </a>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <!-- <li class="nav-item mb-1">
            <a href="/admin/dashboard" class="nav-link d-flex align-items-center <?php echo ($currentPage ?? '') === 'dashboard' ? 'active' : 'text-dark'; ?>">
                <svg class="bi me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M0 0h4v4H0zM6 0h4v7H6zM12 0h4v10h-4zM0 6h4v10H0z" />
                </svg>
                Dashboard
            </a>
        </li> -->

        <li class="nav-item mb-1">
            <a href="/admin/workshops" class="nav-link d-flex align-items-center <?php echo ($currentPage ?? '') === 'workshops' ? 'active' : 'text-dark'; ?>">
                <svg class="bi me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 0L0 4v8l8 4 8-4V4L8 0z" />
                </svg>
                Workshops
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="/admin/bookings" class="nav-link d-flex align-items-center <?php echo ($currentPage ?? '') === 'workshops' ? 'active' : 'text-dark'; ?>">
                <svg class="bi me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                </svg>
                Manage Bookings
            </a>
        </li>

        <li class="nav-item mb-1">
            <a href="/admin/users" class="nav-link d-flex align-items-center <?php echo ($currentPage ?? '') === 'users' ? 'active' : 'text-dark'; ?>">
                <svg class="bi me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
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