<?php
session_start();
echo isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0;
?>
