<?php
session_start();

// Database configuration
$dsn = "mysql:host=localhost;dbname=cs333-project";
$dbUsername = "root"; 
$dbPassword = ""; 

try {
    // Create a PDO connection
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve and sanitize form data
        $username = htmlspecialchars(trim($_POST['username']));
        $password = $_POST['password'];

        // Validate that fields are not empty
        if (empty($username) || empty($password)) {
            die("All fields are required.");
            header("Location: login.php");
            exit();
        }

        // Check if the user exists in the database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            echo "Login successful! Welcome, " . htmlspecialchars($user['username']) . ".";
            header("Location: protected_page.php"); // Redirect to protected page
            exit();
        } else {
            // Invalid credentials
            echo "Invalid username or password.";
            header("Location: login.php");
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    header("Location: login.php");
    exit();
}
?>