<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>property.php</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .slider-wrapper {
      overflow: hidden;
      position: relative;
    }

    .slider-track {
      display: flex;
      width: max-content;
      animation: scroll 20s linear infinite;
    }

    @keyframes scroll {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-50%);
      }

      /* moves half, since slides are duplicated */
    }

    .slide-item {
      min-width: 300px;
      /* adjust width per card */
      margin-right: 1rem;
      flex-shrink: 0;
    }
  </style>
</head>

<body>
  <?php
  require_once "includes/db.php";


  // Fetch properties (limit for performance if needed)
  $query = "SELECT * FROM properties ORDER BY RAND() LIMIT 6";
  $result = mysqli_query($conn, $query);

  $properties = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $properties[] = $row;
  }

  // Duplicate array for seamless loop
  $allSlides = array_merge($properties, $properties);
  ?>

  <section class="py-12 mt-12 bg-gray-50">
    <div class="max-w-8xl mx-auto px-4">
      <h2 class="text-3xl font-bold text-center mb-8">Top Properties</h2>

      <div class="slider-wrapper">
        <div class="slider-track">
          <?php foreach ($allSlides as $row): ?>
            <div class="slide-item bg-white rounded shadow p-4">
              <img src="<?php echo $row['image_url']; ?>" alt="Property" class="w-full h-48 object-cover rounded">
              <h3 class="text-xl font-semibold mt-2"><?php echo $row['title']; ?></h3>
              <p class="text-gray-600">Location: <?php echo $row['location']; ?></p>
              <p class="text-gray-800 font-bold mt-1">$<?php echo number_format($row['price'], 2); ?></p>
              <p class="text-gray-500 mt-1"><?php echo $row['description']; ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>
</body>

</html>