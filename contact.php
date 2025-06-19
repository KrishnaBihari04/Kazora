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


    <!-- Extra tekst onderaan -->
    <p class="mt-5" style="font-size: 0.95rem; color: var(--text-muted);">
      Our team typically replies within 24 hours (Mon–Fri). We look forward to connecting with you.
    </p>

  </div>
</section>

<?php require 'footer.php'; ?>
