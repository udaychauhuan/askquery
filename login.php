<?php

//error_reporting (E_ALL ^ E_NOTICE);
session_start();
include("include/classloader.php");

$email = "";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $login = new Login();
    $result = $login->evaluat($_POST);
    if ($result != "") {
        # code...
        echo '<div class="alert alert-danger alert-dismissible text-center text-capitalize " role="alert">';
        echo $result;
        echo '</div>';
    } else {
        header("location: index.php");
        die;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .form_bg {
            background: linear-gradient(to bottom, #ebebe0, #a3a375, #4d4d33);
            height: 100vh;
            display: flex;
            align-items: center;

        }

        .form_horizontal {
            font-family: 'lato', san-serif;
            text-align: center;
        }

        .form_horizontal .form_icon {

            color: #fff;
            font-size: 100px;
            line-height: 85px;
            margin: 0 0 13px;
        }

        .form_horizontal .title {
            color: #fff;
            font-size: 23px;
            font-weight: 700;
            Letter-spacing: 1 px;
            text-transform: uppercase;
            margin: 0 0 35px 0;
        }

        .form_horizontal .form-group {
            margin: 0 0 10px;
            position: relative;
        }

        .form_horizontal .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            color: #777;
        }

        .form_horizontal .form-control {
            color: #555;
            background-color: #fff;
            font-size: 13px;
            Letter-spacing: 1px;
            height: 37px;
            padding: 2px 15px 2px 35px;
            border: none;
            border-radius: 50px;
        }

        .form_horizontal .form-control::placeholder {
            color: rgba(0, 0, 0, 0.7);
            font-size: 14px;
            text-transform: capitalize;
        }

        .form_horizontal .btn {
            color: #fff;
            background-color: #222;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1px;
            width: 100%;
            padding: 10px 20px;
            margin: 0 0 15px 0;
            border: none;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .form_horizontal .form-options {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .form_horizontal .form-options li a {
            color: #fff;
            letter-spacing: 0.5px;
            margin: 0 0 10px;
            display: black;
        }

        .form_horizontal .form-options li a i {
            font-size: 12px;
        }
    </style>

    <title>Askquery / Login</title>

</head>

<body>




    <div class="form_bg ">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 ">
                    <form method="post" class="form_horizontal" autocomplete="off">
                        <div class="form_icon shadow"><i class="fa fa-user-circle"></i></div>
                        <h3 class="title">login Form</h3>
                        <div class="form-group">
                            <span class="input-icon shadow"><i class="fa fa-user"></i></span>
                            <input value='<?php echo $email ?>' type="email" placeholder="Username" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <span class="input-icon"><i class="fa fa-lock"></i></span>
                            <input value='<?php echo $password ?>' type="password" placeholder="password" name="password" class="form-control" require>
                        </div>
                        <button class="btn sighin">Login</button>

                        <ul class="form-options">
                            <li><a href="#">Forgot Password</a></li>
                            <li><a href="signup.php">Create New Account <i class="fa fa-arrow-right"></i> </a></li>
                        </ul>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>