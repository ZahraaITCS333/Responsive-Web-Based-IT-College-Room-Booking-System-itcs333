<?php
require 'db_connection.php'; 


$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$capacity = isset($_GET['capacity']) ? intval($_GET['capacity']) : 0;


$query = "SELECT id, name, capacity FROM rooms WHERE 1=1";
$params = [];
$types = "";


if (!empty($search)) {
    $query .= " AND name LIKE ?";
    $params[] = "%" . $search . "%";
    $types .= "s";
}


if ($capacity > 0) {
    $query .= " AND capacity >= ?";
    $params[] = $capacity;
    $types .= "i";
}

$stmt = $conn->prepare($query);


if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <nav class="header"> <!-- header (navigation bar) -->
    <a href="homepageprj.php"><span class="material-icons-outlined">home</span></a>
    <div class="header-left">
        <span class="material-icons-outlined">menu_book</span>
        <span class="material-icons-outlined">bar_chart</span>
        <span class="material-icons-outlined">account_circle</span>
    </div>
    <div class="header-right">
        <span class="material-icons-outlined">logout</span>
    </div>
</nav>
    <title>Room Browsing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        .material-icons-outlined { 
    vertical-align:middle;
    line-height:1px;
    color:#af8b58;
}

.header { /*navbar stylings */
    grid-area: header;
    height:70px;
    background-color: #ffffff;
    display:flex;
    align-items:center;
    justify-content: space-between;
    padding: 0 30px 0 30px;
    box-shadow: 0 6px 7px -4px rgba(0,0,0,0.2);
    }
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('rr.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin-top: 50px;
        }

        h1 {
            margin-bottom: 30px;
            text-align: center;  
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            overflow: hidden;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
        }

        .btn-custom {
            background-color: #af8b58;
            color: white;
            border-radius: 5px;
            padding: 10px 15px;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #45a049;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .alert {
            margin-top: 20px;
            padding: 15px;
            background-color: #ffcc00;
            color: #333;
            border-radius: 5px;
        }

        .gallery img {
    margin: 10px;
    border: 10px solid #fac6d7;
    border-radius: 10px;
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
    @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            .room-info {
                width: 90%;
            }

            .btn {
                width: 100%;
                padding: 15px;
            }
        }
       
    .room-info {
        background-color:  #d7f5c4;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 600px;
        max-height: 400px;
        overflow-y: auto; /* Enable scrolling for large content */
        scrollbar-width: thin; /* For modern browsers */
        scrollbar-color: #af8b58 #f9f9f9; /* Custom colors for the scrollbar */
    }

    /* For webkit browsers (Chrome, Safari) */
    .room-info::-webkit-scrollbar {
        width: 10px;
    }

    .room-info::-webkit-scrollbar-track {
        background: #f9f9f9;
    }

    .room-info::-webkit-scrollbar-thumb {
        background-color: #af8b58;
        border-radius: 10px;
        border: 2px solid #f9f9f9;
    }
 

    </style>
</head>
<body>
<img src="  ms.png"alt="class activities 1" Width="100" height="100" >
<div class="container">
    <h1>Available Rooms</h1>

    
    <form method="GET" class="search-form mb-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search by room name" value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="col-md-4">
                <input type="number" name="capacity" class="form-control" placeholder="Min. Capacity" value="<?= htmlspecialchars($capacity) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-custom w-100">Search</button>
            </div>
        </div>
    </form>

    
    <?php if ($result->num_rows > 0): ?>
        <div class="row">
            <?php while ($room = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        
                        <?php 
                        $imagePath = '';
                        switch ($room['name']) {
                            case 'Room A':
                                $imagePath = '  yy.jpg';
                                break;
                            case 'Room B':
                                $imagePath = '   oo.jpg';
                                break;
                            case 'Room C':
                                $imagePath = '  vv.jpg';
                                break;
                                case 'Room D':
                                    $imagePath = '  TT.jpg';
                                    break;
                                    case 'Room E':
                                        $imagePath = '  LL.jpg';
                                        break;
                                        case 'Room H':
                                            $imagePath = '  UU.jpg';
                                            break;
                            
                               
                                break;
                        }
                        ?>
                        <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($room['name']) ?>" class="card-img-top">

                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($room['name']) ?></h5>
                            <p class="card-text">
                                <strong>Capacity:</strong> <?= htmlspecialchars($room['capacity']) ?><br>
                                <strong>Equipment:</strong> Projector, Whiteboard 
                            </p>
                            <a href="room_details.php?id=<?= $room['id'] ?>" class="btn btn-custom">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert">
            No rooms found based on your search criteria.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<footer>
    <p>&copy; 2024 Room Booking System. All rights reserved.</p>
</footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
