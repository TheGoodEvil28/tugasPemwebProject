<!DOCTYPE html>
<html>

<head>
    <!-- ^ library import -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- ^ fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Voga&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Voga&display=swap" rel="stylesheet" />
    <!-- ^ icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/heroicons@1.0.1/dist/solid.js"></script>
    <link rel="icon" type="image/x-icon" href="public/assets/logoT.png" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <!-- ^ local style -->
    <link rel="stylesheet" href="view/profile/styles.css">
    <link rel="stylesheet" href="public/css/navbar.css" />
    <link rel="stylesheet" href="public/css/footer.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>

<body>
    <!-- * Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container d-flex justify-content-between align-items-center top-bar">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center" href="../views/index.php">
                <img src="public/assets/Logo_Thriftin.png" alt="Thriftin Logo" class="img-fluid logo-image" />
            </a>

            <!-- Hamburger Menu (Mobile View) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link mobile-menu-item {{ request()->is('homepage') ? 'active' : '' }}" href="../views/index.php">
                            <span class="mobile-text">HOME</span>
                            <i class="fas fa-chevron-right mobile-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mobile-menu-item {{ request()->is('shopwomen') ? 'active' : '' }}" href="../views/shop.php">
                            <span class="mobile-text">SHOP</span>
                            <i class="fas fa-chevron-right mobile-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mobile-menu-item {{ request()->is('sell') ? 'active' : '' }}" href="../views/sell.php">
                            <span class="mobile-text">SELL</span>
                            <i class="fas fa-chevron-right mobile-arrow"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- User Icons (Right Side on Desktop, Top with Logo on Mobile) -->
            <div class="user-icons d-flex align-items-center">
                <a class="nav-link" href="#">
                    <i class="fas fa-bell" style="font-size: 24px;"></i>
                </a>
                <a class="nav-link" href="#">
                    <i class="fas fa-heart" style="font-size: 24px;"></i>
                </a>
                <a class="nav-link" href="#">
                    <i class="fas fa-gift" style="font-size: 24px;"></i>
                </a>
                <a class="nav-link" href="#">
                    <i class="fas fa-shopping-bag" style="font-size: 24px;"></i>
                </a>
                <a class="nav-link profile-link position-relative" href="index.php" id="profileIcon">
                    <i class="fas fa-user" style="font-size: 24px;"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- * Content -->
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-content">
                <img src="<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile" class="profile-avatar" />
                <h1 class="profile-name"><?= htmlspecialchars($user['display_name']) ?></h1>
                <p class="profile-username">@<?= htmlspecialchars($user['username']) ?></p>

                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value"><?= $stats['purchases'] ?></div>
                        <div class="stat-label">Items Bought</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value"><?= $stats['sales'] ?></div>
                        <div class="stat-label">Items Sold</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value"><?= $stats['donations'] ?></div>
                        <div class="stat-label">Donations</div>
                    </div>
                </div>

                <div class="profile-xp">
                    <i class="fas fa-star"></i>
                    <?= number_format($user['xp_points'], 0, ',', '.') ?> XP Points
                </div>

                <a href="?c=Profile&m=edit" class="edit-profile-btn">
                    <i class="fas fa-edit me-2"></i>Edit Profile
                </a>
            </div>
        </div>

        <!-- Tabs -->
        <div class="history-tabs">
            <a href="?c=Profile&m=purchases" class="history-tab <?= $active_tab === 'purchases' ? 'active' : '' ?>"><i class="fas fa-shopping-bag me-2"></i>Purchases</a>
            <a href="?c=Profile&m=sales" class="history-tab <?= $active_tab === 'sales' ? 'active' : '' ?>"><i class="fas fa-tag me-2"></i>Sales</a>
            <a href="?c=Profile&m=donation" class="history-tab <?= $active_tab === 'donation' ? 'active' : '' ?>"><i class="fas fa-hands-helping me-2"></i>Donations</a>
        </div>

        <!-- Content Section -->
        <div class="history-container">
            <?php if ($active_tab === 'purchases'): ?>
                <?php include 'purchases.php' ?>
            <?php elseif ($active_tab === 'sales'): ?>
                <?php include 'sales.php' ?>
            <?php else: ?>
                <?php include 'donation.php' ?>
            <?php endif; ?>
        </div>
    </div>


    <!-- * footer -->
    <footer class="footer py-4" style="background-color: #0b2442; color: #f7f7f6">
        <div class="container">
            <div class="row">
                <!-- Contact Us -->
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                    <h5 class="footer-title">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li>
                            <i class="bi bi-envelope-fill me-2"></i>
                            <a href="mailto:thriftinNext24@gmail.com" class="footer-link">thriftinindo@gmail.com</a>
                        </li>
                        <li>
                            <i class="bi bi-instagram me-2"></i>
                            <a href="https://instagram.com/thriftinNext24" class="footer-link">@Thriftin._</a>
                        </li>
                        <li>
                            <i class="bi bi-facebook me-2"></i>
                            <a href="https://facebook.com/thriftinNext24" class="footer-link">ThriftinIndo</a>
                        </li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                    <h5 class="footer-title">Categories</h5>
                    <ul class="list-unstyled">
                        <li><a href="views/shop.html" class="footer-link">Women's Fashion</a></li>
                        <li><a href="views/shopmen.html" class="footer-link">Men's Fashion</a></li>
                        <li><a href="views/shopkid.html" class="footer-link">Kid's Fashion</a></li>
                    </ul>
                </div>

                <!-- Help -->
                <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                    <h5 class="footer-title">Help</h5>
                    <ul class="list-unstyled">
                        <li><a href="/contactus" class="footer-link">Contact Us</a></li>
                        <li><a href="#" class="footer-link">FAQ</a></li>
                    </ul>
                </div>

                <!-- Offline Store -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <h5 class="footer-title">Offline Store</h5>
                    <p class="footer-text"><i class="bi bi-geo-alt-fill me-2"></i>Pasir Kaliki, Cicendo, Kota Bandung, Jawa Barat, Indonesia</p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bar text-center py-2" style="border-top: 1px solid rgba(255, 255, 255, 0.2)">
            <p class="mb-0 footer-text">© 2024 Thriftin Company. All rights reserved.</p>
        </div>
    </footer>

    <script src="public/js/navbar.js"></script>
</body>

</html>