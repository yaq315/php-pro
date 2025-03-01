<?php
include '../db_config.php'; // Include database connection file

// Fetch all products from the database
$products = $conn->query("
    SELECT p.id, p.name, p.price, p.stock_quantity, c.name AS category_name, s.name AS supplier_name, p.image
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN suppliers s ON p.supplier_id = s.id
")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
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
        <h1>Product Management</h1>
        <button onclick="openModal()" class="btn">Add New Product</button>
        <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock Quantity</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td>$<?= number_format($product['price'], 2) ?></td>
                <td><?= $product['stock_quantity'] ?></td>
                <td><?= $product['category_name'] ?></td>
                <td><?= $product['supplier_name'] ?></td>
                <td>
    <?php if (isset($product['image']) && !empty($product['image'])): ?>
        <img src="../uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="50">
    <?php else: ?>
        <img src="../uploads/<?= $product['image'] ?>">
    <?php endif; ?>
</td>
                <td class="btn">
                    <a href="javascript:void(0);" onclick="openEditModal(<?= $product['id'] ?>)" class="btn-edit">Edit</a>
                    <a href="process_product.php?action=delete&id=<?= $product['id'] ?>" class="btn-delete">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    </div>

    <!-- Modal for adding a new product -->
   <!-- Modal for adding a new product -->
<div id="addProductModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Add New Product</h2>
        <form action="process_product.php?action=add" method="POST" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required><br><br>
            <label for="stock">Stock Quantity:</label>
            <input type="number" id="stock" name="stock" required><br><br>
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <option value="1">Living Room</option>
                <option value="2">Bedroom</option>
                <option value="3">Dining Room</option>
                <option value="4">Office Furniture</option>
                <option value="5">Outdoor</option>

            </select><br><br>
            <label for="supplier_id">Supplier:</label>
            <select id="supplier_id" name="supplier_id" required>
                <option value="1">Supplier 1</option>
                <option value="2">Supplier 2</option>
                <option value="3">Supplier 3</option>
                <option value="4">Supplier 4</option>
                <option value="5">Supplier 5</option>
            </select><br><br>
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>
            <button type="submit" class="btn">Add</button>
        </form>
    </div>
</div>
    <!-- Modal for editing a product -->
<!-- Modal for editing a product -->
<div id="editProductModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Product</h2>
        <form id="editProductForm" action="process_product.php?action=edit&id=" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="edit_id" name="id">
            <label for="edit_name">Product Name:</label>
            <input type="text" id="edit_name" name="name" required><br><br>
            <label for="edit_price">Price:</label>
            <input type="number" id="edit_price" name="price" step="0.01" required><br><br>
            <label for="edit_stock">Stock Quantity:</label>
            <input type="number" id="edit_stock" name="stock" required><br><br>
            <label for="edit_category_id">Category:</label>
            <select id="edit_category_id" name="category_id" required>
                <option value="1">Living Room</option>
                <option value="2">Bedroom</option>
                <option value="3">Dining Room</option>
                <option value="4">Office Furniture</option>
                <option value="5">Outdoor</option>
            </select><br><br>
            <label for="edit_supplier_id">Supplier:</label>
            <select id="edit_supplier_id" name="supplier_id" required>
                <option value="1">Supplier 1</option>
                <option value="2">Supplier 2</option>
                <option value="3">Supplier 3</option>
                <option value="4">Supplier 4</option>
                <option value="5">Supplier 5</option>
            </select><br><br>
            <label for="edit_image">Product Image:</label>
            <input type="file" id="edit_image" name="image" accept="image/*"><br><br>
            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>
</div>

    <script>
        // Open the "Add New Product" modal
        function openModal() {
            document.getElementById('addProductModal').style.display = 'flex';
        }

        // Close the "Add New Product" modal
        function closeModal() {
            document.getElementById('addProductModal').style.display = 'none';
        }

        // Open the "Edit Product" modal
        function openEditModal(productId) {
            fetch(`fetch_product.php?id=${productId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_price').value = data.price;
                    document.getElementById('edit_stock').value = data.stock_quantity;
                    document.getElementById('edit_category_id').value = data.category_id;
                    document.getElementById('edit_supplier_id').value = data.supplier_id;
                    document.getElementById('editProductModal').style.display = 'flex';
                });
        }

        // Close the "Edit Product" modal
        function closeEditModal() {
            document.getElementById('editProductModal').style.display = 'none';
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
