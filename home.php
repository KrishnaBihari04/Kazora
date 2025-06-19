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

<section class="section" id="contact">
  <div class="container" style="max-width: 1000px;">
    <h2 class="text-center mb-5" style="color: var(--gold-light); font-family: 'Georgia', serif; font-weight: bold; font-size: 2.2rem;">
      Let’s Talk
    </h2>

    <form action="#" method="post" class="p-5 rounded shadow"
      style="background-color: var(--light-gray); border: 1px solid var(--charcoal); box-shadow: 0 0 40px rgba(184,164,126,0.05);">

      <div class="row mb-4">
        <div class="col-md-6 mb-3">
          <label for="name" class="form-label text-light">Name</label>
          <input type="text" class="form-control border-0 shadow-sm"
            style="background-color: white; color: black;" id="name" placeholder="Your full name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="email" class="form-label text-light">Email</label>
          <input type="email" class="form-control border-0 shadow-sm"
            style="background-color: white; color: black;" id="email" placeholder="Your email address" required>
        </div>
      </div>

      <div class="mb-4">
        <label for="subject" class="form-label text-light">Subject</label>
        <input type="text" class="form-control border-0 shadow-sm"
          style="background-color: white; color: black;" id="subject" placeholder="e.g. Order, Business, Appointment" required>
      </div>

      <div class="mb-4">
        <label for="message" class="form-label text-light">Message</label>
        <textarea class="form-control border-0 shadow-sm" rows="6"
          style="background-color: white; color: black;" id="message" placeholder="Your message..." required></textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn px-5 py-2"
          style="border: 2px solid var(--gold-light); color: var(--gold-light); background-color: transparent; font-weight: 600; font-family: 'Georgia', serif; letter-spacing: 1px; transition: all 0.3s ease;">
          Send Message
        </button>
      </div>
    </form>
  </div>
</section>


<?php require 'footer.php'; ?>
