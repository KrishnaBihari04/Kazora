<?php
session_start();

if (!isset($page_title)) {
    $page_title = "Kazora";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($page_title) ?></title>

    <!-- CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="assets/kazora.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css" />
    <script defer src="js/main.js"></script>
</head>
<body class="bg-black text-light" style="font-family: 'Georgia', serif;">

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark px-3">
  <div class="container-fluid d-flex align-items-center justify-content-between px-3 position-relative">

    <!-- Hamburger (left) -->
    <button class="menu-btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
      <div class="menu-lines">
        <span class="menu-line"></span>
        <span class="menu-line"></span>
        <span class="menu-line"></span>
      </div>
    </button>

    <!-- Mobile logo -->
    <a class="logo text-white text-center position-absolute start-50 translate-middle-x d-block d-lg-none" style="z-index: 2;" href="home.php">KAZORA</a>

    <!-- Profile icon (right) -->
    <div class="nav-icons d-lg-none">
      <a href="<?= isset($_SESSION['user']) ? 'account.php' : 'auth.php'; ?>" class="nav-link">
        <i class="fas fa-user"></i>
      </a>
    </div>

    <!-- Desktop nav with logo in the center -->
    <div class="d-none d-lg-flex w-100 align-items-center justify-content-between">
      <!-- Left -->
      <div class="d-flex gap-4 align-items-center">
        <a class="nav-link" href="watches.php">WATCHES</a>
        <a class="nav-link" href="coming-soon.php">ACCESSORIES</a>
        <a class="nav-link" href="our-world.php">OUR WORLD</a>
      </div>

      <!-- Logo -->
      <a class="logo text-white d-inline-block text-center" href="home.php">KAZORA</a>

      <!-- Right (includes profile) -->
      <div class="d-flex gap-4 align-items-center">
        <a class="nav-link" href="stories.php">STORIES</a>
        <a class="nav-link" href="contact.php">CONTACT</a>
        <a class="nav-link" href="boutiques.php">BOUTIQUES</a>
        <a href="<?= isset($_SESSION['user']) ? 'account.php' : 'auth.php'; ?>" class="nav-link">
          <i class="fas fa-user"></i>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Mobile menu -->
<div class="offcanvas offcanvas-end mobile-menu" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header menu-header">
        <h5 class="offcanvas-title menu-title">KAZORA</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav>
            <div class="menu-item"><a href="watches.php" class="menu-link"><i class="fas fa-clock"></i> WATCHES</a></div>
            <div class="menu-item"><a href="coming-soon.php" class="menu-link"><i class="bi bi-gem"></i> ACCESSORIES</a></div>
            <div class="menu-item"><a href="our-world.php" class="menu-link"><i class="fas fa-globe"></i> OUR WORLD</a></div>
            <div class="menu-item"><a href="stories.php" class="menu-link"><i class="fas fa-book-open"></i> STORIES</a></div>
            <div class="menu-item"><a href="contact.php" class="menu-link" data-bs-dismiss="offcanvas"><i class="fas fa-envelope"></i> CONTACT</a></div>
            <div class="menu-item"><a href="boutiques.php" class="menu-link"><i class="fas fa-store"></i> BOUTIQUES</a></div>
            <div class="menu-item"><a href="<?= isset($_SESSION['user']) ? 'account.php' : 'auth.php'; ?>" class="menu-link"><i class="fas fa-user"></i> ACCOUNT</a></div>
        </nav>

        <div class="menu-contact">
            <div class="text-center">
                <p class="mb-1 text-light">info@kazorawatches.com</p>
                <p class="mb-3 text-light">+123 456 789</p>
            </div>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-youtube"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-tiktok"></i></a>
                <a href="#" class="social-btn"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </div>
</div>