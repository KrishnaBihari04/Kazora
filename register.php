<?php
require 'db.php';

// Start sessie indien nog niet gestart
if (session_status() === PHP_SESSION_NONE) session_start();

// Als gebruiker al is ingelogd, doorverwijzen naar accountpagina
if (isset($_SESSION['user'])) {
  header("Location: account.php");
  exit;
}

$errors = [];

// Verwerk formulier bij verzending
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name     = trim($_POST['name']);
  $email    = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm  = $_POST['confirm'];

  // Basisvalidatie
  if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
    $errors[] = "Alle velden zijn verplicht.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Voer een geldig e-mailadres in.";
  } elseif ($password !== $confirm) {
    $errors[] = "Wachtwoorden komen niet overeen.";
  } else {
    // Controleer of het e-mailadres al bestaat
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $errors[] = "Er bestaat al een account met dit e-mailadres.";
    } else {
      // Wachtwoord versleutelen en opslaan
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
      $stmt->bind_param("sss", $name, $email, $hashed);
      $stmt->execute();

      // Automatisch inloggen na registratie
      $_SESSION['user'] = ['name' => $name, 'email' => $email];
      header("Location: account.php");
      exit;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Kazora | Registreren</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Stijlen en Bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navigatie -->
  <?php include 'header.php'; ?>

  <!-- Registratieformulier -->
  <main class="auth-main d-flex justify-content-center align-items-center">
    <div class="auth-box">
      <h2 class="mb-4 text-center">Account aanmaken bij <span class="text-gold">Kazora</span></h2>

      <!-- Foutmeldingen weergeven -->
      <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php foreach ($errors as $e): ?>
              <li><?= htmlspecialchars($e) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- Formuliervelden -->
      <form method="POST" class="d-grid gap-3">
        <div>
          <label for="name" class="form-label">Naam</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div>
          <label for="email" class="form-label">E-mailadres</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div>
          <label for="password" class="form-label">Wachtwoord</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div>
          <label for="confirm" class="form-label">Herhaal wachtwoord</label>
          <input type="password" name="confirm" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-dark">Registreren</button>
      </form>

      <!-- Link naar inlogpagina -->
      <p class="mt-4 text-center">
        Heb je al een account? <a href="login.php" class="link-dark text-decoration-underline">Log hier in</a>
      </p>
    </div>
  </main>

  <!-- Footer -->
  <?php include 'footer.php'; ?>

</body>
</html>
