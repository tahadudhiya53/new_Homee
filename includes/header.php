<?php
// session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <!-- navbar.php -->
    <nav class="flex justify-between items-center px-4 py-3 shadow-md bg-gray-900 ">
        <!-- Left: Logo -->
        <div class="flex items-center">
            <a href="/new_homee/home" class="text-xl font-bold text-blue-600">
                Homee
            </a>
        </div>

        <!-- Center: Navigation Links (Desktop) -->
        <ul class="hidden md:flex space-x-6">
            <nav class="space-x-4">
                <a href="/new_homee/home" class="text-white">Home</a>
                <a href="/new_homee/properties" class="text-white">Properties</a>
                <a href="/new_homee/list_property" class="text-white">List Properties</a>
                <a href="/new_homee/contact" class="text-white">Contact</a>
            </nav>

        </ul>

        <!-- Right: Login/Profile + Mobile Toggle -->
        <div class="flex items-center space-x-4">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Show username + Logout -->
                <span class="text-white font-medium">
                    Welcome, <?= htmlspecialchars($_SESSION['name']) ?>
                </span>
                <a href="index.php?page=logout"
                    class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                    Logout
                </a>
            <?php else: ?>
                <!-- If not logged in -->
                <a href="index.php?page=login"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Login
                </a>
                <a href="index.php?page=register"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    Register
                </a>
            <?php endif; ?>
        </div>
        <!-- Mobile Hamburger -->
        <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none text-2xl">
            ☰
        </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden flex flex-row px-4 py-2 bg-white shadow-md">
        <ul class="space-y-2">
            <a href="/new_homee/home" class="text-gray-700">Home</a>
            <a href="/new_homee/properties" class="text-gray-700">Properties</a>
             <a href="/new_homee/list_property" class="text-gray-700">List Properties</a>
            <a href="/new_homee/contact" class="text-gray-700">Contact</a>
        </ul>
    </div>

    <!-- JS for mobile toggle -->
    <script>
        const toggleBtn = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        toggleBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>

</html>