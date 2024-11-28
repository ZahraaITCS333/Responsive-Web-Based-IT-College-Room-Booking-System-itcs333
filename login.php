<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>    
    <!-- <link rel="stylesheet" href="styles.css?v=2.0"> -->
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <hr>
        <form action="login_process.php" method="POST">
            <label for="username">Username</label>
            <input type="text" placeholder="Enter Username" name="username" id="username" required><br><br>

            <label for="password">Password</label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required><br><br>

            <button type="submit" class="registerbtn">Login</button>
        </form>
        <footer>
            <p><br>Don't have an account? <a href="register.php">Register here</a></p>
        </footer>
    </div>
</body>
</html>