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

$sql = "SELECT
orders.id,
orders.total_amount,
orders.status,
orders.created_at,
order_items.quantity,
order_items.price,
products.name,
products.image

FROM orders

INNER JOIN order_items
ON orders.id = order_items.order_id

INNER JOIN products
ON order_items.product_id = products.id

WHERE orders.user_id='$user_id'

ORDER BY orders.created_at DESC";

//$result = mysqli_query($conn, $sql);
$result = mysqli_query($conn, $sql);

if(!$result)
{
    die(mysqli_error($conn));
}
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">📦 My Orders</h2>

        <a href="products.php" class="btn btn-dark">
            Continue Shopping
        </a>

    </div>

    <?php if(mysqli_num_rows($result) > 0){ ?>

    <div class="table-responsive">

        <table class="table table-hover align-middle shadow">

            <thead class="table-dark">

                <tr>
                    <th>Order ID</th>
                    
                    <th>Image</th>

                    <th>Product</th>

                    <th>Price</th>

                    <th>Quantity</th>

                    <th>Total</th>

                    <th>Status</th>

                    <th>Order Date</th>

                    <th>Invoice</th>

                </tr>

            </thead>

            <tbody>

            <?php
            while($row = mysqli_fetch_assoc($result))
            {
            ?>

            <tr>
                  <td>#<?php echo $row['id']; ?></td>
                <td>

                    <img src="uploads/<?php echo $row['image']; ?>"
                         width="80"
                         height="80"
                         style="object-fit:cover;border-radius:10px;">

                </td>

                <td>

                    <strong>

                    <?php echo $row['name']; ?>

                    </strong>

                </td>

                <td>

                    ₹<?php echo $row['price']; ?>

                </td>

                <td>

                    <?php echo $row['quantity']; ?>

                </td>

                <td class="fw-bold text-success">

                    ₹<?php echo $row['price'] * $row['quantity']; ?>

                </td>

                <td>

                    <?php
                    if($row['status']=="Pending")
                    {
                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                    }
                    elseif($row['status']=="Shipped")
                    {
                        echo '<span class="badge bg-primary">Shipped</span>';
                    }
                    elseif($row['status']=="Delivered")
                    {
                        echo '<span class="badge bg-success">Delivered</span>';
                    }
                    else
                    {
                        echo '<span class="badge bg-danger">'.$row['status'].'</span>';
                    }
                    ?>

                </td>

                <td>

                    <?php echo $row['created_at']; ?>

                </td>
                <td>

<a href="invoice.php?id=<?php echo $row['id']; ?>"
   class="btn btn-primary btn-sm">

    📄 View Invoice

</a>

</td>

            </tr>

            <?php
            }
            ?>

            </tbody>

        </table>

    </div>

    <?php } else { ?>

    <div class="card shadow border-0">

        <div class="card-body text-center py-5">

            <h3>No Orders Yet 📦</h3>

            <p class="text-muted">

                You haven't placed any orders yet.

            </p>

            <a href="products.php" class="btn btn-success">

                Start Shopping

            </a>

        </div>

    </div>

    <?php } ?>

</div>

<style>

.table
{
    border-radius:15px;
    overflow:hidden;
}

.table tbody tr:hover
{
    background:#f8f9fa;
}

.badge
{
    padding:8px 12px;
    font-size:14px;
}

</style>

<?php
include 'includes/footer.php';
?>