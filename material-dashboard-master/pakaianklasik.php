<?php
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function formatRupiah($angka){
    return 'Rp ' . number_format($angka, 2, ',', '.');
}

// Query untuk menampilkan produk dari tabel products
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // Output data dari setiap baris hasil query
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h3>" . $row['product_name'] . "</h3>";
        echo "<p>" . formatRupiah($row['price']) . "</p>";
        echo "<p>" . $row['description'] . "</p>";
        // Tambahkan elemen HTML atau format lain sesuai kebutuhan
        echo "</div>";
    }
} else {
    echo "Tidak ada produk yang ditemukan.";
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neocult Indonesia - Pakaian Klasik</title>
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
            padding: 1px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
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

        nav ul li .dropdown-menu {
            background-color: #fff;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            padding: 10px;
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 2000;
        }

        nav ul li:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #ffd1dc;
            color: #a2c4c9;
            border-radius: 4px;
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

        .user-actions .icon-cart {
            color: #8B4513;
        }

        .user-actions .sign-in {
            text-decoration: none;
            color: #8B4513;
            font-weight: bold;
            margin-left: 20px;
            transition: color 0.3s;
        }

        .user-actions .sign-in:hover {
            color: #c9ad93;
        }

        .user-actions .cart-count {
            background: #ffd1dc;
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
            0% { opacity: 0; }
            100% { opacity: 1; }
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

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .dropdown-menu {
            background-color: #fff;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            padding: 10px;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #ffd1dc;
            color: #a2c4c9;
            border-radius: 4px;
        }

        .search-form {
            display: none;
            position: absolute;
            top: 90px;
            right: 50px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 4px;
            z-index: 1500;
        }

        .search-form input {
            width: 200px;
            padding: 5px;
            margin-right: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-form button {
            padding: 5px 10px;
            border: none;
            background-color: #8B4513;
            color: #fff;
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
                        <a class="nav-link dropdown-toggle" href="timeless.html" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <a href="wishlist.php" class="icon"><i class="bi bi-heart"></i></a>
        <a href="USERS.PHP" class="icon"><i class="bi bi-person"></i></a>
        <a href="cart.php" class="icon icon-cart">
            <i class="bi bi-cart"></i>
            
        </a>
    </div>
</header>

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1>Pakaian Klasik</h1>
        <p>Timeless pieces that never go out of style</p>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Pakaian Klasik</h1>
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $sql = "SELECT * FROM products WHERE category='classic-clothing'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $active = 'active';
                $counter = 0; // Counter untuk menghitung jumlah item dalam satu grup
                while($row = mysqli_fetch_assoc($result)) {
                    if ($counter % 4 == 0) {
                        if ($counter != 0) {
                            echo '</div></div>';
                        }
                        echo '<div class="carousel-item ' . $active . '">';
                        echo '<div class="row">';
                        $active = '';
                    }
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">';
                    echo '<div class="product card">';
                    echo '<img src="images/' . $row["image"] . '" class="card-img-top" alt="' . $row["name"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                    echo '<p class="card-text">' . formatRupiah($row["price"]) . '</p>';
                    echo '<a href="beli.php?id=' . $row['id'] . '&category=classic-clothing" class="btn">Beli Sekarang</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    $counter++; // Increment counter setiap kali item baru ditambahkan
                }
                echo '</div></div>';
            } else {
                echo "0 results";
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>


   <!-- Footer -->
   <footer class=" text-center " style="background-color:#b6dcec;">
  <!-- Grid container -->
  <div class="container p-4">

    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

      <!-- Twitter -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>

      <!-- Google -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>

      <!-- Instagram -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>

      <!-- Linkedin -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
      <!-- Github -->
      <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
    </section>
    <!-- Section: Social media -->


    <!-- Section: Form -->
    <section class="">
      <form action="">
        <!--Grid row-->
        <div class="row d-flex justify-content-center">
          <!--Grid column-->
          <div class="col-auto">
            <p class="pt-2">
              <strong>Sign up for our newsletter</strong>
            </p>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-5 col-12">
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form5Example2" class="form-control" />
              <label class="form-label" for="form5Example2">Email address</label>
            </div>
          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-auto">

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary mb-4">
              Subscribe
            </button>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </form>
    </section>
    <!-- Section: Form -->
    <!-- Section: Text -->
    <section class="mb-4">
      <p>
      Fashion and accessories are essential aspects of self-expression and individual appearance. Fashion encompasses clothing styles and trends popular at a given time, 
      while accessories such as shoes, bags, and jewelry provide personal touches that enrich one's appearance. 
      The evolution of fashion and accessories is influenced by cultural, social, and economic factors, 
      reflecting the values and identities of societies worldwide. The fashion and accessories industry plays a significant role in the global economy, 
      involving the design, production, and marketing of products to meet diverse consumer needs and preferences.      </p>
    </section>
    <!-- Section: Text -->
  </div>
  <!-- Grid container -->
<!-- Grid container -->
<div class="container p-4">
    <!-- Section: Images -->
    <section class="">
      <div class="row">
        <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
          <div data-mdb-ripple-init
            class="bg-image hover-overlay shadow-1-strong rounded"
            data-ripple-color="light"
          >
            <img src="images/gu6.jpg" class="w-100" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
          <div data-mdb-ripple-init
            class="bg-image hover-overlay shadow-1-strong rounded"
            data-ripple-color="light"
          >
            <img src="images/gu1.jpg" class="w-100" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
          <div data-mdb-ripple-init
            class="bg-image hover-overlay shadow-1-strong rounded"
            data-ripple-color="light"
          >
            <img src="images/gu5.jpg" class="w-100" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
          <div data-mdb-ripple-init
            class="bg-image hover-overlay shadow-1-strong rounded"
            data-ripple-color="light"
          >
            <img src="images/gu3.jpg" class="w-100" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
          <div data-mdb-ripple-init
            class="bg-image hover-overlay shadow-1-strong rounded"
            data-ripple-color="light"
          >
            <img src="images/gu4.jpg" class="w-100" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
            </a>
          </div>
        </div>
        <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
          <div data-mdb-ripple-init
            class="bg-image hover-overlay shadow-1-strong rounded"
            data-ripple-color="light"
          >
            <img src="images/gu2.jpg" class="w-100" />
            <a href="#!">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- Section: Images -->
  </div>
  <!-- Grid container -->
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2020 Copyright:
    <a class="text-dark" href="UAS_MANIES.PHP">NEOcult.com</a>
  </div>
  <!-- Copyright -->

</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script>
    function toggleSearchForm() {
        const searchForm = document.getElementById('searchForm');
        if (searchForm.style.display === 'none' || searchForm.style.display === '') {
            searchForm.style.display = 'block';
        } else {
            searchForm.style.display = 'none';
        }
    }
</script>
</body>
</html>
