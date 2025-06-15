<!DOCTYPE html>
<html lang="nl">
<head>
    <!-- Basic settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kazora</title>

    <!-- CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/main.js"></script>
</head>
<body>

<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark px-3">
    <div class="container-fluid d-flex align-items-center justify-content-between px-3 position-relative">

        <!-- Hamburger button for mobile -->
        <button class="menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
            <div class="menu-lines">
                <span class="menu-line"></span>
                <span class="menu-line"></span>
                <span class="menu-line"></span>
            </div>
        </button>

        <!-- Logo for mobile only -->
        <a class="logo text-white text-center mx-auto d-block d-lg-none" href="home.php">KAZORA</a>

        <!-- Desktop navigation (visible on lg and up) -->
        <div class="d-none d-lg-flex w-100 justify-content-between align-items-center position-relative px-4">

            <!-- Left nav links -->
            <ul class="navbar-nav flex-row gap-3">
                <li class="nav-item"><a class="nav-link" href="#">WATCHES</a></li>
                <li class="nav-item"><a class="nav-link" href="#">ACCESSORIES</a></li>
                <li class="nav-item"><a class="nav-link" href="#">OUR WORLD</a></li>
            </ul>

            <!-- Logo for desktop only -->
            <a class="logo text-white text-center position-absolute top-50 start-50 translate-middle d-none d-lg-block" href="#">KAZORA</a>

            <!-- Right nav links -->
            <ul class="navbar-nav flex-row gap-3">
                <li class="nav-item"><a class="nav-link" href="#">STORIES</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">CONTACT</a></li>
                <li class="nav-item"><a class="nav-link" href="#">BOUTIQUES</a></li>
            </ul>
        </div>

        <!-- Profile icon -->
        <div class="nav-icons">
            <a href="account.php"><i class="bi bi-person-circle text-white fs-4"></i></a>
        </div>
    </div>
</nav>

<!-- Mobile menu -->
<div class="offcanvas offcanvas-end mobile-menu" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header menu-header">
        <h5 class="offcanvas-title menu-title" id="mobileMenuLabel">KAZORA</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">
        <nav>
            <div class="menu-item">
                <a href="watches.php" class="menu-link">
                    <i class="fas fa-clock"></i>
                    WATCHES
                </a>
            </div>
            <div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-rings-wedding"></i>
                    ACCESSORIES
                </a>
            </div>
            <div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-globe"></i>
                    OUR WORLD
                </a>
            </div>
            <div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-book-open"></i>
                    STORIES
                </a>
            </div>
            <div class="menu-item">
                <a href="#contact" class="menu-link" data-bs-dismiss="offcanvas">
                    <i class="fas fa-envelope"></i>
                    CONTACT
                </a>
            </div>
            <div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-store"></i>
                    BOUTIQUES
                </a>
            </div>
        </nav>

        <div class="menu-contact">
            <div class="text-center">
                <p class="mb-1">info@kazorawatches.com</p>
                <p class="mb-3">+123 456 789</p>
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

<!-- Hero section -->
    
<div class="hero d-flex justify-content-center align-items-center text-center position-relative" style="height: 100vh; background: url('https://i.pinimg.com/originals/b9/4e/18/b94e18ea40626f10bc67eaba042ec415.gif') center center / cover no-repeat;">
    <div class="overlay position-absolute w-100 h-100" style="background: rgba(18, 18, 18, 0.7); top: 0; left: 0;"></div>
    <div class="hero-content position-relative z-1">
        <h1 class="display-5 fw-bold" style="color: var(--text-light);">Timeless elegance<br>meets contemporary luxury.</h1>
        <a href="#contact" class="btn btn-outline-light mt-4 px-4 py-2">Make appointment</a>
    </div>
</div>

</div>

<!-- Appointment section -->
<section class="section text-center" id="appointment">
    <div class="container">
        <p class="fs-4">KAZORA Watches</p>
        <button class="btn btn-outline-light">Make appointment</button>
    </div>
</section>

<!-- Contact section -->
<section class="section" id="contact">
    <div class="container">
        <h2 class="text-center mb-4">Contact</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control input" id="name" placeholder="Your name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control input" id="email" placeholder="Your email">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control input" id="message" rows="5" placeholder="Your message..."></textarea>
            </div>
            <button type="submit" class="btn btn-outline-light">Send</button>
        </form>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="social-icons mb-2">
        <a href="#"><i class="bi bi-instagram"></i></a>
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-youtube"></i></a>
        <a href="#"><i class="bi bi-linkedin"></i></a>
        <a href="#"><i class="bi bi-tiktok"></i></a>
        <a href="#"><i class="bi bi-pinterest"></i></a>
    </div>
    <p>&copy; 2025 All rights reserved by Kazora &nbsp; | &nbsp; Phone: +123 456 789</p>
</footer>

</body>
</html>