<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}

// Haal huidige gebruiker op uit DB
$email = $_SESSION['user']['email'];
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Check of gebruiker admin is
if ($user['role'] !== 'admin') {
  header("Location: account.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Kazora | Adminpaneel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<main class="auth-main d-flex justify-content-center align-items-center">
  <div class="auth-box text-center" style="max-width: 500px;">
    <h2 class="mb-4">Welkom Admin, <span class="text-gold"><?= htmlspecialchars($user['name']) ?></span></h2>
    <p>Gebruik dit paneel om beheerders toe te voegen of te beheren.</p>
    <a href="admin-auth.php" class="btn btn-dark mt-3">➕ Admin toevoegen</a>
  </div>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
