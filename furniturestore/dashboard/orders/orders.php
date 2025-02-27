<?php
include '../db_config.php';

// Fetch all orders
$orders = $conn->query("SELECT * FROM orders")->fetch_all(MYSQLI_ASSOC);
$users = $conn->query("SELECT * FROM users")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../admin.css">
</head>
<body>
    <h1>Manage Orders</h1>
    <button onclick="openModal('order')">Add Order</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['user_id']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td><?php echo $order['total_amount']; ?></td>
                    <td>
                        <button onclick="openModal('order', <?php echo $order['id']; ?>)">Edit</button>
                        <form method="POST" action="process_order.php" style="display:inline;">
                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                            <button type="submit" name="delete_order">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Order Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="POST" action="process_order.php" id="orderForm">
                <h3 id="modalTitle">Add Order</h3>
                <input type="hidden" name="order_id" id="order_id">
                
                <!-- User ID -->
                <label for="user_id">User:</label>
                <select name="user_id" id="user_id" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['full_name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Order Date -->
                <label for="order_date">Order Date:</label>
                <input type="date" name="order_date" id="order_date" required>

                <!-- Order Status -->
                <label for="order_status">Order Status:</label>
                <select name="order_status" id="order_status" required>
                    <option value="Pending">Pending</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Cancelled">Cancelled</option>
                </select>

                <!-- Total Amount -->
                <label for="total_amount">Total Amount:</label>
                <input type="number" name="total_amount" id="total_amount" step="0.01" required>

                <button type="submit" name="add_order" id="submitOrderButton">Add Order</button>
            </form>
        </div>
    </div>

    <script src="../admin.js"></script>
</body>
</html>