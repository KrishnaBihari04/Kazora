<?php
$page_title = "Kazora Collectie";
require 'header.php';
?>

<div class="d-flex flex-column min-vh-100">

    <main class="flex-grow-1">
        <section class="hero d-flex justify-content-center align-items-center text-center position-relative">
            <div class="overlay"></div>
            <div class="hero-content">
                <h1 class="display-3 fw-bold text-light mb-4">Ontdek de Kazora Collectie</h1>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="products.php?category=1" class="btn btn-outline-light px-5 py-3">Dames Horloges</a>
                    <a href="products.php?category=2" class="btn btn-outline-light px-5 py-3">Heren Horloges</a>
                </div>
            </div>
        </section>
    </main>

    <?php require 'footer.php'; ?>
</div>
