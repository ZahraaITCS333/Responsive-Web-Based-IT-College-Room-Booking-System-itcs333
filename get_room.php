<?php
require_once 'config.php';
requireAdminLogin();

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM rooms WHERE room_id = ?");
    $stmt->execute([$_GET['id']]);
    $room = $stmt->fetch(PDO::FETCH_ASSOC);
    
    header('Content-Type: application/json');
    echo json_encode($room);
}