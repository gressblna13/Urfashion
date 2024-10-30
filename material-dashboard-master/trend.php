<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neocult Indonesia - Trendy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    
        <style>
  * {
      font-family: 'Merriweather', serif;
  }

  body {
      line-height: 1.6;
  }

  header {
      background: #fff;
      padding: 10px 0;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 1000;
  }

  header .logo img {
      margin-left: 10px;
      width: 100px;
      height: auto;
  }

  nav {
      background: #fff;
      flex-grow: 1;
  }

  nav ul {
      list-style: none;
      display: flex;
      justify-content: center;
      padding-left: 0;
  }

  nav ul li {
      margin: 0 10px;
      position: relative;
  }

  nav ul li a {
      text-decoration: none;
      color: #8B4513;
      font-weight: bold;
      transition: color 0.3s;
  }

  nav ul li a:hover {
      color: #c9ad93;
  }

  .user-actions {
      display: flex;
      align-items: center;
      margin-right: 50px;
  }

  .user-actions .icon {
      text-decoration: none;
      color: #8B4513;
      font-size: 20px;
      margin-left: 20px;
      transition: color 0.3s;
  }

  .user-actions .icon:hover {
      color: #c9ad93;
  }

  .user-actions .cart-count {
      background: #c9ad93;
      color: #fff;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 14px;
      vertical-align: top;
      margin-left: 5px;
  }

  .navbar-brand img {
      width: 100px;
      height: auto;
  }

  .hero {
      position: relative;
      height: 50vh;
      overflow: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
      background: url('images/bg.jpg') no-repeat center center/cover;
      animation: fadeIn 2s ease-in-out;
  }

  .hero-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1;
  }

  .hero-text {
      position: relative;
      z-index: 2;
      color: #fff;
      max-width: 80%;
      text-align: center;
  }

  @keyframes fadeIn {
      0% {
          opacity: 0;
      }

      100% {
          opacity: 1;
      }
  }

  .shop-now {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      color: #fff;
      background-color: #333;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
  }

  .shop-now:hover {
      background: #b08d79;
  }

  .products {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
  }

  .section-title {
      font-size: 2rem;
      color: #333;
      margin-bottom: 0;
      text-align: center;
      position: relative;
  }

  .section-paragraph {
      font-size: 1.5rem;
      color: #333;
      text-align: center;
      margin-top: 5px;
      margin-bottom: 5px;
  }

  .section-title::after {
      content: '';
      width: 60px;
      height: 4px;
      background: #333;
      display: block;
      margin: 10px auto;
      border-radius: 2px;
  }

  .product-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      width: 100%;
      max-width: 1200px;
  }

  .product {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      padding: 20px;
      transition: transform 0.3s ease;
      position: relative;
  }

  .product:hover {
      transform: scale(1.05);
  }

  .product img {
      max-width: 100%;
      border-bottom: 1px solid #eee;
      margin-bottom: 20px;
  }

  .product h2 {
      font-size: 1.25rem;
      color: #333;
      margin: 10px 0;
  }

  .product p {
      color: #777;
      font-size: 1rem;
      margin: 10px 0;
  }

  .product a {
      text-decoration: none;
      color: inherit;
  }

  .product a:hover h2,
  .product a:hover p {
      color: #000;
  }

  .btn {
      display: inline-block;
      padding: 10px 20px;
      color: #fff;
      background-color: #67a3d9;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
  }

  .btn:hover {
      background: #b08d79;
  }

  .wishlist-icon {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      color: #ccc;
      cursor: pointer;
      transition: color 0.3s;
  }

  .wishlist-icon.active {
      color: #b0c4de;
  }

  footer {
      background: #333;
      color: #fff;
      text-align: center;
      padding: 10px 0;
      position: relative;
      bottom: 0;
      width: 100%;
  }

  .search-form {
      display: none;
      position: absolute;
      top: 90px;
      right: 20px;
      background-color: #fff;
      padding: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 4px;
      z-index: 1000;
  }

  .search-form form {
      display: flex;
      align-items: center;
  }

  .search-form input[type="text"] {
      flex: 1;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 5px;
  }

  .search-form button {
      background-color: #8B4513;
      color: #fff;
      border: none;
      padding: 8px 12px;
      border-radius: 4px;
      cursor: pointer;
  }

  .search-form button:hover {
      background-color: #c9ad93;
  }

</style>
    
</head>

<body>

