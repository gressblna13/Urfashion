<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Analytics</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #343a40;
            padding: 20px;
            width: 250px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .sidebar .nav-item.active a {
            background: #007bff;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .navbar {
            margin-left: 250px;
        }

        .card {
            margin: 20px 0;
        }

        .chart-container {
            width: 100%;
            height: 400px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2 class="text-white">Admin Dashboard</h2>
        <nav class="nav flex-column">
            <div class="nav-item">
                <a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            </div>
            <div class="nav-item">
                <a href="users.php"><i class="fas fa-users"></i> Users</a>
            </div>
            <div class="nav-item active">
                <a href="analytics.php"><i class="fas fa-chart-line"></i> Analytics</a>
            </div>
            <div class="nav-item">
                <a href="settings.php"><i class="fas fa-cogs"></i> Settings</a>
            </div>
            <div class="nav-item">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user"></i> Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <h1>Analytics</h1>
        <div class="card">
            <div class="card-header">
                Sales Analytics
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Sales',
                    data: [300, 400, 300, 500, 400, 600],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
