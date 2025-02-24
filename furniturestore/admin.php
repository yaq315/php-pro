<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Store Dashboard</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <div class="logo">
                <h1>FurnitureStore</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php" data-section="home"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#" data-section="orders"><i class="fas fa-cogs"></i> Manage Orders</a></li>
                    <li><a href="#" data-section="products"><i class="fas fa-box"></i> Manage Products</a></li>
                    <li><a href="#" data-section="users"><i class="fas fa-users"></i> Manage Users</a></li>
                    <li><a href="#" data-section="inventory"><i class="fas fa-warehouse"></i> Manage Inventory</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <header>
                <h2>Dashboard</h2>
            </header>

            <section class="stats">
                <div class="stat-card" id="totalSales">
                    <h3>Total Sales</h3>
                    <p>0 SAR</p>
                </div>
                <div class="stat-card" id="newOrders">
                    <h3>New Orders</h3>
                    <p>0 Orders</p>
                </div>
                <div class="stat-card" id="newUsers">
                    <h3>New Users</h3>
                    <p>0 Users</p>
                </div>
                <div class="stat-card" id="availableStock">
                    <h3>Available Stock</h3>
                    <p>0 Products</p>
                </div>
            </section>

            <div class="chartss">
                <section class="charts">
                    <div class="chart-card">
                        <div>
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </section>
            </div>

            <section class="tables">
                <div class="table-card">
                    <h3>Latest Orders</h3>
                    <table id="ordersTable">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Orders will be added here dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="table-card">
                    <h3>Latest Products</h3>
                    <table id="productsTable">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Products will be added here dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="table-card">
                    <h3>Latest Users</h3>
                    <table id="usersTable">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Users will be added here dynamically -->
                        </tbody>
                    </table>
                </div>
                <div class="table-card">
                    <h3>Latest Inventory</h3>
                    <table id="inventoryTable">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Inventory items will be added here dynamically -->
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal for Adding Orders -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Add New Order</h3>
            <form id="addOrderForm">
                <div class="form-group">
                    <label for="orderId">Order Number</label>
                    <input type="number" id="orderId" required>
                </div>
                <div class="form-group">
                    <label for="orderUser">User</label>
                    <input type="text" id="orderUser" required>
                </div>
                <div class="form-group">
                    <label for="orderDate">Date</label>
                    <input type="date" id="orderDate" required>
                </div>
                <div class="form-group">
                    <label for="orderStatus">Status</label>
                    <select id="orderStatus" required>
                        <option value="Delivered">Delivered</option>
                        <option value="In Delivery">In Delivery</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="orderProduct">Product</label>
                    <select id="orderProduct" required>
                        <option value="Sofas">Sofas</option>
                        <option value="Tables">Tables</option>
                        <option value="Chairs">Chairs</option>
                        <option value="Beds">Beds</option>
                        <option value="Cabinets">Cabinets</option>
                        <option value="Desks">Desks</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="orderAmount">Amount (SAR)</label>
                    <input type="number" id="orderAmount" required>
                </div>
                <button type="submit">Add Order</button>
            </form>
        </div>
    </div>

    <!-- Modal for Adding Products -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Add New Product</h3>
            <form id="addProductForm">
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" id="productName" required>
                </div>
                <div class="form-group">
                    <label for="productPrice">Price (SAR)</label>
                    <input type="number" id="productPrice" required>
                </div>
                <div class="form-group">
                    <label for="productQuantity">Quantity</label>
                    <input type="number" id="productQuantity" required>
                </div>
                <div class="form-group">
                    <label for="productStatus">Status</label>
                    <select id="productStatus" required>
                        <option value="Available">Available</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                </div>
                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Modal for Adding Users -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Add New User</h3>
            <form id="addUserForm">
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" id="userName" required>
                </div>
                <div class="form-group">
                    <label for="userEmail">Email</label>
                    <input type="email" id="userEmail" required>
                </div>
                <div class="form-group">
                    <label for="userRole">Role</label>
                    <select id="userRole" required>
                        <option value="Admin">Admin</option>
                        <option value="Customer">Customer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="userStatus">Status</label>
                    <select id="userStatus" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit">Add User</button>
            </form>
        </div>
    </div>

    <!-- Modal for Adding Inventory -->
    <div id="inventoryModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Add New Inventory Item</h3>
            <form id="addInventoryForm">
                <div class="form-group">
                    <label for="inventoryProduct">Product Name</label>
                    <select id="inventoryProduct" required>
                        <option value="Sofas">Sofas</option>
                        <option value="Tables">Tables</option>
                        <option value="Chairs">Chairs</option>
                        <option value="Beds">Beds</option>
                        <option value="Cabinets">Cabinets</option>
                        <option value="Desks">Desks</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inventoryQuantity">Quantity</label>
                    <input type="number" id="inventoryQuantity" required>
                </div>
                <div class="form-group">
                    <label for="inventoryLocation">Location</label>
                    <input type="text" id="inventoryLocation" required>
                </div>
                <div class="form-group">
                    <label for="inventoryStatus">Status</label>
                    <select id="inventoryStatus" required>
                        <option value="In Stock">In Stock</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                </div>
                <button type="submit">Add Inventory</button>
            </form>
        </div>
    </div>

    <script src="admin.js"></script>
</body>
</html>