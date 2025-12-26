<?php
require 'config.php';

// Ventes du jour
$sqlDay = "SELECT COALESCE(SUM(total_price), 0) AS total_day 
           FROM sales 
           WHERE DATE(sale_date) = CURDATE()";
$resDay = $conn->query($sqlDay);
$totalDay = $resDay ? (int)$resDay->fetch_assoc()['total_day'] : 0;

// Stock total
$sqlStock = "SELECT COALESCE(SUM(stock), 0) AS total_stock FROM products";
$resStock = $conn->query($sqlStock);
$totalStock = $resStock ? (int)$resStock->fetch_assoc()['total_stock'] : 0;

// Alertes stock bas (seuil = 5)
$sqlLow = "SELECT COUNT(*) AS low_count FROM products WHERE stock <= 5";
$resLow = $conn->query($sqlLow);
$lowCount = $resLow ? (int)$resLow->fetch_assoc()['low_count'] : 0;

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'salesToday' => $totalDay,
    'totalStock' => $totalStock,
    'lowStockAlerts' => $lowCount
]);
