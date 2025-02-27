<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products - DRCORA</title>
    <link rel="stylesheet" href="product.css" />
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
    <h2 class="mar">Our Products</h2>
    <div class="img">
    <section class="products">
      
      <div class="product-grid">
        <div class="product-card">
          <img src="imges/wedding chair .jpeg" alt="Product" 
             onmouseover="this.src='imges/wedding chair2.jpeg'" 
          onmouseout="this.src='imges/wedding chair .jpeg'"
          />
          <h3>Wooden Chair</h3>
          <p>$99.99</p>
          <button onclick="addToCart('Wooden Chair', 99.99)">
            Add to Cart
          </button>
        </div>
      </div>

      <div class="product-grid">
        <div class="product-card">
          <img src="imges/sofa.jpeg" alt="product"
                    onmouseover="this.src='imges/sofa 2.jpeg'" 
                 onmouseout="this.src='imges/sofa.jpeg'" >
          <h3>Sofa</h3>
          <p>$49.99</p>
          <button onclick="addToCart('Wooden Chair', 49.99)">
            Add to Cart
          </button>
        </div>
      </div>

      <div class="product-grid">
        <div class="product-card">
          <img src="imges/outdoor.webp" alt="product"
                    onmouseover="this.src='imges/Outdoor Chair 2.jpeg'" 
                 onmouseout="this.src='imges/outdoor.webp'" />
          <h3>Outdoor Chair</h3>
          <p>$69.99</p>
          <button onclick="addToCart('Wooden Chair', 69.99)">
            Add to Cart
          </button>
        </div>
      </div>

      <div class="product-grid">
        <div class="product-card">
        <img src="imges/Coffee Table.jpeg" alt="product"
                    onmouseover="this.src='imges/Coffee Table 2.jpeg'" 
                 onmouseout="this.src='imges/Coffee Table.jpeg'" />
          <h3>Coffee Table</h3>
          <p>$39.99</p>
          <button onclick="addToCart('Wooden Chair', 39.99)">
            Add to Cart
          </button>
        </div>
      </div>

      <div class="product-grid">
        <div class="product-card">
          <img src="imges/Dining Table.jpeg" alt="Product" 
          onmouseover="this.src='imges/Dining Table 2.webp'" 
          onmouseout="this.src='imges/Dining Table.jpeg'" />
          
          <h3>Dining Table</h3>
          <p>$89.99</p>
          <button onclick="addToCart('Wooden Chair', 89.99)">
            Add to Cart
          </button>
        </div>
      </div>

      <div class="product-grid">
        <div class="product-card">
          <img src="imges/Dining Chair.jpeg" alt="Product"
          onmouseover="this.src='imges/Dining Chair 2.webp'" 
          onmouseout="this.src='imges/Dining Chair.jpeg'" />
          
          <h3>Dining Chair</h3>
          <p>$89.99</p>
          <button onclick="addToCart('Wooden Chair', 89.99)">
            Add to Cart
          </button>
        </div>
      </div>
      
      <div class="product-grid">
        <div class="product-card">
          <img src="imges/Office Chair.webp" alt="Product"
          onmouseover="this.src='imges/Office Chair 2.webp'" 
          onmouseout="this.src='imges/Office Chair.webp'" />
          
          <h3>Office Chair</h3>
          <p>$149.99</p>
          <button onclick="addToCart('Wooden Chair', 149.99)">
            Add to Cart
          </button>
        </div>
      </div>
      
      <div class="product-grid">
        <div class="product-card">
          <img src="imges/Bookshelf.webp" alt="Product"
           onmouseover="this.src='imges/Bookshelf 2.jpg'" 
          onmouseout="this.src='imges/Bookshelf.webp'"
          
          />
          <h3>Bookshelf</h3>
          <p>$119.99</p>
          <button onclick="addToCart('Wooden Chair', 119.99)">
            Add to Cart
          </button>
        </div>
      </div>
      
      <div class="product-grid">
        <div class="product-card">
          <img src="imges/Desk Lamp.jpeg" alt="Product" 
           onmouseover="this.src='imges/Desk Lamp 2.jpeg'" 
          onmouseout="this.src='imges/Desk Lamp.jpeg'"
          
          />
          <h3>Desk Lamp</h3>
          <p>$59.99</p>
          <button onclick="addToCart('Wooden Chair', 59.99)">
            Add to Cart
          </button>
        </div>
      </div>
      <div class="product-grid">
        <div class="product-card">
          <img src="imges/Wardrobe1.jpg" alt="Product"
             onmouseover="this.src='imges/Wardrobe 2.jpg'" 
          onmouseout="this.src='imges/Wardrobe1.jpg'"
          />
          <h3>DWardrobe</h3>
          <p>$89.99</p>
          <button onclick="addToCart('Wooden Chair', 89.99)">
            Add to Cart
          </button>
        </div>
     
      </div>
      
      </div>
    </section>

    <script src="script.js"></script>
  </body>
</html>