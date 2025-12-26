<?php
require 'config.php';

$sql = "
    SELECT SUM((p.sale_price - p.purchase_price) * s.quantity) AS profit
    FROM sales s
    JOIN products p ON p.id = s.product_id
";
$res = $conn->query($sql);
$profit = 0;
if ($res) {
    $row = $res->fetch_assoc();
    $profit = (int)($row['profit'] ?? 0);
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['profit' => $profit]);
