<?php
session_start();

if (!isset($page_title)) {
    $page_title = "Kazora | Boutiques";
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>

    <!-- CSS links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="shortcut icon" href="assets/kazora.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/main.js"></script>
</head>
<body class="bg-black text-light" style="font-family: 'Georgia', serif;">

<?php include 'header.php'; ?>

<!-- Boutique info -->
<section class="section text-center mt-5">
  <div class="container">
    <h1 class="mb-4">Onze Boutique</h1>
    <p class="lead">Bezoek onze exclusieve flagship store in de <strong>Dubai Mall Fashion Avenue</strong>, waar luxe en tijdloze elegantie samenkomen.</p>
    <div class="mt-4">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.6836820112953!2d55.27961917598634!3d25.19719783159868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f433ee2bbf3b7%3A0x1b281c64fba69f57!2sFashion%20Avenue%2C%20Dubai%20Mall!5e0!3m2!1snl!2snl!4v1718610000000!5m2!1snl!2snl"
        width="100%" height="450" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
