<?php
require 'config.php';

$sql = "
    SELECT s.id, p.name AS product_name, s.quantity, s.total_price, s.sale_date
    FROM sales s
    JOIN products p ON p.id = s.product_id
    ORDER BY s.sale_date DESC
    LIMIT 10
";

$res = $conn->query($sql);

$data = [];
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $data[] = [
            'id' => (int)$row['id'],
            'product_name' => $row['product_name'],
            'quantity' => (int)$row['quantity'],
            'total' => (float)$row['total_price'],
            'date' => date('d/m/Y H:i', strtotime($row['sale_date']))
        ];
    }
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>
