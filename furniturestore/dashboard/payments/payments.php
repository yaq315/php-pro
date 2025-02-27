<?php
include '../db_config.php';
include 'fetch_payment.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Payments</title>
    <link rel="stylesheet" href="../admin.css">
   
</head>
<body>
    <h1>Manage Payments</h1>
    <button onclick="openModal('payment')">Add Payment</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Method</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?php echo $payment['id']; ?></td>
                    <td><?php echo $payment['order_id']; ?></td>
                    <td><?php echo $payment['amount']; ?></td>
                    <td><?php echo $payment['payment_status']; ?></td>
                    <td><?php echo $payment['payment_method']; ?></td>
                    <td>
                        <button onclick="openModal('payment', <?php echo $payment['id']; ?>)">Edit</button>
                        <form method="POST" action="process_payment.php" style="display:inline;">
                            <input type="hidden" name="delete_payment" value="<?php echo $payment['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Payment Modal -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="POST" action="process_payment.php">
    <h3 id="modalTitle">Add Payment</h3>
    <input type="hidden" name="payment_id" id="payment_id">

    <!-- Order ID -->
    <label for="order_id">Order ID:</label>
    <input type="number" name="order_id" id="order_id" required>

    <!-- Amount -->
    <label for="amount">Amount:</label>
    <input type="number" name="amount" id="amount" step="0.01" required>

    <!-- Payment Status -->
    <label for="payment_status">Payment Status:</label>
    <select name="payment_status" id="payment_status" required>
        <option value="Paid">Paid</option>
        <option value="Pending">Pending</option>
        <option value="Failed">Failed</option>
    </select>

    <!-- Payment Method -->
    <label for="payment_method">Payment Method:</label>
    <select name="payment_method" id="payment_method" required>
        <option value="Credit Card">Credit Card</option>
        <option value="PayPal">PayPal</option>
        <option value="Bank Transfer">Bank Transfer</option>
        <option value="Cash">Cash</option>
    </select>

    <button type="submit" name="add_payment" id="submitPaymentButton">Add Payment</button>
</form>
        </div>
    </div>
    <script src="../admin.js"></script>
</body>
</html>