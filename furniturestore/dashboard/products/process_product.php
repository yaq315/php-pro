<?php
include '../db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];
        $supplier_id = $_POST['supplier_id'];
        $category_id = $_POST['category_id'];

        $sql = "INSERT INTO products (name, price, stock_quantity, supplier_id, category_id) 
                VALUES ('$name', '$price', '$stock_quantity', '$supplier_id', '$category_id')";
        if ($conn->query($sql)) {
            echo "<script>alert('Product added successfully!'); window.location.href='products.php';</script>";
        } else {
            echo "<script>alert('Error adding product: " . $conn->error . "'); window.location.href='products.php';</script>";
        }
    } elseif (isset($_POST['edit_product'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];
        $supplier_id = $_POST['supplier_id'];
        $category_id = $_POST['category_id'];

        $sql = "UPDATE products 
                SET name='$name', price='$price', stock_quantity='$stock_quantity', supplier_id='$supplier_id', category_id='$category_id' 
                WHERE id='$product_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Product updated successfully!'); window.location.href='products.php';</script>";
        } else {
            echo "<script>alert('Error updating product: " . $conn->error . "'); window.location.href='products.php';</script>";
        }
    } elseif (isset($_POST['delete_product'])) {
        $product_id = $_POST['product_id'];

        $sql = "DELETE FROM products WHERE id='$product_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Product deleted successfully!'); window.location.href='products.php';</script>";
        } else {
            echo "<script>alert('Error deleting product: " . $conn->error . "'); window.location.href='products.php';</script>";
        }
    }
}
?>