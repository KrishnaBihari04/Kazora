<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: account.php");
    exit();
}
$page_title = "Registreren";
require 'header.php';
?>

<section class="container py-5">
    <h2 class="text-center mb-4">Account aanmaken</h2>
    <form action="process_register.php" method="POST" class="mx-auto" style="max-width: 500px;">
        <div class="mb-3">
            <label for="name" class="form-label">Naam</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mailadres</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Wachtwoord</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-outline-light w-100">Registreren</button>
    </form>
    <p class="text-center mt-3">Al een account? <a href="login.php" class="text-light text-decoration-underline">Log hier in</a></p>
</section>

<?php require 'footer.php'; ?>
