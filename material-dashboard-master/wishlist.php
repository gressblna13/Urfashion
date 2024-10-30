<?php
session_start();
include 'db_connection.php';

// Menangani POST request untuk menambahkan item ke wishlist
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $category = $_POST['category'];

    // Periksa apakah session wishlist sudah ada
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = array();
    }

    // Periksa apakah item sudah ada di wishlist
    if (!in_array($product_id, array_column($_SESSION['wishlist'], 'product_id'))) {
        // Tambahkan ke wishlist session
        $_SESSION['wishlist'][] = array('product_id' => $product_id, 'category' => $category);

        echo "Item berhasil ditambahkan ke wishlist!";
    } else {
        echo "Item sudah ada di wishlist Anda.";
    }
    exit; // Menghentikan eksekusi script lebih lanjut
}
?>
