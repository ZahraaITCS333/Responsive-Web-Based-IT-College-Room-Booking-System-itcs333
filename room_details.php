 <?php
require 'db_connection.php';  
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid Room ID.');
}

$id = intval($_GET['id']);
$query = "SELECT name, capacity, equipment, available_times FROM rooms WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('Room not found.');
}

$room = $result->fetch_assoc();

 
$backgroundClass = '';
switch ($id) {
    case 1:
        $backgroundClass = 'Room-A';  
        break;
    case 2:
        $backgroundClass = 'Room-B';  
        break;
    case 3:
        $backgroundClass = 'Room-C';   
        break;
    case 4:
        $backgroundClass = 'Room-D';  
        break;
    case 5:
        $backgroundClass = 'Room-E';  
        break;
    case 6:
        $backgroundClass = 'Room-H';  
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color:  #ebb9bf;
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 90vh;
            margin: 0;
        }

        .Room-A {
            background-color: #ffe4e1;
        }

        .Room-B {
            background-color:  #ffe4e1;
        }

        .Room-C {
            background-color: #ffe4e1;
        }

        .Room-D {
            background-color: #ffe4e1;
        }

        .Room-E {
            background-color: #ffe4e1;
        }

        .Room-H {
            background-color: #ffe4e1;
        }

        header {
            background:   #c4eff5;
            color: white;
            text-align: center;
            padding: 15px;
            border-radius: 10px;
            width: 50%;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 2.5rem;
            color: #d9235f;
        }

        .room-info {
            background-color:  #d7f5c4;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .list-group-item {
            background-color: #f9f9f9;
            border: none;
            padding: 10px;
            font-size: 1.1rem;
        }

        .list-group-item strong {
            color: #4b0082;
        }

        .btn {
            background-color: #af8b58;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #ff3385;
        }

        footer {
            background: #83e965;
            color: #3e3e3e;
            text-align: center;
            padding: 10px;
            width: 100%;
            position: absolute;
            bottom: 0;
            margin-top: auto;
        }

        @media (max-width: 600px) {
          
            h1 {
                font-size: 2rem;
            }

            .room-info {
                width: 80%;
            }

            .btn {
                width: 100%;
                padding: 15px;
            }
        }
        img {
     
     border-radius: 5px; 
     margin: 10px;  
     padding: 5px; 
     transition: transform 3s;
       
 
 }
        img:hover {
        transform: scale(2.2);  
    } 
    </style>
</head>
<body class="container mt-5 <?= $backgroundClass ?>">
<img src="  ms.png"alt="class activities 1" Width="100" height="100" >

<header>
    <h1><?= htmlspecialchars($room['name']) ?> Details</h1>
</header>

<div class="room-info">
    <ul class="list-group">
        <li class="list-group-item"><strong>Capacity:</strong> <?= htmlspecialchars($room['capacity']) ?> people</li>
        <li class="list-group-item"><strong>Equipment:</strong> <?= htmlspecialchars($room['equipment']) ?></li>
        <li class="list-group-item"><strong>Available Times:</strong> <?= htmlspecialchars($room['available_times']) ?></li>
    </ul>
    <a href="room_browsing.php" class="btn mt-3">Back to Room Browsing</a>
</div>

<footer>
    <p>&copy; 2024 Room Booking System. All rights reserved.</p>
</footer>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
