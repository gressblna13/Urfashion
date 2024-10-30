<?php
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function formatRupiah($angka){
    return 'Rp ' . number_format($angka, 2, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neocult Indonesia - Sepatu Klasik</title>
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
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            margin-top: 3.5rem;
        }
        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: calc(100% - 40px);
            height: calc(100% - 40px);
            object-fit: cover;
            z-index: -1;
            margin: 20px;
            border-radius: 20px;
        }
        .hero-overlay {
            position: absolute;
            top: 20px;
            left: 20px;
            width: calc(100% - 40px);
            height: calc(100% - 40px);
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
            border-radius: 20px;
        }
        .hero-text {
            position: relative;
            z-index: 2;
            color: #fff;
            max-width: 80%;
        }
        .products {
            padding: 50px 20px;
            background: #f9f9f9;
            margin-bottom: 10px;
        }
        .product {
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product img {
            width: 100%;
            border-radius: 10px;
            aspect-ratio: 4 / 5;
            object-fit: cover;
        }
        .product h5 {
            margin: 20px 0 10px;
            font-size: 20px;
        }
        .product p {
            font-size: 18px;
            color: #c9ad93;
        }
        .product:hover {
            transform: translateY(-10px);
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
                        <a class="nav-link" href="grafik.php">GRAPHICS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aksesoris.php">ACCESSORIES</a></li>
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
    <img src="images/bg.jpg" alt="Hero Image" class="hero-image">
    <div class="hero-text">
        <h1>Sepatu Klasik</h1>
        <p>Timeless pieces that never go out of style</p>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Sepatu Pria</h1>
    <div class="row">
        <?php
        $sql = "SELECT * FROM productssepatuklasik WHERE category='men' LIMIT 8";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-3 mb-4">';
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h5>' . $row["name"] . '</h5>';
                echo '<p>' . formatRupiah($row["price"]) . '</p>';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=productssepatuklasik" class="btn btn-primary">Beli Sekarang</a>';
                echo '<i class="bi bi-heart wishlist-icon" data-product-id="' . $row["id"] . '" data-category="productssepatuklasik"></i>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Sepatu Wanita</h1>
    <div class="row">
        <?php
        $sql = "SELECT * FROM productssepatuklasik WHERE category='women' LIMIT 8";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-3 mb-4">';
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h5>' . $row["name"] . '</h5>';
                echo '<p>' . formatRupiah($row["price"]) . '</p>';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=productssepatuklasik" class="btn btn-primary">Beli Sekarang</a>';
                echo '<i class="bi bi-heart wishlist-icon" data-product-id="' . $row["id"] . '" data-category="productssepatuklasik"></i>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</section>

<footer class="mt-4">
    <p>&copy; 2024 Neocult. Semua hak cipta dilindungi.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="wishlist.js"></script>
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
