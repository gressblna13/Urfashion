<?php
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neocult Indonesia - Graphics</title>
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

        /* Tambahkan style untuk form pencarian */
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
        <a href="#" class="icon icon-cart"><i class="bi bi-cart"></i></a>
    </div>

</header>

<?php
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

function formatRupiah($angka){
    return 'Rp ' . number_format($angka, 2, ',', '.');
}
?>

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1>GRAPHICS</h1>
        <p>Menampilkan Koleksi Grafis Terbaru dari Neocult</p>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">T-Shirts</h1>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM productsgrafik WHERE category='T-Shirt' LIMIT 4";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>' . formatRupiah($row["price"]) . '</p>';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=productsgrafik" class="btn">Beli Sekarang</a>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Hoodies</h1>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM productsgrafik WHERE category='Hoodie' LIMIT 4";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>' . formatRupiah($row["price"]) . '</p>';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=productsgrafik" class="btn">Beli Sekarang</a>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Sweatshirts</h1>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM productsgrafik WHERE category='Sweatshirt' LIMIT 4";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>' . formatRupiah($row["price"]) . '</p>';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=productsgrafik" class="btn">Beli Sekarang</a>';
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</section>

<section class="products container">
    <h1 class="section-title text-center mb-5">Tank Tops</h1>
    <div class="product-grid">
        <?php
        $sql = "SELECT * FROM productsgrafik WHERE category='Tank Top' LIMIT 4";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>' . formatRupiah($row["price"]) . '</p>';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=productsgrafik" class="btn">Beli Sekarang</a>';
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
