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

if(!isset($_GET['id']))
{
    header("Location: orders.php");
    exit();
}

$order_id = $_GET['id'];
$user_id = $_SESSION['user_id'];
$sql = "SELECT
orders.*,
users.name,
users.email,
users.phone,
users.address

FROM orders

JOIN users
ON orders.user_id = users.id

WHERE orders.id='$order_id'
AND orders.user_id='$user_id'";

$result = mysqli_query($conn, $sql);

$order = mysqli_fetch_assoc($result);
?>

<div class="container mt-5 mb-5">

<div class="card shadow">

<div class="card-header bg-dark text-white">

<h2 class="mb-0">
🧾 ShopSphere Invoice
</h2>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<h5>Customer Details</h5>

<p>

<strong>Name:</strong>
<?php echo $order['name']; ?>

</p>

<p>

<strong>Email:</strong>
<?php echo $order['email']; ?>

</p>

<p>

<strong>Phone:</strong>
<?php echo $order['phone']; ?>

</p>

<p>

<strong>Address:</strong>
<?php echo $order['address']; ?>

</p>

</div>

<div class="col-md-6 text-end">

<h5>Order Details</h5>

<p>

<strong>Order ID:</strong>

#<?php echo $order['id']; ?>

</p>

<p>

<strong>Date:</strong>

<?php echo $order['created_at']; ?>

</p>

<p>

<strong>Status:</strong>

<?php echo $order['status']; ?>

</p>

</div>

</div>

<hr>
<h4 class="mb-3">

Products Ordered

</h4>

<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>Product</th>

<th>Price</th>

<th>Quantity</th>

<th>Total</th>

</tr>

</thead>

<tbody>

<?php

$item_sql = "SELECT
order_items.*,
products.name

FROM order_items

JOIN products

ON order_items.product_id = products.id

WHERE order_items.order_id='$order_id'";

$item_result = mysqli_query($conn, $item_sql);

while($item = mysqli_fetch_assoc($item_result))
{

?>

<tr>

<td>

<?php echo $item['name']; ?>

</td>

<td>

₹<?php echo $item['price']; ?>

</td>

<td>

<?php echo $item['quantity']; ?>

</td>

<td>

₹<?php echo $item['price'] * $item['quantity']; ?>

</td>

</tr>

<?php
}
?>

</tbody>

</table>
<div class="text-end">

<h3>

Grand Total :

<span class="text-success">

₹<?php echo $order['total_amount']; ?>

</span>

</h3>

</div>
<div class="mt-4">

<button
onclick="window.print()"
class="btn btn-success">

🖨 Print Invoice

</button>

<a href="orders.php"
class="btn btn-secondary">

Back to Orders

</a>

</div>

</div>

</div>

</div>

<?php
include 'includes/footer.php';
?>