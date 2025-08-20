<?php
include 'db.php';

// Fetch existing user data
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT full_name, last_name FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $last_name = $_POST['last_name'];

    $update = $conn->prepare("UPDATE users SET full_name = ?, last_name = ? WHERE id = ?");
    $update->bind_param("ssi", $full_name, $last_name, $id);
    $update->execute();

    header("Location: index.php");
    exit;
}
?>
<?php include 'auth.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form method="POST">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>

            <button type="submit">Update</button>
        </form>
        <a href="index.php" class="back">Back to User List</a>
    </div>
</body>
</html>
