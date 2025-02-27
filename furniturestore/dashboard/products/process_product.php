<?php
include '../db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];
        $supplier_id = $_POST['supplier_id'];
        $category_id = $_POST['category_id'];

        // رفع الصورة
        $image_url = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/'; // مجلد لحفظ الصور
            $image_name = basename($_FILES['image']['name']);
            $image_path = $upload_dir . $image_name;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $image_url = $image_path;
            }
        }

        $sql = "INSERT INTO products (name, price, stock_quantity, supplier_id, category_id, image_url) 
                VALUES ('$name', '$price', '$stock_quantity', '$supplier_id', '$category_id', '$image_url')";
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

        // رفع الصورة (إذا تم تحميل صورة جديدة)
        $image_url = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/'; // مجلد لحفظ الصور
            $image_name = basename($_FILES['image']['name']);
            $image_path = $upload_dir . $image_name;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                $image_url = $image_path;
            }
        }

        // تحديث البيانات
        $sql = "UPDATE products 
                SET name='$name', price='$price', stock_quantity='$stock_quantity', 
                    supplier_id='$supplier_id', category_id='$category_id'";
        if (!empty($image_url)) {
            $sql .= ", image_url='$image_url'";
        }
        $sql .= " WHERE id='$product_id'";

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