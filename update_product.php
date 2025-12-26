<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $product_id = (int) ($_POST["product_id"] ?? 0);
    $name = $conn->real_escape_string($_POST["name"] ?? "");
    $category = $conn->real_escape_string($_POST["category"] ?? "");
    $purchase_price = (float) ($_POST["purchase_price"] ?? 0);
    $sale_price = (float) ($_POST["sale_price"] ?? 0);
    $stock = (int) ($_POST["stock"] ?? 0);

    if ($product_id <= 0 || $name === "") {
        echo "error: invalid_data";
        exit;
    }

    $sql = "UPDATE products 
            SET name='$name', category='$category', purchase_price=$purchase_price, 
                sale_price=$sale_price, stock=$stock 
            WHERE id=$product_id";

    if ($conn->query($sql)) {
        echo "success";
    } else {
        echo "error: " . $conn->error;
    }
}
?>
