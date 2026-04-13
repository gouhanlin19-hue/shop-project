<?php
session_start();
include(__DIR__ . "/config/db.php");

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}

$limit = 3;
$offset = ($page - 1) * $limit;

// Total number of products
$totalSql = "SELECT COUNT(*) AS total FROM products";
$totalStmt = $conn->query($totalSql);
$totalProducts = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];

// Fetch products with seller name
$sql = "
    SELECT products.*, sellers.name AS seller_name
    FROM products
    LEFT JOIN sellers ON products.seller_id = sellers.id
    LIMIT $limit OFFSET $offset
";
$stmt = $conn->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <a href="statistics.php">Statistics</a>
        <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
            <a href="add_product.php">Add Product</a>
        <?php endif; ?>
    </div>

    <div class="nav-right">
        <?php if (isset($_SESSION["username"])): ?>
            <span class="nav-user">
                <?php echo htmlspecialchars($_SESSION["username"]); ?>
                (<?php echo htmlspecialchars($_SESSION["role"]); ?>)
            </span>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</div>

<a href="javascript:history.back()" class="back-button">← Back</a>

<h1 class="page-title">Our Products</h1>

<div class="container">
    <div class="products-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p class="price">$<?php echo htmlspecialchars($product['price']); ?></p>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>
                    <strong>Seller:</strong>
                    <?php echo htmlspecialchars($product['seller_name'] ?? 'Unknown'); ?>
                </p>

                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin"): ?>
                    <div class="card-actions">
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['id']; ?>"
                           onclick="return confirm('Are you sure?');">Delete</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>

        <?php if ($offset + $limit < $totalProducts): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>