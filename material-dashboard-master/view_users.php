<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'config.php';

// Fetch users data
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="nav-item">
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
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </div>
    <div class="content">
        <h1>View Users</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($result) && mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo isset($row['name']) ? $row['name'] : 'N/A'; ?></td>
                                <td><?php echo isset($row['email']) ? $row['email'] : 'N/A'; ?></td>
                                <td><?php echo isset($row['role']) ? $row['role'] : 'N/A'; ?></td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
