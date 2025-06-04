<!-- resources/views/layout/footer.blade.php -->
<link rel="stylesheet" href="../resource/css/nav.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Voga&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<script src="https://unpkg.com/heroicons@1.0.1/dist/solid.js"></script>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container d-flex justify-content-between align-items-center top-bar">
    
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="../views/index.php">
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