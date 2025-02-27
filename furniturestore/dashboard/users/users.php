<?php
include '../db_config.php';

// Fetch all users
$users = $conn->query("SELECT * FROM users")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="../admin.css">
</head>
<body>
    <h1>Manage Users</h1>
    <button onclick="openModal('user')">Add User</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['address']; ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <button onclick="openModal('user', <?php echo $user['id']; ?>)">Edit</button>
                        <form method="POST" action="process_user.php" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <button type="submit" name="delete_user">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- User Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="POST" action="process_user.php" id="userForm">
                <h3 id="modalTitle">Add User</h3>
                <input type="hidden" name="user_id" id="user_id">
                
                <!-- Full Name -->
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" required>

                <!-- Phone -->
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" required>

                <!-- Email -->
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <!-- Address -->
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" required>

                <!-- Role -->
                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>

                <button type="submit" name="add_user" id="submitUserButton">Add User</button>
            </form>
        </div>
    </div>

    <script src="../admin.js"></script>
</body>
</html>