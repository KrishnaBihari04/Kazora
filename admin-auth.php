<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

// Alleen admins mogen deze pagina zien
require 'db.php';
$email = $_SESSION['user']['email'];
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user['role'] !== 'admin') {
  header("Location: account.php");
  exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $code = $_POST['admincode'];
  if ($code === 'admin') {
    // Toegang goed → sessie zetten → door
    $_SESSION['admin_verified'] = true;
    header("Location: admin-register.php");
    exit;
  } else {
    $error = "Onjuist admin-wachtwoord.";
  }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Bevestig Admin-toegang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<main class="auth-main d-flex justify-content-center align-items-center">
  <div class="auth-box text-center" style="max-width: 400px;">
    <h2 class="mb-4">Beveiliging</h2>
    <p>Voer het admin-wachtwoord in om verder te gaan.</p>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" class="d-grid gap-3">
      <input type="password" name="admincode" class="form-control" placeholder="Admin-wachtwoord" required>
      <button type="submit" class="btn btn-dark">Bevestigen</button>
    </form>
  </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
