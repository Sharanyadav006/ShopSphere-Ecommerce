<?php
session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include '../config/db.php';

if(!isset($_GET['id']))
{
    header("Location: orders.php");
    exit();
}

$order_id = $_GET['id'];
$sql = "SELECT
orders.*,
users.name,
users.email,
shipping_addresses.phone,
shipping_addresses.address,
shipping_addresses.city,
shipping_addresses.state,
shipping_addresses.pincode

FROM orders

JOIN users
ON orders.user_id = users.id

LEFT JOIN shipping_addresses
ON orders.user_id = shipping_addresses.user_id

WHERE orders.id='$order_id'";

$result = mysqli_query($conn,$sql);

$order = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>

<head>

<title>Order Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h2>
<i class="fa-solid fa-receipt"></i>

Order Details

</h2>

</div>

<div class="card-body">

<h4 class="mb-4">

Customer Information

</h4>

<table class="table table-bordered">

<tr>

<th width="250">Customer Name</th>

<td><?php echo $order['name']; ?></td>

</tr>

<tr>

<th>Email</th>

<td><?php echo $order['email']; ?></td>

</tr>

<tr>

<th>Phone</th>

<td><?php echo $order['phone']; ?></td>

</tr>

<tr>

<th>Address</th>

<td>

<?php
echo $order['address'].", ".
     $order['city'].", ".
     $order['state']." - ".
     $order['pincode'];
?>

</td>

</tr>

<tr>

<th>Total Amount</th>

<td class="fw-bold text-success">

₹<?php echo $order['total_amount']; ?>

</td>

</tr>

<tr>

<th>Status</th>

<td>

<?php

$status = $order['status'];

if($status=="Pending")
{
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}
elseif($status=="Shipped")
{
    echo "<span class='badge bg-primary'>Shipped</span>";
}
else
{
    echo "<span class='badge bg-success'>Delivered</span>";
}

?>

</td>

</tr>

<tr>

<th>Order Date</th>

<td>

<?php echo $order['created_at']; ?>

</td>

</tr>

</table>
<div class="mt-4">

<a href="orders.php"
class="btn btn-secondary">

<i class="fa-solid fa-arrow-left"></i>

Back to Orders

</a>

</div>

</div>

</div>

</div>

</body>

</html>
