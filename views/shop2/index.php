<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thriftin - Toko Thrift</title>
    <link rel="icon" type="image/x-icon" href="../resource/images/logoT.png">
    <link rel="stylesheet" href="../resource/css/nav.css">
    <link rel="stylesheet" href="../resource/css/app.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Voga&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Voga&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/heroicons@1.0.1/dist/solid.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../resource/css/order.css">
    <link rel="stylesheet" href="../resource/css/shop.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Voga&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resource/css/nav.css">
    <link rel="stylesheet" href="../resource/css/app.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Voga&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/heroicons@1.0.1/dist/solid.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet"></head>
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
   <section class="container my-5">
  <div class="row">
    <!-- Product Summary -->
    <div class="col-md-6">
      <div class="card shadow-sm p-3">
        <h4 class="mb-4">Order</h4>
        <div class="d-flex align-items-center">
          <img src="index.php?c=Route&m=serveImage&id=<?php echo $product['id']; ?>" 
               alt="Product Image" class="img-fluid rounded" style="width: 100px; height: auto; margin-right: 20px;">
          <div>
            <h5><?php echo htmlspecialchars($product['brand']); ?></h5>
            <p class="text-muted">Size <?php echo htmlspecialchars($product['size']); ?> - <?php echo htmlspecialchars($product['condition']); ?></p>
            <p class="text-muted">Color: <?php echo htmlspecialchars($product['color']); ?></p>
          </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between fw-bold">
          <p>Total</p>
          <p>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></p>
        </div>
      </div>
    </div>

    <!-- Address Form -->
    <div class="col-md-6">
      <div class="p-4 bg-white shadow-sm rounded">
        <h4 class="mb-4">Address</h4>
        <form method="post" action="index.php?c=Route&m=saveOrder">
          <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Find Your Address</label>
            <input type="text" name="address_search" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Full Address</label>
            <textarea name="full_address" class="form-control" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Other Details (Optional)</label>
            <input type="text" name="additional_details" class="form-control">
          </div>
          <button type="submit" class="btn btn-dark w-100">Proceed to Delivery</button>
        </form>
      </div>
    </div>
  </div>
</section>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('profileIcon').addEventListener('click', function(event) {
        event.preventDefault();
        var dropdown = document.getElementById('profileDropdown');
        dropdown.classList.toggle('d-none');
    });

    // Close the dropdown when clicking outside of it
    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('profileDropdown');
        var profileIcon = document.getElementById('profileIcon');
        if (!profileIcon.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('d-none');
        }
    });
</script>
<footer class="footer py-4" style="background-color: #0B2442; color: #F7F7F6;">
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
          <li><a href="../views/shop.html" class="footer-link">Women's Fashion</a></li>
          <li><a href="../views/shopmen.html" class="footer-link">Men's Fashion</a></li>
          <li><a href="../views/shopkid.html" class="footer-link">Kid's Fashion</a></li>
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
