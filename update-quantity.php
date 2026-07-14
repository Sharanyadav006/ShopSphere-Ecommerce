<?php

include 'config/db.php';

$id = $_GET['id'];
$action = $_GET['action'];

if($action == "increase")
{
    $sql = "UPDATE cart
            SET quantity = quantity + 1
            WHERE id='$id'";

    mysqli_query($conn, $sql);
}

if($action == "decrease")
{
    $check_sql = "SELECT * FROM cart WHERE id='$id'";

    $result = mysqli_query($conn, $check_sql);

    $cart = mysqli_fetch_assoc($result);

    if($cart['quantity'] > 1)
    {
        $sql = "UPDATE cart
                SET quantity = quantity - 1
                WHERE id='$id'";

        mysqli_query($conn, $sql);
    }
    else
    {
        $delete_sql = "DELETE FROM cart WHERE id='$id'";

        mysqli_query($conn, $delete_sql);
    }
}

header("Location: cart.php");

?>