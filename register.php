<?php

include 'config/db.php';
include 'includes/functions.php';

if(isset($_POST['register']))
{
    $name = sanitize($_POST['name']);

    $email = sanitize($_POST['email']);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $error = "Invalid Email Format";
    }
    else
    {
        $password = password_hash($_POST['password'],
                                  PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn,
                "INSERT INTO users(name,email,password)
                 VALUES(?,?,?)");

        mysqli_stmt_bind_param($stmt,
                               "sss",
                               $name,
                               $email,
                               $password);

        if(mysqli_stmt_execute($stmt))
        {
            $success = "Registration Successful";
        }
        else
        {
            $error = "Registration Failed";
        }
    }
}

include 'includes/header.php';
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow p-4">

                <h2 class="text-center mb-4">
                    User Registration
                </h2>

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

                <form method="POST">

                    <input type="text"
                           name="name"
                           class="form-control mb-3"
                           placeholder="Enter Name"
                           required>

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
                            name="register"
                            class="btn btn-success w-100">

                        Register

                    </button>

                </form>

                <p class="mt-3 text-center">

                    Already have an account?

                    <a href="login.php">
                        Login
                    </a>

                </p>

            </div>

        </div>

    </div>

</div>

<?php
include 'includes/footer.php';
?>