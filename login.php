<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// Als ingelogd → redirect
if (isset($_SESSION['user'])) {
  header("Location: account.php");
  exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = ['name' => $user['name'], 'email' => $user['email']];
    header("Location: account.php");
    exit;
  } else {
    $error = "Ongeldige inloggegevens. Probeer opnieuw.";
  }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Kazora | Inloggen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <?php include 'header.php'; ?>

  <main class="auth-main d-flex justify-content-center align-items-center">
    <div class="auth-box">
      <h2 class="mb-4 text-center">Inloggen bij <span class="text-gold">Kazora</span></h2>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" class="d-grid gap-3">
        <div>
          <label for="email" class="form-label">E-mailadres</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div>
          <label for="password" class="form-label">Wachtwoord</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-dark">Inloggen</button>
      </form>

      <p class="mt-4 text-center">
        Nog geen account? <a href="register.php" class="link-dark text-decoration-underline">Registreer hier</a>
      </p>
    </div>
  </main>

  <?php include 'footer.php'; ?>

</body>
</html>
