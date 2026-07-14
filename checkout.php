<?php

session_start();

include 'config/db.php';

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.product_id,
        cart.quantity,
        products.price
        FROM cart
        JOIN products
        ON cart.product_id = products.id
        WHERE cart.user_id='$user_id'";

$result = mysqli_query($conn, $sql);

$total = 0;

$cart_items = [];

while($row = mysqli_fetch_assoc($result))
{
    $cart_items[] = $row;

    $total += $row['price'] * $row['quantity'];
}

$order_sql = "INSERT INTO orders(user_id, total_amount)
              VALUES('$user_id', '$total')";

mysqli_query($conn, $order_sql);

$order_id = mysqli_insert_id($conn);

foreach($cart_items as $item)
{
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $price = $item['price'];

    $item_sql = "INSERT INTO order_items(order_id, product_id, quantity, price)
                 VALUES('$order_id', '$product_id', '$quantity', '$price')";

    mysqli_query($conn, $item_sql);
}

$clear_cart = "DELETE FROM cart WHERE user_id='$user_id'";

mysqli_query($conn, $clear_cart);

echo "Order Placed Successfully";

?>

<br><br>

<a href="orders.php">View Orders</a>