<html>

<head> <!--style & google icons stylsheet links-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="homepagestyles.css">
    <title>Welcome!</title>
</head>

<body>
    <div class="grid-container">
        <nav class="header"> <!--header (navbar)-->
            <a href="homepageprj.php"><span class="material-icons-outlined">home</span></a>
            <div class="header-left">
                <a><span class="material-icons-outlined">menu_book</span></a>
                <a><span class="material-icons-outlined">bar_chart</span></a>
                <a><span class="material-icons-outlined">account_circle</span></a>
            </div>
            <div class="header-right">
                <span class="material-icons-outlined">logout</span>
            </div>
        </nav>
        <div class="main-container"> <!--main content: buttons and welcome message-->
            <div class="hello">
               <img src="UOB-Logo-Transparant.png" alt="UOB Logo" width="222" height="257">            
               <h1>Welcome to the UOB Room Booking System!</h1>
               <a><button>Browse Rooms</button></a>
               <a href="userbookingsdash.php" target="_blank"><button>View Bookings</button></a>
            </div>
        </div>
    </div>
</body>

</html>