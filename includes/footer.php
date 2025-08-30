<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <script src="https://cdn.tailwindcss.com"></script>
<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

</head>
<body>
    <!-- footer.php -->
<footer class="bg-gray-900 text-gray-300">
  <div class="max-w-7xl mx-auto px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      
      <!-- Logo / About -->
      <div>
        <h2 class="text-2xl font-bold text-white">Homee</h2>
        <p class="mt-3 text-sm">
          Building modern and user-friendly websites with clean design and great performance.
        </p>
      </div>

      <!-- Quick Links -->
      <div>
        <h3 class="text-lg font-semibold text-white">Quick Links</h3>
        <ul class="mt-3 space-y-2">
          <li><a href="index.php" class="hover:underline">Home</a></li>
          <li><a href="about.php" class="hover:underline">About</a></li>
          <li><a href="services.php" class="hover:underline">Services</a></li>
          <li><a href="contact.php" class="hover:underline">Contact</a></li>
        </ul>
      </div>

      <!-- Social Links -->
      <div>
        <h3 class="text-lg font-semibold text-white">Follow Us</h3>
        <div class="mt-3 flex space-x-4">
          <a href="#" class="hover:text-white">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="hover:text-white">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="hover:text-white">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="hover:text-white">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm">
      <p>&copy; <?php echo date("Y"); ?> YourCompany. All rights reserved.</p>
    </div>
  </div>
</footer>


</body>
</html>