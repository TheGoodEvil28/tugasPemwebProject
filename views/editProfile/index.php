<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="View/editProfile/styles.css" />
    <link rel="stylesheet" href="public/css/navbar.css" />
    <link rel="stylesheet" href="public/css/footer.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a class="nav-link profile-link position-relative" href="?profile&m=index" id="profileIcon">
                    <i class="fas fa-user" style="font-size: 24px;"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- * Content -->
    <div class="edit-profile-container">
        <a class="back-button" href="?c=profile"><i class="fas fa-arrow-left"></i> Back to Profile</a>

        <div class="edit-profile-card">
            <h2 class="edit-profile-title">Edit Profile</h2>

            <div class="profile-picture-section">
                <div class="profile-picture-container">
                    <img src="<?= htmlspecialchars($user['profile_picture']) ?>"
                        alt="Profile Picture"
                        class="profile-picture" />
                    <div class="picture-overlay">
                        <i class="fas fa-camera"></i>
                    </div>
                </div>

                <div class="picture-actions">
                    <button type="button"
                        class="btn-change-picture"
                        data-bs-toggle="modal"
                        data-bs-target="#pictureModal">
                        <i class="fas fa-sync-alt"></i> Change Photo
                    </button>
                    <button type="button"
                        class="btn-remove-picture"
                        onclick="removeProfilePicture()">
                        <i class="fas fa-trash-alt"></i> Remove
                    </button>
                </div>
            </div>

            <!-- Picture Modal -->
            <div class="modal fade" id="pictureModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Update Profile Picture</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Image URL</label>
                                <input type="url"
                                    class="form-control"
                                    id="profilePictureUrl"
                                    placeholder="<?= htmlspecialchars($user['profile_picture']) ?>" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-save" onclick="updatePictureInput()">Save URL</button>
                        </div>
                    </div>
                </div>
            </div>


            <form class="profile-form" method="POST" action="?c=Profile&m=update">
                <!-- Hidden input in main form -->
                <input type="hidden" name="profile_picture" id="profilePictureInput" value="<?= htmlspecialchars($user['profile_picture']) ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" value="<?= htmlspecialchars($user['username']) ?>" readonly />
                    </div>
                </div>

                <div class="form-group">
                    <label for="display-name">Display Name</label>
                    <div class="input-with-icon">
                        <i class="fas fa-signature"></i>
                        <input type="text" id="display-name" name="display_name"
                            value="<?= htmlspecialchars($user['display_name']) ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email"
                            value="<?= htmlspecialchars($user['email']) ?>" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <div class="input-with-icon">
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="phone" name="phone"
                            value="<?= htmlspecialchars($user['phone']) ?>" />
                    </div>
                </div>

                <div class="form-actions">
                    <a href="?c=Profile" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Save Changes</button>
                </div>
            </form>
            <? var_dump($user) ?>
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
                        <li><a href="?c=Shop&m=women" class="footer-link">Women's Fashion</a></li>
                        <li><a href="?c=Shop&m=men" class="footer-link">Men's Fashion</a></li>
                        <li><a href="?c=Shop&m=kids" class="footer-link">Kid's Fashion</a></li>
                    </ul>
                </div>

                <!-- Help -->
                <div class="col-lg-2 col-md-6 col-sm-12 mb-3">
                    <h5 class="footer-title">Help</h5>
                    <ul class="list-unstyled">
                        <li><a href="?c=Contact" class="footer-link">Contact Us</a></li>
                        <li><a href="?c=FAQ" class="footer-link">FAQ</a></li>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- script buat handler pp -->
    <script>
        function updatePictureInput() {
            const urlInput = document.getElementById('profilePictureUrl');
            const hiddenInput = document.getElementById('profilePictureInput');
            const previewImg = document.querySelector('.profile-picture');

            if (urlInput.checkValidity()) {
                previewImg.src = urlInput.value;
                hiddenInput.value = urlInput.value;
                bootstrap.Modal.getInstance(document.getElementById('pictureModal')).hide();
            }
        }

        function removeProfilePicture() {
            document.querySelector('.profile-picture').src = '/path/to/default.jpg';
            document.getElementById('profilePictureInput').value = '';
        }
    </script>
    <script src="public/js/navbar.js"></script>
</body>

</html>