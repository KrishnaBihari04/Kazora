<?php
require 'db.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("⛔ Ongeldig product.");
}

$product_id = intval($_GET['id']);

// Product ophalen
$stmt = $conn->prepare("SELECT p.*, c.name AS category_name FROM products p JOIN category c ON p.category_id = c.id WHERE p.id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) {
  die("⛔ Product niet gevonden.");
}

// Review toevoegen
$review_error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
  $name = $_SESSION['user']['name'];
  $rating = intval($_POST['rating']);
  $review = trim($_POST['review']);

  if ($rating < 1 || $rating > 5 || empty($review)) {
    $review_error = "Geef een geldige beoordeling en een review.";
  } else {
    $stmt = $conn->prepare("INSERT INTO reviews (name, rating, review, product_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sisi", $name, $rating, $review, $product_id);
    $stmt->execute();
  }
}

// Alle reviews voor dit product ophalen
$stmt = $conn->prepare("SELECT * FROM reviews WHERE product_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$reviews = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['productname']) ?> | Kazora</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include 'header.php'; ?>

<main class="container mt-5 pt-5 text-center text-white">
  <h2 class="mb-4"><?= htmlspecialchars($product['productname']) ?></h2>

  <img src="<?= htmlspecialchars($product['img']) ?>" alt="<?= htmlspecialchars($product['productname']) ?>" style="max-height: 300px" class="mb-4 img-fluid">

  <h4 class="text-gold">€<?= htmlspecialchars($product['price']) ?></h4>
  <p class="lead"><?= htmlspecialchars($product['description']) ?></p>
  <p class="text-muted">Categorie: <?= htmlspecialchars($product['category_name']) ?></p>
  <a href="#" class="btn btn-outline-light px-4 py-2 mt-3">Reserveer dit horloge</a>

  <hr class="my-5">

  <?php if (isset($_SESSION['user'])): ?>
    <h4 class="mb-3">Laat een review achter</h4>
    <?php if ($review_error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($review_error) ?></div>
    <?php endif; ?>
    <form method="POST" class="mb-5 d-grid gap-3" style="max-width: 500px; margin: 0 auto;">
      <select name="rating" class="form-select" required>
        <option value="">Beoordeling (1–5)</option>
        <option value="5">5 - Uitstekend</option>
        <option value="4">4 - Goed</option>
        <option value="3">3 - Gemiddeld</option>
        <option value="2">2 - Matig</option>
        <option value="1">1 - Slecht</option>
      </select>
      <textarea name="review" class="form-control" placeholder="Jouw review..." required></textarea>
      <button type="submit" class="btn btn-dark">Verstuur review</button>
    </form>
  <?php else: ?>
    <p class="text-muted">Log in om een review achter te laten.</p>
  <?php endif; ?>

  <h4 class="mb-3">💬 Recensies</h4>
  <?php if ($reviews->num_rows > 0): ?>
    <?php while ($r = $reviews->fetch_assoc()): ?>
      <div class="bg-dark p-3 rounded mb-3 text-start" style="max-width: 600px; margin: 0 auto;">
        <strong><?= htmlspecialchars($r['name']) ?></strong> 
        <span class="text-gold">
          <?= str_repeat("⭐", intval($r['rating'])) ?>
          <span class="text-white">(<?= $r['rating'] ?>/5)</span>
        </span>
        <p class="mb-0"><?= htmlspecialchars($r['review']) ?></p>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-muted">Nog geen reviews.</p>
  <?php endif; ?>

</main>

<?php include 'footer.php'; ?>

</body>
</html>
