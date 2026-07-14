<?php

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

include 'config/db.php';

$user_id = $_SESSION['user_id'];

$product_id = $_GET['id'];

$check =

"SELECT * FROM wishlist

 WHERE user_id='$user_id'

 AND product_id='$product_id'";

$check_result =
mysqli_query($conn, $check);

if(mysqli_num_rows($check_result) == 0)
{
    $sql =

    "INSERT INTO wishlist
    (user_id, product_id)

    VALUES

    ('$user_id',
     '$product_id')";

    mysqli_query($conn, $sql);
}

header("Location: wishlist.php");

?>