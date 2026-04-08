<?php
session_start();
include 'db.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $name = $fname . " " . $lname;
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    // VALIDATIONS
    if(strlen($password) < 6){
        $error = "Password must be at least 6 characters";
    } 
    elseif($password != $confirm){
        $error = "Passwords do not match";
    }
    else {

        // CHECK EMAIL EXISTS
        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if(mysqli_num_rows($check) > 0){
            $error = "Email already registered!";
        } else {

            // INSERT INTO DATABASE
            $query = "INSERT INTO users(name,email,password)
                      VALUES('$name','$email','$password')";

            if(mysqli_query($conn, $query)){
                $success = "Registered Successfully!";
                $_SESSION['user'] = $fname;
            } else {
                $error = "Database Error!";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - GlowingDiva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #fff0f5, #ffe4ec);
}

/* HERO */
.hero {
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
    height: 220px;
    background: linear-gradient(to right, rgba(0,0,0,0.6), rgba(233,30,99,0.4));
}
.hero h1 {
    position: relative;
    color: white;
}

/* PANEL */
.panel {
    background: rgba(255,255,255,0.9);
    border-radius: 15px;
    padding: 25px;
    transition: 0.4s;
}
.panel:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* INPUT */
input, select {
    border-radius: 10px !important;
}
input:focus, select:focus {
    border-color: #e91e63 !important;
}

/* BUTTON */
.btn-pink {
    background: linear-gradient(45deg, #e91e63, #ff4081);
    color: white;
    border: none;
}

/* ANIMATION */
.fade-up {
    opacity: 0;
    transform: translateY(40px);
    transition: 0.7s;
}
.fade-up.show {
    opacity: 1;
    transform: translateY(0);
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
<h1>Create Your Account</h1>
</section>

<!-- MAIN -->
<div class="container py-5">
<div class="row g-4">

<!-- LEFT -->
<div class="col-md-4 fade-up">
<div class="panel">
<h5>Why Join Us? 💄</h5>

<ul class="mt-3">
<li>✔ Exclusive discounts</li>
<li>✔ Birthday gifts</li>
<li>✔ Order tracking</li>
<li>✔ Early access</li>
<li>✔ Reward points</li>
</ul>

<hr>
<p>Already a member? <a href="signin.php">Sign In</a></p>
</div>
</div>

<!-- RIGHT -->
<div class="col-md-8 fade-up">
<div class="panel">

<h5 class="mb-3">Personal Details</h5>

<?php if($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<?php if($success): ?>
<div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<form method="POST">

<div class="row">
<div class="col-md-6">
<input name="fname" class="form-control mb-3" placeholder="First Name" required>
</div>
<div class="col-md-6">
<input name="lname" class="form-control mb-3" placeholder="Last Name" required>
</div>
</div>

<input name="email" type="email" class="form-control mb-3" placeholder="Email Address" required>

<div class="row">
<div class="col-md-4">
<input class="form-control mb-3" value="+91" readonly>
</div>
<div class="col-md-8">
<input class="form-control mb-3" placeholder="Phone Number">
</div>
</div>

<div class="row">
<div class="col-md-6">
<input type="date" class="form-control mb-3">
</div>
<div class="col-md-6">
<select class="form-control mb-3">
<option>Select Gender</option>
<option>Male</option>
<option>Female</option>
</select>
</div>
</div>

<input name="password" type="password" class="form-control mb-3" placeholder="Password" required>
<input name="confirm" type="password" class="form-control mb-3" placeholder="Confirm Password" required>

<div class="form-check mb-2">
<input class="form-check-input" type="checkbox" required>
<label>I agree to Terms</label>
</div>

<button class="btn btn-pink w-100">Create Account</button>

</form>

</div>
</div>

</div>
</div>

<!-- FOOTER -->
<footer class="footer">
<p>© 2026 BeautyStore</p>
</footer>

<script>
const elements = document.querySelectorAll('.fade-up');
window.addEventListener('scroll', () => {
elements.forEach(el => {
if(el.getBoundingClientRect().top < window.innerHeight - 50){
el.classList.add('show');
}
});
});
</script>

</body>
</html>