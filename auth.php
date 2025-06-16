<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION['user'])) {
  header("Location: account.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Kazora | Login of Registreren</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <?php include 'header.php'; ?>

  <main class="auth-main d-flex justify-content-center align-items-center">
    <div class="auth-box text-center">
      <h2 class="mb-4">Welkom bij <span class="text-gold">Kazora</span></h2>
      <p class="mb-4">Kies een optie om verder te gaan</p>
      <div class="d-grid gap-3">
        <a href="login.php" class="btn btn-dark">Inloggen</a>
        <a href="register.php" class="btn btn-dark">Registreren</a>
      </div>
    </div>
  </main>

  <?php include 'footer.php'; ?>

</body>
</html>
