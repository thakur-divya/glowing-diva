<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id='$id'");
    header("Location: product_management.php");
}

/* EDIT FETCH */
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
    $editData = mysqli_fetch_assoc($res);
}

/* INSERT / UPDATE */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];
    $category_id = $_POST['category_id'];

    /* IMAGE UPLOAD */
    $image = $editData['image'] ?? "images/default.jpeg";

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . $_FILES['image']['name'];
        $target = "images/" . $imageName;

        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $image = $target;
    }

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        mysqli_query($conn, "
            UPDATE products SET 
                name='$name',
                brand='$brand',
                description='$description',
                price='$price',
                stock='$stock',
                image='$image',
                status='$status',
                category_id='$category_id'
            WHERE id='$id'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO products(name, brand, description, price, stock, image, status, category_id)
            VALUES('$name', '$brand', '$description', '$price', '$stock', '$image', '$status', '$category_id')
        ");
    }

    header("Location: product_management.php");
}

/* FETCH ALL PRODUCTS */
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
            background: linear-gradient(135deg, #fff0f5, #ffe4ec);
        }

        .sidebar {
            height: 100vh;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
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
        }

        .sidebar a:hover {
            background: #ffe4ec;
            color: #e91e63;
        }

        .main {
            padding: 30px;
        }

        .card-box {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .btn-pink {
            background: linear-gradient(45deg, #e91e63, #ff4081);
            color: white;
            border-radius: 10px;
        }

        .table th {
            background: #ffe4ec;
        }

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
                    <th>Action</th>
                </tr>

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td>₹<?= $row['price'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td>
                        <a href="?edit=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?delete=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <!-- FORM -->
        <div class="card-box">
            <h5><?= $editData ? 'Update Product' : 'Add Product' ?></h5>

            <form method="POST" enctype="multipart/form-data">

                <?php if ($editData): ?>
                    <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                <?php endif; ?>

                <input name="name" class="form-control mb-3"
                       value="<?= $editData['name'] ?? '' ?>"
                       placeholder="Product Name" required>

                <input name="brand" class="form-control mb-3"
                       value="<?= $editData['brand'] ?? '' ?>"
                       placeholder="Brand" required>

                <textarea name="description" class="form-control mb-3"
                          placeholder="Description"><?= $editData['description'] ?? '' ?></textarea>

                <input name="price" class="form-control mb-3"
                       value="<?= $editData['price'] ?? '' ?>"
                       placeholder="Price" required>

                <input name="stock" class="form-control mb-3"
                       value="<?= $editData['stock'] ?? '' ?>"
                       placeholder="Stock" required>

                <!-- IMAGE -->
                <?php if ($editData && $editData['image']) { ?>
                    <img src="<?= $editData['image'] ?>" width="80" class="mb-2">
                <?php } ?>

                <input type="file" name="image" class="form-control mb-3">

                <!-- CATEGORY -->
                <select name="category_id" class="form-control mb-3" required>
                    <option value="">Select Category</option>
                    <?php
                    $cat = mysqli_query($conn, "SELECT * FROM categories");
                    while ($c = mysqli_fetch_assoc($cat)) {
                    ?>
                        <option value="<?= $c['id'] ?>"
                            <?= ($editData && $editData['category_id'] == $c['id']) ? 'selected' : '' ?>>
                            <?= $c['name'] ?>
                        </option>
                    <?php } ?>
                </select>

                <!-- STATUS -->
                <select name="status" class="form-control mb-3">
                    <option value="Active">Active</option>
                    <option value="Low">Low</option>
                    <option value="Out">Out</option>
                </select>

                <button class="btn btn-pink">
                    <?= $editData ? 'Update Product' : 'Save Product' ?>
                </button>

            </form>
        </div>

    </div>
</div>
</div>

</body>
</html>