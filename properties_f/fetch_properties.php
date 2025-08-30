<?php
include "db.php";

$category = $_GET['category'] ?? '';
$location = $_GET['location'] ?? '';
$minPrice = $_GET['min_price'] ?? 0;
$maxPrice = $_GET['max_price'] ?? 999999999;
$page     = $_GET['page'] ?? 1;

$limit = 6; 
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM properties WHERE 1=1";

// Apply filters
if (!empty($category)) {
    $sql .= " AND category='$category'";
}
if (!empty($location)) {
    $sql .= " AND location LIKE '%$location%'";
}
$sql .= " AND price BETWEEN $minPrice AND $maxPrice";

$sql .= " LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

$properties = [];
while($row = $result->fetch_assoc()){
    $properties[] = $row;
}

echo json_encode($properties);
?>
