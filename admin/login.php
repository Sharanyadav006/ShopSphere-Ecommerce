<?php

session_start();

include '../config/db.php';

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn,
            "SELECT * FROM admins WHERE email=?");

    mysqli_stmt_bind_param($stmt,
                           "s",
                           $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0)
    {
        $admin = mysqli_fetch_assoc($result);

        if(password_verify($password,
                           $admin['password']))
        {
            $_SESSION['admin_id'] = $admin['id'];

            header("Location: dashboard.php");
        }
        else
        {
            $error = "Wrong Password";
        }
    }
    else
    {
       $error = "Admin Not Found";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
    background:linear-gradient(135deg,#0f172a,#1e3a8a,#2563eb);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial,sans-serif;
}

.login-card{
    width:420px;
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 15px 35px rgba(0,0,0,.3);
}

.card-header{
    background:#111827;
    color:white;
    text-align:center;
    padding:30px;
}

.card-header i{
    font-size:60px;
    margin-bottom:15px;
}

.card-body{
    padding:35px;
}

.form-control{
    height:50px;
    border-radius:10px;
}

.btn-login{
    height:50px;
    border-radius:10px;
    font-size:18px;
    font-weight:bold;
}

.footer-text{
    text-align:center;
    color:#777;
    margin-top:20px;
}

</style>
</head>
<body>

<div class="card login-card">

<div class="card-header">

<i class="fa-solid fa-user-shield"></i>

<h2>ShopSphere</h2>

<p>Admin Login Panel</p>

</div>

<div class="card-body">
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
<form method="POST">

<div class="mb-3">

<label>Email Address</label>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter Admin Email"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required>

</div>

<div class="d-grid">

<button
type="submit"
name="login"
class="btn btn-dark btn-login">

<i class="fa-solid fa-right-to-bracket"></i>

 Login

</button>

</div>

</form>

<div class="footer-text">


</div>

</div>

</div>

</body>
</html>