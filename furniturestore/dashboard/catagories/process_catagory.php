<?php
include '../db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_category'])) {
        $name = $_POST['name'];

        $sql = "INSERT INTO categories (name) VALUES ('$name')";
        if ($conn->query($sql)) {
            echo "<script>alert('Category added successfully!'); window.location.href='categories.php';</script>";
        } else {
            echo "<script>alert('Error adding category: " . $conn->error . "'); window.location.href='categories.php';</script>";
        }
    } elseif (isset($_POST['edit_category'])) {
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];

        $sql = "UPDATE categories SET name='$name' WHERE id='$category_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Category updated successfully!'); window.location.href='categories.php';</script>";
        } else {
            echo "<script>alert('Error updating category: " . $conn->error . "'); window.location.href='categories.php';</script>";
        }
    } elseif (isset($_POST['delete_category'])) {
        $category_id = $_POST['category_id'];

        $sql = "DELETE FROM categories WHERE id='$category_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Category deleted successfully!'); window.location.href='categories.php';</script>";
        } else {
            echo "<script>alert('Error deleting category: " . $conn->error . "'); window.location.href='categories.php';</script>";
        }
    }
}
?>