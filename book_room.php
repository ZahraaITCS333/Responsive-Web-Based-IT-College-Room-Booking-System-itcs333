<?php
session_start();

// Database connection using PDO
try {
    $pdo = new PDO('mysql:host=localhost;dbname=project333', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Handle room booking
if (isset($_POST['book_room'])) {
    $user_id = $_POST['user_id'];
    $room_id = $_POST['room_id'];
    $starts_at = $_POST['starts_at'];
    $ends_at = $_POST['ends_at'];

    // Conflict checking: Ensure no overlapping bookings for the same room
    $sql = "SELECT COUNT(*) FROM room_bookings WHERE room_id = :room_id 
            AND (starts_at < :ends_at AND ends_at > :starts_at)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'room_id' => $room_id,
        'starts_at' => $starts_at,
        'ends_at' => $ends_at,
    ]);
    $conflict = $stmt->fetchColumn();

    if ($conflict > 0) {
        // Set an error message in the session
        $_SESSION['message'] = "The selected room is already booked during this time.";
    } else {
        // Insert booking into the database
        $sql = "INSERT INTO room_bookings (room_id, user_id, starts_at, ends_at, booking_status) 
                VALUES (:room_id, :user_id, :starts_at, :ends_at, 'booked')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'room_id' => $room_id,
            'user_id' => $user_id,
            'starts_at' => $starts_at,
            'ends_at' => $ends_at,
        ]);

        // Redirect to userbookingsdash.php on success
        header("Location: userbookingsdash.php");
        exit;
    }
}

// Fetch available rooms
$rooms = $pdo->query("SELECT id, name, capacity FROM rooms")->fetchAll(PDO::FETCH_ASSOC);

// Fetch and clear session message (if exists)
$message = isset($_SESSION['message']) ? $_SESSION['message'] : null;
unset($_SESSION['message']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Booking System</title>
    <style>
        /* Include CSS here */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, Helvetica, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .form-container { background-color: white; padding: 40px 20px 30px 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px; text-align: center; }
        .form-container h2 { margin-bottom: 10px; font-size: 24px; color: #af8b58; }
        label { display: block; margin: 7px 0 5px; text-align: left; color: #333; }
        input, select { width: 100%; padding: 12px; margin: 3px 0; border: 1px solid #ccc; border-radius: 4px; background-color: #fafafa; font-size: 16px; }
        input:focus, select:focus { border-color: #af8b58; outline: none; background-color: #f1f1f1; }
        .registerbtn { width: 100%; padding: 12px; background-color: #af8b58; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .registerbtn:hover { background-color: #876b44; }
        .alert { text-align: center; color: #af8b58; font-weight: bold; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Book a Room</h2>
        <?php if (!empty($message)) echo "<div class='alert'>$message</div>"; ?>

        <!-- Booking Form -->
        <form method="post">
            <label for="user_id">User ID:</label>
            <input type="number" name="user_id" id="user_id" required>

            <label for="room_id">Select Room:</label>
            <select name="room_id" id="room_id" required>
                <option value="">-- Select a Room --</option>
                <?php foreach ($rooms as $room): ?>
                    <option value="<?= htmlspecialchars($room['id']) ?>">
                        <?= htmlspecialchars($room['name']) ?> (Capacity: <?= htmlspecialchars($room['capacity']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="starts_at">Start Time:</label>
            <input type="datetime-local" name="starts_at" id="starts_at" required>

            <label for="ends_at">End Time:</label>
            <input type="datetime-local" name="ends_at" id="ends_at" required>

            <button type="submit" name="book_room" class="registerbtn">Book Room</button>
        </form>
    </div>
</body>
</html>
