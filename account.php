<?php
session_start();

// Als gebruiker niet is ingelogd, doorverwijzen naar authorization
if (!isset($_SESSION['user'])) {
    header("Location: /kazora/auth-choice.php"); // Pas aan naar jouw map als nodig
    exit();
}

$page_title = "Mijn Account";
require 'header.php';
?>

<section class="container py-5">
    <h2 class="text-center mb-4">Welkom, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</h2>
    <p class="text-center">Je bent ingelogd met het e-mailadres: <strong><?= htmlspecialchars($_SESSION['user']['email']) ?></strong></p>
    <div class="text-center mt-4">
        <a href="/kazora/logout.php" class="btn btn-outline-light">Uitloggen</a>
    </div>
</section>

<?php require 'footer.php'; ?>
