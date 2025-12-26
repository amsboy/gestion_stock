<?php
// add_purchase.php
// Enregistre un réapprovisionnement et met à jour le stock

header('Content-Type: application/json; charset=utf-8');

require 'config.php'; // doit définir $conn (mysqli)

// Récupération et validation des données POST
$product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
$purchase_price = isset($_POST['purchase_price']) ? (float)$_POST['purchase_price'] : 0.0;

if ($product_id <= 0 || $quantity <= 0 || $purchase_price <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Données invalides.']);
    exit;
}

$total_cost = $quantity * $purchase_price;

$conn->begin_transaction();

try {
    // Vérifier que le produit existe
    $checkSql = "SELECT id FROM products WHERE id = ? FOR UPDATE";
    $checkStmt = $conn->prepare($checkSql);
    if (!$checkStmt) throw new Exception('Erreur préparation vérification produit.');
    $checkStmt->bind_param('i', $product_id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows === 0) {
        $conn->rollback();
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Produit introuvable.']);
        exit;
    }
    $checkStmt->close();

    // 1) Insérer dans purchases
    $insertSql = "INSERT INTO purchases (product_id, quantity, purchase_price, total_cost) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertSql);
    if (!$insertStmt) throw new Exception('Erreur préparation insertion purchase.');
    // total_cost stocké en centimes ou unité selon ta DB ; ici on envoie float
    $insertStmt->bind_param('iidd', $product_id, $quantity, $purchase_price, $total_cost);
    if (!$insertStmt->execute()) throw new Exception('Erreur exécution insertion purchase.');
    $insertStmt->close();

    // 2) Mettre à jour le stock
    $updateSql = "UPDATE products SET stock = stock + ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    if (!$updateStmt) throw new Exception('Erreur préparation update stock.');
    $updateStmt->bind_param('ii', $quantity, $product_id);
    if (!$updateStmt->execute()) throw new Exception('Erreur exécution update stock.');
    $updateStmt->close();

    $conn->commit();

    echo json_encode(['status' => 'success', 'message' => 'Réapprovisionnement enregistré.']);
    exit;
} catch (Exception $e) {
    $conn->rollback();
    http_response_code(500);
    // Ne pas exposer les détails en production ; utile en dev
    echo json_encode(['status' => 'error', 'message' => 'Erreur serveur lors du réapprovisionnement.']);
    exit;
}
?>