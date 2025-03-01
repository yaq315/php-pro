<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add') {
        $name = $_POST['name'];
        $price = (float) $_POST['price'];
        $imges = $_POST['imges'];

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['name'] === $name) {
                $item['quantity']++;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = [
                'name' => $name,
                'price' => $price,
                'imges' => $imges,
                'quantity' => 1
            ];
        }

        header('Location: cart.php');
        exit();
    }

    $index = $_POST['index'];
    if (isset($_SESSION['cart'][$index])) {
        if ($_POST['action'] === 'increase') {
            $_SESSION['cart'][$index]['quantity']++;
        } elseif ($_POST['action'] === 'decrease') {
            if ($_SESSION['cart'][$index]['quantity'] === 1) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            } else {
                $_SESSION['cart'][$index]['quantity']--;
            }
        } elseif ($_POST['action'] === 'edit') {
            $newQuantity = (int) $_POST['quantity'];
            if ($newQuantity > 0) {
                $_SESSION['cart'][$index]['quantity'] = $newQuantity;
            } else {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        } elseif ($_POST['action'] === 'delete') {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
    header("Location: cart.php");
    exit();
}

function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - DECORA</title>
    <link rel="stylesheet" href="cart.css">
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <img src="imges/logofurniture.png" alt="DECORA Logo" />
        </div>
        <ul>
            <li>
                <a href="index.php"><i class="fas fa-home"></i> Home </a>
            </li>
            <li>
                <a href="product.php"><i class="fas fa-couch"></i> Products</a>
            </li>
            <li>
                <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
            </li>
        </ul>
        <a class="small" href="login.php"><i class="fas fa-user"></i> Login</a>
    </nav>
</header>

<section class="cart">
    <h2>Your Shopping Cart</h2>
    <div class="cart-items">
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty</p>
        <?php else: ?>
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <div class="cart-item">
                    <img src="<?php echo htmlspecialchars($item['imges']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="100">
                    <div class="item-details">
                        <p><?php echo htmlspecialchars($item['name']); ?></p>
                        <p>$<?php echo number_format($item['price'], 2); ?></p>
                    </div>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="index" value="<?php echo $index; ?>">
                        <button type="submit" name="action" value="decrease">-</button>
                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" style="width: 50px;">
                        <button type="submit" name="action" value="increase">+</button>
                        <button type="submit" name="action" value="edit">Update</button>
                        <button type="submit" name="action" value="delete" class="delete-btn" onclick="return confirmDelete()">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="cart-total">Total: $<?php echo number_format(calculateTotal(), 2); ?></div>
    <div class="checkout">
        <a href="product.php"><button>Checkout</button></a>
    </div>
</section>
</body>
</html>