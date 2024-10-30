<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Memeriksa koneksi ke database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data pengguna
$user_count_query = "SELECT COUNT(*) as user_count FROM users";
$user_count_result = mysqli_query($conn, $user_count_query);
$user_count = $user_count_result ? mysqli_fetch_assoc($user_count_result)['user_count'] : 0;

// Mengambil data penjualan
$sales_query = "SELECT SUM(total) as total_sales FROM orders";
$sales_result = mysqli_query($conn, $sales_query);
$total_sales = $sales_result ? mysqli_fetch_assoc($sales_result)['total_sales'] : 0;

// Mengambil jumlah pesanan
$order_count_query = "SELECT COUNT(*) as order_count FROM orders";
$order_count_result = mysqli_query($conn, $order_count_query);
$order_count = $order_count_result ? mysqli_fetch_assoc($order_count_result)['order_count'] : 0;

// Mengambil data admin
$admin_query = "SELECT * FROM admin WHERE id = ".$_SESSION['admin'];
$admin_result = mysqli_query($conn, $admin_query);
$admin_data = mysqli_fetch_assoc($admin_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #343a40;
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
        .content {
            margin-left: 250px;
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
        .profile-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .profile-card img {
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .table-custom {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-white">Admin Dashboard</h2>
        <nav class="nav flex-column">
            <div class="nav-item active">
                <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </div>
            <div class="nav-item">
                <a href="add_product.php"><i class="fas fa-plus-circle"></i> Add Product</a>
            </div>
            <div class="nav-item">
                <a href="view_orders.php"><i class="fas fa-shopping-cart"></i> View Orders</a>
            </div>
            <div class="nav-item">
                <a href="view_users.php"><i class="fas fa-users"></i> View Users</a>
            </div>
            <div class="nav-item">
                <a href="#"><i class="fas fa-cogs"></i> Settings</a>
            </div>
            <div class="nav-item">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
    </div>

    <div class="content">
        <h1>Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card card-custom card-bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <h4><?php echo $user_count; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom card-bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Sales</h5>
                        <h4>$<?php echo $total_sales; ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom card-bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Orders</h5>
                        <h4><?php echo $order_count; ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="mt-4">Admin Profile</h2>
        <div class="profile-card">
            <img src="images/admin_avatar.png" alt="Admin Avatar" class="img-fluid" width="150">
            <h3><?php echo $admin_data['name']; ?></h3>
            <p><?php echo $admin_data['email']; ?></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
