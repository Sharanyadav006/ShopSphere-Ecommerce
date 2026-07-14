<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">

<div class="container">

<!-- Logo -->

<a class="navbar-brand fw-bold fs-3"
   href="dashboard.php">

   ShopSphere

</a>

<!-- Mobile Toggle -->

<button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<!-- Navbar Links -->

<div class="collapse navbar-collapse"
     id="navbarNav">

<ul class="navbar-nav ms-auto align-items-lg-center">

<!-- Home -->

<li class="nav-item mx-2">

<a class="nav-link"
   href="dashboard.php">

   Home

</a>

</li>

<!-- Products -->

<li class="nav-item mx-2">

<a class="nav-link"
   href="products.php">

   Products

</a>

</li>

<!-- Cart -->
<li class="nav-item mx-2">

<a class="nav-link"
   href="wishlist.php">

   Wishlist

</a>

</li>
<li class="nav-item mx-2">

<a class="nav-link"
   href="cart.php">

   Cart

</a>

</li>

<!-- Orders -->

<li class="nav-item mx-2">

<a class="nav-link"
   href="orders.php">

   Orders

</a>

</li>

<!-- Welcome User -->

<li class="nav-item mx-2">

<span class="nav-link text-warning">

<?php
if(isset($_SESSION['user_name']))
{
    echo "Hi, ".$_SESSION['user_name'];
}
?>

</span>

</li>

<!-- Logout -->

<li class="nav-item mx-2">

<a class="btn btn-warning px-4"
   href="logout.php">

   Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<style>

.navbar
{
    padding-top: 15px;
    padding-bottom: 15px;
}

.navbar-brand
{
    letter-spacing: 1px;
}

.nav-link
{
    font-size: 17px;

    transition: 0.3s;
}

.nav-link:hover
{
    color: #ffc107 !important;

    transform: translateY(-2px);
}

</style>