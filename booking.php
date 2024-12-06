<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user_id = 1; // Assume logged in user

    $query = $pdo->prepare("INSERT INTO bookings (user_id, room_id, date, time, status) VALUES (?, ?, ?, ?, 'Pending')");
    $query->execute([$user_id, $room_id, $date, $time]);
    echo "Room booked successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Book a Room</title>
</head>
<body>
    <div class="container">
        <h1>Book a Room</h1>
        <form method="POST">
            <div class="mb-3">
                <label>Room:</label>
                <select name="room_id" class="form-control">
                    <option value="1">Room 101</option>
                    <option value="2">Room 102</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Date:</label>
                <input type="date" name="date" class="form-control">
            </div>
            <div class="mb-3">
                <label>Time:</label>
                <input type="time" name="time" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Book Now</button>
        </form>
    </div>
</body>
</html>
