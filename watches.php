<?php
$page_title = "Kazora Collectie";
require 'header.php';
?>

<section class="hero d-flex justify-content-center align-items-center text-center position-relative" style="height: 80vh; background: url('https://i.pinimg.com/originals/b9/4e/18/b94e18ea40626f10bc67eaba042ec415.gif') center center / cover no-repeat;">
    <div class="overlay position-absolute w-100 h-100" style="background: rgba(18, 18, 18, 0.7); top: 0; left: 0;"></div>
    <div class="position-relative z-1">
        <h1 class="display-3 fw-bold text-light mb-4">Ontdek de Kazora Collectie</h1>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="products.php?category=1" class="btn btn-outline-light px-5 py-3">Dames Horloges</a>
            <a href="products.php?category=2" class="btn btn-outline-light px-5 py-3">Heren Horloges</a>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>
