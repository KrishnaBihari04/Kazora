<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

// Admin toevoegen
$admin_success = $admin_error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_admin'])) {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];

  if ($password !== $confirm) {
    $admin_error = "Wachtwoorden komen niet overeen.";
  } else {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $admin_error = "Gebruiker met dit e-mailadres bestaat al.";
    } else {
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
      $stmt->bind_param("sss", $name, $email, $hashed);
      $stmt->execute();
      $admin_success = "Nieuwe admin aangemaakt.";
    }
  }
}

// Verwijderen
if (isset($_GET['delete_user'])) $conn->query("DELETE FROM users WHERE id=" . (int)$_GET['delete_user']);
if (isset($_GET['delete_product'])) $conn->query("DELETE FROM products WHERE id=" . (int)$_GET['delete_product']);

// Updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['update_user_id'])) {
    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, role=? WHERE id=?");
    $stmt->bind_param("sssi", $_POST['name'], $_POST['email'], $_POST['role'], $_POST['update_user_id']);
    $stmt->execute();
  }
  if (isset($_POST['update_product_id'])) {
    $stmt = $conn->prepare("UPDATE products SET productname=?, price=?, description=?, img=?, category_id=? WHERE id=?");
    $stmt->bind_param("ssssii", $_POST['productname'], $_POST['price'], $_POST['description'], $_POST['img'], $_POST['category_id'], $_POST['update_product_id']);
    $stmt->execute();
  }
}

// Ophalen
$admins = $conn->query("SELECT * FROM users WHERE role = 'admin' ORDER BY id ASC");
$users = $conn->query("SELECT * FROM users WHERE role != 'admin' ORDER BY id ASC");
$products = $conn->query("SELECT p.*, c.name AS category FROM products p JOIN category c ON p.category_id = c.id ORDER BY p.id ASC");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Admin | Kazora</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>
<main class="container mt-5 pt-5">
  <h1 class="text-center mb-5">Admin Paneel</h1>

  <h2>➕ Nieuwe Admin toevoegen</h2>
  <?php if ($admin_success): ?><div class="alert alert-success"><?= $admin_success ?></div><?php endif; ?>
  <?php if ($admin_error): ?><div class="alert alert-danger"><?= $admin_error ?></div><?php endif; ?>
  <form method="POST" class="row g-2 mb-5">
    <input type="hidden" name="add_admin" value="1">
    <div class="col-md-3"><input type="text" name="name" placeholder="Naam" class="form-control" required></div>
    <div class="col-md-3"><input type="email" name="email" placeholder="E-mail" class="form-control" required></div>
    <div class="col-md-2"><input type="password" name="password" placeholder="Wachtwoord" class="form-control" required></div>
    <div class="col-md-2"><input type="password" name="confirm" placeholder="Bevestig" class="form-control" required></div>
    <div class="col-md-2"><button class="btn btn-dark w-100">Toevoegen</button></div>
  </form>

  <h2>👑 Alle Admins</h2>
  <table class="table table-dark table-bordered">
    <thead class="table-light text-dark">
      <tr><th>ID</th><th>Naam</th><th>Email</th><th>Rol</th><th>Acties</th></tr>
    </thead>
    <tbody>
      <?php while ($a = $admins->fetch_assoc()): ?>
        <tr>
          <form method="POST">
            <input type="hidden" name="update_user_id" value="<?= $a['id'] ?>">
            <td><?= $a['id'] ?></td>
            <td><input name="name" value="<?= htmlspecialchars($a['name']) ?>" class="form-control"></td>
            <td><input name="email" value="<?= htmlspecialchars($a['email']) ?>" class="form-control"></td>
            <td><input name="role" value="<?= $a['role'] ?>" class="form-control"></td>
            <td>
              <button class="btn btn-sm btn-warning">Opslaan</button>
              <a href="?delete_user=<?= $a['id'] ?>" onclick="return confirm('Verwijderen?')" class="btn btn-sm btn-danger">X</a>
            </td>
          </form>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <h2 class="mt-5">👤 Alle Gebruikers</h2>
  <table class="table table-dark table-bordered">
    <thead class="table-light text-dark">
      <tr><th>ID</th><th>Naam</th><th>Email</th><th>Rol</th><th>Aangemaakt</th><th>Acties</th></tr>
    </thead>
    <tbody>
      <?php while ($u = $users->fetch_assoc()): ?>
        <tr>
          <form method="POST">
            <input type="hidden" name="update_user_id" value="<?= $u['id'] ?>">
            <td><?= $u['id'] ?></td>
            <td><input name="name" value="<?= htmlspecialchars($u['name']) ?>" class="form-control"></td>
            <td><input name="email" value="<?= htmlspecialchars($u['email']) ?>" class="form-control"></td>
            <td><input name="role" value="<?= $u['role'] ?>" class="form-control"></td>
            <td><?= date('d-m-Y H:i', strtotime($u['created_at'])) ?></td>
            <td>
              <button class="btn btn-sm btn-warning">Opslaan</button>
              <a href="?delete_user=<?= $u['id'] ?>" onclick="return confirm('Verwijderen?')" class="btn btn-sm btn-danger">X</a>
            </td>
          </form>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <h2 class="mt-5">⌚ Alle Producten</h2>
  <table class="table table-dark table-bordered">
    <thead class="table-light text-dark">
      <tr><th>ID</th><th>Naam</th><th>Prijs</th><th>Beschrijving</th><th>Afbeelding</th><th>Categorie</th><th>Acties</th></tr>
    </thead>
    <tbody>
      <?php while ($p = $products->fetch_assoc()): ?>
        <tr>
          <form method="POST">
            <input type="hidden" name="update_product_id" value="<?= $p['id'] ?>">
            <td><?= $p['id'] ?></td>
            <td><input name="productname" value="<?= htmlspecialchars($p['productname']) ?>" class="form-control"></td>
            <td><input name="price" value="<?= $p['price'] ?>" class="form-control"></td>
            <td><input name="description" value="<?= htmlspecialchars($p['description']) ?>" class="form-control"></td>
            <td><input name="img" value="<?= htmlspecialchars($p['img']) ?>" class="form-control"></td>
            <td><input name="category_id" value="<?= $p['category_id'] ?>" class="form-control"></td>
            <td>
              <button class="btn btn-sm btn-warning">Opslaan</button>
              <a href="?delete_product=<?= $p['id'] ?>" onclick="return confirm('Verwijderen?')" class="btn btn-sm btn-danger">X</a>
            </td>
          </form>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
