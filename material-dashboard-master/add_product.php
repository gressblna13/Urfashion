<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

$message = '';

// Menangani Form Tambah Produk
if (isset($_POST['add_product'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_stock = mysqli_real_escape_string($conn, $_POST['product_stock']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);

    // Menangani unggahan file
    $product_image = $_FILES['product_image']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($product_image);
    move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);

    // Menentukan tabel berdasarkan kategori produk yang dipilih
    $table = '';
    switch ($product_category) {
        case 'prakaianklasik':
            $table = 'products';
            break;
        case 'aksesoris':
            $table = 'productsaksesori';
            break;
        case 'grafik':
            $table = 'productsgrafik';
            break;
        case 'sepatuklasik':
            $table = 'productssepatuklasik';
            break;
        case 'trend':
            $table = 'productstrend';
            break;
        default:
            // Menangani kasus default atau skenario error
            $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Invalid product category selected.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            break;
    }

    // Menambahkan produk ke tabel yang ditentukan
    if ($table) {
        $query = "INSERT INTO $table (name, price, stock, description, category, image) VALUES ('$product_name', '$product_price', '$product_stock', '$product_description', '$product_category', '$product_image')";
        
        if (mysqli_query($conn, $query)) {
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Product added successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        } else {
            $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Error: ' . mysqli_error($conn) . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #bfdfff;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 15px;
            text-align: left;
            display: block;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar .nav-item.active a {
            background: #007bff;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .card-custom {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            color: white;
        }

        .card-bg-primary {
            background-color: #007bff;
        }

        .card-bg-success {
            background-color: #28a745;
        }

        .card-bg-warning {
            background-color: #ffc107;
        }

        .chart-container {
            width: 100%;
            height: 400px;
        }

        h1 {
            color: #F48FB1;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            color: #64B5F6;
        }

        .btn-primary {
            background-color: #F48FB1;
            border-color: #F48FB1;
            width: 100%;
            padding: 10px;
            font-size: 1.2rem;
        }

        .btn-primary:hover {
            background-color: #F06292;
            border-color: #F06292;
        }

        .form-control {
            border-radius: 10px;
            border-color: #64B5F6;
            height: 45px;
            font-size: 1.1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(100, 181, 246, 0.5);
            border-color: #64B5F6;
        }

        textarea.form-control {
            height: auto;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-white">Admin Dashboard</h2>
        <nav class="nav flex-column">
            <div class="nav-item active">
                <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </div>
            <div class="nav-item">
                <a href="#add_product"><i class="fas fa-plus-circle"></i> Add Product</a>
            </div>
            <div class="nav-item">
                <a href="view_orders.php"><i class="fas fa-shopping-cart"></i> View Orders</a>
            </div>
            <div class="nav-item">
                <a href="users.php"><i class="fas fa-users"></i> Users</a>
            </div>
            <div class="nav-item">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
    </div>

    <div class="content">
        <div class="container">
            <div id="add_product" class="container-form">
                <h1>Add Product</h1>
                <?php echo $message; ?>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_price" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="product_price" name="product_price" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_stock" class="form-label">Product Stock</label>
                                <input type="number" class="form-control" id="product_stock" name="product_stock" required>
                            </div>
                            <div class="mb-3">
                                <label for="product_description" class="form-label">Product Description</label>
                                <textarea class="form-control" id="product_description" name="product_description" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="product_category" class="form-label">Product Category</label>
                                <select class="form-control" id="product_category" name="product_category" required>
                                    <option value="products">Pakaian Klasik</option>
                                    <option value="productsaksesoris">Aksesoris</option>
                                    <option value="productsgrafik">Grafik</option>
                                    <option value="productssepatuklasik">Sepatu Klasik</option>
                                    <option value="productstrend">Trend</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="product_image" class="form-label">Product Image</label>
                                <input class="form-control" type="file" id="product_image" name="product_image" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="add_product">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
