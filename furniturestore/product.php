<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products - DRCORA</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <header>
      <nav>
        <h1>DECORA</h1>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="products.html">Products</a></li>
          <li><a href="cart.php">Cart</a></li>
        </ul>
      </nav>
    </header>

    <section class="products">
      <h2>Our Products</h2>
      <div class="product-grid">
        <div class="product-card">
          <img src="imges/product2.jpg" alt="Product" />
          <h3>Wooden Chair</h3>
          <p>$99.99</p>
          <button onclick="addToCart('Wooden Chair', 99.99)">
            Add to Cart
          </button>
        </div>
      </div>
    </section>

    <script src="script.js"></script>
  </body>
</html>
