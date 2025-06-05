<?php
$success = $_SESSION['success'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['success'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Order - Thriftin</title>
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
    <link rel="stylesheet" href="view/updateOrder/styles.css">
    <link rel="stylesheet" href="public/css/navbar.css" />
    <link rel="stylesheet" href="public/css/footer.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>

<body>
    <!-- Navigation Bar -->
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
                        <a class="nav-link mobile-menu-item" href="../views/index.php">
                            <span class="mobile-text">HOME</span>
                            <i class="fas fa-chevron-right mobile-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mobile-menu-item" href="../views/shop.php">
                            <span class="mobile-text">SHOP</span>
                            <i class="fas fa-chevron-right mobile-arrow"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mobile-menu-item" href="../views/sell.php">
                            <span class="mobile-text">SELL</span>
                            <i class="fas fa-chevron-right mobile-arrow"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- User Icons -->
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

    <!-- Update Order Form -->
    <div class="update-container">
        <h2 class="form-title">Update Your Order</h2>

        <?php if ($success): ?>
            <div class="alert success"><?= $success ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="alert error"><?= $error ?></div>
        <?php endif; ?>

        <div class="order-info">
            <div class="info-row">
                <span class="info-label">Product:</span>
                <span class="info-value"><?= htmlspecialchars($order['product_title']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Price:</span>
                <span class="info-value">Rp <?= number_format($order['price'], 0, ',', '.') ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Order Date:</span>
                <span class="info-value"><?= date('F j, Y', strtotime($order['created_at'])) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value"><?= ucfirst($order['status']) ?></span>
            </div>
        </div>

        <form method="POST" class="order-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($order['name'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" value="<?= htmlspecialchars($order['phone_number'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="address_search">Address Search</label>
                <input type="text" id="address_search" name="address_search" value="<?= htmlspecialchars($order['address_search'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="full_address">Full Address</label>
                <textarea id="full_address" name="full_address" rows="3" required><?= htmlspecialchars($order['full_address'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="additional_details">Additional Details</label>
                <textarea id="additional_details" name="additional_details" rows="2"><?= htmlspecialchars($order['additional_details'] ?? '') ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn primary">Update Order</button>
                <a href="?c=profile&m=purchases" class="btn secondary">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Footer -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        document.querySelector('.order-form').addEventListener('submit', function(e) {
            const phoneInput = document.getElementById('phone_number');
            if (!phoneInput.value.match(/^\+?[0-9]{8,15}$/)) {
                alert('Please enter a valid phone number');
                e.preventDefault();
            }

            const addressInput = document.getElementById('full_address');
            if (addressInput.value.length < 10) {
                alert('Please enter a complete address');
                e.preventDefault();
            }
        });
    </script>
</body>

</html>