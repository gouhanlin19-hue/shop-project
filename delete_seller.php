<?php
session_start();
include(__DIR__ . "/config/db.php");

// Only admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    die("Access denied. Admin only.");
}

if (!isset($_GET['id'])) {
    die("Seller ID is missing.");
}

$id = (int)$_GET['id'];

// Check if seller has products linked to it
$check = $conn->prepare("SELECT COUNT(*) FROM products WHERE seller_id = :id");
$check->execute([":id" => $id]);
$productCount = $check->fetchColumn();

if ($productCount > 0) {
    die("❌ Cannot delete seller — they still have products linked to them. Delete the products first.");
}

$sql = "DELETE FROM sellers WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([":id" => $id]);

header("Location: sellers.php");
exit();
?>