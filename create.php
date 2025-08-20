<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $last_name = $_POST['last_name'];

    $stmt = $conn->prepare("INSERT INTO users (full_name, last_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $full_name, $last_name);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>
<?php include 'auth.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Add New User</h2>
        <form method="POST">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" required>

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" required>

            <button type="submit">Create User</button>
        </form>
        <a href="index.php" class="back">Back to User List</a>
    </div>
</body>
</html>
