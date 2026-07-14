<?php

session_start();

include 'config/db.php';

include 'includes/header.php';
include 'includes/navbar.php';
$limit = 9;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if($page < 1)
{
    $page = 1;
}

$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM products WHERE 1";

if(isset($_GET['search']) &&
   !empty($_GET['search']))
{
    $search = $_GET['search'];

    $sql .= " AND name LIKE '%$search%'";
}

if(isset($_GET['category']) &&
   !empty($_GET['category']))
{
    $category = $_GET['category'];

    $sql .= " AND category_id='$category'";
}
if(isset($_GET['sort']))
{
    if($_GET['sort']=="low")
    {
        $sql .= " ORDER BY price ASC";
    }
    elseif($_GET['sort']=="high")
    {
        $sql .= " ORDER BY price DESC";
    }
}
else
{
    $sql .= " ORDER BY id DESC";
}
$count_result = mysqli_query($conn, $sql);
$total_products = mysqli_num_rows($count_result);

$sql .= " LIMIT $offset, $limit";

$result = mysqli_query($conn, $sql);

?>

<div class="container mt-5">

<!-- Page Title -->

<div class="d-flex justify-content-between
            align-items-center mb-4">

<h1 class="fw-bold">

    Our Products

</h1>

</div>

<!-- Search + Filter -->

<div class="card shadow border-0 mb-5">

<div class="card-body">

<form method="GET">

<div class="row g-3">

<div class="col-md-4">

<input type="text"
       name="search"
       class="form-control"
       placeholder="Search Products">

</div>

<div class="col-md-3">

<select name="category"
        class="form-select">

<option value="">
    All Categories
</option>


<?php

$cat_sql = "SELECT * FROM categories";

$cat_result = mysqli_query($conn,
                           $cat_sql);

while($cat =
      mysqli_fetch_assoc($cat_result))
{
?>

<option value="<?php echo $cat['id']; ?>">

<?php echo $cat['name']; ?>

</option>

<?php
}
?>

</select>

</div>
<div class="col-md-2">

<select name="sort" class="form-select">

<option value="">Sort By</option>

<option value="low">
Price: Low to High
</option>

<option value="high">
Price: High to Low
</option>

</select>

</div>

<div class="col-md-3">

<button type="submit"
        class="btn btn-dark w-100">

    Search

</button>

</div>

</div>

</form>

</div>

</div>

<!-- Product Grid -->

<div class="row">

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<div class="col-md-4 mb-4">

<div class="card h-100 shadow border-0
            product-card">

<a href="product-details.php?id=<?php echo $row['id']; ?>">

<img src="uploads/<?php echo $row['image']; ?>"
     class="card-img-top"
     style="height:250px;
            object-fit:cover;">

</a>

<div class="card-body d-flex flex-column">

<h5 class="card-title">

<a href="product-details.php?id=<?php echo $row['id']; ?>"
   class="text-decoration-none text-dark">

<?php echo $row['name']; ?>

</a>

</h5>

<p class="card-text text-muted">

<?php
echo substr($row['description'],
            0,
            80);
?>

...

</p>

<h4 class="text-success mb-3">

₹<?php echo $row['price']; ?>

</h4>

<div class="mt-auto">

<a href="add-to-cart.php?id=<?php echo $row['id']; ?>"
   class="btn btn-success w-100">

   Add To Cart

</a>
<a href="add-to-wishlist.php?id=<?php echo $row['id']; ?>"
   class="btn btn-outline-dark w-100 mt-2">

   ❤️ Wishlist

</a>
</div>

</div>

</div>

</div>

<?php
}
?>

</div>

</div>

<style>

.product-card
{
    transition: 0.3s;
}

.product-card:hover
{
    transform: translateY(-8px);
}

</style>
<?php

$total_pages = ceil($total_products / $limit);

if($total_pages > 1)
{
?>

<nav class="mt-5">

<ul class="pagination justify-content-center">

<?php
for($i = 1; $i <= $total_pages; $i++)
{
?>

<li class="page-item <?php if($page == $i) echo 'active'; ?>">

<a class="page-link"
href="?page=<?php echo $i; ?>
&search=<?php echo urlencode($_GET['search'] ?? ''); ?>
&category=<?php echo $_GET['category'] ?? ''; ?>
&sort=<?php echo $_GET['sort'] ?? ''; ?>">

<?php echo $i; ?>

</a>

</li>

<?php
}
?>

</ul>

</nav>

<?php
}
?>
<?php
include 'includes/footer.php';
?>