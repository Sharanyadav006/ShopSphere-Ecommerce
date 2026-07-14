<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include '../config/db.php';

$user_sql =
"SELECT COUNT(*) AS total_users FROM users";

$user_result =
mysqli_query($conn, $user_sql);

$user_data =
mysqli_fetch_assoc($user_result);

$product_sql =
"SELECT COUNT(*) AS total_products FROM products";

$product_result =
mysqli_query($conn, $product_sql);

$product_data =
mysqli_fetch_assoc($product_result);

$order_sql =
"SELECT COUNT(*) AS total_orders FROM orders";

$order_result =
mysqli_query($conn, $order_sql);

$order_data =
mysqli_fetch_assoc($order_result);


$revenue_sql =
"SELECT SUM(total_amount) AS total_revenue
FROM orders
WHERE status='Delivered'";

$revenue_result =
mysqli_query($conn, $revenue_sql);

$revenue_data =
mysqli_fetch_assoc($revenue_result);

if($revenue_data['total_revenue']=="")
{
    $revenue_data['total_revenue']=0;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-light">

<!-- Navbar -->

<nav class="navbar navbar-dark bg-dark">

<div class="container-fluid">

<span class="navbar-brand mb-0 h1">

    Admin Dashboard

</span>

<a href="logout.php"
   class="btn btn-warning">

   Logout

</a>

</div>

</nav>

<div class="container mt-5">

<div class="row mb-4">

<div class="col-md-3">

<div class="card shadow border-0 bg-primary text-white">

<div class="card-body text-center">

<i class="fa-solid fa-users fa-3x mb-3"></i>

<h4>Total Users</h4>

<h1>

<?php
echo $user_data['total_users'];
?>

</h1>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow border-0 bg-success text-white">

<div class="card-body text-center">

<i class="fa-solid fa-box fa-3x mb-3"></i>

<h4>Total Products</h4>

<h1>

<?php
echo $product_data['total_products'];
?>

</h1>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow border-0 bg-dark text-white">

<div class="card-body text-center">

<i class="fa-solid fa-cart-shopping fa-3x mb-3"></i>

<h4>Total Orders</h4>

<h1>

<?php
echo $order_data['total_orders'];
?>

</h1>

</div>

</div>

</div>

</div>
<div class="col-md-3">

<div class="card shadow border-0 bg-warning text-dark">

<div class="card-body text-center">

<i class="fa-solid fa-indian-rupee-sign fa-3x mb-3"></i>

<h4>Total Revenue</h4>

<h2>

₹<?php echo number_format($revenue_data['total_revenue']); ?>

</h2>

</div>

</div>

</div>

<!-- Quick Actions -->

<div class="card shadow border-0">

<div class="card-body">

<h3 class="mb-4">
    Quick Actions
</h3>

<div class="row">

<div class="col-md-4 mb-3">

<a href="add-product.php"
   class="btn btn-dark w-100 p-3">

   <i class="fa-solid fa-plus"></i>

   Add Product

</a>

</div>

<div class="col-md-4 mb-3">

<a href="orders.php"
   class="btn btn-primary w-100 p-3">

   <i class="fa-solid fa-truck"></i>

   Manage Orders

</a>

</div>

<div class="col-md-4 mb-3">

<a href="../products.php"
   class="btn btn-success w-100 p-3">

   <i class="fa-solid fa-store"></i>

   View Store

</a>

</div>

</div>

</div>

</div>

</div>

</body>
</html>