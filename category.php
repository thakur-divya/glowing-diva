<?php
include 'db.php';

$category_id = $_GET['id'] ?? '';
$selectedBrand = $_GET['brand'] ?? '';

/* GET CATEGORY NAME */
$catName = "";
if($category_id){
    $cat = mysqli_query($conn, "SELECT name FROM categories WHERE id='$category_id'");
    $c = mysqli_fetch_assoc($cat);
    $catName = $c['name'];
}

/* BUILD QUERY */
$query = "
SELECT products.*, categories.name AS category 
FROM products 
LEFT JOIN categories ON products.category_id = categories.id
WHERE products.category_id='$category_id'
";

/* BRAND FILTER */
if($selectedBrand){
    $query .= " AND products.brand='$selectedBrand'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $catName ?> - GlowingDiva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #fff0f5, #ffe4ec);
}

.hero {
    height: 200px;
    background: url('https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.product-card {
    background: white;
    border-radius: 15px;
    padding: 15px;
    transition: 0.3s;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.product-img {
    height: 180px;
    object-fit: cover;
    width: 100%;
}

.price {
    color: #e91e63;
    font-weight: bold;
}

.btn-pink {
    background: linear-gradient(45deg,#e91e63,#ff4081);
    color: white;
}

.sidebar {
    background: white;
    padding: 20px;
    border-radius: 15px;
}
.filter-btn {
    display: block;
    padding: 8px;
    margin-bottom: 8px;
    border-radius: 10px;
    text-decoration: none;
    color: #333;
}
.filter-btn.active {
    background: #e91e63;
    color: white;
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<!-- HERO -->
<section class="hero text-center">
<h2><?= $catName ?> Products 💄</h2>
</section>

<div class="container py-5">
<div class="row">

<!-- SIDEBAR -->
<div class="col-md-3">
<div class="sidebar">

<h5>Filter by Brand</h5>
<hr>

<a href="?id=<?= $category_id ?>" class="filter-btn <?= $selectedBrand=='' ? 'active' : '' ?>">All</a>

<?php
$brands = mysqli_query($conn, "SELECT DISTINCT brand FROM products WHERE category_id='$category_id'");
while($b = mysqli_fetch_assoc($brands)){
?>
<a href="?id=<?= $category_id ?>&brand=<?= $b['brand'] ?>"
   class="filter-btn <?= $selectedBrand==$b['brand'] ? 'active' : '' ?>">
   <?= $b['brand'] ?>
</a>
<?php } ?>

</div>
</div>

<!-- PRODUCTS -->
<div class="col-md-9">
<div class="row g-4">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="col-md-4">
<div class="product-card">
<a href="product.php?id=<?= $row['id'] ?>" style="text-decoration:none; color:black;">

<img src="<?= $row['image'] ?>" class="product-img">

<h6 class="mt-2"><?= $row['name'] ?></h6>

</a>
<p class="text-muted"><?= $row['brand'] ?></p>

<p class="price">₹<?= $row['price'] ?></p>

<button class="btn btn-pink btn-sm w-100">Add to Cart</button>

</div>
</div>

<?php } ?>

</div>
</div>

</div>
</div>

</body>
</html>