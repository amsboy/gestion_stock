<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? '';
    $category = $_POST["category"] ?? '';
    $purchase_price = $_POST["purchase_price"] ?? 0;
    $sale_price = $_POST["sale_price"] ?? 0;
    $stock = $_POST["stock"] ?? 0;

    if ($name !== '') {
        $sql = "INSERT INTO products (name, category, purchase_price, sale_price, stock)
                VALUES ('$name', '$category', '$purchase_price', '$sale_price', '$stock')";

        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "missing name";
    }
} else {
    echo "no post data";
}
?>