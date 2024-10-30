<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Mengambil data untuk dashboard
$user_count_query = "SELECT COUNT(*) as user_count FROM users";
$user_count_result = mysqli_query($conn, $user_count_query);
if (!$user_count_result) {
    die('Error fetching user count: ' . mysqli_error($conn));
}
$user_count = mysqli_fetch_assoc($user_count_result)['user_count'];

$sales_query = "SELECT SUM(total_price) as total_sales FROM orders"; // Menggunakan kolom total_price
$sales_result = mysqli_query($conn, $sales_query);
if (!$sales_result) {
    die('Error fetching total sales: ' . mysqli_error($conn));
}
$total_sales = mysqli_fetch_assoc($sales_result)['total_sales'];

$order_count_query = "SELECT COUNT(*) as order_count FROM orders";
$order_count_result = mysqli_query($conn, $order_count_query);
if (!$order_count_result) {
    die('Error fetching order count: ' . mysqli_error($conn));
}
$order_count = mysqli_fetch_assoc($order_count_result)['order_count'];

// Mengambil data pengguna untuk tabel
$user_data_query = "SELECT id, username, email, role FROM users"; // Menggunakan kolom username, email, dan role
$user_data_result = mysqli_query($conn, $user_data_query);
if (!$user_data_result) {
    die('Error fetching user data: ' . mysqli_error($conn));
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
        footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-3 mb-4">
        <h1>Admin Dashboard</h1>
    </header>
    <div class="sidebar">
        <h2 class="text-white text-center">Admin Dashboard</h2>
        <nav class="nav flex-column">
            <div class="nav-item active">
                <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </div>
            <div class="nav-item">
                <a href="add_product.php"><i class="fas fa-plus-circle"></i> Add Product</a>
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
        <h1 class="mb-4">Dashboard</h1>
        <div class="row mb-4">
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

        <!-- Tabel Pengguna -->
        <h2>User Table</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($user_data_result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($user_data_result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo isset($row['username']) ? $row['username'] : 'N/A'; ?></td>
                                <td><?php echo isset($row['email']) ? $row['email'] : 'N/A'; ?></td>
                                <td><?php echo isset($row['role']) ? $row['role'] : 'N/A'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No results found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
