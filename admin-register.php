<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];

  if ($password !== $confirm) {
    $error = "Wachtwoorden komen niet overeen.";
  } else {
    // Check of email al bestaat
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $error = "Er bestaat al een gebruiker met dit e-mailadres.";
    } else {
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
      $stmt->bind_param("sss", $name, $email, $hashed);
      $stmt->execute();
      $success = "Admin-account is succesvol aangemaakt.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Admin Registratie | Kazora</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<main class="auth-main d-flex justify-content-center align-items-center">
  <div class="auth-box" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Admin-account aanmaken</h2>

    <?php if (!empty($success)): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="d-grid gap-3">
      <input type="text" name="name" class="form-control" placeholder="Naam" required>
      <input type="email" name="email" class="form-control" placeholder="E-mailadres" required>
      <input type="password" name="password" class="form-control" placeholder="Wachtwoord" required>
      <input type="password" name="confirm" class="form-control" placeholder="Herhaal wachtwoord" required>
      <button type="submit" class="btn btn-dark mt-2">Admin aanmaken</button>
    </form>
  </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
