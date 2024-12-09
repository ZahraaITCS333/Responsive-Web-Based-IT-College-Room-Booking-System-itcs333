<html>
<head> <!--style & google icons stylsheet links-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="userdashcss.css">
    <style>
        .btn {
            background-color: #af8b58; /* Primary button color */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn:hover {
            background-color: #876b44; /* Darker shade on hover */
        }

        .btn:focus {
            outline: none;
            box-shadow: 0 0 5px #af8b58;
        }

        .alert {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
            border-radius: 4px;
            font-size: 14px;
        }

        .card {
            background-color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .card {
    background-color: #fff;
    margin: 10px 0;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center; /* Center-align text */
    display: flex;
    flex-direction: column; /* Stack elements vertically */
    justify-content: center; /* Center content vertically */
    align-items: center; /* Center content horizontally */
}

.card strong {
    color: #333;
    font-size: 18px; /* Make room name slightly larger */
}

.card button {
    margin-top: 10px; /* Add space between text and button */
}

    </style>
    <title>Your Bookings</title>
</head>
<body>

<div>
    <nav class="header"> <!--header (navbar)-->
        <a href="homepageprj.php"><span class="material-icons-outlined">home</span></a>
        <div class="header-left">
            <span class="material-icons-outlined">menu_book</span>
            <a href="prjtesting.php"><span class="material-icons-outlined">bar_chart</span></a>
            <span class="material-icons-outlined">account_circle</span>
        </div>
        <div class="header-right">
            <span class="material-icons-outlined">logout</span>
        </div>
    </nav>

    <span style="padding-top: 20px; display: inline-block; text-align: center; width: 100%; font-weight=bold;"> 
        <h1>    
            <?php echo 'Your Upcoming Bookings and Booking History';?>
        </h1>
    </span>

    <br>
    <br>

    <?php

$user_id = 1; // For demonstration purposes

try {
    // PDO connection to the database
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=project333", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle booking cancellation
    if (isset($_POST['cancel_booking'])) {
        $booking_id = $_POST['booking_id'];

        $deleteQuery = "DELETE FROM room_bookings WHERE booking_id = :booking_id";
        $stmt = $pdo->prepare($deleteQuery);
        $stmt->execute(['booking_id' => $booking_id]);

        echo '<div class="alert">Booking ID ' . htmlspecialchars($booking_id) . ' has been cancelled successfully.</div>';
    }

    // Query to find upcoming bookings
    $upcomingsquery = "
        SELECT room_bookings.booking_id,
               rooms.name, 
               room_bookings.starts_at
        FROM room_bookings
        JOIN rooms ON room_bookings.room_id = rooms.id
        WHERE room_bookings.user_id = :user_id 
          AND room_bookings.starts_at > NOW() 
          AND booking_status = 'booked'
        ORDER BY room_bookings.starts_at ASC";

    // Prepare and execute the query for upcoming bookings
    $statement = $pdo->prepare($upcomingsquery);
    $statement->execute([':user_id' => $user_id]);

    $upcomingBookings = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Display upcoming bookings
    echo '<span style="display: inline-block; text-align: center; width: 100%; font-weight: bold;">Your Upcoming Bookings:</span> <br><br>';

    if (!$upcomingBookings) { // If there are no upcoming bookings
        echo '<div class="card">No Upcoming Bookings found!</div>';
    } else {
        foreach ($upcomingBookings as $booking) { // Display upcoming bookings
            echo '<div class="card">';
            echo '<strong>' . htmlspecialchars($booking['name']) . '</strong><br>';
            echo 'Time: ' . htmlspecialchars($booking['starts_at']) . '<br>';
            echo '<form method="post">';
            echo '<input type="hidden" name="booking_id" value="' . htmlspecialchars($booking['booking_id']) . '">';
            echo '<button type="submit" name="cancel_booking" class="btn">Cancel Booking</button>';
            echo '</form>';
            echo '</div>';
        }
    }

    echo '<br><br>';

    // Query to find past bookings
    $pastQuery = "
        SELECT rooms.name, 
               room_bookings.starts_at
        FROM room_bookings
        JOIN rooms ON room_bookings.room_id = rooms.id
        WHERE room_bookings.user_id = :user_id 
          AND room_bookings.starts_at < NOW() 
          AND booking_status = 'booked'
        ORDER BY room_bookings.starts_at ASC";

    // Prepare and execute the query for past bookings
    $stmt = $pdo->prepare($pastQuery);
    $stmt->execute([':user_id' => $user_id]);

    $pastBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display past bookings
    echo '<span style="display: inline-block; text-align: center; width: 100%; font-weight: bold;">Your Past Bookings:</span> <br><br>';

    if (!$pastBookings) { // If there are no past bookings
        echo '<div class="card">No Past Bookings found!</div>';
    } else {
        foreach ($pastBookings as $booking) { // Display past bookings
            echo '<div class="card">';
            echo '<strong>' . htmlspecialchars($booking['name']) . '</strong><br>';
            echo 'Time: ' . htmlspecialchars($booking['starts_at']) . '<br>';
            echo '</div>';
        }
    }
} catch (PDOException $e) {
    // Handle errors gracefully
    echo "Error: " . $e->getMessage();
}
?>

</div>
</body>
<html>
