<?php
require_once 'config.php';

// Create initial admin user
$username = 'admin';
$password = 'admin123'; // Change this to a secure password
$email = 'admin@example.com';

try {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
    $stmt->execute([$username, $hashedPassword, $email]);
    
    echo "Admin user created successfully!";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>