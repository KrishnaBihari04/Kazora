<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: auth.php');
    exit;
}

$user = $_SESSION['user'];
$user_id = $user['id'];
$success = "";
$error = "";

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['save_changes'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Stap 1: Haal huidige hash uit DB
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed = $row['password'];

        // Stap 2: Verifieer huidig wachtwoord
        if (password_verify($current_password, $hashed)) {

            // Stap 3a: Nieuw wachtwoord vereist controle
            if (!empty($new_password)) {
                if ($new_password === $confirm_password) {
                    $hashed_new = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, password=? WHERE id=?");
                    $stmt->bind_param("sssi", $name, $email, $hashed_new, $user_id);
                    if ($stmt->execute()) {
                        $success = "Wachtwoord en gegevens succesvol bijgewerkt.";
                    } else {
                        $error = "Bijwerken mislukt. Probeer opnieuw.";
                    }
                    $stmt->close();
                } else {
                    $error = "Nieuwe wachtwoorden komen niet overeen.";
                }
            }

            // Stap 3b: Alleen naam en e-mail wijzigen
            if (empty($new_password) && empty($error)) {
                $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
                $stmt->bind_param("ssi", $name, $email, $user_id);
                if ($stmt->execute()) {
                    $success = "Gegevens succesvol bijgewerkt.";
                } else {
                    $error = "Bijwerken mislukt. Probeer opnieuw.";
                }
                $stmt->close();
            }

        } else {
            $error = "Huidig wachtwoord is onjuist.";
        }
    } else {
        $error = "Gebruiker niet gevonden.";
    }

    // Stap 4: Ververs sessiegegevens na succesvolle wijziging
    if (isset($success)) {
        $stmt = $conn->prepare("SELECT id, name, email, created_at, role FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows === 1) {
            $_SESSION['user'] = $result->fetch_assoc();
            $user = $_SESSION['user'];
        }
        $stmt->close();
    }
}

// Handle account deletion
if (isset($_POST['delete_account'])) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            session_destroy();
            header("Location: auth.php");
            exit;
        } else {
            $error = "Je account kon niet worden verwijderd. Probeer opnieuw.";
        }
    } else {
        $error = "Er ging iets mis bij het verwijderen van je account.";
    }
    $stmt->close();
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

  <main class="auth-main d-flex justify-content-center align-items-center">
    <div class="auth-box" style="width: 100%; max-width: 600px;">
      <h2 class="mb-4 text-center">Welcome back, <span class="text-gold"><?= htmlspecialchars($user['name']) ?></span></h2>

      <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <!-- Formulier voor accountgegevens -->
      <form method="POST" class="d-grid gap-3">
        <div>
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>

        <div>
          <label class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div>
          <label class="form-label">Current password <span class="text-gold">(required for changes)</span></label>
          <input type="password" name="current_password" class="form-control" required>
        </div>

        <div>
          <label class="form-label">New password</label>
          <input type="password" name="new_password" class="form-control" placeholder="Leave blank if you don't want to change">
        </div>

        <div>
          <label class="form-label">Confirm new password</label>
          <input type="password" name="confirm_password" class="form-control">
        </div>

        <div class="form-text text-start mt-2 text-white">
          <strong>Account created on:</strong> <?= date('d-m-Y H:i', strtotime($user['created_at'])) ?><br>
          <strong>Password:</strong> ********
        </div>

        <button type="submit" name="save_changes" class="btn btn-dark mt-3">Save changes</button>
      </form>

      <?php if ($user['role'] === 'admin'): ?>
        <a href="admin.php" class="btn btn-outline-warning w-100 mt-4">Go to Admin Panel</a>
      <?php endif; ?>

      <a href="logout.php" class="btn btn-dark w-100 mt-2">Logout</a>

      <form method="POST" class="mt-3" onsubmit="return confirm('Weet je zeker dat je je account wilt verwijderen? Dit kan niet ongedaan worden gemaakt.')">
        <button type="submit" name="delete_account" class="btn btn-delete w-100">Verwijder mijn account</button>
      </form>
    </div>
  </main>

  <!-- <?php include 'footer.php'; ?> -->

</body>
</html>
