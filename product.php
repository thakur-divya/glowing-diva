<?php
include 'db.php';

$id = $_GET['id'] ?? 0;

/* FETCH PRODUCT FROM DB */
$res = mysqli_query($conn, "
SELECT products.*, categories.name AS category
FROM products
LEFT JOIN categories ON products.category_id = categories.id
WHERE products.id='$id'
");

$product = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $product['name'] ?> - GlowingDiva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #fff0f5, #ffe4ec);
}

.card-box {
    background: rgba(255,255,255,0.95);
    border-radius: 20px;
    padding: 25px;
}

.main-img {
    width: 100%;
    border-radius: 15px;
}

.price {
    font-size: 22px;
    color: #e91e63;
    font-weight: bold;
}

.btn-pink {
    background: linear-gradient(45deg,#e91e63,#ff4081);
    color: white;
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<div class="container py-5">

<div class="row g-4">

<!-- IMAGE -->
<div class="col-md-6">
<div class="card-box text-center">
<img src="<?= $product['image'] ?>" class="main-img">
</div>
</div>

<!-- DETAILS -->
<div class="col-md-6">
<div class="card-box">

<h6 class="text-muted"><?= $product['category'] ?></h6>
<h4><?= $product['name'] ?></h4>

<p class="text-muted"><?= $product['brand'] ?></p>

<p><?= $product['description'] ?? 'Premium beauty product' ?></p>

<p class="price">₹<?= $product['price'] ?></p>

<p><b>Stock:</b> <?= $product['stock'] ?></p>

<button class="btn btn-pink w-100 mb-2">Add to Cart</button>
<button class="btn btn-dark w-100">Buy Now</button>

</div>
</div>

</div>

</div>

<footer class="footer text-center bg-dark text-white p-3 mt-5">
© 2026 BeautyStore
</footer>

</body>
</html>