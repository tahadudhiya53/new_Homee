<?php // add-property.php 

include 'auth_check.php';
require_once 'includes/db.php';
$success = $error = ""; // Handle form submit 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $location = trim($_POST['location']);
    $category = $_POST['category'];
    $image_url = trim($_POST['image_url']);
    
    // For now just URL input, can upgrade to upload later 
    if ($title && $description && $price && $location && $category) {
        $td = $conn->prepare("INSERT INTO properties (title, description, price, location, category, image_url) VALUES (?, ?, ?, ?, ?, ?)");
        $td->bind_param("ssdsss", $title, $description, $price, $location, $category, $image_url);
        if ($td->execute()) {
            $success = "Property added successfully!";
        } else {
            $error = "Error: " . $td->error;
        }
        $td->close();
    } else {
        $error = "Please fill all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Property</title>
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

<body class="bg-gray-50">
    <section class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg p-8" data-aos="fade-up">
            <h1 class="text-2xl font-bold mb-6 text-center" data-aos="zoom-in">Add New Property</h1>

            <?php if ($success): ?>
                <p class="mb-4 p-3 bg-green-100 text-green-700 rounded" data-aos="fade-up"><?= $success ?></p>
            <?php endif; ?>
            <?php if ($error): ?>
                <p class="mb-4 p-3 bg-red-100 text-red-700 rounded" data-aos="fade-up"><?= $error ?></p>
            <?php endif; ?>

            <form method="POST" class="space-y-4" data-aos="fade-up">
                <div>
                    <label class="block mb-1 font-medium">Title *</label>
                    <input type="text" name="title" required class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Description *</label>
                    <textarea name="description" required class="w-full border rounded p-2"></textarea>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Price (₹) *</label>
                    <input type="number" step="0.01" name="price" required class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Location *</label>
                    <input type="text" name="location" required class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Category *</label>
                    <select name="category" required class="w-full border rounded p-2">
                        <option value="">Select</option>
                        <option value="sell">Sell</option>
                        <option value="rent">Rent</option>
                        <option value="mortgage">Mortgage</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Image URL</label>
                    <input type="url" name="image_url" placeholder="https://example.com/property.jpg" class="w-full border rounded p-2">
                </div>

                <div data-aos="zoom-in">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                        Add Property
                    </button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>