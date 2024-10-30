<?php
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }
}

if (isset($_POST['signup'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password == $confirm_password) {
        $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
        if (mysqli_query($conn, $query)) {
            echo "Signup successful!";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest - Neocult Indonesia</title>
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
            top: 50px;
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

        footer {
            background-color: #ffd1dc;
            color: #fff;
            text-align: center;
            padding: 50px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .footer-waves {
            position: absolute;
            top: 0;
            width: 100%;
            height: 50px;
            background: url('path/to/waves.png') repeat-x;
            background-size: cover;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section {
            flex: 1 1 200px;
            margin: 20px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #8B4513;
        }

        .footer-section p,
        .footer-section a {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
        }

        .footer-section a:hover {
            color: #8B4513;
            text-decoration: none;
        }

        .newsletter-form input[type="email"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: calc(100% - 100px);
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .newsletter-form input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #8B4513;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .newsletter-form input[type="submit"]:hover {
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <a href="#" class="icon icon-cart"><i class="bi bi-cart"></i></a>
    </div>
</header>

<section class="products">
    <h1 class="section-title">Clothes Coquette</h1>
    <div class="product-grid">
        <div class="product">
            <a href="PinkCardi.html">
                <img src="images/jw1.png" alt="Product 1">
                <h2>Blossom Dreams</h2>
                <p>Rp 599.000</p>
            </a>
        </div>
        <div class="product">
            <img src="images/jw8.jpg" alt="Product 2">
            <h2>Rosy Whispers</h2>
            <p>$25.00</p>
        </div>
        <div class="product">
            <img src="images/jw6.jpg" alt="Product 3">
            <h2>Blue Serenity</h2>
            <p>$30.00</p>
        </div>
        <div class="product">
            <img src="images/jw4.png" alt="Product 4">
            <h2>Olive Allure</h2>
            <p>$35.00</p>
        </div>
    </div>
</section>

<section class="products">
    <h1 class="section-title">Type Of Skirt</h1>
    <div class="product-grid">
        <div class="product">
            <a href="PinkCardi.html">
                <img src="images/rok1.png" alt="Product 1">
                <h2>Denim Dazzle</h2>
                <p>Rp 599.000</p>
            </a>
        </div>
        <div class="product">
            <img src="images/rok3.png" alt="Product 3">
            <h2>Urban Chic</h2>
            <p>$30.00</p>
        </div>
        <div class="product">
            <img src="images/skirt.jpg" alt="Product 2">
            <h2>Elegance Pleats</h2>
            <p>$25.00</p>
        </div>
        <div class="product">
            <img src="images/rok4.png" alt="Product 4">
            <h2>Ribbon Romance</h2>
            <p>$35.00</p>
        </div>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Chic Collection</h1>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product card">
                <img src="images/bajju1.png" class="card-img-top" alt="Product 1">
                <div class="card-body">
                    <h5 class="card-title">Sophia Ribbon Blouse</h5>
                    <p class="card-text">$20.00</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product card">
                <img src="images/bajju2.png" class="card-img-top" alt="Product 2">
                <div class="card-body">
                    <h5 class="card-title">Graceful Pleated Skirt</h5>
                    <p class="card-text">$25.00</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product card">
                <img src="images/bajju3.png" class="card-img-top" alt="Product 3">
                <div class="card-body">
                    <h5 class="card-title">Sweet Peony Shoes</h5>
                    <p class="card-text">$30.00</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product card">
                <img src="images/bajju4.jpg" class="card-img-top" alt="Product 4">
                <div class="card-body">
                    <h5 class="card-title">Chic Charm Keyring</h5>
                    <p class="card-text">$35.00</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Elegant Blue Styles</h1>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product card">
                <img src="images/BLU1.png" class="card-img-top" alt="Product 1">
                <div class="card-body">
                    <h5 class="card-title">Sophia Ribbon Blouse</h5>
                    <p class="card-text">$20.00</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product card">
                <img src="images/BLU2.png" class="card-img-top" alt="Product 2">
                <div class="card-body">
                    <h5 class="card-title">Graceful Pleated Skirt</h5>
                    <p class="card-text">$25.00</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product card">
                <img src="images/BLUE3.png" class="card-img-top" alt="Product 3">
                <div class="card-body">
                    <h5 class="card-title">Sweet Peony Shoes</h5>
                    <p class="card-text">$30.00</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="product card">
                <img src="images/BLU4.png" class="card-img-top" alt="Product 4">
                <div class="card-body">
                    <h5 class="card-title">Chic Charm Keyring</h5>
                    <p class="card-text">$35.00</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="products">
    <h1 class="section-title">Stylish Statements</h1>
    <div class="product-grid">
        <div class="product">
            <a href="PinkCardi.html">
                <img src="images/NANA1.png" alt="Product 1">
                <h2>Lacy Elegance</h2>
                <p>Rp 599.000</p>
            </a>
        </div>
        <div class="product">
            <img src="images/NANA2.png" alt="Product 2">
            <h2>Playful Purples</h2>
            <p>$25.00</p>
        </div>
        <div class="product">
            <img src="images/NANA3.png" alt="Product 3">
            <h2>Butterfly Nights</h2>
            <p>$30.00</p>
        </div>
        <div class="product">
            <img src="images/NANA4.png" alt="Product 4">
            <h2>Urban Adventurer</h2>
            <p>$35.00</p>
        </div>
    </div>
</section>

<footer>
    <div class="footer-waves"></div>
    <div class="footer-content">
        <div class="footer-section newsletter">
            <h3>Newsletter</h3>
            <p>Subscribe to our newsletter now!</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email">
                <input type="submit" value="GO">
            </form>
        </div>
        <div class="footer-section latest-news">
            <h3>Latest News</h3>
            <p><a href="#">Neocult annual sale</a><br>June 24 2024 - 23:59</p>
            <p><a href="#">Neocult garage sale</a><br>July 3 2024 - 23:59</p>
        </div>
        <div class="footer-section tags">
            <h3>Tags</h3>
            <a href="LATEST.PHP">Latest</a>
            <a href="trend.php">Trendy</a>
            <a href="pakaianklasik.php">Classic Clothes</a>
            <a href="sepatuklasik.php">Classic Shoes</a>
            <a href="aksesoris.php">Accesories</a>
            <a href="grafik.php">Graphics</a>
            <a href="SignUp.html">Sign Up</a>
        </div>
        <div class="footer-section address">
            <h3>Address</h3>
            <p>St. Letjen S. Parman No. 1, Grogol Petamburan, Jakarta Barat</p>
            <p>Email: neocult@gmail.com</p>
            <div class="socials">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-tumblr"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>Clothes . Skirt . Necklace . Bracelet . Shoes</p>
        <p>2024 Neocult. All Rights Reserved.</p>
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
</script>
</body>
</html>
