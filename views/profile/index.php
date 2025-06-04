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
   <link rel="stylesheet" href="../resource/css/nav.css">
    <link rel="stylesheet" href="../resource/css/app.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container d-flex justify-content-between align-items-center top-bar">
    
   <!-- Logo -->
   <a class="navbar-brand d-flex align-items-center" href="../index.php">
    <img src="../resource/images/Logo_Thriftin.png" alt="Thriftin Logo" class="img-fluid logo-image">
  </a>


    <!-- Hamburger Menu (Mobile View) -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    

    <!-- Navigation Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link mobile-menu-item {{ request()->is('homepage') ? 'active' : '' }}" href="../index.php">
            <span class="mobile-text">HOME</span>
            <i class="fas fa-chevron-right mobile-arrow"></i> 
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobile-menu-item {{ request()->is('shopwomen') ? 'active' : '' }}" href="../views/shop.html">
            <span class="mobile-text">SHOP</span>
            <i class="fas fa-chevron-right mobile-arrow"></i> 
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link mobile-menu-item {{ request()->is('sell') ? 'active' : '' }}" href="../views/sell.html">
            <span class="mobile-text">SELL</span>
            <i class="fas fa-chevron-right mobile-arrow"></i> 
          </a>
        </li>
      </ul>
    </div>
    <!-- User Icons (Right Side on Desktop, Top with Logo on Mobile) -->
    <div class="user-icons d-flex align-items-center">
      <a class="nav-link" href="#"><img src="../resource/images/Icon_Gambar/Semua_Icon/notification.png" alt="Notification Icon" style="width: 24px; height: 24px;"></a>
      <a class="nav-link" href="#"><img src="../resource/images/Icon_Gambar/Semua_Icon/love.png" alt="Love Icon" style="width: 24px; height: 24px;"></a>
      <a class="nav-link" href="#"><img src="../resource/images/Icon_Gambar/Semua_Icon/gift.png" alt="Gift Icon" style="width: 24px; height: 24px;"></a>
      <a class="nav-link" href="#"><img src="../resource/images/Icon_Gambar/Semua_Icon/shopping bag.png" alt="Shopping Bag Icon" style="width: 24px; height: 24px;"></a>
      <a class="nav-link profile-link position-relative" href="#" id="profileIcon">
        <img src="../resource/images/Icon_Gambar/Semua_Icon/profile.png" alt="Profile Icon" style="width: 24px; height: 24px;">
      </a>
    </div>
  </div>
</nav>
        <?php
// profile/index.php

require_once __DIR__ . '/../../model/Model.class.php';


$model = new Model();
$db = $model->connect();

// Fetch purchase history from orders table
$stmt = $db->query("SELECT o.*, p.category, p.brand, p.size, p.price
                     FROM orders o
                     LEFT JOIN products p ON o.product_id = p.id
                     ORDER BY o.created_at DESC");
$purchases = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container my-5">
    <h1 class="mb-4">Purchase History</h1>

    <?php if (empty($purchases)): ?>
        <p>No purchases yet.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Buyer Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['id']) ?></td>
                        <td><?= htmlspecialchars($order['product_id']) ?></td>
                        <td><?= htmlspecialchars($order['category']) ?></td>
                        <td><?= htmlspecialchars($order['brand']) ?></td>
                        <td><?= htmlspecialchars($order['size']) ?></td>
                        <td>Rp <?= number_format($order['price'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($order['name']) ?></td>
                        <td><?= htmlspecialchars($order['full_address']) ?></td>
                        <td>
                            <a href="index.php?c=Route&m=editProduct&id=<?= $order['product_id'] ?>" class="btn btn-sm btn-primary">Edit Product</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>



    <footer class="footer py-4" style="background-color: #0B2442; color: #F7F7F6;">
  <div class="container">
    <div class="row">
      <!-- Contact Us -->
      <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <h5 class="footer-title">Contact Us</h5>
        <ul class="list-unstyled">
          <li>
            <i class="bi bi-envelope-fill me-2"></i>
            thriftinindo@gmail.com
          </li>
          <li>
            <i class="bi bi-instagram me-2"></i>
            @Thriftin._
          </li>
          <li>
            <i class="bi bi-facebook me-2"></i>
            ThriftinIndo
          </li>
        </ul>
      </div>

      <!-- Categories -->
      <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
        <h5 class="footer-title">Categories</h5>
        <ul class="list-unstyled">
          <li>Women's Fashion</li>
          <li>Men's Fashion</li>
          <li>Kid's Fashion</li>
        </ul>
      </div>

      <!-- Help -->
      <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
        <h5 class="footer-title">Help</h5>
        <ul class="list-unstyled">
          <li>Contact Us</li>
          <li>FAQ</li>
        </ul>
      </div>

      <!-- Offline Store -->
      <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
        <h5 class="footer-title">Offline Store</h5>
        <p class="footer-text">
          <i class="bi bi-geo-alt-fill me-2"></i>Pasir Kaliki, Cicendo, Kota Bandung, Jawa Barat, Indonesia
        </p>
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div class="footer-bar text-center py-2" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
    <p class="mb-0 footer-text">© 2024 Thriftin Company. All rights reserved.</p>
  </div>
</footer>


    <script src="public/js/navbar.js"></script>
</body>

</html>