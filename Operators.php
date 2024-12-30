<?php
/*
$host = 'localhost';  // أو عنوان الخادم إذا كان مختلفاً
$username = 'root';   // اسم المستخدم لقاعدة البيانات
$password = '';       // كلمة المرور لقاعدة البيانات
$dbname = 'luxe_admin'; // اسم قاعدة البيانات

// إنشاء الاتصال
$conn = new mysqli($host, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استلام البيانات من النموذج
    $name = $_POST['productName'];
    $category = $_POST['productCategory'];
    $price = $_POST['productPrice'];
    $stock = $_POST['productStock'];
    $description = $_POST['productDescription'];
    $image = $_FILES['productImage']['name'];

    // رفع الصورة (إذا كانت موجودة)
    if ($image) {
        move_uploaded_file($_FILES['productImage']['tmp_name'], 'uploads/' . $image);
    }

    // إضافة البيانات إلى قاعدة البيانات
    $sql = "INSERT INTO products (name, category, price, stock, description, image) 
            VALUES ('$name', '$category', '$price', '$stock', '$description', '$image')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}



include('db.php');

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>Ürün ID</th><th>Ürün Adı</th><th>Kategori</th><th>Fiyat</th><th>Stok</th><th>Durum</th><th>İşlemler</th></tr>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['category'] . '</td>';
        echo '<td>' . $row['price'] . '</td>';
        echo '<td>' . $row['stock'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '<td>
                <button class="btn-edit" onclick="editProduct(' . $row['id'] . ')">Edit</button>
                <button class="btn-delete" onclick="deleteProduct(' . $row['id'] . ')">Delete</button>
              </td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "No products found!";
}



include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productId'])) {
    // استلام البيانات من النموذج
    $id = $_POST['productId'];
    $name = $_POST['productName'];
    $category = $_POST['productCategory'];
    $price = $_POST['productPrice'];
    $stock = $_POST['productStock'];
    $description = $_POST['productDescription'];
    $image = $_FILES['productImage']['name'];

    // رفع الصورة (إذا كانت موجودة)
    if ($image) {
        move_uploaded_file($_FILES['productImage']['tmp_name'], 'uploads/' . $image);
    }

    // تحديث البيانات في قاعدة البيانات
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




include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteProductId'])) {
    $productId = $_POST['deleteProductId'];

    // حذف المنتج من قاعدة البيانات
    $sql = "DELETE FROM products WHERE id = $productId";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}






*/
?>