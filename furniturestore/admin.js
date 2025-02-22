// Data Source
let orders = [];
let products = [];
let users = [];
let inventory = [];
let totalSales = 0;

// Chart Initialization
const barCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Sofas', 'Tables', 'Chairs', 'Beds', 'Cabinets', 'Desks'],
        datasets: [{
            label: 'Sales (SAR)',
            data: [0, 0, 0, 0, 0, 0], // Initial data
            backgroundColor: [
                'rgba(139, 115, 85, 0.8)', // Brown
                'rgba(210, 180, 140, 0.8)', // Beige
                'rgba(85, 107, 47, 0.8)', // Olive Green
                'rgba(139, 115, 85, 0.8)', // Brown
                'rgba(210, 180, 140, 0.8)', // Beige
                'rgba(85, 107, 47, 0.8)' // Olive Green
            ],
            borderColor: [
                'rgba(139, 115, 85, 1)', // Brown
                'rgba(210, 180, 140, 1)', // Beige
                'rgba(85, 107, 47, 1)', // Olive Green
                'rgba(139, 115, 85, 1)', // Brown
                'rgba(210, 180, 140, 1)', // Beige
                'rgba(85, 107, 47, 1)' // Olive Green
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(210, 180, 140, 0.2)' // Light grid lines
                },
                ticks: {
                    color: '#5a4a42' // Dark brown text
                },
                title: {
                    display: true,
                    text: 'Total Sales ($)',
                    color: '#5a4a42',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            x: {
                grid: {
                    color: 'rgba(210, 180, 140, 0.2)' // Light grid lines
                },
                ticks: {
                    color: '#5a4a42' // Dark brown text
                },
                title: {
                    display: true,
                    text: 'Product Categories',
                    color: '#5a4a42',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: '#5a4a42' // Dark brown text
                }
            }
        }
    }
});

