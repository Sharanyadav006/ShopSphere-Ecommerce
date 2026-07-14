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

$user_id = $_SESSION['user_id'];

$sql =

"SELECT wishlist.id AS wishlist_id,
 products.*

 FROM wishlist

 JOIN products

 ON wishlist.product_id = products.id

 WHERE wishlist.user_id='$user_id'

 ORDER BY wishlist.id DESC";

$result = mysqli_query($conn, $sql);

?>

<div class="container mt-5">

<!-- Heading -->

<div class="d-flex justify-content-between
            align-items-center mb-4">

<h1 class="fw-bold">

❤️ My Wishlist

</h1>

<a href="products.php"
   class="btn btn-dark">

Continue Shopping

</a>

</div>

<!-- Wishlist Products -->

<div class="row">

<?php
if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
    {
?>

<div class="col-md-4 mb-4">

<div class="card h-100 shadow-lg
            border-0 wishlist-card">

<!-- Product Image -->

<div class="overflow-hidden">

<a href="product-details.php?id=<?php echo $row['id']; ?>">

<img src="uploads/<?php echo $row['image']; ?>"
     class="card-img-top wishlist-image">

</a>

</div>

<!-- Product Content -->

<div class="card-body d-flex flex-column">

<h5 class="card-title fw-bold">

<a href="product-details.php?id=<?php echo $row['id']; ?>"
   class="text-decoration-none text-dark">

<?php echo $row['name']; ?>

</a>

</h5>

<p class="text-muted">

<?php
echo substr($row['description'],
            0,
            80);
?>

...

</p>

<h4 class="text-success mb-4">

₹<?php echo $row['price']; ?>

</h4>

<div class="mt-auto">

<a href="add-to-cart.php?id=<?php echo $row['id']; ?>"
   class="btn btn-success w-100 mb-2">

   Add To Cart

</a>

<a href="remove-wishlist.php?id=<?php echo $row['wishlist_id']; ?>"
   class="btn btn-outline-dark w-100">

   Remove

</a>

</div>

</div>

</div>

</div>

<?php
    }
}
else
{
?>

<div class="col-12">

<div class="alert alert-warning text-center p-5">

<h3>

Your Wishlist Is Empty ❤️

</h3>

<p>

Browse products and save your favorites.

</p>

<a href="products.php"
   class="btn btn-dark mt-3">

   Explore Products

</a>

</div>

</div>

<?php
}
?>

</div>

</div>

<!-- Styling -->

<style>

.wishlist-card
{
    transition: 0.4s;

    border-radius: 20px;

    overflow: hidden;
}

.wishlist-card:hover
{
    transform: translateY(-10px);
}

.wishlist-image
{
    height: 250px;

    object-fit: cover;

    transition: 0.4s;
}

.wishlist-card:hover .wishlist-image
{
    transform: scale(1.05);
}

</style>

<?php
include 'includes/footer.php';
?>