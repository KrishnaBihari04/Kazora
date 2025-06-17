<?php
$page_title = "Kazora Collection";
require 'header.php';
?>

<!-- Begin pagina-wrapper -->
<div class="d-flex flex-column min-vh-100">

    <!-- Hoofdinhoud (Hero sectie met knoppen voor categorieën) -->
    <main class="flex-grow-1">
        <section class="hero d-flex justify-content-center align-items-center text-center position-relative">
            <!-- Donkere overlay over de achtergrond -->
            <div class="overlay"></div>

            <!-- Hero-tekst en knoppen -->
            <div class="hero-content">
                <h1 class="display-3 fw-bold text-light mb-4">Discover the Kazora Collection</h1>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="products.php?category=1" class="btn btn-outline-light px-5 py-3">Women's Watches</a>
                    <a href="products.php?category=2" class="btn btn-outline-light px-5 py-3">Men's Watches</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php require 'footer.php'; ?>
</div>
