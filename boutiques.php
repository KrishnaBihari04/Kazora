<?php 
// Pagina titel instellen
$page_title = "Kazora – Boutiques";
// Header inladen
require 'header.php'; 
?>

<!-- Boutique informatie sectie -->
<section class="section text-center mt-5" style="background-color: var(--dark-gray); padding: 60px 20px; border-radius: 10px;">
  <div class="container">
    <!-- Titel van de boutique -->
    <h1 class="mb-4" style="font-size: 2.5rem; color: var(--gold); letter-spacing: 1px;">Our Boutique</h1>
    <!-- Introductie tekst -->
    <p class="lead mb-4" style="font-size: 1.4rem; margin-bottom: 30px;">
      Visit our exclusive flagship store in <strong>Dubai Mall Fashion Avenue</strong>, where luxury and timeless elegance come together.
    </p>
    <!-- Scheidingslijn -->
    <hr style="border-top: 2px solid rgba(255,255,255,0.2); margin: 50px 0;">
    <!-- Beschrijvende tekst over Kazora -->
    <p style="font-size: 1.3rem; margin-bottom: 30px; line-height: 1.8;">
      At Kazora, we believe in the art of watchmaking. Our collection consists of carefully designed timepieces that embody the perfect blend of refinement, innovation, and timeless elegance. Each watch is crafted with meticulous attention to detail, using materials of the highest quality and craftsmanship.
    </p>
    <p style="font-size: 1.3rem; margin-bottom: 30px; line-height: 1.8;">
      As a leading name in the luxury watch industry, we offer a unique experience for discerning customers seeking exclusivity and style. Our collection reflects our passion for perfection and our commitment to delivering watches that not only tell time but also make a statement.
    </p>
    <p style="font-size: 1.3rem; margin-bottom: 30px; line-height: 1.8;">
      Located in the prestigious Dubai Mall Fashion Avenue, we invite you to view our extensive collection personally. Our experts are ready to assist you in finding the perfect watch that matches your style.
    </p>
    <!-- Opening hours -->
    <div class="timing mb-5" style="margin-top: 50px;">
      <p style="font-size: 1.4rem; margin-bottom: 10px;">Opening Hours:</p>
      <p style="font-size: 1.3rem; margin: 5px 0;">
        <span class="highlight">Sunday to Wednesday</span>: 10:00 AM - 10:00 PM
      </p>
      <p style="font-size: 1.3rem; margin: 5px 0;">
        <span class="highlight">Thursday to Saturday</span>: 10:00 AM - 12:00 AM
      </p>
    </div>
    <!-- Scheidingslijn -->
    <hr style="border-top: 2px solid rgba(255,255,255,0.2); margin: 50px 0;">
    <!-- Aansporende tekst -->
    <p style="font-size: 1.4rem; font-weight: bold; color: var(--gold); margin-bottom: 40px;">
      Discover the world of exclusive watches at Kazora – where timeless luxury and craftsmanship come together.
    </p>
    <!-- Google Maps kaart -->
    <div style="margin-top: 30px; border-radius: 10px; overflow: hidden;">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.6836820112953!2d55.27961917598634!3d25.19719783159868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f433ee2bbf3b7%3A0x1b281c64fba69f57!2sFashion%20Avenue%2C%20Dubai%20Mall!5e0!3m2!1sen!2snp!4v1718610000000!5m2!1sen!2snp"
        width="100%" height="450" style="border:0; border-radius: 10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</section>

<?php 
// Footer inladen
require 'footer.php'; 
?>