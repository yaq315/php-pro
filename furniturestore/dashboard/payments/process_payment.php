<?php
include '../db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add Payment
    if (isset($_POST['add_payment'])) {
        $order_id = $_POST['order_id'];
        $amount = $_POST['amount'];
        $payment_status = $_POST['payment_status'];
        $payment_method = $_POST['payment_method'];

        $sql = "INSERT INTO payments (order_id, amount, payment_status, payment_method) 
                VALUES ('$order_id', '$amount', '$payment_status', '$payment_method')";
        if ($conn->query($sql)) {
            echo "<script>alert('Payment added successfully!'); window.location.href='payments.php';</script>";
        } else {
            echo "<script>alert('Error adding payment: " . $conn->error . "');</script>";
        }
    }

    // Edit Payment
    elseif (isset($_POST['edit_payment'])) {
        $payment_id = $_POST['payment_id'];
        $order_id = $_POST['order_id'];
        $amount = $_POST['amount'];
        $payment_status = $_POST['payment_status'];
        $payment_method = $_POST['payment_method'];

        $sql = "UPDATE payments 
                SET order_id='$order_id', amount='$amount', payment_status='$payment_status', payment_method='$payment_method' 
                WHERE id='$payment_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Payment updated successfully!'); window.location.href='payments.php';</script>";
        } else {
            echo "<script>alert('Error updating payment: " . $conn->error . "');</script>";
        }
    }

    // Delete Payment
    elseif (isset($_POST['delete_payment'])) {
        $payment_id = $_POST['delete_payment'];

        $sql = "DELETE FROM payments WHERE id='$payment_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Payment deleted successfully!'); window.location.href='payments.php';</script>";
        } else {
            echo "<script>alert('Error deleting payment: " . $conn->error . "');</script>";
        }
    }
}
?>