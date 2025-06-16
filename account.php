<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

// Huidige gebruiker ophalen
$email = $_SESSION['user']['email'];
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Formulier afhandeling
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newName = trim($_POST['name']);
  $newEmail = trim($_POST['email']);
  $newPassword = $_POST['new_password'];
  $confirm = $_POST['confirm_password'];
  $currentPassword = $_POST['current_password'];

  // Beveiliging: controleer huidig wachtwoord
  if (!password_verify($currentPassword, $user['password'])) {
    $error = "Je huidige wachtwoord is onjuist.";
  } else {
    // Update voorbereiden
    $updates = [];
    $params = [];

    if ($newName !== $user['name']) {
      $updates[] = "name = ?";
      $params[] = $newName;
      $_SESSION['user']['name'] = $newName;
    }

    if ($newEmail !== $user['email']) {
      $updates[] = "email = ?";
      $params[] = $newEmail;
      $_SESSION['user']['email'] = $newEmail;
    }

    if (!empty($newPassword)) {
      if ($newPassword !== $confirm) {
        $error = "Nieuwe wachtwoorden komen niet overeen.";
      } else {
        $updates[] = "password = ?";
        $params[] = password_hash($newPassword, PASSWORD_DEFAULT);
      }
    }

    if (!$error && count($updates) > 0) {
      $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $params[] = $user['id'];
      $stmt->bind_param(str_repeat("s", count($params) - 1) . "i", ...$params);
      $stmt->execute();
      $success = "Je gegevens zijn succesvol bijgewerkt.";
    }
  }

  // Refresh data
  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", $user['id']);
  $stmt->execute();
  $user = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Kazora | Mijn account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <?php include 'header.php'; ?>

  <main class="auth-main d-flex justify-content-center align-items-center">
    <div class="auth-box" style="width: 100%; max-width: 600px;">
      <h2 class="mb-4 text-center">Welkom terug, <span class="text-gold"><?= htmlspecialchars($user['name']) ?></span></h2>

      <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" class="d-grid gap-3">
        <div>
          <label class="form-label">Naam</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div>
          <label class="form-label">E-mailadres</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div>
          <label class="form-label">Huidig wachtwoord <span class="text-gold">(verplicht voor wijzigingen)</span></label>
          <input type="password" name="current_password" class="form-control" required>
        </div>

        <div>
          <label class="form-label">Nieuw wachtwoord</label>
          <input type="password" name="new_password" class="form-control" placeholder="Leeg laten als je niets wilt veranderen">
        </div>

        <div>
          <label class="form-label">Herhaal nieuw wachtwoord</label>
          <input type="password" name="confirm_password" class="form-control">
        </div>

        <div class="form-text text-start mt-2 text-white">
          <strong>Account aangemaakt op:</strong> <?= date('d-m-Y H:i', strtotime($user['created_at'])) ?><br>
          <strong>Wachtwoord:</strong> ********
        </div>

        <button type="submit" class="btn btn-dark mt-3">Wijzigingen opslaan</button>
      </form>

      <a href="logout.php" class="btn btn-dark w-100 mt-4">Uitloggen</a>
    </div>
  </main>

  <?php include 'footer.php'; ?>

</body>
</html>
