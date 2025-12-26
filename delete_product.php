<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer l'ID du produit
    $product_id = (int) ($_POST["product_id"] ?? 0);

    if ($product_id <= 0) {
        echo "error: invalid_id";
        exit;
    }

    // Supprimer le produit
    $sql = "DELETE FROM products WHERE id = $product_id";

    if ($conn->query($sql)) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}
?>