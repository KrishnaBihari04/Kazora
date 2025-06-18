<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: auth.php');
    exit;
}

$user = $_SESSION['user'];
$user_id = $user['id'];

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['save_changes'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate and update
    if (!empty($current_password)) {
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($hashed);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($current_password, $hashed)) {
            if (!empty($new_password) && $new_password === $confirm_password) {
                $hashed_new = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET name=?, email=?, password=? WHERE id=?");
                $stmt->bind_param("sssi", $name, $email, $hashed_new, $user_id);
                $stmt->execute();
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['email'] = $email;
            } else {
                $error = "New passwords don't match.";
            }
        } else {
            $error = "Incorrect current password.";
        }
    } else {
        $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $email, $user_id);
        $stmt->execute();
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
    }
}

// Handle delete
if (isset($_POST['delete_account'])) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    session_destroy();
    header("Location: auth.php");
    exit;
}

$page_title = "My Account";
require 'header.php';
?>

<main class="auth-main">
  <div class="container" style="max-width: 600px;">
    <h2 class="text-center mb-5">Welcome back, <?= htmlspecialchars($user['name']) ?></h2>

    <?php if (isset($error)) : ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input class="form-control" type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input class="form-control" type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Current password (required for changes)</label>
        <input class="form-control" type="password" name="current_password">
      </div>

      <div class="mb-3">
        <label class="form-label">New password</label>
        <input class="form-control" type="password" name="new_password" placeholder="Leave blank if you don't want to change">
      </div>

      <div class="mb-3">
        <label class="form-label">Confirm new password</label>
        <input class="form-control" type="password" name="confirm_password">
      </div>

      <p class="text-muted mt-3 mb-1">
        Account created on: <?= date('d-m-Y H:i', strtotime($user['created_at'])) ?><br>
        Password: ********
      </p>

      <button type="submit" name="save_changes" class="btn btn-secondary w-100 mt-3">Save changes</button>

      <?php if ($user['role'] === 'admin') : ?>
        <a href="admin.php" class="btn btn-outline-warning w-100 mt-2">Go to Admin Panel</a>
      <?php endif; ?>

      <a href="logout.php" class="btn btn-secondary w-100 mt-2">Logout</a>
    </form>

    <!-- Delete account form -->
    <form method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action is permanent.')">
      <button type="submit" name="delete_account" class="btn btn-delete w-100 mt-2">Delete Account</button>
    </form>
  </div>
</main>

<?php require 'footer.php'; ?>


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

      <!-- Delete button -->
    <form method="post" onsubmit="return confirm('Are you sure you want to permanently delete your account? This cannot be undone.');">
      <button type="submit" name="delete_account" class="btn btn-delete w-100 mt-2">Delete Account</button>
    </form>

  </main>

  <!-- <?php include 'footer.php'; ?> -->

</body>
</html>