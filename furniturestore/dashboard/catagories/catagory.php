<?php
include '../db_config.php';

// جلب جميع الفئات
$categories = $conn->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="../admin.css">
</head>
<body>
    <h1>Manage Categories</h1>
    <button onclick="openModal('category')">Add Category</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo $category['name']; ?></td>
                    <td>
                        <button onclick="openModal('category', <?php echo $category['id']; ?>)">Edit</button>
                        <form method="POST" action="process_category.php" style="display:inline;">
                            <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                            <button type="submit" name="delete_category">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Category Modal -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="POST" action="process_category.php" id="categoryForm">
                <h3 id="modalTitle">Add Category</h3>
                <input type="hidden" name="category_id" id="category_id">
                
                <!-- Category Name -->
                <label for="name">Category Name:</label>
                <input type="text" name="name" id="name" required>

                <button type="submit" name="add_category" id="submitCategoryButton">Add Category</button>
            </form>
        </div>
    </div>

    <script src="../admin.js"></script>
</body>
</html>