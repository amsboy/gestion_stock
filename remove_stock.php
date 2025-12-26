<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = (int) $_POST["product_id"];
    $quantity = (int) $_POST["quantity"];

    if ($product_id <= 0 || $quantity <= 0) {
        echo "error";
        exit;
    }

    // Récupérer stock actuel
    $check = $conn->query("SELECT stock FROM products WHERE id = $product_id");
    $product = $check->fetch_assoc();

    if (!$product) {
        echo "error";
        exit;
    }

    if ($product["stock"] < $quantity) {
        echo "not_enough_stock";
        exit;
    }

    $new_stock = $product["stock"] - $quantity;

    // Mettre à jour le stock
    $conn->query("UPDATE products SET stock = $new_stock WHERE id = $product_id");

    // Enregistrer le mouvement
    $conn->query("INSERT INTO stock_movements (product_id, movement_type, quantity) 
                  VALUES ($product_id, 'out', $quantity)");

    echo "success";
}
?>