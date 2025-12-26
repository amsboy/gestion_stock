<?php
include "config.php";

$sql = "SELECT id, name, category, stock, alert_threshold FROM products ORDER BY name ASC";
$result = $conn->query($sql);

$products = [];

while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>