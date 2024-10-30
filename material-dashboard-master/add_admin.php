<?php
session_start();
include 'config.php';

// Hash password sebelum menyimpannya ke database
$username = 'haechan';
$password = password_hash('pudubear', PASSWORD_DEFAULT);

// Periksa apakah username sudah ada
$query_check = "SELECT * FROM admin WHERE username='$username'";
$result_check = mysqli_query($conn, $query_check);

if (mysqli_num_rows($result_check) == 0) {
    $query_insert = "INSERT INTO admin (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $query_insert)) {
        echo "Admin user 'haechan' berhasil ditambahkan.";
    } else {
        echo "Error: " . $query_insert . "<br>" . mysqli_error($conn);
    }
} else {
    // Jika username sudah ada, langsung masuk ke dashboard
    $_SESSION['admin'] = $username;
    header('Location: index.php');
    exit();
}

mysqli_close($conn);
?>
