<?php
include "config.php";

$today = date("Y-m-d");

$sql = "SELECT s.*, p.name 
        FROM sales s 
        JOIN products p ON s.product_id = p.id
        WHERE DATE(s.created_at) = '$today'
        ORDER BY s.created_at DESC";

$result = $conn->query($sql);

$sales = [];

while ($row = $result->fetch_assoc()) {
    $sales[] = $row;
}

echo json_encode($sales);
?>