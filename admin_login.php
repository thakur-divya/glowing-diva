<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['admin'] = $email;
        header("Location: product_management.php");
    } else {
        $error = "Invalid Admin Login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login - GlowingDiva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #fff0f5, #ffe4ec);
}

/* MAIN BOX */
.main-box {
    background: rgba(255,255,255,0.9);
    border-radius: 20px;
    padding: 25px;
}

/* LEFT PANEL */
.left-panel {
    background: linear-gradient(135deg, #ffe4ec, #fff0f5);
    border-radius: 15px;
    padding: 30px;
}

/* RIGHT PANEL */
.right-panel {
    background: rgba(255,255,255,0.95);
    border-radius: 15px;
    padding: 30px;
}

/* BRAND TITLE */
.brand-title {
    font-weight: 700;
    font-size: 30px;
    background: linear-gradient(45deg, #e91e63, #ff4081);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* BADGE */
.admin-badge {
    display: inline-block;
    padding: 5px 12px;
    font-size: 12px;
    border-radius: 20px;
    background: rgba(233,30,99,0.1);
    color: #e91e63;
    margin-top: 5px;
}

/* TAGLINE */
.tagline {
    font-size: 14px;
    color: #555;
    margin-top: 10px;
}

/* BUTTON */
.btn-pink {
    background: linear-gradient(45deg, #e91e63, #ff4081);
    color: white;
    border: none;
}

/* ROLE BUTTON */
.role-btn {
    padding: 8px 12px;
    border-radius: 10px;
    border: 1px solid #ddd;
    cursor: pointer;
    background: #f8f8f8;
}
.role-btn.active {
    background: #e91e63;
    color: white;
}

/* INPUT */
input {
    border-radius: 10px !important;
}
input:focus {
    border-color: #e91e63 !important;
    box-shadow: 0 0 6px rgba(233,30,99,0.3);
}
</style>
</head>

<body>

<div class="container py-5">
<div class="main-box">

<div class="row g-4">

<!-- LEFT PANEL -->
<div class="col-md-6">
<div class="left-panel text-center">

<h2 class="brand-title">💄 GlowingDiva</h2>

<div class="admin-badge">ADMIN PORTAL</div>

<p class="tagline">
Manage your store, products, orders, customers and more.
</p>

<hr>

<ul class="text-start">
<li>✔ Product & inventory management</li>
<li>✔ Order tracking</li>
<li>✔ Customer moderation</li>
<li>✔ Analytics & reports</li>
<li>✔ Discounts & offers</li>
</ul>

<hr>

<p class="small text-muted">
🔒 256-bit SSL encrypted <br>
Session timeout: 30 min
</p>

</div>
</div>

<!-- RIGHT PANEL -->
<div class="col-md-6">
<div class="right-panel">

<h4 class="text-center">Welcome Back 👋</h4>
<p class="text-center text-muted">Sign in to your admin account</p>

<?php if($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">

<!-- ROLE -->
<div class="d-flex gap-2 mb-3">
<button type="button" class="role-btn active" onclick="selectRole(this,'Super Admin')">Super Admin</button>
<button type="button" class="role-btn" onclick="selectRole(this,'Manager')">Manager</button>
</div>

<input type="hidden" name="role" id="role" value="Super Admin">

<!-- EMAIL -->
<label>Email</label>
<input type="email" name="email" class="form-control mb-3" placeholder="admin@gmail.com" required>

<!-- PASSWORD -->
<label>Password</label>
<div class="input-group mb-3">
<input type="password" name="password" id="pass" class="form-control" placeholder="Enter password" required>
<button type="button" class="btn btn-outline-secondary" onclick="togglePass()">👁</button>
</div>

<!-- CAPTCHA (dummy) -->
<div class="border p-3 mb-3 text-center text-muted rounded">
[ reCAPTCHA ]
</div>

<button class="btn btn-pink w-100">Login</button>

</form>

</div>
</div>

</div>

</div>
</div>

<script>
function selectRole(el, role){
document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
el.classList.add('active');
document.getElementById("role").value = role;
}

function togglePass(){
let p = document.getElementById("pass");
p.type = p.type === "password" ? "text" : "password";
}
</script>

</body>
</html>