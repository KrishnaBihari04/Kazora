<?php 
$page_title = "Kazora – Home";
require 'header.php'; 
?>

<!-- Hero sectie met achtergrondafbeelding en call-to-action knop -->
<div class="hero d-flex justify-content-center align-items-center text-center position-relative" style="height: 100vh; background: url('https://i.pinimg.com/originals/b9/4e/18/b94e18ea40626f10bc67eaba042ec415.gif') center center / cover no-repeat;">
    <div class="overlay position-absolute w-100 h-100" style="background: rgba(18, 18, 18, 0.7); top: 0; left: 0;"></div>
    <div class="hero-content position-relative z-1">
        <h1 class="display-5 fw-bold" style="color: var(--text-light);">Timeless elegance<br>meets contemporary luxury.</h1>
        <a href="#contact" class="btn btn-outline-light mt-4 px-4 py-2">Make appointment</a>
    </div>
</div>

<!-- Contactsectie met formulier -->
<section class="section" id="contact">
    <div class="container">
        <h2 class="text-center mb-4">Contact</h2>
        <form>
            <!-- Naamveld -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control input" id="name" placeholder="Your name">
            </div>
            <!-- E-mailveld -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control input" id="email" placeholder="Your email">
            </div>
            <!-- Berichtveld -->
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control input" id="message" rows="5" placeholder="Your message..."></textarea>
            </div>
            <!-- Verstuurknop -->
            <button type="submit" class="btn btn-outline-light">Send</button>
        </form>
    </div>
</section>

<?php require 'footer.php'; ?>
