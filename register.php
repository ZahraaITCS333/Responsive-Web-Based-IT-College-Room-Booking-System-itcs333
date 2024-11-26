<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="registeration.css">
    <!-- <link rel="stylesheet" href="styles.css?v=1.0"> -->
</head>
<body>
    <div class="form-container">
        <h2>Sign Up</h2>
        <hr>
        <?php
        if (isset($_SESSION['success'])) {
            echo "<p style='color: green;'>" . $_SESSION['success'] . "</p>";
            unset($_SESSION['success']); // Clear success message
        }
        if (isset($_SESSION['error'])) {
            echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']); // Clear error message
        }
        ?>

        <form action="register_process.php" method="POST">

            <label for="fName">First name </label>
            <input type="text" placeholder="Enter first name" name="fName" id="fName" required><br><br>

            <label for="lName">Last name </label>
            <input type="text" placeholder="Enter last name" name="lName" id="lName" required><br><br>

            <label for="username">Username </label>
            <input type="text" placeholder="Enter Username" name="username" id="username" required><br><br>

            <label for="email">Email </label>
            <input type="email" placeholder="Enter Email" name="email" id="email" required><br><br>

            <label for="password">Password </label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required><br><br>

            <button type="submit" class="registerbtn">Register</button>
        </form>
        <footer>
            <p><br>Already have an account? <a href="login.php">Login here</a></p>
        </footer>
    </div>
</body>
</html>