<header>
    <div class="logo">
        <a href="uas_manies.php">
            <img src="images/logo.png" alt="MyBrand Logo">
        </a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="LATEST.PHP">LATEST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trend.php">TRENDY</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="pakaianklasik.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            TIMELESS
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="pakaianklasik.php">Classic clothes</a></li>
                            <li><a class="dropdown-item" href="sepatuklasik.php">Classic shoes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aksesoris.php">ACCESSORIES</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="grafik.php">GRAPHICS</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="user-actions">
        <a href="#" class="icon search" onclick="toggleSearchForm()"><i class="bi bi-search"></i></a>
        <div id="searchForm" class="search-form">
            <form id="searchForm" onsubmit="search(event)">
                <input type="text" name="query" id="searchInput" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <a href="wishlist_page.php" class="icon"><i class="bi bi-heart"></i> <span id="wishlist-count"><?php echo isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0; ?></span></a>
        <a href="USERS.PHP" class="icon"><i class="bi bi-person"></i></a>
        <a href="#" class="icon icon-cart"><i class="bi bi-cart"></i></a>
    </div>
</header>

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1>TRENDY</h1>
        <p>TRENDS IN FALL 24 FROM NEOCULT</p>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">FALL 24 MAN COLLECTION</h1>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM productstrend WHERE category='trend' AND gender='man' LIMIT 8";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>$' . $row["price"] . '</p>';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=trend" class="btn btn-primary">Beli Sekarang</a>';
                echo '<i class="bi bi-heart wishlist-icon" data-product-id="' . $row["id"] . '" data-category="trend"></i>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">FALL 24 WOMEN COLLECTION</h1>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM productstrend WHERE category='trend' AND gender='woman' LIMIT 8";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>$' . $row["price"] . '</p>';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=trend" class="btn btn-primary">Beli Sekarang</a>';
                echo '<i class="bi bi-heart wishlist-icon" data-product-id="' . $row["id"] . '" data-category="trend"></i>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</section>

<!-- Footer -->
<footer class="text-center" style="background-color:#b6dcec;">
    <div class="container p-4">
        <section class="mb-4">
            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
        </section>

        <section class="">
            <form action="">
                <div class="row d-flex justify-content-center">
                    <div class="col-auto">
                        <p class="pt-2">
                            <strong>Sign up for our newsletter</strong>
                        </p>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="form-outline mb-4">
                            <input type="email" id="form5Example2" class="form-control" />
                            <label class="form-label" for="form5Example2">Email address</label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-4">
                            Subscribe
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <section class="mb-4">
            <p>
                Fashion and accessories are essential aspects of self-expression and individual appearance. Fashion encompasses clothing styles and trends popular at a given time,
                while accessories such as shoes, bags, and jewelry provide personal touches that enrich one's appearance.
                The evolution of fashion and accessories is influenced by cultural, social, and economic factors,
                reflecting the values and identities of societies worldwide. The fashion and accessories industry plays a significant role in the global economy,
                involving the design, production, and marketing of products to meet diverse consumer needs and preferences.
            </p>
        </section>
    </div>

    <div class="container p-4">
        <section class="">
            <div class="row">
                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                    <div class="bg-image hover-overlay shadow-1-strong rounded" data-mdb-ripple-color="light">
                        <img src="images/gu6.jpg" class="w-100" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                    <div class="bg-image hover-overlay shadow-1-strong rounded" data-mdb-ripple-color="light">
                        <img src="images/gu1.jpg" class="w-100" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                    <div class="bg-image hover-overlay shadow-1-strong rounded" data-mdb-ripple-color="light">
                        <img src="images/gu5.jpg" class="w-100" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                    <div class="bg-image hover-overlay shadow-1-strong rounded" data-mdb-ripple-color="light">
                        <img src="images/gu3.jpg" class="w-100" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                    <div class="bg-image hover-overlay shadow-1-strong rounded" data-mdb-ripple-color="light">
                        <img src="images/gu4.jpg" class="w-100" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                    <div class="bg-image hover-overlay shadow-1-strong rounded" data-mdb-ripple-color="light">
                        <img src="images/gu2.jpg" class="w-100" />
                        <a href="#!">
                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright:
        <a class="text-dark" href="UAS_MANIES.PHP">NEOcult.com</a>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
    function toggleSearchForm() {
        const searchForm = document.getElementById('searchForm');
        if (searchForm.style.display === 'none' || searchForm.style.display === '') {
            searchForm.style.display = 'block';
        } else {
            searchForm.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const wishlistIcons = document.querySelectorAll('.wishlist-icon');

        wishlistIcons.forEach(function(icon) {
            icon.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const category = this.getAttribute('data-category');
                const userId = 1;

                fetch('wishlist.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'user_id=' + userId + '&product_id=' + productId + '&category=' + category,
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    this.classList.toggle('active');
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
</body>
</html>
