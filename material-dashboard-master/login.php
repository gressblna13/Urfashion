<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $username;
            header('Location: index.php');
            exit();
        } else {
            $error_message = "Password salah!";
        }
    } else {
        $error_message = "Username salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            display: flex;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            margin-top: -50px; /* Menambahkan margin negatif untuk menaikkan form */
        }
        .login-form {
            padding: 40px;
            flex: 1;
        }
        .login-info {
            background-color: #dc3545;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex: 1;
        }
        .login-info h1 {
            font-size: 2.5rem;
        }
        .login-info p {
            margin: 20px 0;
        }
        .login-info .logo img {
            width: 80px;
            height: auto;
        }
        .login-form h2 {
            margin-bottom: 30px;
            font-size: 2rem;
        }
        .login-form .form-control {
            margin-bottom: 20px;
            border-radius: 50px;
            padding-left: 45px;
            font-size: 1.2rem;
            height: 50px;
        }
        .login-form .btn-primary {
            background: linear-gradient(135deg, #f8b500 0%, #ffcd3c 100%);
            border: none;
            border-radius: 10px;
            padding: 15px 0;
            font-size: 1.2rem;
            color: white;
            text-transform: uppercase;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .login-form .btn-primary:hover {
            background: linear-gradient(135deg, #ffcd3c 0%, #f8b500 100%);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .login-form .alert {
            margin-bottom: 20px;
            border-radius: 50px;
            font-size: 1rem;
        }
        .login-form .form-group {
            position: relative;
        }
        .login-form .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ced4da;
            font-size: 1.2rem;
            margin-top: -10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2 class="text-center">Login Admin</h2>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <i class="fa fa-user"></i>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="login">SIGN IN</button>
            </form>
        </div>
        <div class="login-info">
            <div class="text-center">
                <div class="logo">
                    <img src="images/logo.jpg" alt="Logo">
                </div>
                <h1>INFINITY</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec neque tortor.</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
