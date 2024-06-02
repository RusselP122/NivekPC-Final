<?php
include_once "include/conn.php";

// Pagination variables
$limit = 12;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Default SQL query to fetch all products
$sql = "SELECT * FROM products";

// Check if a search term is provided
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    // Append a WHERE clause to filter products by name or description
    $sql .= " WHERE product_name LIKE '%$search%' OR description LIKE '%$search%'";
}

// Check if a category is selected
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = $_GET['category'];
    // Append a WHERE clause to filter products by category
    if ($category !== 'ALL') {
        if (strpos($sql, 'WHERE') !== false) {
            $sql .= " AND category = '$category'";
        } else {
            $sql .= " WHERE category = '$category'";
        }
    }
}

// Add pagination clauses to the SQL query
$sql .= " LIMIT $limit OFFSET $offset";

// Execute the SQL query
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count total products (without pagination)
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();

// Calculate total pages
$total_pages = ceil($total_products / $limit);

// Filter function
function filterProduct($category)
{
    // Implement your filter logic here
    // For demonstration purposes, you can just reload the page with a query parameter indicating the selected category
    header("Location: shop.php?category=$category");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-icons/font/bootstrap-icons.css">
    <title>Nivek PC</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'include/navbar.php'; ?>
    

    <style> 
    #pagination {
    margin-top: 50px; 
  }

  #pagination a {
      margin-right: 5px; 
      text-decoration: none;
      color: #333; 
      padding: 5px 10px; 
      border: 1px solid #ccc; 
      border-radius: 5px; 
  }

  #pagination a:hover {
      background-color: #f0f0f0; 
  }

  #pagination a.active {
      background-color: #6759ff;
      color: #ffffff;
  }

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    border: none;
    outline: none;
    font-family: "Poppins", sans-serif;
  }
  .wrapper {
    width: 95%;
    margin: 0 auto;
  }
  #search-container {
    margin: 1em 0;
  }
  #search-container input {
    background-color: transparent;
    width: 40%;
    border-bottom: 2px solid #110f29;
    padding: 1em 0.3em;
    color: white;
  }
  #search-container input:focus {
    border-bottom-color: #6759ff;
  }
  #search-container button {
    padding: 1em 2em;
    margin-left: 1em;
    background-color: #6759ff;
    color: #ffffff;
    border-radius: 5px;
    margin-top: 0.5em;
    cursor: pointer;
  }
  .button-value {
    border: 2px solid #6759ff;
    padding: 1em 2.2em;
    border-radius: 3em;
    background-color: transparent;
    color: #6759ff;
    cursor: pointer;
  }

  #products {
    display: grid;
    grid-template-columns: auto auto auto;
    grid-column-gap: 1.5em;
    padding: 2em 0;
  }
  .card {
    background-color: #ffffff;
    max-width: 18em;
    margin-top: 1em;
    padding: 1em;
    border-radius: 5px;
    box-shadow: 1em 2em 2.5em rgba(1, 2, 68, 0.08);
  }
  .image-container {
    text-align: center;
  }
  img {
    max-width: 100%;
    object-fit: contain;
  }
  .container {
    padding-top: 1em;
    color: #110f29;
  }
  .container h5 {
    font-weight: 500;
  }
  .hide {
    display: none;  
  }
  @media screen and (max-width: 720px) {
    img {
      max-width: 100%;
      object-fit: contain;
      height: 10em;
    }
    .card {
      max-width: 10em;
      margin-top: 1em;
    }
    #products {
      grid-template-columns: auto auto;
      grid-column-gap: 1em;
    }
  }


</style>

</head>
<body>
    
   
<div class="wrapper">
        <div id="search-container">
            <form action="shop.php" method="GET">
                <input type="search" name="search" id="search-input" placeholder="Search product name here.." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" id="search">Search</button>
            </form>
        </div>
        <div id="buttons">
            <button class="button-value" onclick="filterProduct('ALL')">All</button>
            <button class="button-value" onclick="filterProduct('RAM')">RAM</button>
            <button class="button-value" onclick="filterProduct('CPU')">CPU</button>
            <button class="button-value" onclick="filterProduct('PC CASE')">PC CASE</button>
            <button class="button-value" onclick="filterProduct('GPU')">GPU</button>
            <button class="button-value" onclick="filterProduct('Motherboard')">Motherboard</button>
            <button class="button-value" onclick="filterProduct('PSU')">PSU</button>
            <button class="button-value" onclick="filterProduct('Fans')">Fans</button>
            <button class="button-value" onclick="filterProduct('Storage')">Storage</button>
        </div>
      <div id="products"></div>
    </div>

    <section id="product1" class="section-p1">
    <div class="pro-container">
        <?php foreach ($products as $product) : ?>
            <div class="pro">
                <img src="shop_product/<?php echo $product['product_img']; ?>" alt="">
                <div class="des">
                    <span><?php echo $product['product_name']; ?></span>
                    
                    <?php
                    // Truncate description to 50 words and add ellipsis if longer
                    $description_words = explode(' ', $product['description']);
                    $short_description = implode(' ', array_slice($description_words, 0, 50));
                    if (count($description_words) > 50) {
                        $short_description .= '...';
                    }
                    ?>
                    
                    <h5><?php echo $short_description; ?></h5>
                    
                    <div class="star">
                        <?php for ($i = 0; $i < 5; $i++) : ?>
                            <i class="fa fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <h4> ₱ <?php echo $product['product_price']; ?></h4>
                </div>
                <a href="sproduct.php?id=<?php echo $product['product_id']; ?>"><i class="bi-cart-plus cart"></i></a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

    
<section id="pagination" class="section-p1" style="display: <?php echo (isset($_GET['category']) ? 'none' : 'block'); ?>">
<?php
        if ($page > 1) {
            echo '<a href="shop.php?page=' . ($page - 1) . (isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '') . '"><i class="fa-solid fa-arrow-left"></i></a>';
        }

        // Generate pagination links
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? 'active' : '';
            echo '<a href="shop.php?page=' . $i . (isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '') . '" class="' . $active_class . '">' . $i . '</a>';
        }

        if ($page < $total_pages) {
            echo '<a href="shop.php?page=' . ($page + 1) . (isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '') . '"><i class="fa-solid fa-arrow-right"></i></a>';
        }
        ?>
</section>


    <section id="newsletter" class="section-p1 section-m2">
        <div class="newstext">
            <h4>Sign Up For Updates</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span>
            </p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div> 
    </section> 


    <?php include 'include/footer.php'; ?>
    <script src="script.js"></SCript>

    <script>
    function filterProduct(category) {
        var pagination = document.getElementById('pagination');
        if (pagination) {
            pagination.style.display = 'none';
        }

        if (category === 'ALL') {
            window.location.href = 'shop.php';
        } else {
            window.location.href = 'shop.php?category=' + category; 
        }
    }
    </script>

</body>
</html> 