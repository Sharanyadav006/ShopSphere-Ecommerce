<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'config/db.php';
include 'includes/header.php';
include 'includes/navbar.php';

$amount = isset($_GET['amount']) ? $_GET['amount'] : 0;
if(isset($_POST['place_order']))
{
    $user_id = $_SESSION['user_id'];
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];
mysqli_query($conn,
"INSERT INTO shipping_addresses
(user_id, full_name, phone, email, address, city, state, pincode)
VALUES
('$user_id','$full_name','$phone','$email','$address','$city','$state','$pincode')");
    
    $insertOrder = mysqli_query($conn,
        "INSERT INTO orders(user_id,total_amount,status)
         VALUES('$user_id','$amount','Pending')");

    $order_id = mysqli_insert_id($conn);

    
    $cart = mysqli_query($conn,
        "SELECT * FROM cart WHERE user_id='$user_id'");

    while($item = mysqli_fetch_assoc($cart))
    {
        $product_id = $item['product_id'];
        $quantity   = $item['quantity'];

        
        $product = mysqli_query($conn,
            "SELECT price FROM products
             WHERE id='$product_id'");

        $row = mysqli_fetch_assoc($product);

        $price = $row['price'];

        mysqli_query($conn,
            "INSERT INTO order_items
            (order_id,product_id,quantity,price)
            VALUES
            ('$order_id','$product_id','$quantity','$price')");
    }

    
    mysqli_query($conn,
        "DELETE FROM cart WHERE user_id='$user_id'");

    header("Location: orders.php");
    exit();
}
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-lg border-0">

                <div class="card-header bg-success text-white text-center">

                    <h2>Payment</h2>

                </div>

                <div class="card-body">
<form method="POST">

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="full_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea name="address"
                  class="form-control"
                  rows="3"
                  required></textarea>
    </div>

    <div class="row">

        <div class="col-md-6">

            <label class="form-label">City</label>

            <input type="text"
                   name="city"
                   class="form-control"
                   required>

        </div>

        <div class="col-md-6">

            <label class="form-label">State</label>

            <input type="text"
                   name="state"
                   class="form-control"
                   required>

        </div>

    </div>

    <div class="mt-3">

        <label class="form-label">Pincode</label>

        <input type="text"
               name="pincode"
               class="form-control"
               required>

    </div>

    <hr>

    <h5>Total Amount</h5>

    <h2 class="text-success">
        ₹<?php echo $amount; ?>
    </h2>

    <hr>

    <h5>Payment Method</h5>

    <div class="form-check">

        <input class="form-check-input"
               type="radio"
               name="payment_method"
               value="COD"
               checked>

        <label class="form-check-label">
            Cash on Delivery
        </label>

    </div>

    <div class="form-check">

        <input class="form-check-input"
               type="radio"
               name="payment_method"
               value="ONLINE">

        <label class="form-check-label">
            Online Payment (Coming Soon)
        </label>

    </div>

    <div class="d-grid mt-4">

        <button type="submit"
                name="place_order"
                class="btn btn-success btn-lg">

            Place Order

        </button>

    </div>

</form>
                    

                   

                </div>

            </div>

        </div>

    </div>

</div>

<?php
include 'includes/footer.php';
?>