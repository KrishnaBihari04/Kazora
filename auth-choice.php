<?php
$page_title = "Welkom bij Kazora";
require 'header.php';
?>

<section class="container py-5 text-center">
    <h2 class="mb-4">Welkom bij Kazora</h2>
    <p class="mb-4">Log in of maak een account aan om toegang te krijgen tot je persoonlijke pagina.</p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="login.php" class="btn btn-outline-light px-4 py-2">Inloggen</a>
        <a href="register.php" class="btn btn-outline-light px-4 py-2">Registreren</a>
    </div>
</section>

<?php require 'footer.php'; ?>
