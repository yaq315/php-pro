<?php
include '../db_config.php';

// جلب جميع المنتجات
$products = $conn->query("SELECT * FROM products")->fetch_all(MYSQLI_ASSOC);
$suppliers = $conn->query("SELECT * FROM suppliers")->fetch_all(MYSQLI_ASSOC);
$categories = $conn->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="../admin.css">
</head>
<body>
    <h1>Manage Products</h1>
    <button onclick="openModal('product')">Add Product</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock Quantity</th>
                <th>Supplier</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td>
                        <?php if (!empty($product['images'])): ?>
                            <img src="<?php echo $product['images']; ?>" alt="Product Image" style="width: 50px; height: 50px;">
                        <?php else: ?>
                            <span>No Image</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['stock_quantity']; ?></td>
                    <td><?php echo $product['supplier_id']; ?></td>
                    <td><?php echo $product['category_id']; ?></td>
                    <td>
                        <button onclick="openModal('product', <?php echo $product['id']; ?>)">Edit</button>
                        <form method="POST" action="process_product.php" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <button type="submit" name="delete_product">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="POST" action="process_product.php" id="productForm" enctype="multipart/form-data">
                <h3 id="modalTitle">Add Product</h3>
                <input type="hidden" name="product_id" id="product_id">
                
                <!-- Name -->
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <!-- Price -->
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" step="0.01" required>

                <!-- Stock Quantity -->
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" name="stock_quantity" id="stock_quantity" required>

                <!-- Supplier -->
                <label for="supplier_id">Supplier:</label>
                <select name="supplier_id" id="supplier_id" required>
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?php echo $supplier['id']; ?>"><?php echo $supplier['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Category -->
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Image -->
                <label for="image">Image:</label>
                <input type="file" name="image" id="image">

                <button type="submit" name="add_product" id="submitProductButton">Add Product</button>
            </form>
        </div>
    </div>

    <script src="../admin.js"></script>
</body>
</html>