<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart - DECORA</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <nav>
        <div class="logo">
          <img src="imges/logofurniture.png" alt="DECORA Logo" />
        </div>
        
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="products.html">Products</a></li>
          <li><a href="cart.php">Cart</a></li>
        </ul>
      </nav>
    </header>

    <section class="cart">
      <h2 style="margin-top: 70px">Shopping Cart</h2>
      <div class="cart-items"></div>
      <button onclick="checkout()">Checkout</button>
    </section>

    <script src="script.js"></script>
  </body>
</html>
