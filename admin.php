<?php
// إعداد الاتصال بقاعدة البيانات
$host = 'localhost';  // أو عنوان الخادم إذا كان مختلفاً
$username = 'root';   // اسم المستخدم لقاعدة البيانات
$password = '';       // كلمة المرور لقاعدة البيانات
$dbname = 'luxe_admin'; // اسم قاعدة البيانات

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إضافة منتج جديد
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productName'])) {
    $name = $_POST['productName'];
    $category = $_POST['productCategory'];
    $price = $_POST['productPrice'];
    $stock = $_POST['productStock'];
    $description = $_POST['productDescription'];
    $image = $_FILES['productImage']['name'];

    if ($image) {
        move_uploaded_file($_FILES['productImage']['tmp_name'], 'uploads/' . $image);
    }

    $sql = "INSERT INTO products (name, category, price, stock, description, image) 
            VALUES ('$name', '$category', '$price', '$stock', '$description', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// تعديل منتج
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editProductId'])) {
    $id = $_POST['editProductId'];
    $name = $_POST['productName'];
    $category = $_POST['productCategory'];
    $price = $_POST['productPrice'];
    $stock = $_POST['productStock'];
    $description = $_POST['productDescription'];
    $image = $_FILES['productImage']['name'];

    if ($image) {
        move_uploaded_file($_FILES['productImage']['tmp_name'], 'uploads/' . $image);
    }

    $sql = "UPDATE products SET 
            name = '$name',
            category = '$category',
            price = '$price',
            stock = '$stock',
            description = '$description',
            image = '$image' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// حذف منتج
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteProductId'])) {
    $productId = $_POST['deleteProductId'];

    $sql = "DELETE FROM products WHERE id = $productId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUXE Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --danger-color: #e74c3c;
            --light-gray: #f5f6fa;
            --dark-gray: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--light-gray);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: var(--dark-gray);
            color: white;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 10px;
        }

        .sidebar-menu a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar-menu a:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .card-title {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
        }

        .card-value {
            font-size: 1.8em;
            font-weight: bold;
            color: var(--dark-gray);
        }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 500px;
        }

        .search-bar input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #34495e;
        }

        .product-table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .product-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table th,
        .product-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .product-table tr:hover {
            background-color: #f8f9fa;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-edit {
            background-color: var(--warning-color);
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .btn-delete {
            background-color: var(--danger-color);
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            border-radius: 10px;
            padding: 20px;
            position: relative;
        }

        .close-modal {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 1.5em;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .form-group textarea {
            height: 100px;
            resize: vertical;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 10px;
            }

            .sidebar-header {
                padding: 10px 0;
            }

            .sidebar-menu span {
                display: none;
            }

            .main-content {
                margin-left: 70px;
            }

            .dashboard-cards {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
    </style>
</head> 
<body>
    <?php include "sidebar.php" ?>

    <div class="main-content">
        <div class="dashboard-cards">
            <div class="card">
                <div class="card-title">Toplam Ürün</div>
                <div class="card-value">124</div>
            </div>
            <div class="card">
                <div class="card-title">Aktif Siparişler</div>
                <div class="card-value">18</div>
            </div>
            <div class="card">
                <div class="card-title">Toplam Müşteri</div>
                <div class="card-value">856</div>
            </div>
            <div class="card">
                <div class="card-title">Aylık Gelir</div>
                <div class="card-value">₺45,250</div>
            </div>
        </div>

        <div class="action-bar">
            <div class="search-bar">
                <input type="text" placeholder="Ürün ara...">
                <button class="btn btn-primary">Ara</button>
            </div>
            <button class="btn btn-primary" onclick="openModal()">
                <i class="fas fa-plus"></i> Yeni Ürün Ekle
            </button>
        </div>

        <div class="product-table">
            <table>
                <thead>
                    <tr>
                        <th>Ürün ID</th>
                        <th>Ürün Adı</th>
                        <th>Kategori</th>
                        <th>Fiyat</th>
                        <th>Stok</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <div class="action-buttons">
                                <button class="btn-edit" onclick="editProduct(1001)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn-delete" onclick="deleteProduct(1001)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- More product rows... -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add/Edit Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Yeni Ürün Ekle</h2>
            <form id="productForm" onsubmit="handleProductSubmit(event)" >
                <div class="form-group">
                    <label for="productName">Ürün Adı</label>
                    <input type="text" id="productName" required>
                </div>
                <div class="form-group">
                    <label for="productCategory">Kategori</label>
                    <input id="productCategory" required>
                </div>
                <div class="form-group">
                    <label for="productPrice">Fiyat (TL)</label>
                    <input type="number" id="productPrice" required min="0">
                </div>
                <div class="form-group">
                    <label for="productStock">Stok Miktarı</label>
                    <input type="number" id="productStock" required min="0">
                </div>
                <div class="form-group">
                    <label for="productDescription">Ürün Açıklaması</label>
                    <textarea id="productDescription"></textarea>
                </div>
                <div class="form-group">
                    <label for="productImage">Ürün Görseli</label>
                    <input type="file" id="productImage" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>
        </div>
    </div>

    <script>
        // Modal functions
        function openModal() {
            document.getElementById('productModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('productModal').style.display = 'none';
        }

        // Edit product
        function editProduct(productId) {
            openModal();
            document.getElementById('modalTitle').textContent = 'Ürün Düzenle';
            // Here you would typically fetch product details and populate the form
        }

        // Delete product
        function deleteProduct(productId) {
            if (confirm('Bu ürünü silmek istediğinizden emin misiniz?')) {
                // Here you would typically make an API call to delete the product
                console.log('Deleting product:', productId);
            }
        }

        // Handle form submission
      function handleProductSubmit(event) {
          event.preventDefault();
          // Here you would typically make an API call to save the product
          const formData = new FormData(event.target);
          console.log('Saving product...');
          closeModal();
      }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('productModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>