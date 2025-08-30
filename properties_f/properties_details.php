<?php
include "../includes/db.php";
$id = $_GET['id'] ?? 0;
$result = $conn->query("SELECT * FROM properties WHERE id=$id");
$property = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties_details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto p-6">
        <img src="<?php echo $property['image_url']; ?>" class="w-full h-[500px] object-cover rounded">
        <h1 class="text-2xl font-bold mt-4"><?php echo $property['title']; ?></h1>
        <p class="text-gray-600"><?php echo $property['location']; ?></p>
        <p class="text-blue-600 text-xl font-bold">₹ <?php echo $property['price']; ?></p>
        <p class="mt-4"><?php echo $property['description']; ?></p>
    </div>
</body>

</html>