<?php
require 'db.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

// Add new admin
$admin_success = $admin_error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_admin'])) {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];

  if ($password !== $confirm) {
    $admin_error = "Passwords do not match.";
  } else {
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $admin_error = "A user with this email already exists.";
    } else {
      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
      $stmt->bind_param("sss", $name, $email, $hashed);
      $stmt->execute();
      $admin_success = "New admin successfully created.";
    }
  }
}

// Delete actions
if (isset($_GET['delete_user'])) $conn->query("DELETE FROM users WHERE id=" . (int)$_GET['delete_user']);
if (isset($_GET['delete_product'])) $conn->query("DELETE FROM products WHERE id=" . (int)$_GET['delete_product']);

// Update data
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

// Fetch data
$admins = $conn->query("SELECT * FROM users WHERE role = 'admin' ORDER BY id ASC");
$users = $conn->query("SELECT * FROM users WHERE role != 'admin' ORDER BY id ASC");
$products = $conn->query("SELECT p.*, c.name AS category FROM products p JOIN category c ON p.category_id = c.id ORDER BY p.id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Panel | Kazora</title>
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<!-- Include header.php if needed -->
<!-- <?php include 'header.php'; ?> -->

<main class="container mt-5 pt-5">
  <h1 class="text-center mb-5">Admin Dashboard</h1>

  <!-- Section: Add new admin -->
  <h2>➕ Add New Admin</h2>
  <?php if ($admin_success): ?><div class="alert alert-success"><?= $admin_success ?></div><?php endif; ?>
  <?php if ($admin_error): ?><div class="alert alert-danger"><?= $admin_error ?></div><?php endif; ?>
  <form method="POST" class="row g-2 mb-5">
    <input type="hidden" name="add_admin" value="1" />
    <div class="col-md-3"><input type="text" name="name" placeholder="Name" class="form-control" required /></div>
    <div class="col-md-3"><input type="email" name="email" placeholder="Email" class="form-control" required /></div>
    <div class="col-md-2"><input type="password" name="password" placeholder="Password" class="form-control" required /></div>
    <div class="col-md-2"><input type="password" name="confirm" placeholder="Confirm" class="form-control" required /></div>
    <div class="col-md-2"><button class="btn btn-dark w-100">Add</button></div>
  </form>

  <!-- Section: All admins -->
  <h2 class="mt-5">👑 All Admins</h2>
  <table class="table table-dark table-bordered">
    <thead class="table-light text-dark">
      <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php while ($a = $admins->fetch_assoc()): ?>
        <tr>
          <form method="POST">
            <input type="hidden" name="update_user_id" value="<?= $a['id'] ?>" />
            <td><?= $a['id'] ?></td>
            <td><input name="name" value="<?= htmlspecialchars($a['name']) ?>" class="form-control" /></td>
            <td><input name="email" value="<?= htmlspecialchars($a['email']) ?>" class="form-control" /></td>
            <td><input name="role" value="<?= $a['role'] ?>" class="form-control" /></td>
            <td><?= !empty($a['created_at']) ? date('d-m-Y H:i', strtotime($a['created_at'])) : 'Unknown' ?></td>
            <td>
              <button class="btn btn-sm btn-warning">Save</button>
              <a href="?delete_user=<?= $a['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">X</a>
            </td>
          </form>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Section: All users -->
  <h2 class="mt-5">👤 All Users</h2>
  <table class="table table-dark table-bordered">
    <thead class="table-light text-dark">
      <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php while ($u = $users->fetch_assoc()): ?>
        <tr>
          <form method="POST">
            <input type="hidden" name="update_user_id" value="<?= $u['id'] ?>" />
            <td><?= $u['id'] ?></td>
            <td><input name="name" value="<?= htmlspecialchars($u['name']) ?>" class="form-control" /></td>
            <td><input name="email" value="<?= htmlspecialchars($u['email']) ?>" class="form-control" /></td>
            <td><input name="role" value="<?= $u['role'] ?>" class="form-control" /></td>
            <td><?= date('d-m-Y H:i', strtotime($u['created_at'])) ?></td>
            <td>
              <button class="btn btn-sm btn-warning">Save</button>
              <a href="?delete_user=<?= $u['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">X</a>
            </td>
          </form>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Section: All products -->
  <h2 class="mt-5">⌚ All Products</h2>
  <table class="table table-dark table-bordered">
    <thead class="table-light text-dark">
      <tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Category</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php while ($p = $products->fetch_assoc()): ?>
        <tr>
          <form method="POST">
            <input type="hidden" name="update_product_id" value="<?= $p['id'] ?>" />
            <td><?= $p['id'] ?></td>
            <td><input name="productname" value="<?= htmlspecialchars($p['productname']) ?>" class="form-control" /></td>
            <td><input name="price" value="<?= $p['price'] ?>" class="form-control" /></td>
            <td><input name="description" value="<?= htmlspecialchars($p['description']) ?>" class="form-control" /></td>
            <td><input name="img" value="<?= htmlspecialchars($p['img']) ?>" class="form-control" /></td>
            <td><input name="category_id" value="<?= $p['category_id'] ?>" class="form-control" /></td>
            <td>
              <button class="btn btn-sm btn-warning">Save</button>
              <a href="?delete_product=<?= $p['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">X</a>
            </td>
          </form>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>

<!-- Include footer -->
<?php include 'footer.php'; ?>
</body>
</html>