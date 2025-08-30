  <?php
  // contact.php

  $success = "";
  $error = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    if ($name == "" || $email == "" || $subject == "" || $message == "") {
      $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = "Please enter a valid email address!";
    } else {
      // Example: send mail (you can configure your own mail server)
      $to = "yourmail@example.com"; // Change to your email
      $headers = "From: $email";
      if (mail($to, $subject, $message, $headers)) {
        $success = "Your message has been sent successfully!";
      } else {
        $error = "Failed to send message. Please try again later.";
      }
    }
  }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact.php</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        AOS.init({
          duration: 800, // animation duration
          once: true, // animate only once
        });
      });
    </script>
  </head>

  <body>
    <section class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-10">
      <div data-aos="zoom-in" class="w-full max-w-lg bg-white shadow-lg rounded-2xl p-8">
        <h2 data-aos="fade-down" class="text-2xl font-bold text-center text-gray-800 mb-6">Contact Us</h2>

        <?php if ($success): ?>
          <p data-aos="fade-right" class="mb-4 text-green-600 font-medium bg-green-100 p-2 rounded"><?= $success ?></p>
        <?php elseif ($error): ?>
          <p data-aos="fade-right" class="mb-4 text-red-600 font-medium bg-red-100 p-2 rounded"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-4">
          <div data-aos="fade-up">
            <label class="block text-gray-700 font-medium mb-1">Name</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300 transition duration-300" required>
          </div>

          <div data-aos="fade-up" data-aos-delay="100">
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300 transition duration-300" required>
          </div>

          <div data-aos="fade-up" data-aos-delay="200">
            <label class="block text-gray-700 font-medium mb-1">Subject</label>
            <input type="text" name="subject" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300 transition duration-300" required>
          </div>

          <div data-aos="fade-up" data-aos-delay="300">
            <label class="block text-gray-700 font-medium mb-1">Message</label>
            <textarea name="message" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300 transition duration-300" required></textarea>
          </div>

          <button data-aos="zoom-in-up" data-aos-delay="400" type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
            Send Message
          </button>
        </form>
      </div>
    </section>

  </body>

  </html>