<?php
$product = [
    "name" => "9 to 5 Weightless Mousse Foundation",
    "brand" => "Lakme",
    "price" => 449,
    "old_price" => 599,
    "rating" => 4,
    "reviews" => 241,
    "images" => [
        "images/foundation.jpeg",
        "images/foundation2chanel.jpeg",
        "images/foundation3elf.jpeg"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product - GlowingDiva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #fff0f5, #ffe4ec);
}

/* CARD */
.card-box {
    background: rgba(255,255,255,0.95);
    border-radius: 20px;
    padding: 25px;
}

/* IMAGE */
.main-img {
    width: 100%;
    border-radius: 15px;
    transition: 0.3s;
}
.main-img:hover {
    transform: scale(1.05);
}

/* THUMB */
.thumb {
    width: 70px;
    border-radius: 10px;
    cursor: pointer;
    border: 2px solid transparent;
}
.thumb.active {
    border: 2px solid #e91e63;
}

/* PRICE */
.price {
    font-size: 22px;
    color: #e91e63;
    font-weight: bold;
}
.old-price {
    text-decoration: line-through;
    color: gray;
}
.discount {
    color: green;
    font-weight: bold;
}

/* BUTTON */
.btn-pink {
    background: linear-gradient(45deg, #e91e63, #ff4081);
    color: white;
    border: none;
}

/* SHADE */
.shade {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-block;
    cursor: pointer;
    border: 2px solid transparent;
}
.shade.active {
    border: 2px solid black;
}

/* TABS */
.tab-box {
    background: white;
    border-radius: 20px;
    padding: 20px;
}

/* REVIEW */
.review-box {
    background: #fff0f5;
    padding: 15px;
    border-radius: 10px;
}
</style>
</head>

<body>

<?php include_once 'header.php'; ?>

<div class="container py-5">

<div class="row g-4">

<!-- LEFT -->
<div class="col-md-6">
<div class="card-box text-center">

<img id="mainImage" src="<?= $product['images'][0] ?>" class="main-img mb-3">

<div>
<?php foreach($product['images'] as $img): ?>
<img src="<?= $img ?>" class="thumb m-1" onclick="changeImage(this)">
<?php endforeach; ?>
</div>

</div>
</div>

<!-- RIGHT -->
<div class="col-md-6">
<div class="card-box">

<h6 class="text-muted"><?= $product['brand'] ?></h6>
<h4><?= $product['name'] ?></h4>

<!-- Rating -->
<p>
<?php for($i=1;$i<=5;$i++): ?>
<?= $i <= $product['rating'] ? "⭐" : "☆" ?>
<?php endfor; ?>
(<?= $product['reviews'] ?> reviews)
</p>

<!-- Price -->
<p>
<span class="price">₹<?= $product['price'] ?></span>
<span class="old-price">₹<?= $product['old_price'] ?></span>
<span class="discount">
<?= round((($product['old_price'] - $product['price']) / $product['old_price']) * 100) ?>% OFF
</span>
</p>

<p class="text-success">Only 5 left in stock</p>

<!-- Shade -->
<h6>Shade</h6>
<div>
<span class="shade" style="background:#f1c27d" onclick="selectShade(this)"></span>
<span class="shade" style="background:#d2a679" onclick="selectShade(this)"></span>
<span class="shade" style="background:#a67c52" onclick="selectShade(this)"></span>
</div>

<!-- Quantity -->
<h6 class="mt-3">Quantity</h6>
<div class="d-flex align-items-center">
<button class="btn btn-outline-secondary" onclick="changeQty(-1)">-</button>
<input id="qty" type="text" value="1" class="form-control text-center mx-2" style="width:60px">
<button class="btn btn-outline-secondary" onclick="changeQty(1)">+</button>
</div>

<!-- Buttons -->
<div class="mt-3 d-flex gap-2">
<button class="btn btn-pink w-50">Add to Cart</button>
<button class="btn btn-dark w-50">Buy Now</button>
</div>

</div>
</div>

</div>

<!-- TABS -->
<div class="tab-box mt-4">

<ul class="nav nav-tabs">
<li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#desc">Description</a></li>
<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#spec">Specifications</a></li>
<li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#review">Reviews</a></li>
</ul>

<div class="tab-content mt-3">

<div id="desc" class="tab-pane fade show active">
<p>Lightweight foundation with smooth matte finish and long wear.</p>
</div>

<div id="spec" class="tab-pane fade">
<ul>
<li>Brand: Lakme</li>
<li>Skin Type: All</li>
<li>SPF: 30+</li>
</ul>
</div>

<div id="review" class="tab-pane fade">
<div class="review-box">
<p><strong>Priya S.</strong> ⭐⭐⭐⭐⭐</p>
<p>Very smooth and long lasting!</p>
</div>
</div>

</div>

</div>

</div>

<footer class="footer text-center bg-dark text-white p-3 mt-5">
© 2026 BeautyStore
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
function changeImage(el){
document.getElementById("mainImage").src = el.src;

document.querySelectorAll(".thumb").forEach(t => t.classList.remove("active"));
el.classList.add("active");
}

function changeQty(val){
let qty = document.getElementById("qty");
let current = parseInt(qty.value);
if(current + val >= 1){
qty.value = current + val;
}
}

function selectShade(el){
document.querySelectorAll(".shade").forEach(s => s.classList.remove("active"));
el.classList.add("active");
}
</script>

</body>
</html>