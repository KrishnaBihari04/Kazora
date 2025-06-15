<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: account.php");
    exit();
}
$page_title = "Inloggen";
require 'header.php';
?>

<section class="container py-5">
    <h2 class="text-center mb-4">Inloggen</h2>
    <form action="process_login.php" method="POST" class="mx-auto" style="max-width: 500px;">
        <div class="mb-3">
            <label for="email" class="form-label">E-mailadres</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Wachtwoord</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-outline-light w-100">Inloggen</button>
    </form>
    <p class="text-center mt-3">Nog geen account? <a href="register.php" class="text-light text-decoration-underline">Registreer hier</a></p>
</section>

<?php require 'footer.php'; ?>
