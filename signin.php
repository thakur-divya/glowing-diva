<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['user'] = $email;
        header("Location: index.php");
    } else {
        $error = "Invalid Login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - GlowingDiva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #fff0f5, #ffe4ec);
}

/* HERO */
.hero {
    position: relative;
    height: 220px;
    background: url('https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero::before {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(233,30,99,0.4));
}
.hero h1 {
    position: relative;
    color: white;
}

/* PANEL */
.panel {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(12px);
    border-radius: 15px;
    padding: 30px;
    transition: 0.3s;
}
.panel:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* INPUT */
input {
    border-radius: 10px !important;
}
input:focus {
    border-color: #e91e63 !important;
    box-shadow: 0 0 8px rgba(233,30,99,0.2);
}

/* BUTTON */
.btn-pink {
    background: linear-gradient(45deg, #e91e63, #ff4081);
    color: white;
    border: none;
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

<?php include_once 'header.php'; ?>

<!-- HERO -->
<section class="hero">
<h1>Welcome Back</h1>
</section>

<!-- LOGIN -->
<div class="container py-5">
<div class="row justify-content-center">

<div class="col-md-6">
<div class="panel">

<h4 class="text-center mb-3">Sign In 💄</h4>
<p class="text-center text-muted">Login to your beauty account</p>

<?php if($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">

<label>Email Address</label>
<input type="email" name="email" class="form-control mb-3" placeholder="your@email.com" required>

<label>Password</label>
<input type="password" name="password" class="form-control mb-3" placeholder="Enter password" required>

<div class="d-flex justify-content-between mb-3">
<label><input type="checkbox"> Remember me</label>
<a href="#" class="text-danger">Forgot password?</a>
</div>

<button class="btn btn-pink w-100">Sign In</button>

<p class="text-center mt-3">
New user? <a href="signup.php" class="text-danger">Create account</a>
</p>

</form>

</div>
</div>

</div>
</div>

<!-- FOOTER -->
<footer class="footer">
<p>© 2026 BeautyStore</p>
</footer>

</body>
</html>