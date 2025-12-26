<?php
include "config.php";

$year = date('Y');
$month = date('m');

$sql = "
    SELECT 
        COALESCE(SUM(s.total_price), 0) AS total_sales,
        COALESCE(SUM((p.sale_price - p.purchase_price) * s.quantity), 0) AS estimated_profit,
        COALESCE(SUM(s.quantity), 0) AS products_sold
    FROM sales s
    JOIN products p ON s.product_id = p.id
    WHERE YEAR(s.created_at) = $year
      AND MONTH(s.created_at) = $month
";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

echo json_encode([
    "total_sales" => (float)$data["total_sales"],
    "estimated_profit" => (float)$data["estimated_profit"],
    "products_sold" => (int)$data["products_sold"],
    "year" => $year,
    "month" => (int)$month
]);