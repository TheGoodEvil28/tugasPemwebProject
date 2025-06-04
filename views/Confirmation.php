<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style3.css">
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

    <section class="confirmation-content py-5" style="min-height: 80vh;">
        <div class="container text-center">
            <h1 class="mt-5">Product Submitted Successfully!</h1>
            <p class="lead">Thank you for listing your product on Thriftin!</p>
            <a href="?c=route&m=index" class="btn btn-primary mt-3">Back to Home</a>
        </div>
    </section>

</body>
</html>