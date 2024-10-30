<?php
// Mulai sesi
session_start();

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error_message = '';

// Proses login
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];
        
        // Debugging
        echo "Input Password: " . $password . "<br>";
        echo "Stored Hash: " . $stored_password . "<br>";

        if (password_verify($password, $stored_password)) {
            $_SESSION['username'] = $username;
            header("Location: UAS_MANIES.PHP");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Invalid username.";
    }
}

// Proses signup
if (isset($_POST['signup'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password == $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            echo "Signup successful! Please log in.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        $error_message = "Passwords do not match.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="UAS.CSS">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
/* Custom styles for the login page */
.login-body {
    background-color: #f7f7f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: 'Merriweather', serif;
}

.login-container {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 400px;
    width: 100%;
}

.login-header {
    font-size: 2em;
    font-weight: bold;
    margin-bottom: 10px;
}

.login-subheader {
    font-size: 1.2em;
    margin-bottom: 30px;
    color: #c9ad93;
}

.tab-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.tab {
    cursor: pointer;
    padding: 10px 20px;
    margin: 0 5px;
    border: none;
    background: #f0f0f0;
    font-weight: bold;
    color: #333;
    transition: background 0.3s;
}

.tab.active {
    background: #c9ad93;
    color: #fff;
}

.login-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.login-form button {
    width: 100%;
    padding: 10px;
    background: #c9ad93;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    transition: background 0.3s;
}

.login-form button:hover {
    background: #b08d79;
}

.social-login a {
    font-size: 24px;
    margin: 0 10px;
    color: #333;
    transition: color 0.3s;
}

.social-login a:hover {
    color: #c9ad93;
}

.logo img {
    width: 150px; /* Ubah ukuran sesuai kebutuhan Anda */
    height: auto;
}
</style>
<body class="login-body">
    <div class="login-container">
        <div class="logo">
            <img src="logo.png" alt="#">
        </div>
        <div class="tab-container">
            <button class="tab active" onclick="showTab('login')">Log in</button>
            <button class="tab" onclick="showTab('signup')">Sign up</button>
        </div>
        <?php if ($error_message): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <div id="login" class="login-form">
            <form action="USERS.PHP" method="POST">
                <input type="text" name="username" placeholder="Masukkan email atau nama pengguna" required>
                <input type="password" name="password" placeholder="Kata sandi" required>
                <button type="submit" name="login">Masuk</button>
            </form>
            <a href="#">Lupa kata sandi?</a>
        </div>
        
        <div id="signup" class="login-form" style="display: none;">
            <form action="USERS.PHP" method="POST">
                <input type="email" name="email" placeholder="Masukkan email" required>
                <input type="text" name="username" placeholder="Masukkan nama pengguna" required>
                <input type="password" name="password" placeholder="Kata sandi" required>
                <input type="password" name="confirm_password" placeholder="Konfirmasi Kata Sandi" required>
                <button type="submit" name="signup">Sign up</button>
            </form>
        </div>
        <div class="social-login">
            <a href="#">👤</a>
            <a href="#">🐦</a>
            <a href="#">🅖</a>
        </div>
    </div>

    <script>
        function showTab(tab) {
            document.getElementById('login').style.display = tab === 'login' ? 'block' : 'none';
            document.getElementById('signup').style.display = tab === 'signup' ? 'block' : 'none';
            document.querySelectorAll('.tab').forEach(function(button) {
                button.classList.remove('active');
            });
            document.querySelector('.tab-container .tab[onclick="showTab(\'' + tab + '\')"]').classList.add('active');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
