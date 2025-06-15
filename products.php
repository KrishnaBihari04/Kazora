<?php
require 'db.php';

$category_id = isset($_GET['category']) ? intval($_GET['category']) : 1;

$sql = "SELECT products.*, category.name as category_name
        FROM products
        JOIN category ON products.category_id = category.id
        WHERE category.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();

$category_name = '';
if ($row = $result->fetch_assoc()) {
    $category_name = $row['category_name'];
    $result->data_seek(0);
}

$page_title = "Kazora – " . $category_name;
require 'header.php';
?>

<!-- Begin wrapper -->
<div class="d-flex flex-column min-vh-100 bg-black">

    <!-- Hero -->
    <section class="hero d-flex justify-content-center align-items-center text-center position-relative" style="height: 60vh; background: url('https://i.pinimg.com/originals/b9/4e/18/b94e18ea40626f10bc67eaba042ec415.gif') center center / cover no-repeat;">
        <div class="overlay position-absolute w-100 h-100" style="background: rgba(18, 18, 18, 0.7); top: 0; left: 0;"></div>
        <div class="position-relative z-1">
            <h1 class="display-4 fw-bold text-light"><?= htmlspecialchars($category_name) ?></h1>
        </div>
    </section>

    <!-- Producten -->
    <section class="py-5 container flex-grow-1">
        <div class="row g-4">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 bg-dark text-light border-0 shadow">
                        <img src="<?= htmlspecialchars($row['img']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['productname']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['productname']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                            <p class="fw-bold" style="color: var(--gold);">€<?= htmlspecialchars($row['price']) ?></p>
                            <a href="#" class="btn btn-outline-light w-100">Bekijk</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Footer -->
    <?php require 'footer.php'; ?>
</div>
