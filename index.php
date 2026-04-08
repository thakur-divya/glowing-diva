<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GlowingDiva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

/* HERO */
.hero {
    height: 400px;
    background: url('https://images.unsplash.com/photo-1596462502278-27bfdc403348') center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

/* BUTTON */
.btn-pink {
    background: linear-gradient(45deg, #e91e63, #ff4081);
    color: white;
    border-radius: 8px;
}

/* PRODUCT CARD */
.product-card {
    border-radius: 20px;
    overflow: hidden;
    background: white;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
}
.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.product-img {
    height: 250px;
    width: 100%;
    object-fit: cover;
}

.product-title {
    font-weight: 600;
    margin-top: 10px;
}

.price {
    color: #e91e63;
    font-weight: bold;
    font-size: 18px;
}

.category-label {
    font-size: 13px;
    color: #888;
}

/* CATEGORY CARD */
.category-card {
    display: block;
    text-decoration: none;
    background: linear-gradient(45deg, #fff0f5, #ffe4ec);
    padding: 30px;
    border-radius: 20px;
    transition: 0.3s;
    color: #333;
}
.category-card i {
    font-size: 30px;
    color: #e91e63;
    margin-bottom: 10px;
}
.category-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* FOOTER */
.footer {
    background: #111;
    color: white;
    padding: 20px;
    text-align: center;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<?php include 'header.php'; ?>

<!-- HERO -->
<section class="hero text-center">
    <div>
        <h1>Beauty That Speaks</h1>
        <p>Discover premium makeup products</p>
        <button class="btn btn-pink">Shop Now</button>
    </div>
</section>

<!-- PRODUCTS -->
<div class="container py-5">
<h3 class="text-center mb-4">Trending Products</h3>

<div class="row g-4">

<?php
$result = mysqli_query($conn, "
SELECT products.*, categories.name AS category
FROM products
LEFT JOIN categories ON products.category_id = categories.id
LIMIT 6
");

while($row = mysqli_fetch_assoc($result)){
?>

<div class="col-md-4">
<div class="product-card">

<img src="<?= $row['image'] ?>" class="product-img">

<div class="card-body text-center">

<p class="category-label"><?= $row['category'] ?></p>

<h6 class="product-title"><?= $row['name'] ?></h6>

<p class="price">₹<?= $row['price'] ?></p>

<button class="btn btn-pink btn-sm px-3">Add to Cart</button>

</div>

</div>
</div>

<?php } ?>

</div>
</div>

<!-- CATEGORY -->
<div class="container pb-5">
<h3 class="text-center mb-4">Shop by Category</h3>

<div class="row text-center g-4">

<div class="col-md-3">
    <a href="category.php?id=1" class="category-card">
        <i class="bi bi-heart"></i>
        <div>Lipstick</div>
    </a>
</div>

<div class="col-md-3">
    <a href="category.php?id=2" class="category-card">
        <i class="bi bi-droplet"></i>
        <div>Foundation</div>
    </a>
</div>

<div class="col-md-3">
    <a href="category.php?id=3" class="category-card">
        <i class="bi bi-eye"></i>
        <div>Eye Kit</div>
    </a>
</div>

<div class="col-md-3">
    <a href="category.php?id=4" class="category-card">
        <i class="bi bi-star"></i>
        <div>Perfume</div>
    </a>
</div>

<div class="col-md-3">
    <a href="category.php?id=5" class="category-card">
        <i class="bi bi-gem"></i>
        <div>Accessories</div>
    </a>
</div>

<div class="col-md-3">
    <a href="category.php?id=6" class="category-card">
        <i class="bi bi-brush"></i>
        <div>Blush</div>
    </a>
</div>

</div>
</div>

<!-- FOOTER -->
<footer class="footer">
<p>© 2026 BeautyStore</p>
</footer>

</body>
</html>