<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "Message sent successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact - GlowingDiva</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(to right, #fff0f5, #ffe4ec);
}

/* HERO (FIXED 🔥) */
.hero {
    position: relative;
    height: 250px;
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
    font-size: 40px;
}

/* CONTACT BOX (GLASS EFFECT) */
.contact-box {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(15px);
    padding: 30px;
    border-radius: 15px;
}

/* INPUT */
input, textarea {
    border-radius: 10px !important;
}

input:focus, textarea:focus {
    border-color: #e91e63 !important;
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
    <h1>Contact Us</h1>
</section>

<!-- CONTACT -->
<div class="container py-5">
<div class="row g-4">

<!-- LEFT -->
<div class="col-md-5">
    <div class="contact-box">
        <h4>Contact Info 💄</h4>
        <p class="text-muted">We’d love to hear from you!</p>

        <p><i class="bi bi-geo-alt-fill text-danger"></i> Mumbai, India</p>
        <p><i class="bi bi-envelope-fill text-danger"></i> support@glowingdiva.com</p>
        <p><i class="bi bi-telephone-fill text-danger"></i> +91 9876543210</p>
    </div>
</div>

<!-- RIGHT -->
<div class="col-md-7">
    <div class="contact-box">
        <h4 class="text-center mb-3">Get in Touch 💌</h4>

        <?php if($message): ?>
            <div class="alert alert-success text-center"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">
            <input name="name" class="form-control mb-3" placeholder="Name" required>
            <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
            <textarea name="message" class="form-control mb-3" rows="4" placeholder="Message" required></textarea>

            <button class="btn btn-pink w-100">Send Message</button>
        </form>
    </div>
</div>

</div>
</div>

<!-- MAP -->
<div class="container mb-5">
<iframe src="https://maps.google.com/maps?q=Mumbai&t=&z=13&ie=UTF8&iwloc=&output=embed"
width="100%" height="300" style="border-radius:15px;"></iframe>
</div>

<!-- FOOTER -->
<footer class="footer">
<p>© 2026 BeautyStore</p>
<i class="bi bi-facebook"></i>
<i class="bi bi-instagram mx-2"></i>
<i class="bi bi-twitter"></i>
</footer>

</body>
</html>