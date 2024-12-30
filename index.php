<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --accent-color: #3498db;
            --text-color: #333;
            --light-gray: #f5f6fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .top-bar {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 0;
            font-size: 0.9em;
            text-align: center;
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            background: white;
        }

        .logo {
            font-size: 1.8em;
            font-weight: bold;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--secondary-color);
        }

        .header-icons {
            display: flex;
            gap: 20px;
        }

        .header-icons i {
            font-size: 1.2em;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .header-icons i:hover {
            color: var(--secondary-color);
        }

        /* Hero Section */
        .hero {
            margin-top: 120px;
            padding: 60px 5%;
            text-align: center;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/api/placeholder/1920/600');
            background-size: cover;
            color: white;
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .hero h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #c0392b;
        }

        /* Products Section */
        .products {
            padding: 60px 5%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 2em;
            color: var(--primary-color);
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            padding: 20px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            position: relative;
            overflow: hidden;
            padding-top: 100%;
        }

        .product-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
        }

        .product-info h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .product-price {
            color: var(--secondary-color);
            font-size: 1.2em;
            font-weight: bold;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .add-to-cart {
            padding: 8px 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-to-cart:hover {
            background-color: var(--secondary-color);
        }

        /* Footer */
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 60px 5% 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        .footer-section p {
            margin-bottom: 10px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links i {
            font-size: 1.5em;
            transition: color 0.3s ease;
        }

        .social-links i:hover {
            color: var(--secondary-color);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2em;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        /* Search Field Styles */
        .search-form {
            display: flex;
            align-items: center;
            background-color: var(--light-gray);
            border-radius: 5px;
            padding: 5px;
        }

        .search-input {
            border: none;
            padding: 8px;
            font-size: 1em;
            border-radius: 5px;
            outline: none;
            width: 200px;
        }

        .search-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-button i {
            font-size: 1.2em;
        }

        .search-button:hover {
            background-color: var(--secondary-color);
        }

    </style>
</head>
<body>
    <header class="header">
        <div class="main-header">
            <div class="logo">MUT</div>
            <nav class="nav-links">
                <a href="#home">Ana Sayfa</a>
                <a href="#products">Ürünler</a>
                <a href="#about">Hakkımızda</a>
                <a href="#contact">İletişim</a>
                <a href="pas.html">Admin</a>
            </nav>
            <div class="header-icons">
                <form class="search-form">
                    <input type="text" id="searchInput" placeholder="Ürün Ara..." class="search-input" onkeyup="searchProducts()">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </form>
                <i class="fas fa-user"></i>
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </header>
      
    <section class="hero" id="home">
        <h1>Ürünlerimize Göz Atın</h1>
        <p>Kaliteli ve güvenilir ürünler sizleri bekliyor.</p>
        <a href="#products" class="cta-button">Şimdi Alışverişe Başla</a>
    </section>

    <section class="products" id="products">
        <div class="section-title">
            <h2>Popüler Ürünler</h2>
        </div>   
        <div class="product-grid" id="productGrid">
          
          <?php
                include 'conn.php';
                $urunler = $conn->query("SELECT * FROM urunler");
                while($row = $urunler->fetch_assoc()) {
                    ?>
                        <div class="product-card" data-name="<?php echo $row['name']; ?>">
                            <div class="product-image">
                                <img src="uploads/images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                            </div>
                            <div class="product-info">
                                <h3><?php echo $row['name']; ?></h3>
                                <p><?php echo $row['description']; ?></p>
                                <div class="product-price">₺<?php echo $row['price']; ?></div>
                            </div>
                            <div class="product-actions">
                                <button class="add-to-cart">Sepete Ekle</button>
                            </div> 
                        </div>
            <?php
                }
            ?>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Hakkımızda</h3>
                <p>Bizimle iletişime geçin ve en iyi alışveriş deneyimini yaşayın!</p>
            </div>
            <div class="footer-section">
                <h3>Sosyal Medya</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 MUT. Tüm hakları saklıdır.</p>
        </div>
    </footer>

    <script>
        function searchProducts() {
            let input = document.getElementById('searchInput').value.toLowerCase();
            let products = document.querySelectorAll('.product-card');
            products.forEach(function(product) {
                let productName = product.getAttribute('data-name').toLowerCase();
                if (productName.includes(input)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
