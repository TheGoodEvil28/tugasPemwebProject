<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle upload file dulu
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "../assets/uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Bikin folder kalau belum ada
        }
        $photo_name = basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $photo_name;
        
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_uploaded = $photo_name;
        } else {
            $photo_uploaded = '';
        }
    } else {
        $photo_uploaded = '';
    }

    // Simpan semua inputan ke session
    $_SESSION['product'] = [
        'photo' => $photo_uploaded,
        'description' => $_POST['description'],
        'category' => $_POST['category'],
        'brand' => $_POST['brand'],
        'condition' => $_POST['condition'],
        'color' => $_POST['color'],
        'size' => $_POST['size'],
        'fabric' => $_POST['fabric'],
    ];
} else {
    header('Location: Sell.php');
    exit();
}

$product = $_SESSION['product'];
?>

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

<section class="container-content">
    <div class="product-details">
        <h3><b>Product Details</b></h3>
        
        <!-- Foto Produk -->
        <div class="product-photo-grid">
            <?php if (!empty($product['photo'])) : ?>
                <img src="../assets/uploads/<?php echo htmlspecialchars($product['photo']); ?>" alt="Product Photo">
            <?php else : ?>
                <p>No photo uploaded.</p>
            <?php endif; ?>
        </div>

        <!-- Detail Produk -->
        <div class="item-details">
            <table>
                <tr><td><strong>Description</strong></td><td>: <?php echo nl2br(htmlspecialchars($product['description'])); ?></td></tr>
                <tr><td><strong>Category</strong></td><td>: <?php echo htmlspecialchars($product['category']); ?></td></tr>
                <tr><td><strong>Brand</strong></td><td>: <?php echo htmlspecialchars($product['brand']); ?></td></tr>
                <tr><td><strong>Condition</strong></td><td>: <?php echo htmlspecialchars($product['condition']); ?></td></tr>
                <tr><td><strong>Color</strong></td><td>: <?php echo htmlspecialchars($product['color']); ?></td></tr>
                <tr><td><strong>Size</strong></td><td>: <?php echo htmlspecialchars($product['size']); ?></td></tr>
                <tr><td><strong>Fabric</strong></td><td>: <?php echo htmlspecialchars($product['fabric']); ?></td></tr>
            </table>
        </div>
    </div>

    <div class="price-details">
        <h3>Set Your Product Price</h3>
        <form action="?c=Route&m=confirmation" method="POST">
            <label for="price">Enter your price</label>
            <input type="number" id="price" name="price" placeholder="Input Price" min="0" required>

            <p class="total-price">Total Price: Rp 63,000</p>
            <div class="d-grid">
                <button type="submit"><b>Send Product</b></button>
            </div>
        </form>
    </div>
</section>

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
