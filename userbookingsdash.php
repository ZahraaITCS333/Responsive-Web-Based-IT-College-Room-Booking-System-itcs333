<html>
<head> <!--style & google icons stylsheet links-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="userdashcss.css">
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
    $user_id=1; //for demonstration purposes
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cs333project", 'root', ''); //pdo connection
    //query to find upcoming bookings
    $upcomingsquery = "
        SELECT rooms.name, 
        room_bookings.starts_at
        FROM room_bookings
        JOIN rooms ON room_bookings.room_id = rooms.id
        WHERE room_bookings.user_id = :user_id 
        AND room_bookings.starts_at > NOW() AND booking_status = 'booked'
        ORDER BY room_bookings.starts_at ASC";

    $statement = $pdo->prepare($upcomingsquery); //prepare query
    $statement->execute([':user_id' => $user_id]); //execute query

    $upcomingBookings = $statement->fetchAll(PDO::FETCH_ASSOC); //fetch query results

//display the bookings
    echo '<span style="display: inline-block; text-align: center; width: 100%; font-weight: bold;">Your Upcoming Bookings:</span> <br><br>';
    if($upcomingBookings==null) { //if there are no upcoming bookings display "no bookings found"
        echo '<div class="card">';
        echo 'No Upcoming Bookings found!';
        echo '</div>';
    }
    else {
        foreach ($upcomingBookings as $booking) { //if there are then display them
            echo '<div class="card">';
            echo '<strong>' . htmlspecialchars($booking['name']) . '</strong><br>';
            echo 'Time: ' . htmlspecialchars($booking['starts_at']) . '<br><br>';
            echo '</div>';
        }
    }

    echo '</div>';
    echo '</div>';
    echo '<br><br>';

    $pdo = new PDO("mysql:host=127.0.0.1;port=3306;dbname=cs333project", 'root', ''); //pdo connection

    //query to find past bookings
    $query = "
        SELECT rooms.name, 
        room_bookings.starts_at
        FROM room_bookings
        JOIN rooms ON room_bookings.room_id = rooms.id
        WHERE room_bookings.user_id = :user_id 
        AND room_bookings.starts_at < NOW() AND booking_status='booked'
        ORDER BY room_bookings.starts_at ASC";

    $stmt = $pdo->prepare($query); //prepare query
    $stmt->execute([':user_id' => $user_id]); //execute query

    $pastBookings = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetch query results

    echo '<span style="display: inline-block; text-align: center; width: 100%; font-weight: bold;">Your Past Bookings:</span> <br><br>';

// Display the upcoming bookings
    if($pastBookings==null) { //if there are no past bookings display "no past bookings"
        echo '<div class="card">';
        echo 'No Past Bookings found!';
        echo '</div>';
    }
    else {
        foreach ($pastBookings as $booking) { //if there are then display them
            echo '<div class="card">';
            echo '<strong>' . htmlspecialchars($booking['name']) . '</strong><br>';
            echo 'Time: ' . htmlspecialchars($booking['starts_at']) . '<br><br>';
            echo '</div>';
        }
    }

    ?>
</div>
</body>
<html>