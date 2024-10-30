<?php
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$product = null;
$columns = null;

if (isset($_GET['id']) && isset($_GET['category'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $category = mysqli_real_escape_string($conn, $_GET['category']);

    // Tentukan tabel dan kolom berdasarkan kategori
    if ($category == 'accessories') {
        $table = 'productsaksesoris';
        $columns = [
            'name' => 'product_name',
            'price' => 'product_price',
            'image' => 'product_image'
        ];
    } elseif ($category == 'classic-clothing') {
        $table = 'products';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image'
        ];
    } elseif ($category == 'trend') {
        $table = 'productstrend';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image'
        ];
    } elseif ($category == 'productssepatuklasik') {
        $table = 'productssepatuklasik';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image'
        ];
    } elseif ($category == 'productsgrafik') {
        $table = 'productsgrafik';
        $columns = [
            'name' => 'name',
            'price' => 'price',
            'image' => 'image'
        ];
    } else {
        echo "Kategori tidak valid.";
        exit;
    }

    $sql = "SELECT * FROM $table WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
} else {
    echo "ID produk atau kategori tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli Sekarang - <?php echo htmlspecialchars($product[$columns['name']]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            color: #000;
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

        .product-details {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 20px;
        }

        .product-details .product-image {
            flex: 1;
            max-width: 400px;
            margin-right: 20px;
        }

        .product-details .product-info {
            flex: 2;
        }

        .product-details img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-details h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        .product-details p {
            font-size: 1.25rem;
            color: #666;
            margin-bottom: 20px;
        }

        .product-details .btn {
            background-color: #c9ad93;
            color: #fff;
            border: none;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .product-details .btn:hover {
            background-color: #a87c67;
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
                            <li><a class="dropdown-item" href="timeless/classic-footwear.html">Classic shoes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">GRAPHICS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aksesoris.php">ACCESSORIES</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="user-actions">
        <a href="#" class="icon search" onclick="toggleSearchForm()"><i class="fas fa-search"></i></a>
        <div id="searchForm" class="search-form">
            <form id="searchForm" onsubmit="search(event)">
                <input type="text" name="query" id="searchInput" placeholder="Search...">
                <button type="submit">Search</button>
            </form>
        </div>
        <a href="USERS.PHP" class="sign-in">SIGN IN</a>
        <a href="#" class="icon-cart"><i class="fas fa-shopping-cart"></i> <span class="cart-count">1</span></a>
    </div>
</header>

<section class="product-details container">
    <div class="product-image">
        <img src="images/<?php echo $product[$columns['image']]; ?>" alt="<?php echo $product[$columns['name']]; ?>">
    </div>
    <div class="product-info">
        <h1><?php echo $product[$columns['name']]; ?></h1>
        <p>Price: $<?php echo $product[$columns['price']]; ?></p>
        <a href="checkout.php?id=<?php echo $product['id']; ?>&category=<?php echo $category; ?>" class="btn">Proceed to Checkout</a>
    </div>
</section>

<footer class="mt-4">
    <p>&copy; 2024 Neocult. Semua hak cipta dilindungi.</p>
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
