<?php
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$product = null;
$columns = null;

if (isset($_GET['id']) && isset($_GET['category'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $category = mysqli_real_escape_string($conn, $_GET['category']);

    // Debugging: print the category value
    

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
    } elseif ($category == 'productsgrafik') {  // Ensure this matches your URL parameter
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

$orderProcessed = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $product_id = $product['id'];
    $total_price = $product[$columns['price']] * $quantity;

    $sql = "INSERT INTO orders (product_id, name, address, phone, quantity, total_price) VALUES ('$product_id', '$name', '$address', '$phone', '$quantity', '$total_price')";

    if (mysqli_query($conn, $sql)) {
        $orderProcessed = true;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - <?php echo htmlspecialchars($product[$columns['name']]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Merriweather', serif;
        }

        body {
            line-height: 1.6;
            background-color: #ffe4e1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 100%;
            margin: 20px auto;
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

        header .logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        header .logo img {
            margin-left: 100px;
            width: 100px;
            height: auto;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-grow: 1;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #c9ad93;
        }

        .user-actions {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .user-actions .icon {
            text-decoration: none;
            color: #333;
            font-size: 20px;
            margin-left: 15px;
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
            color: #333;
            font-weight: bold;
            margin-left: 15px;
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

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
            margin-top: auto;
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
                        <a class="nav-link dropdown-toggle" href="pakaianklasik.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            TIMELESS
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="pakaianklasik.php">Classic clothes</a></li>
                            <li><a class="dropdown-item" href="timeless/classic-footwear.html">Classic shoes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aksesoris.php">ACCESSORIES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FOOTWEAR</a>
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

<div class="container">
    <?php if ($orderProcessed) : ?>
        <div class="card mt-5">
            <div class="card-body text-center">
                <h2 class="card-title">Order Berhasil</h2>
                <p>Order berhasil diproses. Terima kasih!</p>
                <a href="uas_manies.php" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        </div>
    <?php else : ?>
        <div class="card mt-5">
            <div class="card-body">
                <h2 class="card-title text-center">Checkout</h2>
                <div class="product-details text-center mb-4">
                    <h3><?php echo htmlspecialchars($product[$columns['name']]); ?></h3>
                    <p>Price: $<?php echo htmlspecialchars($product[$columns['price']]); ?></p>
                </div>
                <form method="post">
                    <div class="form-group mb-3">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Alamat:</label>
                        <input type="text" id="address" name="address" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Telepon:</label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity">Jumlah:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="1" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 Neocult. Semua hak cipta dilindungi.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
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
