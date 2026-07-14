<?php

session_start();

include 'config/db.php';
include 'includes/functions.php';

if(isset($_POST['login']))
{
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    $stmt = mysqli_prepare($conn,
            "SELECT * FROM users WHERE email=?");

    mysqli_stmt_bind_param($stmt,
                           "s",
                           $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,
                           $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];

            $_SESSION['user_name'] = $user['name'];

            header("Location: dashboard.php");
        }
        else
        {
            $error = "Wrong Password";
        }
    }
    else
    {
        $error = "User Not Found";
    }
}

include 'includes/header.php';
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">
                    User Login
                </h2>

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

                    <input type="email"
                           name="email"
                           class="form-control mb-3"
                           placeholder="Enter Email"
                           required>

                    <input type="password"
                           name="password"
                           class="form-control mb-3"
                           placeholder="Enter Password"
                           required>

                    <button type="submit"
                            name="login"
                            class="btn btn-primary w-100">

                        Login

                    </button>

                </form>

                <p class="mt-3 text-center">

                    Don't have an account?

                    <a href="register.php">
                        Register
                    </a>

                </p>

            </div>

        </div>

    </div>

</div>

<?php
include 'includes/footer.php';
?>