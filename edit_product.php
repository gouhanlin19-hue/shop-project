<?php
session_start();
include(__DIR__ . "/config/db.php");

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    die("Access denied. Admin only.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $seller_id = $_POST["seller_id"];

    $sql = "INSERT INTO products (name, price, description, image, seller_id)
            VALUES (:name, :price, :description, :image, :seller_id)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":name" => $name,
        ":price" => $price,
        ":description" => $description,
        ":image" => $image,
        ":seller_id" => $seller_id
    ]);

    $message = "Product added successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="statistics.php">Statistics</a>
        <a href="add_product.php">Add Product</a>
    </div>

    <a href="javascript:history.length > 1 ? history.back() : 'products.php'" class="back-button">
        ← Back
    </a>
    <div class="nav-right">
        <span class="nav-user">
            <?php echo htmlspecialchars($_SESSION["username"]); ?>
            (<?php echo htmlspecialchars($_SESSION["role"]); ?>)
        </span>
        <a href="logout.php">Logout</a>
    </div>
</div>

<h1 class="page-title">Add New Product</h1>

<?php if ($message): ?>
    <p class="message"><?php echo htmlspecialchars($message); ?></p>
<?php endif; ?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="Product name" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="text" name="image" placeholder="Image filename">
    <input type="number" name="seller_id" placeholder="Seller ID" required>
    <button type="submit">Add Product</button>
</form>

</body>
</html>