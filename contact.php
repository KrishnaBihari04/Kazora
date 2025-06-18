<?php 
$page_title = "Kazora – Contact";
require 'header.php'; 
?>

<section class="section text-center" style="padding-top: 100px;">
  <div class="container" style="max-width: 900px; margin: 0 auto;">

    <!-- Titel en intro -->
    <h1 class="mb-3" style="color: var(--gold); font-weight: 500;">Contact Us</h1>

    <p class="lead mb-4" style="font-size: 1.2rem;">
      Whether you're curious about our collections, need help with your order, or just want to connect — we’re here for you.
    </p>

    <hr style="border-top: 1px solid rgba(255, 255, 255, 0.2); margin: 40px 0;">

    <!-- Contact info blok -->
    <div class="mb-5">
      <p><strong>Email:</strong> <a href="mailto:info@kazorawatches.com" style="color: var(--gold-light);">info@kazorawatches.com</a></p>
      <p><strong>Phone:</strong> <span style="color: var(--gold-light);">+123 456 789</span></p>
      <p><strong>Location:</strong> Dubai Mall – Fashion Avenue</p>
    </div>

    <!-- Veelgestelde vragen blok -->
    <div class="mb-5">
      <h3 style="color: var(--gold-light); margin-bottom: 20px;">Before You Write Us</h3>
      <ul class="text-center" style="max-width: 700px; margin: 0 auto; list-style: none; padding-left: 0; font-size: 1rem; color: var(--text-muted);">
        <li class="mb-2">• Wondering about delivery times or return policies? <a href="#" style="color: var(--gold-light); text-decoration: underline;">Check our FAQ</a>.</li>
        <li class="mb-2">• Want to book a private boutique appointment? Mention it in your message.</li>
        <li class="mb-2">• Collaborations, press or wholesale inquiries? Select “Business” in your subject.</li>
      </ul>
    </div>

    <!-- Formulier -->
    <form action="#" method="post" style="max-width: 800px; margin: 0 auto;">
      <div class="row mb-3">
        <div class="col-md-6 mb-2">
          <input type="text" class="form-control bg-white text-dark border-0 shadow-sm" placeholder="Your Name" required>
        </div>
        <div class="col-md-6 mb-2">
          <input type="email" class="form-control bg-white text-dark border-0 shadow-sm" placeholder="Your Email" required>
        </div>
      </div>

      <div class="mb-3">
        <input type="text" class="form-control bg-white text-dark border-0 shadow-sm" placeholder="Subject (e.g. Order, Business, Appointment)" required>
      </div>

      <div class="mb-4">
        <textarea class="form-control bg-white text-dark border-0 shadow-sm" rows="5" placeholder="Your Message..." required></textarea>
      </div>

      <button type="submit" class="btn btn-outline-light px-4">Send Message</button>
    </form>

    <!-- Extra tekst onderaan -->
    <p class="mt-5" style="font-size: 0.95rem; color: var(--text-muted);">
      Our team typically replies within 24 hours (Mon–Fri). We look forward to connecting with you.
    </p>

  </div>
</section>

<?php require 'footer.php'; ?>
