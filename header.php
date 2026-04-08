<?php
function renderNavbar() {
echo '
<style>
.navbar {
    position: sticky;
    top: 0;
    z-index: 1000;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.navbar-brand {
    font-size: 24px;
}

.nav-link {
    margin: 0 10px;
    color: black !important;
}

.nav-link:hover {
    color: #e91e63 !important;
}

.btn-pink {
    background: linear-gradient(45deg, #e91e63, #ff4081);
    color: white;
    border: none;
}
</style>

<nav class="navbar navbar-expand-lg py-3">
    <div class="container">

        <a class="navbar-brand text-danger fw-bold" href="index.php">GlowingDiva</a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">

            <form class="d-flex mx-auto w-50">
                <input class="form-control me-2 rounded-pill" placeholder="Search products...">
                <button class="btn btn-pink rounded-pill">Search</button>
            </form>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Products</a></li>

                <li class="nav-item"><i class="bi bi-person fs-5 mx-2"></i></li>

                <li class="nav-item position-relative">
                    <i class="bi bi-cart fs-5"></i>
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">2</span>
                </li>
            </ul>

        </div>
    </div>
</nav>
';
}

renderNavbar();
?>