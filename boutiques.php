<?php
require 'header.php'; 
if (!isset($page_title)) {
    $page_title = "Kazora | Boutiques";
}
?>

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

<?php require 'footer.php'; ?>