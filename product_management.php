<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
}

/* ADD PRODUCT */
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];
    $category_id = $_POST['category_id'];

    $image = "images/default.jpeg";

    mysqli_query($conn, "
    INSERT INTO products(name,brand,price,stock,image,status,category_id)
    VALUES('$name','$brand','$price','$stock','$image','$status','$category_id')
    ");
}

/* FETCH PRODUCTS */
$result = mysqli_query($conn, "
SELECT products.*, categories.name AS category
FROM products
LEFT JOIN categories ON products.category_id = categories.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>GlowingDiva Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg,#fff0f5,#ffe4ec);
}

/* SIDEBAR */
.sidebar {
    height: 100vh;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.sidebar h5 {
    color: #e91e63;
    font-weight: 700;
}

.sidebar a {
    display: block;
    padding: 10px;
    margin: 8px 0;
    border-radius: 10px;
    color: #444;
    text-decoration: none;
    transition: 0.3s;
}

.sidebar a:hover {
    background: #ffe4ec;
    color: #e91e63;
    transform: translateX(5px);
}

/* MAIN */
.main {
    padding: 30px;
}

/* CARD */
.card-box {
    background: white;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

/* BUTTON */
.btn-pink {
    background: linear-gradient(45deg,#e91e63,#ff4081);
    color: white;
    border-radius: 10px;
}

/* TABLE */
.table th {
    background: #ffe4ec;
}

/* FORM */
input, textarea, select {
    border-radius: 10px !important;
}
</style>
</head>

<body>

<div class="container-fluid">
<div class="row">

<!-- SIDEBAR -->
<div class="col-md-2">
<div class="sidebar">

<h5>💄 GlowingDiva</h5>
<hr>

<a href="#">🏠 Dashboard</a>
<a href="#">📦 Products</a>
<a href="#">🧾 Orders</a>
<a href="#">👥 Customers</a>
<a href="#">📊 Analytics</a>

<hr>
<a href="logout.php">🚪 Logout</a>

</div>
</div>

<!-- MAIN -->
<div class="col-md-10 main">

<h4>Product Management 💄</h4>
<p class="text-muted">Manage your entire product catalogue</p>

<!-- TABLE -->
<div class="card-box mb-4">

<table class="table">
<tr>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Stock</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?= $row['name'] ?></td>
<td><?= $row['category'] ?></td>
<td>₹<?= $row['price'] ?></td>
<td><?= $row['stock'] ?></td>
</tr>
<?php } ?>

</table>

</div>

<!-- ADD PRODUCT -->
<div class="card-box">

<h5>Add Product</h5>

<form method="POST">

<input name="name" class="form-control mb-3" placeholder="Product Name" required>
<input name="brand" class="form-control mb-3" placeholder="Brand" required>

<textarea class="form-control mb-3" placeholder="Description"></textarea>

<input name="price" class="form-control mb-3" placeholder="Price" required>
<input name="stock" class="form-control mb-3" placeholder="Stock" required>

<!-- CATEGORY DROPDOWN -->
<select name="category_id" class="form-control mb-3" required>
<option value="">Select Category</option>

<?php
$cat = mysqli_query($conn, "SELECT * FROM categories");
while($c = mysqli_fetch_assoc($cat)){
?>
<option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
<?php } ?>

</select>

<select name="status" class="form-control mb-3">
<option value="Active">Active</option>
<option value="Low">Low</option>
<option value="Out">Out</option>
</select>

<button class="btn btn-pink">Save Product</button>

</form>

</div>

</div>
</div>
</div>

</body>
</html>