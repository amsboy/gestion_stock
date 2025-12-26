<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Récupération des données envoyées par le formulaire
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $unit_price = $_POST["unit_price"];
    $total_price = $_POST["total_price"];

    // 1️⃣ Vérifier que le produit existe et récupérer son stock actuel
    $check = $conn->query("SELECT stock FROM products WHERE id = $product_id");
    $product = $check->fetch_assoc();

    if (!$product) {
        echo "invalid_product";
        exit;
    }

    if ($product["stock"] < $quantity) {
        echo "not_enough_stock";
        exit;
    }

    // 2️⃣ Enregistrer la vente
    $sql_sale = "INSERT INTO sales (product_id, quantity, unit_price, total_price)
                 VALUES ($product_id, $quantity, $unit_price, $total_price)";

    if ($conn->query($sql_sale) !== TRUE) {
        echo "sale_error";
        exit;
    }

    // 3️⃣ Mettre à jour le stock
    $new_stock = $product["stock"] - $quantity;

    $sql_update_stock = "UPDATE products SET stock = $new_stock WHERE id = $product_id";
    $conn->query($sql_update_stock);

    // 4️⃣ Enregistrer le mouvement de stock (sortie)
    $sql_movement = "INSERT INTO stock_movements (product_id, movement_type, quantity)
                     VALUES ($product_id, 'out', $quantity)";
    $conn->query($sql_movement);

    echo "success";
}
?>