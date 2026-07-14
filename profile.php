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

$result = mysqli_query($conn,
"SELECT * FROM users WHERE id='$user_id'");

$user = mysqli_fetch_assoc($result);
if(isset($_POST['update_profile']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    if(!empty($password))
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        mysqli_query($conn,
        "UPDATE users SET
        name='$name',
        email='$email',
        phone='$phone',
        address='$address',
        password='$password'
        WHERE id='$user_id'");
    }
    else
    {
        mysqli_query($conn,
        "UPDATE users SET
        name='$name',
        email='$email',
        phone='$phone',
        address='$address'
        WHERE id='$user_id'");
    }

    echo "<script>alert('Profile Updated Successfully');</script>";

    $result = mysqli_query($conn,
    "SELECT * FROM users WHERE id='$user_id'");

    $user = mysqli_fetch_assoc($result);
}

?>
<div class="container mt-5 mb-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="card shadow border-0">

<div class="card-header bg-dark text-white">

<h3 class="mb-0">👤 My Profile</h3>

</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label class="form-label">Full Name</label>

<input
type="text"
name="name"
class="form-control"
value="<?php echo $user['name']; ?>">

</div>

<div class="mb-3">

<label class="form-label">Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $user['email']; ?>">

</div>

<div class="mb-3">

<label class="form-label">Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?php echo $user['phone']; ?>">

</div>

<div class="mb-3">

<label class="form-label">Address</label>

<textarea
name="address"
class="form-control"
rows="4"><?php echo $user['address']; ?></textarea>

</div>

<div class="mb-3">

<label class="form-label">New Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Leave blank if you don't want to change">

</div>

<button
type="submit"
name="update_profile"
class="btn btn-success">

Update Profile

</button>

</form>

</div>

</div>

</div>

</div>

</div>