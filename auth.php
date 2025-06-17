<?php
// Check if the session has not already started, and start it if necessary
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// If the user is already logged in, redirect to account page
if (isset($_SESSION['user'])) {
  header("Location: account.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Kazora | Login or Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Link to CSS file -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- Bootstrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

  <!-- Include header.php -->
  <?php include 'header.php'; ?>

  <!-- Main section for login/register options -->
  <main class="auth-main d-flex justify-content-center align-items-center">
    <div class="auth-box text-center">
      <h2 class="mb-4">Welcome to <span class="text-gold">Kazora</span></h2>
      <p class="mb-4">Choose an option to proceed</p>
      <div class="d-grid gap-3">
        <a href="login.php" class="btn btn-dark">Login</a>
        <a href="register.php" class="btn btn-dark">Register</a>
      </div>
    </div>
  </main>

  <!-- Include footer.php -->
  <?php include 'footer.php'; ?>

</body>
</html>