// Function to Add a New Order
function addOrder(order) {
    orders.push(order);
    totalSales += order.amount;

    // Update Stats
    document.getElementById('totalSales').querySelector('p').textContent = `${totalSales} SAR`;
    document.getElementById('newOrders').querySelector('p').textContent = `${orders.length} Orders`;

    // Update Table
    const tableBody = document.querySelector('#ordersTable tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${order.id}</td>
        <td>${order.user}</td>
        <td>${order.date}</td>
        <td>${order.status}</td>
    `;
    tableBody.appendChild(newRow);

    // Update Chart
    const productIndex = barChart.data.labels.indexOf(order.product);
    if (productIndex !== -1) {
        barChart.data.datasets[0].data[productIndex] += order.amount;
        barChart.update();
    }
}

// Function to Add a New Product
function addProduct(product) {
    products.push(product);

    // Update Stats
    document.getElementById('availableStock').querySelector('p').textContent = `${products.length} Products`;

    // Update Table
    const tableBody = document.querySelector('#productsTable tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${product.name}</td>
        <td>${product.price} SAR</td>
        <td>${product.quantity}</td>
        <td>${product.status}</td>
    `;
    tableBody.appendChild(newRow);
}

// Function to Add a New User
function addUser(user) {
    users.push(user);

    // Update Stats
    document.getElementById('newUsers').querySelector('p').textContent = `${users.length} Users`;

    // Update Table
    const tableBody = document.querySelector('#usersTable tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${user.name}</td>
        <td>${user.email}</td>
        <td>${user.role}</td>
        <td>${user.status}</td>
    `;
    tableBody.appendChild(newRow);
}

// Function to Add a New Inventory Item
function addInventory(item) {
    inventory.push(item);

    // Update Stats
    document.getElementById('availableStock').querySelector('p').textContent = `${inventory.length} Items`;

    // Update Table
    const tableBody = document.querySelector('#inventoryTable tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${item.product}</td>
        <td>${item.quantity}</td>
        <td>${item.location}</td>
        <td>${item.status}</td>
    `;
    tableBody.appendChild(newRow);
}

// Handle Order Form Submission
document.getElementById('addOrderForm').addEventListener('submit', (e) => {
    e.preventDefault();

    const order = {
        id: parseInt(document.getElementById('orderId').value),
        user: document.getElementById('orderUser').value,
        date: document.getElementById('orderDate').value,
        status: document.getElementById('orderStatus').value,
        product: document.getElementById('orderProduct').value,
        amount: parseInt(document.getElementById('orderAmount').value)
    };

    addOrder(order);

    // Reset Form and Close Modal
    document.getElementById('addOrderForm').reset();
    document.getElementById('orderModal').style.display = 'none';
});

// Handle Product Form Submission
document.getElementById('addProductForm').addEventListener('submit', (e) => {
    e.preventDefault();

    const product = {
        name: document.getElementById('productName').value,
        price: parseInt(document.getElementById('productPrice').value),
        quantity: parseInt(document.getElementById('productQuantity').value),
        status: document.getElementById('productStatus').value
    };

    addProduct(product);

    // Reset Form and Close Modal
    document.getElementById('addProductForm').reset();
    document.getElementById('productModal').style.display = 'none';
});

// Handle User Form Submission
document.getElementById('addUserForm').addEventListener('submit', (e) => {
    e.preventDefault();

    const user = {
        name: document.getElementById('userName').value,
        email: document.getElementById('userEmail').value,
        role: document.getElementById('userRole').value,
        status: document.getElementById('userStatus').value
    };

    addUser(user);

    // Reset Form and Close Modal
    document.getElementById('addUserForm').reset();
    document.getElementById('userModal').style.display = 'none';
});

// Handle Inventory Form Submission
document.getElementById('addInventoryForm').addEventListener('submit', (e) => {
    e.preventDefault();

    const item = {
        product: document.getElementById('inventoryProduct').value,
        quantity: parseInt(document.getElementById('inventoryQuantity').value),
        location: document.getElementById('inventoryLocation').value,
        status: document.getElementById('inventoryStatus').value
    };

    addInventory(item);

    // Reset Form and Close Modal
    document.getElementById('addInventoryForm').reset();
    document.getElementById('inventoryModal').style.display = 'none';
});

// Modal Handling
const orderModal = document.getElementById('orderModal');
const productModal = document.getElementById('productModal');
const userModal = document.getElementById('userModal');
const inventoryModal = document.getElementById('inventoryModal');
const closeModals = document.querySelectorAll('.modal .close');

// Show Order Modal when "Manage Orders" is clicked
document.querySelector('[data-section="orders"]').addEventListener('click', (e) => {
    e.preventDefault();
    orderModal.style.display = 'flex';
});

// Show Product Modal when "Manage Products" is clicked
document.querySelector('[data-section="products"]').addEventListener('click', (e) => {
    e.preventDefault();
    productModal.style.display = 'flex';
});

// Show User Modal when "Manage Users" is clicked
document.querySelector('[data-section="users"]').addEventListener('click', (e) => {
    e.preventDefault();
    userModal.style.display = 'flex';
});

// Show Inventory Modal when "Manage Inventory" is clicked
document.querySelector('[data-section="inventory"]').addEventListener('click', (e) => {
    e.preventDefault();
    inventoryModal.style.display = 'flex';
});

// Close Modals when clicking outside the modal or on the close button
closeModals.forEach(close => {
    close.addEventListener('click', () => {
        orderModal.style.display = 'none';
        productModal.style.display = 'none';
        userModal.style.display = 'none';
        inventoryModal.style.display = 'none';
    });
});

window.addEventListener('click', (e) => {
    if (e.target === orderModal || e.target === productModal || e.target === userModal || e.target === inventoryModal) {
        orderModal.style.display = 'none';
        productModal.style.display = 'none';
        userModal.style.display = 'none';
        inventoryModal.style.display = 'none';
    }
});