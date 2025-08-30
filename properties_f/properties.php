<?php include 'auth_check.php';
require_once "includes/db.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Properties</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

  <div class="container mx-auto p-4">

    <!-- Filter Form -->
    <form method="GET" action="properties.php" class="flex flex-wrap gap-4 mb-6">
      <select name="category" class="border p-2 flex-1 min-w-[150px]">
        <option value="">All Categories</option>
        <option value="sell" <?= ($_GET['category'] ?? '') == 'sell' ? 'selected' : '' ?>>Sell</option>
        <option value="rent" <?= ($_GET['category'] ?? '') == 'rent' ? 'selected' : '' ?>>Rent</option>
        <option value="mortgage" <?= ($_GET['category'] ?? '') == 'mortgage' ? 'selected' : '' ?>>Mortgage</option>
      </select>
      <input type="text" name="location" value="<?= $_GET['location'] ?? '' ?>" placeholder="Location" class="border p-2 flex-1 min-w-[150px]">
      <input type="number" name="min_price" value="<?= $_GET['min_price'] ?? '' ?>" placeholder="Min Price" class="border p-2 flex-1 min-w-[150px]">
      <input type="number" name="max_price" value="<?= $_GET['max_price'] ?? '' ?>" placeholder="Max Price" class="border p-2 flex-1 min-w-[150px]">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- Properties Grid -->
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
      <?php
      include "includes/db.php";

      $category = $_GET['category'] ?? '';
      $location = $_GET['location'] ?? '';
      $minPrice = $_GET['min_price'] ?? 0;
      $maxPrice = $_GET['max_price'] ?? 999999999;
      $page     = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

      $limit = 6;
      $offset = ($page - 1) * $limit;


      // Base query
      $sql = "SELECT * FROM properties WHERE 1=1";
      if (!empty($category)) {
        $sql .= " AND category='$category'";
      }
      if (!empty($location)) {
        $sql .= " AND location LIKE '%$location%'";
      }
      $sql .= " AND price BETWEEN $minPrice AND $maxPrice";
      $sql .= " LIMIT $limit OFFSET $offset";

      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "
            <div class='border rounded-lg shadow bg-white overflow-hidden hover:shadow-lg transition'>
              <img src='{$row['image_url']}' alt='Property' class='w-full h-48 object-cover'>
              <div class='p-4'>
                <h2 class='text-lg font-bold'>{$row['title']}</h2>
                <p class='text-gray-600'>{$row['location']}</p>
                <p class='text-blue-600 font-bold'>₹ {$row['price']}</p>
                <a href='/new_homee/property_details/{$row['id']}'class='mt-2 inline-block text-sm text-white bg-green-500 px-3 py-1 rounded'>View Details</a>
              </div>
            </div>
          ";
        }
      } else {
        echo "<p class='col-span-3 text-center text-gray-500'>No properties found.</p>";
      }
      ?>
    </div>

    <!-- Pagination -->
    <div class="flex flex-wrap justify-center gap-2 mt-6">
      <?php
      // Count with filters
      $countSql = "SELECT COUNT(*) as total FROM properties WHERE 1=1";
      if (!empty($category)) {
        $countSql .= " AND category='$category'";
      }
      if (!empty($location)) {
        $countSql .= " AND location LIKE '%$location%'";
      }
      $countSql .= " AND price BETWEEN $minPrice AND $maxPrice";

      $countResult = $conn->query($countSql);
      $total = $countResult->fetch_assoc()['total'];
      $pages = ceil($total / $limit);

      for ($i = 1; $i <= $pages; $i++) {
        $active = ($i == $page) ? "bg-blue-600 text-white" : "bg-gray-200";
        echo "<a href='?page=$i&category=$category&location=$location&min_price=$minPrice&max_price=$maxPrice' class='px-3 py-1 rounded $active'>$i</a>";
      }
      ?>
    </div>

  </div>

</body>

</html>