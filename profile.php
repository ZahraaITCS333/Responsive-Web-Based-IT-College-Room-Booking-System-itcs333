<?php
include 'includes/db.php';
// Assume user is logged in with ID 1 for demonstration
$user_id = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Handle file upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "uploads/";
        $file_name = basename($_FILES['profile_picture']['name']);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);

        $query = $pdo->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
        $query->execute([$target_file, $user_id]);
    }

    // Update user details
    $query = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $query->execute([$name, $email, $user_id]);
}

// Fetch user data
$query = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$query->execute([$user_id]);
$user = $query->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <h1>Your Profile</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" value="<?= $user['name']; ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label>Profile Picture:</label>
                <input type="file" name="profile_picture" class="form-control">
                <?php if ($user['profile_picture']): ?>
                    <img src="<?= $user['profile_picture']; ?>" alt="Profile Picture" width="100">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</body>
</html>
