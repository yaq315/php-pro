<?php
session_start(); // بدء الجلسة لإظهار رسائل التنبيه
include '../db_config.php'; // استيراد ملف اتصال قاعدة البيانات

// جلب جميع الطلبات من قاعدة البيانات
$orders = $conn->query("
    SELECT o.id, o.order_date, o.total_amount, o.order_status, u.full_name AS user_name
    FROM orders o
    LEFT JOIN users u ON o.user_id = u.id
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="../admin.css">
    <style>
        /* تنسيق الأزرار */
        .btn {
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

        .btn-edit {
            background-color: #4CAF50; /* لون أخضر */
        }

        .btn-edit:hover {
            background-color: #45a049; /* لون أخضر داكن */
        }

        .btn-delete {
            background-color: #f44336; /* لون أحمر */
        }

        .btn-delete:hover {
            background-color: #d32f2f; /* لون أحمر داكن */
        }

        .btn-add {
            background-color: #008CBA; /* لون أزرق */
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-add:hover {
            background-color: #007B9E; /* لون أزرق داكن */
        }

        /* رسائل التنبيه */
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* تنسيق الجدول */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #8B7355;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* تنسيق النوافذ المنبثقة (Modals) */
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            float: right;
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
        }

        .close:hover {
            color: #f44336;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <h1>Order Management</h1>

        <!-- عرض رسائل التنبيه -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

       
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['order_date'] ?></td>
                        <td>$<?= number_format($order['total_amount'], 2) ?></td>
                        <td><?= ucfirst($order['order_status']) ?></td>
                        <td><?= $order['user_name'] ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="openEditModal(<?= $order['id'] ?>)" class="btn btn-edit">Edit</a>
                            <a href="process_order.php?action=delete&id=<?= $order['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    
   

    <!-- Modal for editing an order -->
    <div id="editOrderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit Order</h2>
            <form id="editOrderForm" action="process_order.php?action=edit&id=" method="POST">
                <input type="hidden" id="edit_id" name="id">
                <label for="edit_status">Status:</label>
                <select id="edit_status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Delivered">Delivered</option>
                    <option value="Cancelled">Cancelled</option>
                </select><br><br>
                <button type="submit" class="btn btn-edit">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
   

        // Open the "Edit Order" modal
        function openEditModal(orderId) {
            fetch(`fetch_order.php?id=${orderId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_status').value = data.status;

                    // تحديث الإجراء داخل الفورم
                    document.getElementById('editOrderForm').action = `process_order.php?action=edit&id=${data.id}`;

                    document.getElementById('editOrderModal').style.display = 'flex';
                });
        }

        // Close the "Edit Order" modal
        function closeEditModal() {
            document.getElementById('editOrderModal').style.display = 'none';
        }
    </script>
</body>
</html>