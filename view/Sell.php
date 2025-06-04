<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sell Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style1.css">
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
      <a class="nav-link" href="#"><img src="assets/img/Notifikasi.jpg" alt="Notifikasi" width="24"></a>
      <a class="nav-link" href="#"><img src="assets/img/love.jpg" alt="love" width="24"></a>
      <a class="nav-link" href="#"><img src="assets/img/gift.jpg" alt="gift" width="24"></a>
      <a class="nav-link" href="#"><img src="assets/img/bag.jpg" alt="bag" width="24"></a>
      <a class="nav-link" href="#"><img src="assets/img/profil.jpg" alt="profile" width="24"></a>
    </div>
  </div>
</nav>

<!-- Main Form Content -->
<section class="sell-section">
<form action="index.php?c=SellController&m=productDetail" method="POST">
    <h2>Sell Your Items</h2>
        <div class="sell-container">
            <!-- Product Section -->
            <div class="product-section">
                <h3><b>Product</b></h3>
                <div class="product-photo-grid">
                    <!-- Photo Items -->
                    <div class="photo-item">
                        <label for="add-photo">
                            <img src="assets/img/plus.jpg" alt="Add Photo">
                        </label>
                        <span>Add Photo</span> 
                        <input type="file" id="add-photo" name="photo" style="display:none;">
                    </div>
                    <div class="photo-item"></div>
                    <div class="photo-item"></div>
                    <div class="photo-item"></div>
                    <div class="photo-item"></div>
                    <div class="photo-item"></div>
                </div>

                <textarea name="description" placeholder="Describe the items to be sold (brand, name, size, and condition)"></textarea>
            </div>

            <!-- Detail Information Section -->
            <div class="detail-section">
                <h3><b>Detail Information</b></h3>

                <label for="category">Category</label>
                <select name="category">
                    <option value="">Category</option>
                    <option value="Women's Fashion">Women's Fashion</option>
                    <option value="Men's Fashion">Men's Fashion</option>
                    <option value="Kid's Fashion">Kid's Fashion</option>
                </select>

                <label for="brand">Brand</label>
                <select name="brand">
                    <option value="">Brand</option>
                    <option value="Uniqlo">Uniqlo</option>
                    <option value="Zara">Zara</option>
                    <option value="Adidas">Adidas</option>
                </select>

                <label for="condition">Condition</label>
                <select name="condition">
                    <option value="">Condition</option>
                    <option value="New">New</option>
                    <option value="Like New">Like New</option>
                    <option value="Used">Used</option>
                </select>

                <label for="color">Color</label>
                <select name="color">
                    <option value="">Color</option>
                    <option value="Red">Red</option>
                    <option value="Blue">Blue</option>
                    <option value="Black">Black</option>
                </select>

                <label for="size">Size</label>
                <select name="size">
                    <option value="">Size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                </select>

                <label for="fabric">Type of Fabric</label>
                <select name="fabric">
                    <option value="">Type of Fabric</option>
                    <option value="Cotton">Cotton</option>
                    <option value="Polyester">Polyester</option>
                    <option value="Wool">Wool</option>
                </select>
            </div>
        </div>

        <div class="submit-button">
            <button type="submit"><b>Submit</b></button>
        </div>
    </form>
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
