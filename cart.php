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

$sql = "SELECT cart.id AS cart_id,
        products.*,
        cart.quantity

        FROM cart

        JOIN products

        ON cart.product_id = products.id

        WHERE cart.user_id='$user_id'";

$result = mysqli_query($conn, $sql);

$total = 0;

?>

<div class="container mt-5">

<h1 class="mb-4 fw-bold">

Shopping Cart

</h1>

<div class="card shadow border-0">

<div class="card-body">

<div class="table-responsive">

<table class="table align-middle">

<thead class="table-dark">

<tr>

<th>Product</th>
<th>Image</th>
<th>Price</th>
<th>Quantity</th>
<th>Subtotal</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php
while($row = mysqli_fetch_assoc($result))
{
$subtotal =
$row['price'] * $row['quantity'];

$total += $subtotal;
?>

<tr>

<td>

<?php echo $row['name']; ?>

</td>

<td>

<img src="uploads/<?php echo $row['image']; ?>"
     width="80"
     height="80"
     style="object-fit:cover;
            border-radius:10px;">

</td>

<td>

₹<?php echo $row['price']; ?>

</td>

<td>

<a href="update-quantity.php?action=decrease&id=<?php echo $row['cart_id']; ?>"
   class="btn btn-danger btn-sm">

   -

</a>

<span class="mx-2 fw-bold">

<?php echo $row['quantity']; ?>

</span>

<a href="update-quantity.php?action=increase&id=<?php echo $row['cart_id']; ?>"
   class="btn btn-success btn-sm">

   +

</a>

</td>

<td>

₹<?php echo $subtotal; ?>

</td>

<td>

<a href="remove-from-cart.php?id=<?php echo $row['cart_id']; ?>"
   class="btn btn-dark btn-sm">

   Remove

</a>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

<div class="d-flex justify-content-between
            align-items-center mt-4">

<h3>

Total:
<span class="text-success">

₹<?php echo $total; ?>

</span>

</h3>

<a href="payment.php?amount=<?php echo $total; ?>"
   class="btn btn-success btn-lg">

   Proceed To Payment

</a>

</div>

</div>

</div>

</div>

<?php
include 'includes/footer.php';
?>