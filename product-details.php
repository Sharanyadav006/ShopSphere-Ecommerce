<?php

session_start();

include 'config/db.php';

include 'includes/header.php';
include 'includes/navbar.php';

if(!isset($_GET['id']))
{
    header("Location: products.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM products
        WHERE id='$id'";

$result = mysqli_query($conn, $sql);

$product = mysqli_fetch_assoc($result);
$avg_sql = "SELECT
AVG(rating) AS avg_rating,
COUNT(*) AS total_reviews
FROM reviews
WHERE product_id='$id'";

$avg_result = mysqli_query($conn, $avg_sql);

$avg = mysqli_fetch_assoc($avg_result);
if(isset($_POST['submit_review']))
{
    if(isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id'];

        $rating = $_POST['rating'];

        $review = $_POST['review'];

        $insert_review =

        "INSERT INTO reviews
        (user_id, product_id, rating, review)

        VALUES

        ('$user_id',
         '$id',
         '$rating',
         '$review')";

        mysqli_query($conn, $insert_review);
    }
}
?>

<div class="container mt-5">

<div class="row g-5">

<!-- Product Image -->

<div class="col-md-6">

<div class="card shadow border-0">

<img src="uploads/<?php echo $product['image']; ?>"
     class="img-fluid rounded"
     style="height:500px;
            object-fit:cover;">

</div>

</div>

<!-- Product Details -->

<div class="col-md-6">

<h1 class="fw-bold mb-3">

<?php echo $product['name']; ?>

</h1>

<h2 class="text-success mb-4">

₹<?php echo $product['price']; ?>

</h2>
<div class="mb-3">

<?php

$rating = round($avg['avg_rating']);

for($i=1; $i<=5; $i++)
{
    if($i <= $rating)
        echo "⭐";
    else
        echo "☆";
}

?>

<span class="ms-2">

<?php
echo number_format($avg['avg_rating'],1);
?>

/5

(<?php echo $avg['total_reviews']; ?> Reviews)

</span>

</div>

<p class="text-muted fs-5 mb-4">

<?php echo $product['description']; ?>

</p>

<h5 class="mb-4">

Availability:

<?php
if($product['stock'] > 0)
{
?>

<span class="badge bg-success">

In Stock

</span>

<?php
}
else
{
?>

<span class="badge bg-danger">

Out Of Stock

</span>

<?php
}
?>

</h5>

<h5 class="mb-4">

Stock Remaining:

<span class="text-primary">

<?php echo $product['stock']; ?>

</span>

</h5>

<div class="d-flex gap-3">

<a href="add-to-cart.php?id=<?php echo $product['id']; ?>"
   class="btn btn-success btn-lg">

   Add To Cart

</a>

<a href="products.php"
   class="btn btn-dark btn-lg">

   Back

</a>

</div>

</div>

</div>

</div>
<!-- Reviews Section -->

<div class="container mt-5">

<div class="card shadow border-0">

<div class="card-body">

<h3 class="mb-4">

Customer Reviews

</h3>

<!-- Review Form -->

<?php
if(isset($_SESSION['user_id']))
{
?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Rating

</label>

<select name="rating"
        class="form-select"
        required>

<option value="">Select Rating</option>

<option value="5">⭐⭐⭐⭐⭐</option>
<option value="4">⭐⭐⭐⭐</option>
<option value="3">⭐⭐⭐</option>
<option value="2">⭐⭐</option>
<option value="1">⭐</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">

Review

</label>

<textarea name="review"
          class="form-control"
          rows="4"
          placeholder="Write your review"
          required></textarea>

</div>

<button type="submit"
        name="submit_review"
        class="btn btn-dark">

Submit Review

</button>

</form>

<hr>

<?php
}
?>

<!-- Display Reviews -->

<?php

$review_sql =

"SELECT reviews.*,
 users.name

 FROM reviews

 JOIN users

 ON reviews.user_id = users.id

 WHERE product_id='$id'

 ORDER BY reviews.id DESC";

$review_result =
mysqli_query($conn,
             $review_sql);

while($review =
      mysqli_fetch_assoc($review_result))
{
?>

<div class="mb-4">

<h5>

<?php echo $review['name']; ?>

</h5>

<p class="text-warning">

<?php

for($i=1;
    $i <= $review['rating'];
    $i++)
{
    echo "⭐";
}

?>

</p>

<p>

<?php echo $review['review']; ?>

</p>

<small class="text-muted">

<?php echo $review['created_at']; ?>

</small>

<hr>

</div>

<?php
}
?>

</div>

</div>

</div>
<?php
include 'includes/footer.php';
?>