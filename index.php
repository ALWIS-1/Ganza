<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Table</title>
    <link rel="stylesheet" href="styles.css">
    <a href="logout.php" class="back" style="float: right;">Logout</a>

</head>
<body>
    <div class="container">
        <h1>User List</h1>
        <a href="create.php" class="back">Add New User</a>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT id, full_name, last_name FROM users");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['full_name']) . "</td>
                                <td>" . htmlspecialchars($row['last_name']) . "</td>
                                <td class='actions'>
                                    <a href='update.php?id={$row['id']}' class='edit'>Edit</a>
                                    <a href='delete.php?id={$row['id']}' class='delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found</td></tr>";
                }
                $conn->close();
                ?>
                <?php include 'auth.php'; ?>

            </tbody>
        </table>
    </div>
</body>
</html>
