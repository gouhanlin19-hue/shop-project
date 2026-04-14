<?php
session_start();
include(__DIR__ . "/config/db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":username" => $username,
        ":password" => $password
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        header("Location: products.php");
        exit();
    } else {
        $message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
<?php include("navbar.php"); ?>

<a href="javascript:history.length > 1 ? history.back() : 'products.php'" class="back-button">
    ← Back
</a>

<h1 class="page-title">Login</h1>

<?php if ($message): ?>
    <p class="message" style="color: #dc2626;">
        <?php echo htmlspecialchars($message); ?>
    </p>
<?php endif; ?>

<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

</body>
</html>