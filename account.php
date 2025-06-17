<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

// <!--Inloggen controleren-->
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

// <!--Huidige gebruiker ophalen-->
$email = $_SESSION['user']['email'];
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// <!--Formulier verwerking-->
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $newName = trim($_POST['name']);
  $newEmail = trim($_POST['email']);
  $newPassword = $_POST['new_password'];
  $confirm = $_POST['confirm_password'];
  $currentPassword = $_POST['current_password'];

  // <!--Beveiliging: controleer huidig wachtwoord-->
  if (!password_verify($currentPassword, $user['password'])) {
    $error = "Your current password is incorrect.";
  } else {
    // <!--Bijwerken voorbereiden-->
    $updates = [];
    $params = [];

    // <!--Naam aanpassen-->
    if ($newName !== $user['name']) {
      $updates[] = "name = ?";
      $params[] = $newName;
      $_SESSION['user']['name'] = $newName;
    }

    // <!--Email aanpassen-->
    if ($newEmail !== $user['email']) {
      $updates[] = "email = ?";
      $params[] = $newEmail;
      $_SESSION['user']['email'] = $newEmail;
    }

    // <!--Wachtwoord aanpassen-->
    if (!empty($newPassword)) {
      if ($newPassword !== $confirm) {
        $error = "New passwords do not match.";
      } else {
        $updates[] = "password = ?";
        $params[] = password_hash($newPassword, PASSWORD_DEFAULT);
      }
    }

    // <!--Database update uitvoeren-->
    if (!$error && count($updates) > 0) {
      $sql = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
      $stmt = $conn->prepare($sql);
      $params[] = $user['id'];
      $stmt->bind_param(str_repeat("s", count($params) - 1) . "i", ...$params);
      $stmt->execute();
      $success = "Your details have been updated successfully.";
    }
  }

  // <!--Gebruikergegevens refreshen-->
  $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->bind_param("i", $user['id']);
  $stmt->execute();
  $user = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Kazora | My Account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

  <!-- <?php include 'header.php'; ?> -->

  <!-- Hoofdsectie voor accountgegevens-->
  <main class="auth-main d-flex justify-content-center align-items-center">
    <div class="auth-box" style="width: 100%; max-width: 600px;">
      <!-- Welkomsttekst met gebruikersnaam -->
      <h2 class="mb-4 text-center">Welcome back, <span class="text-gold"><?= htmlspecialchars($user['name']) ?></span></h2>

      <!-- Success bericht tonen -->
      <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <!-- Foutmelding tonen -->
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <!-- Formulier voor gebruikersgegevens -->
      <form method="POST" class="d-grid gap-3">
        <!-- Naam veld -->
        <div>
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <!-- Email veld -->
        <div>
          <label class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <!-- Huidig wachtwoord -->
        <div>
          <label class="form-label">Current password <span class="text-gold">(required for changes)</span></label>
          <input type="password" name="current_password" class="form-control" required>
        </div>

        <!-- Nieuw wachtwoord -->
        <div>
          <label class="form-label">New password</label>
          <input type="password" name="new_password" class="form-control" placeholder="Leave blank if you don't want to change">
        </div>

        <!-- Bevestig nieuw wachtwoord -->
        <div>
          <label class="form-label">Confirm new password</label>
          <input type="password" name="confirm_password" class="form-control">
        </div>

        <!-- Gebruikersinformatie -->
        <div class="form-text text-start mt-2 text-white">
          <strong>Account created on:</strong> <?= date('d-m-Y H:i', strtotime($user['created_at'])) ?><br>
          <strong>Password:</strong> ********
        </div>

        <!-- Submit knop -->
        <button type="submit" class="btn btn-dark mt-3">Save changes</button>
      </form>

      <!-- Admin panel link -->
      <?php if ($user['role'] === 'admin'): ?>
        <a href="admin.php" class="btn btn-outline-warning w-100 mt-4">Go to Admin Panel</a>
      <?php endif; ?>

      <!-- Logout knop -->
      <a href="logout.php" class="btn btn-dark w-100 mt-2">Logout</a>
    </div>
  </main>

  <!-- <?php include 'footer.php'; ?> -->

</body>
</html>