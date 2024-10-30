<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="index.php">Dashboard</a>
        <a href="add_product.php">Add Product</a>
        <a href="view_orders.php">View Orders</a>
        <a href="view_users.php">View Users</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <div class="container">
            <h2 class="mt-4">Orders</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($result) && mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo isset($row['order_date']) ? $row['order_date'] : 'N/A'; ?></td>
                                    <td><?php echo isset($row['total']) ? $row['total'] : 'N/A'; ?></td>
                                    <td><?php echo isset($row['status']) ? $row['status'] : 'N/A'; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Tidak ada hasil ditemukan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
