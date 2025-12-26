<?php
include "config.php";

$sql = "
    SELECT 
        COALESCE(SUM(stock * purchase_price), 0) AS total_purchase_value,
        COALESCE(SUM(stock * sale_price), 0) AS total_sale_value
    FROM products
";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

echo json_encode([
    "purchase_value" => (float)$data["total_purchase_value"],
    "sale_value" => (float)$data["total_sale_value"]
]);