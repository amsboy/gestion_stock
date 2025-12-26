<?php
include "config.php";

// Lundi de cette semaine
$weekStart = date('Y-m-d', strtotime('monday this week'));
// Dimanche de cette semaine
$weekEnd = date('Y-m-d', strtotime('sunday this week'));

$sql = "
    SELECT 
        COALESCE(SUM(s.total_price), 0) AS total_sales,
        COALESCE(SUM((p.sale_price - p.purchase_price) * s.quantity), 0) AS estimated_profit,
        COALESCE(SUM(s.quantity), 0) AS products_sold
    FROM sales s
    JOIN products p ON s.product_id = p.id
    WHERE DATE(s.created_at) BETWEEN '$weekStart' AND '$weekEnd'
";

$result = $conn->query($sql);
$data = $result->fetch_assoc();

echo json_encode([
    "total_sales" => (float)$data["total_sales"],
    "estimated_profit" => (float)$data["estimated_profit"],
    "products_sold" => (int)$data["products_sold"],
    "week_start" => $weekStart,
    "week_end" => $weekEnd
]);