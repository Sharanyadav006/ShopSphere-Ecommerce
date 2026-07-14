<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include '../config/db.php';

$sql = "SELECT orders.*,
        users.name

        FROM orders

        JOIN users

        ON orders.user_id = users.id

        ORDER BY orders.id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-light">

<!-- Navbar -->

<nav class="navbar navbar-dark bg-dark">

<div class="container-fluid">

<a href="dashboard.php"
   class="navbar-brand">

   Admin Panel

</a>

<a href="logout.php"
   class="btn btn-warning">

   Logout

</a>

</div>

</nav>

<div class="container mt-5">

<div class="card shadow border-0">

<div class="card-header bg-dark text-white">

<h2>

<i class="fa-solid fa-cart-shopping"></i>

Manage Orders

</h2>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-dark">

<tr>

<th>Order ID</th>
<th>Customer</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Actions</th>

</tr>

</thead>

<tbody>

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<tr>

<td>

#<?php echo $row['id']; ?>

</td>

<td>

<?php echo $row['name']; ?>

</td>

<td>

₹<?php echo $row['total_amount']; ?>

</td>

<td>

<?php
$status = $row['status'];

if($status == "Pending")
{
    echo "<span class='badge bg-warning text-dark'>
          Pending
          </span>";
}
elseif($status == "Shipped")
{
    echo "<span class='badge bg-primary'>
          Shipped
          </span>";
}
else
{
    echo "<span class='badge bg-success'>
          Delivered
          </span>";
}
?>

</td>

<td>

<?php echo $row['created_at']; ?>

</td>

<td>

<a href="order_details.php?id=<?php echo $row['id']; ?>"
class="btn btn-info btn-sm">

<i class="fa fa-eye"></i> View

</a>

<a href="update-order-status.php?id=<?php echo $row['id']; ?>&status=Shipped"
class="btn btn-primary btn-sm">

<i class="fa fa-truck"></i> Ship

</a>

<a href="update-order-status.php?id=<?php echo $row['id']; ?>&status=Delivered"
class="btn btn-success btn-sm">

<i class="fa fa-check"></i> Deliver

</a>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>
</html>