<?php
include '../db_config.php'; // Include database connection file

// Fetch all payments from the database
$payments = $conn->query("
    SELECT p.id, p.payment_date, p.amount, p.payment_status, p.payment_method, o.id AS order_id
    FROM payments p
    LEFT JOIN orders o ON p.order_id = o.id
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments Management</title>
    <link rel="stylesheet" href="../admin.css">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }
        .close {
            float: right;
            cursor: pointer;
        }

        .btn a {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: white;
            margin: 2px;
        }

        /* زر Edit */
        .btn-edit {
            background-color: #4CAF50; 
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        /* زر Delete */
        .btn-delete {
            background-color: #f44336;
        }

        .btn-delete:hover {
            background-color: #d32f2f; 
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Payments Management</h1>
        <button onclick="openModal()" class="btn">Add New Payment</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Payment Date</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Payment Method</th>
                    <th>Order ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?= $payment['id'] ?></td>
                        <td><?= $payment['payment_date'] ?></td>
                        <td>$<?= number_format($payment['amount'], 2) ?></td>
                        <td><?= $payment['payment_status'] ?></td>
                        <td><?= $payment['payment_method'] ?></td>
                        <td><?= $payment['order_id'] ?></td>
                        <td class="btn">
                            <a href="javascript:void(0);" onclick="openEditModal(<?= $payment['id'] ?>)" class="btn-edit">Edit</a>
                            <a href="process_payment.php?action=delete&id=<?= $payment['id'] ?>" class="btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for adding a new payment -->
    <div id="addPaymentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Add New Payment</h2>
            <form action="process_payment.php?action=add" method="POST">
                <label for="payment_date">Payment Date:</label>
                <input type="date" id="payment_date" name="payment_date" required><br><br>
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" step="0.01" required><br><br>
                <label for="payment_status">Payment Status:</label>
                <select id="payment_status" name="payment_status" required>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Failed">Failed</option>
                </select><br><br>
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Cash">Cash</option>
                </select><br><br>
                <label for="order_id">Order ID:</label>
                <input type="number" id="order_id" name="order_id" required><br><br>
                <button type="submit" class="btn">Add</button>
            </form>
        </div>
    </div>

    <!-- Modal for editing a payment -->
    <div id="editPaymentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Payment</h2>
            <form id="editPaymentForm" action="process_payment.php?action=edit&id=" method="POST">
                <input type="hidden" id="edit_id" name="id">
                <label for="edit_payment_date">Payment Date:</label>
                <input type="date" id="edit_payment_date" name="payment_date" required><br><br>
                <label for="edit_amount">Amount:</label>
                <input type="number" id="edit_amount" name="amount" step="0.01" required><br><br>
                <label for="edit_payment_status">Payment Status:</label>
                <select id="edit_payment_status" name="payment_status" required>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Failed">Failed</option>
                </select><br><br>
                <label for="edit_payment_method">Payment Method:</label>
                <select id="edit_payment_method" name="payment_method" required>
                    <option value="Credit Card">Credit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Cash">Cash</option>
                </select><br><br>
                <label for="edit_order_id">Order ID:</label>
                <input type="number" id="edit_order_id" name="order_id" required><br><br>
                <button type="submit" class="btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // Open the "Add New Payment" modal
        function openModal() {
            document.getElementById('addPaymentModal').style.display = 'flex';
        }

        // Close the "Add New Payment" modal
        function closeModal() {
            document.getElementById('addPaymentModal').style.display = 'none';
        }

        // Open the "Edit Payment" modal
        function openEditModal(paymentId) {
            fetch(`fetch_payment.php?id=${paymentId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_payment_date').value = data.payment_date;
                    document.getElementById('edit_amount').value = data.amount;
                    document.getElementById('edit_payment_status').value = data.payment_status;
                    document.getElementById('edit_payment_method').value = data.payment_method;
                    document.getElementById('edit_order_id').value = data.order_id;
                    document.getElementById('editPaymentModal').style.display = 'flex';
                });
        }

        // Close the "Edit Payment" modal
        function closeEditModal() {
            document.getElementById('editPaymentModal').style.display = 'none';
        }

        // Close any modal when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>