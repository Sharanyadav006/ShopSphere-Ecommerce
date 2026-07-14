<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'config/db.php';

include 'includes/header.php';
include 'includes/navbar.php';

$product_sql = "SELECT * FROM products LIMIT 6";

$product_result = mysqli_query($conn, $product_sql);

?>

<div class="container mt-4">

    <!-- Hero Section -->
       <!-- Hero Banner -->

<div class="hero-section text-white
            d-flex align-items-center">

<div class="container">

<div class="row">

<div class="col-md-6">

<h1 class="display-3 fw-bold mb-4">

Welcome To ShopSphere

</h1>

<p class="lead mb-4">

Discover the best deals on electronics,
fashion, books, shoes, and more.

</p>

<a href="products.php"
   class="btn btn-warning btn-lg">

   Shop Now

</a>

</div>

</div>

</div>

</div>
    

    <!-- Featured Products -->
     <!-- Featured Products -->

<div class="d-flex justify-content-between
            align-items-center mb-4">

<h2 class="fw-bold">

Featured Products

</h2>

<a href="products.php"
   class="btn btn-dark">

   View All

</a>

</div>

<div class="row">

<?php
while($product =
      mysqli_fetch_assoc($product_result))
{
?>

<div class="col-md-4 mb-4">

<div class="card h-100 shadow-lg
            border-0 product-card">

<!-- Product Image -->

<div class="overflow-hidden">

<a href="product-details.php?id=<?php echo $product['id']; ?>">

<img src="uploads/<?php echo $product['image']; ?>"
     class="card-img-top product-image">

</a>

</div>

<!-- Product Content -->

<div class="card-body d-flex flex-column">

<h5 class="card-title fw-bold">

<a href="product-details.php?id=<?php echo $product['id']; ?>"
   class="text-decoration-none text-dark">

<?php echo $product['name']; ?>

</a>

</h5>

<p class="text-muted">

<?php
echo substr($product['description'],
            0,
            80);
?>

...

</p>

<h4 class="text-success mb-4">

₹<?php echo $product['price']; ?>

</h4>

<div class="mt-auto">

<a href="add-to-cart.php?id=<?php echo $product['id']; ?>"
   class="btn btn-success w-100">

   Add To Cart

</a>

</div>

</div>

</div>

</div>

<?php
}
?>

</div>
<!-- Categories -->

<h2 class="mb-4">

Shop By Category

</h2>

<div class="row mb-5">

<div class="col-md-3 mb-3">

<div class="card shadow border-0
            text-center p-4">

<h4>

📱 Mobiles

</h4>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0
            text-center p-4">

<h4>

👕 Fashion

</h4>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0
            text-center p-4">

<h4>

📚 Books

</h4>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="card shadow border-0
            text-center p-4">

<h4>

👟 Shoes

</h4>

</div>

</div>

</div>
    <h2 class="mb-4">
        Featured Products
    </h2>

    <div class="row">

        <?php
        while($product = mysqli_fetch_assoc($product_result))
        {
        ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow">

                <img src="uploads/<?php echo $product['image']; ?>"
                     class="card-img-top"
                     height="250">

                <div class="card-body">

                    <h5 class="card-title">

                        <?php echo $product['name']; ?>

                    </h5>

                    <p class="card-text">

                        ₹<?php echo $product['price']; ?>

                    </p>

                    <a href="add-to-cart.php?id=<?php echo $product['id']; ?>"
                       class="btn btn-success">

                        Add To Cart

                    </a>

                </div>

            </div>

        </div>

        <?php
        }
        ?>

    </div>

</div>

<style>

.hero-section
{
    height: 500px;

    background:
    linear-gradient(
    rgba(0,0,0,0.6),
    rgba(0,0,0,0.6)
    ),

    url('https://images.unsplash.com/photo-1512436991641-6745cdb1723f?q=80&w=1200');

    background-size: cover;

    background-position: center;

    border-radius: 20px;

    margin-bottom: 50px;
}

.product-card
{
    transition: 0.3s;
}

.product-card:hover
{
    transform: translateY(-8px);
}
.product-card
{
    transition: 0.4s;

    border-radius: 20px;

    overflow: hidden;
}

.product-card:hover
{
    transform: translateY(-10px);
}

.product-image
{
    height: 250px;

    object-fit: cover;

    transition: 0.4s;
}

.product-card:hover .product-image
{
    transform: scale(1.05);
}

</style>
<?php
include 'includes/footer.php';
?>