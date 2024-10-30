<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neocult Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        * {
            font-family: 'Merriweather', serif;
        }

        body {
            line-height: 1.6;
            background-color: #f9f9f9;
        }

        header {
            background: #fff;
            padding: 10px 0;
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

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            padding-left: 0;
        }

        nav ul li {
            margin: 0 10px;
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: #8B4513;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #c9ad93;
        }

        nav ul li .dropdown-menu {
            background-color: #fff;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            padding: 10px;
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 2000;
        }

        nav ul li:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #ffd1dc;
            color: #a2c4c9;
            border-radius: 4px;
        }

        .user-actions {
            display: flex;
            align-items: center;
            margin-right: 50px;
        }

        .user-actions .icon {
            text-decoration: none;
            color: #8B4513;
            font-size: 20px;
            margin-left: 20px;
            transition: color 0.3s;
        }

        .user-actions .icon:hover {
            color: #c9ad93;
        }

        .user-actions .icon-cart {
            color: #8B4513;
        }

        .user-actions .sign-in {
            text-decoration: none;
            color: #8B4513;
            font-weight: bold;
            margin-left: 20px;
            transition: color 0.3s;
        }

        .user-actions .sign-in:hover {
            color: #c9ad93;
        }

        .user-actions .cart-count {
            background: #ffd1dc;
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 14px;
            vertical-align: top;
            margin-left: 5px;
        }

        .navbar-brand img {
            width: 100px;
            height: auto;
        }

        .hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            margin-top: 3.5rem;
        }

        .hero-image {
            position: absolute;
            top: 0;
            left: 0;
            width: calc(100% - 40px);
            height: calc(100% - 40px);
            object-fit: cover;
            z-index: -1;
            margin: 20px;
            border-radius: 20px;
        }

        .hero-overlay {
            position: absolute;
            top: 20px;
            left: 20px;
            width: calc(100% - 40px);
            height: calc(100% - 40px);
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
            border-radius: 20px;
        }

        .hero-text {
            position: relative;
            z-index: 2;
            color: #fff;
            max-width: 80%;
        }

        .products {
            padding: 50px 20px;
            background: #f9f9f9;
            margin-bottom: 10px;
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

        /* Styling for Footer */
        .footer {
            background-color: #f3e7e9;
            padding: 60px 0;
            position: relative;
        }

        .footer:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background-color: #b8d8d8;
            clip-path: polygon(0 50%, 100% 0, 100% 100%, 0 100%);
        }

        .footer .footer-top {
            padding-bottom: 20px;
        }

        .footer .footer-about {
            color: #333;
        }

        .footer .footer-about .sitename {
            color: #e7467f;
            font-weight: 700;
            font-size: 24px;
        }

        .footer p {
            color: #666;
            line-height: 1.8;
        }

        .footer .social-links a {
            color: #333;
            font-size: 18px;
            margin-right: 10px;
        }

        .footer .social-links a:hover {
            color: #e7467f;
        }

        .footer .footer-links h4,
        .footer .footer-contact h4 {
            color: #333;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .footer .footer-links ul,
        .footer .footer-contact p {
            color: #666;
        }

        .footer .footer-links ul li,
        .footer .footer-contact p {
            margin-bottom: 10px;
        }

        .footer .footer-contact strong {
            color: #333;
        }

        .footer .credits {
            color: #666;
            margin-top: 20px;
        }

        .footer .credits a {
            color: #333;
            font-weight: 600;
        }

        .footer .credits a:hover {
            color: #e7467f;
        }

        .footer{
    background-color: #add8e6 ;/* Warna biru pastel menggunakan kode hex */

    
    padding: 20px; 
/* Menambahkan jarak dari bagian isi footer */
        }

        .socials a {
            display: inline-block;
            margin: 10px;
            color: #8B4513;
            font-size: 20px;
        }

        .socials a:hover {
            color: #c9ad93;
        }

        .shadow-link {
            display: inline-block;
            padding: 5px 10px;
            background-color: #67A3D9;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .shadow-link:hover {
            background-color: #5b92c2;
            color: white;
        }

        .search-form {
            display: none;
            position: absolute;
            top: 50px;
            right: 50px;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            z-index: 1000;
        }

        .search-form form {
            display: flex;
            align-items: center;
        }

        .search-form input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 5px;
        }

        .search-form button {
            background-color: #8B4513;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #c9ad93;
        }

        /* Styling for Work Collection section */
        #work {
            padding: 80px 0;
            background-color: #f8f8f8;
        }

        #work .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        #work .section-title h2 {
            font-size: 36px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        #work .section-title p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        #work .work-thumb {
            position: relative;
            overflow: hidden;
        }

        #work .work-thumb img {
            width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        #work .work-thumb:hover img {
            transform: scale(1.1);
        }

        #work .work-thumb a {
            display: block;
        }

        #work h4 {
            margin-top: 20px;
            font-size: 20px;
            font-weight: 600;
            color: #333;
            text-align: center;
        }

        /* Animation using Animate.css */
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        /* Custom animation delays */
        .animated:nth-child(odd) {
            animation-delay: 0.4s;
        }

        .animated:nth-child(even) {
            animation-delay: 0.6s;
        }

        .section-title {
            font-size: 2.5rem;
            color: #8B4513;
            margin-bottom: 1rem;
        }

        .categories {
            padding: 50px 20px;
            background: #f3e7e9;
            margin-bottom: 10px;
        }

        .categories h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .categories ul {
            list-style: none;
            padding-left: 0;
        }

        .categories ul li {
            margin: 10px 0;
        }

        .categories ul li a {
            text-decoration: none;
            color: #8B4513;
            font-weight: bold;
            transition: color 0.3s;
        }

        .categories ul li a:hover {
            color: #c9ad93;
        }

        .about-us {
            padding: 50px 20px;
            background: #fff;
            margin-bottom: 10px;
        }

        .about-us img {
            width: 100%;
            border-radius: 10px;
            object-fit: cover;
        }

        .about-us .content {
            padding: 20px;
        }

        .about-us .content h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .about-us .content p {
            font-size: 1rem;
            color: #666;
        }
    </style>
