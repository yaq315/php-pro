<?php
include '../db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_order'])) {
        $user_id = $_POST['user_id'];
        $order_date = $_POST['order_date'];
        $order_status = $_POST['order_status'];
        $total_amount = $_POST['total_amount'];

        $sql = "INSERT INTO orders (user_id, order_date, order_status, total_amount) 
                VALUES ('$user_id', '$order_date', '$order_status', '$total_amount')";
        if ($conn->query($sql)) {
            echo "<script>alert('Order added successfully!'); window.location.href='orders.php';</script>";
        } else {
            echo "<script>alert('Error adding order: " . $conn->error . "'); window.location.href='orders.php';</script>";
        }
    } elseif (isset($_POST['edit_order'])) {
        $order_id = $_POST['order_id'];
        $user_id = $_POST['user_id'];
        $order_date = $_POST['order_date'];
        $order_status = $_POST['order_status'];
        $total_amount = $_POST['total_amount'];

        $sql = "UPDATE orders 
                SET user_id='$user_id', order_date='$order_date', order_status='$order_status', total_amount='$total_amount' 
                WHERE id='$order_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Order updated successfully!'); window.location.href='orders.php';</script>";
        } else {
            echo "<script>alert('Error updating order: " . $conn->error . "'); window.location.href='orders.php';</script>";
        }
    } elseif (isset($_POST['delete_order'])) {
        $order_id = $_POST['order_id'];

        $sql = "DELETE FROM orders WHERE id='$order_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Order deleted successfully!'); window.location.href='orders.php';</script>";
        } else {
            echo "<script>alert('Error deleting order: " . $conn->error . "'); window.location.href='orders.php';</script>";
        }
    }
}
?>