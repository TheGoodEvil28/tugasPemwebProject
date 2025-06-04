

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Detail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style2.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container d-flex justify-content-between align-items-center top-bar">
    <a class="navbar-brand d-flex align-items-center" href="../index.html">
    <img src="assets/img/LogoThriftin.jpg" alt="Thriftin Logo" class="img-fluid logo-image" style="height: 50px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">SHOP</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">SELL</a>
        </li>
      </ul>
    </div>
    <div class="user-icons d-flex align-items-center gap-4">
      <img src="assets/img/Notifikasi.jpg" alt="Notifikasi" width="24">
      <img src="assets/img/love.jpg" alt="love" width="24">
      <img src="assets/img/gift.jpg" alt="gift" width="24">
      <img src="assets/img/bag.jpg" alt="bag" width="24">
      <img src="assets/img/profil.jpg" alt="profil" width="24">
    </div>
  </div>
</nav>



<?php if (!$product): ?>
  <p>No product data to show!</p>
  <?php exit; ?>
<?php endif; ?>

<!-- Main Content -->
<div class="container my-5 pt-5">
  <h2>Product Details</h2>

  <?php if (!empty($product['image_data'])): ?>
  <img src="data:<?php echo htmlspecialchars($product['image_type']); ?>;base64,<?php echo base64_encode($product['image_data']); ?>" alt="Product Photo" style="max-width: 200px;">
<?php else: ?>
  <p>No photo uploaded.</p>
<?php endif; ?>
<p>Description: <?php echo htmlspecialchars($product['description']); ?></p>
<p>Category: <?php echo htmlspecialchars($product['category']); ?></p>
<p>Brand: <?php echo htmlspecialchars($product['brand']); ?></p>
<p>Condition: <?php echo htmlspecialchars($product['condition']); ?></p>
<p>Color: <?php echo htmlspecialchars($product['color']); ?></p>
<p>Size: <?php echo htmlspecialchars($product['size']); ?></p>
<p>Fabric: <?php echo htmlspecialchars($product['fabric_type'] ?? ''); ?></p>





  <!-- Form to set price -->
  <form action="index.php?c=Route&m=saveProduct" method="POST" class="mt-4">
    <label for="price" class="form-label">Set Your Price (Rp)</label>
    <input type="number" name="price" id="price" class="form-control mb-3" placeholder="Input Price" min="0" required>
    <button type="submit" class="btn btn-primary">Save Product with Price</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

</body>
</html>
