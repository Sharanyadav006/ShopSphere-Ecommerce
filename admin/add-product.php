<?php

session_start();

if(!isset($_SESSION['admin_id']))
{
    header("Location: login.php");
    exit();
}

include '../config/db.php';

if(isset($_POST['add_product']))
{
    $name = $_POST['name'];

    $description = $_POST['description'];

    $price = $_POST['price'];

    $stock = $_POST['stock'];

    $category_id = $_POST['category_id'];

    $image = $_FILES['image']['name'];

    $tmp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp_name,
                       "../uploads/".$image);

    $sql = "INSERT INTO products
            (name,description,price,image,stock,category_id)

            VALUES

            ('$name',
             '$description',
             '$price',
             '$image',
             '$stock',
             '$category_id')";

    if(mysqli_query($conn, $sql))
    {
        $success = "Product Added Successfully";
    }
    else
    {
        $error = "Failed To Add Product";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Add Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow-lg border-0">

<div class="card-header bg-dark text-white">

<h2 class="text-center">
    Add New Product
</h2>

</div>

<div class="card-body p-4">

<?php
if(isset($success))
{
?>

<div class="alert alert-success">

    <?php echo $success; ?>

</div>

<?php
}
?>

<?php
if(isset($error))
{
?>

<div class="alert alert-danger">

    <?php echo $error; ?>

</div>

<?php
}
?>

<form method="POST"
      enctype="multipart/form-data">

    <div class="mb-3">

        <label class="form-label">

            Product Name

        </label>

        <input type="text"
               name="name"
               class="form-control"
               placeholder="Enter Product Name"
               required>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Description

        </label>

        <textarea name="description"
                  class="form-control"
                  rows="4"
                  placeholder="Enter Product Description"
                  required></textarea>

    </div>

    <div class="row">

        <div class="col-md-6 mb-3">

            <label class="form-label">

                Price

            </label>

            <input type="number"
                   name="price"
                   class="form-control"
                   placeholder="Enter Price"
                   required>

        </div>

        <div class="col-md-6 mb-3">

            <label class="form-label">

                Stock

            </label>

            <input type="number"
                   name="stock"
                   class="form-control"
                   placeholder="Enter Stock"
                   required>

        </div>

    </div>

    <div class="mb-3">

        <label class="form-label">

            Category

        </label>

        <select name="category_id"
                class="form-select"
                required>

            <option value="">
                Select Category
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

    <div class="mb-4">

        <label class="form-label">

            Product Image

        </label>

        <input type="file"
               name="image"
               class="form-control"
               required>

    </div>

    <button type="submit"
            name="add_product"
            class="btn btn-dark w-100">

        Add Product

    </button>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>