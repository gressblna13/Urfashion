<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "uas_manies");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Merriweather', serif;
        }
        body {
            line-height: 1.6;
        }
        header {
            background: #fff;
            padding: 1px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        header .logo img {
            margin-left: 10px;
            width: 100px;
            height: auto;
        }
        .container {
            margin-top: 20px;
        }
        .product {
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .product img {
            width: 100%;
            border-radius: 10px;
            aspect-ratio: 4 / 5;
            object-fit: cover;
        }
        .product h5 {
            margin: 20px 0 10px;
            font-size: 20px;
        }
        .product p {
            font-size: 18px;
            color: #c9ad93;
        }
        .product:hover {
            transform: translateY(-10px);
        }
        .remove-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: #dc3545;
            cursor: pointer;
        }
        .btn-primary, .btn-danger {
            margin: 5px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <a href="uas_manies.php">
            <img src="images/logo.png" alt="MyBrand Logo">
        </a>
    </div>
</header>

<div class="container">
    <h1 class="my-5">Wishlist Saya</h1>
    <div class="row">
        <?php
        if (isset($_SESSION['wishlist']) && !empty($_SESSION['wishlist'])) {
            $wishlist = $_SESSION['wishlist'];

            foreach ($wishlist as $item) {
                if (is_string($item) && strpos($item, '-') !== false) {
                    // Memisahkan item untuk mendapatkan id dan kategori
                    list($product_id, $category) = explode('-', $item);

                    // Menentukan tabel berdasarkan kategori
                    if ($category == 'trend') {
                        $table = 'productstrend';
                    } elseif ($category == 'productssepatuklasik') {
                        $table = 'productssepatuklasik';
                    } else {
                        continue; // Lewati jika kategori tidak dikenali
                    }

                    // Mengambil detail produk dari tabel yang sesuai
                    $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
                    $stmt->bind_param("i", $product_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-3 mb-4">';
                        echo '<div class="product">';
                        echo '<i class="fas fa-trash remove-icon" data-product-id="' . $row["id"] . '" data-category="' . $category . '"></i>';
                        echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                        echo '<h5>' . $row["name"] . '</h5>';
                        echo '<p>$' . $row["price"] . '</p>';
                        echo '<a href="beli.php?id=' . $row["id"] . '&category=' . $category . '" class="btn btn-primary">Beli Sekarang</a>';
                        echo '</div>';
                        echo '</div>';
                    }

                    $stmt->close();
                }
            }
        } else {
            echo '<p>Wishlist Anda kosong.</p>';
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('.remove-icon').on('click', function() {
            var productId = $(this).data('product-id');
            var category = $(this).data('category');
            var removeItem = productId + '-' + category;

            // Menghapus item dari session wishlist
            $.post('remove_from_wishlist.php', { item: removeItem }, function(response) {
                alert(response);
                location.reload(); // Memuat ulang halaman setelah penghapusan
            });
        });
    });
</script>
</body>
</html>

<?php
$conn->close();
?>