</head>

<body>
    <header class="animate__animated animate__fadeInDown">
        <div class="logo">
            <a href="uas_manies.php">
                <img src="images/logo.png" alt="MyBrand Logo">
            </a>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="LATEST.PHP">LATEST</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="trend.php">TRENDY</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="pakaianklasik.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                TIMELESS
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="pakaianklasik.php">Classic clothes</a></li>
                                <li><a class="dropdown-item" href="sepatuklasik.php">Classic shoes</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="grafik.php">GRAPHICS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aksesoris.php">ACCESSORIES</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="user-actions">
            <a href="#" class="icon search" onclick="toggleSearchForm()"><i class="bi bi-search"></i></a>
            <div id="searchForm" class="search-form">
                <form id="searchForm" onsubmit="search(event)">
                    <input type="text" name="query" id="searchInput" placeholder="Search...">
                    <button type="submit">Search</button>
                </form>
            </div>
            <a href="wishlist.php" class="icon"><i class="bi bi-heart"></i></a>
            <a href="USERS.PHP" class="icon"><i class="bi bi-person"></i></a>
            <a href="#" class="icon icon-cart"><i class="bi bi-cart"></i></a>
        </div>
    </header>

    <section class="hero">
        <div class="hero-overlay animate__animated animate__fadeIn"></div>
        <img src="images/bg.jpg" alt="Hero Image" class="hero-image animate__animated animate__zoomIn">
        <div class="hero-text">
            <h1 class="animate__animated animate__fadeInUp">NEOCULT</h1>
            <p class="animate__animated animate__fadeInUp">Minimalist wardrobe you wished for!</p>
            <a href="LATEST.PHP" class="shop-now shadow-link animate__animated animate__fadeInUp">Shop Now</a>
        </div>
    </section>

    <h1 class="section-title text-center mb-5 animate__animated animate__fadeInUp">COLLECTION AT NEOCULT</h1>

    <section class="products container">
        <h3 class="section-title text-left mb-2 animate__animated animate__fadeInUp">OUR TRENDING ITEMS</h3>
        <p class="text-left mb-3"><a href="trend.php" class="shadow-link animate__animated animate__fadeInUp">see other products</a></p>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="product animate__animated animate__fadeInUp">
                    <img src="images/trend6.jpg" alt="Product 1">
                    <h5>Urban Stealth Jacket</h5>
                    <p>$20.00</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="product animate__animated animate__fadeInUp">
                    <img src="images/trend2.jpg" alt="Product 2">
                    <h5>Shadow Racer Jacket</h5>
                    <p>$25.00</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="product animate__animated animate__fadeInUp">
                    <img src="images/trend4.jpg" alt="Product 3">
                    <h5>Classic Denim Jacket</h5>
                    <p>$30.00</p>
                </div>
            </div>
        </div>
    </section>

    <section class="categories container">
        <h3 class="section-title text-left mb-2 animate__animated animate__fadeInUp">CATEGORIES</h3>
        <ul class="list-group animate__animated animate__fadeInUp">
            <li class="list-group-item"><a href="pakaianklasik.php">Classic clothes</a></li>
            <li class="list-group-item"><a href="sepatuklasik.php">Classic shoes</a></li>
            <li class="list-group-item"><a href="aksesoris.php">Accessories</a></li>
        </ul>
    </section>

    <section class="about-us container">
        <div class="row">
            <div class="col-md-6">
                <img src="images/bg.jpg" alt="About Us">
            </div>
            <div class="col-md-6 content">
                <h3>About Us</h3>
                <p>Our collection of stylish and unique pieces are designed to make you stand out. We believe in empowering individuals through fashion and providing high-quality, sustainable clothing options.</p>
            </div>
        </div>
    </section>

    <footer class="bg-light text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-5 col-md-12 mb-4 mb-md-0">
                <a class="d-flex align-items-center mb-3" href="index.html">
                    <span class="sitename">Append</span>
                </a>
                <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
                <div class="social-links">
                    <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                    <a href="@gressblnamunthe" class="me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6 mb-4 mb-md-0">
                <h4 class="mb-4">Useful Links</h4>
                <ul class="list-unstyled">
                    <li><a href="UAS_MANIES.PHP">Home</a></li>
                    <li><a href="UAS_MANIES.HP">About us</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Terms of service</a></li>
                    <li><a href="#">Privacy policy</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6 mb-4 mb-md-0">
                <h4 class="mb-4">Our Services</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Product Management</a></li>
                    <li><a href="#">Marketing</a></li>
                    <li><a href="#">Graphic Design</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-12 text-center text-md-start">
                <h4 class="mb-4">Contact Us</h4>
                <p>Neocult Fashion</p>
                <p>Jakarta Barat Grogol</p>
                <p>United States</p>
                <p class="mb-3"><strong>Phone:</strong> <span>082160697019</span></p>
                <p><strong>Email:</strong> <span>geyesmunthe@gmail.com</span></p>
            </div>
        </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <p>© <span>Copyright</span> <strong class="sitename">Append</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">NeoCult 24 </a>
        </div>
    </div>
</footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="path/to/your/custom/footer.css">

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script>
        function toggleSearchForm() {
            const searchForm = document.getElementById('searchForm');
            if (searchForm.style.display === 'none' || searchForm.style.display === '') {
                searchForm.style.display = 'block';
            } else {
                searchForm.style.display = 'none';
            }
        }
    </script>
</body>

</html>
