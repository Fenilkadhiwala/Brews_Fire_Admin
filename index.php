<?php

session_name("admin");
session_start();

if (isset($_SESSION["adminId"])) {
    header("location:dashboard.php");
}

if (isset($_SESSION['error'])) {
    $errorStr = $_SESSION['error'];
    session_destroy();
} else {
    $errorStr = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
    body {
        background-color: #f1f1f1;
    }

    .formContainer {
        box-shadow: 4px 8px 16px #d7d7d7;
        margin: 75px auto;
        padding: 20px;
        border-radius: 0px 0px 4px 4px;
    }

    input {
        box-shadow: none !important;
        outline: none;
    }

    #formHeading {
        background: #63cd9c;
        margin: -20px;
        border-radius: 4px 4px 0px 0px;

    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="main.css">
    <title>Brews Fire | Log In</title>
    <style>
    #myBtn {
        /* background:red; */
        border-radius: 0px;
        background: #198754;
        color: white;
    }
    </style>
</head>

<body>
    <nav style="height:76px;" class="navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-between align-items-center order-lg-0" href="#">

                <span class="text-uppercase fw-lighter ms-2">Brews Fire</span>
            </a>
        </div>
    </nav>
    <div class="p-4" id="parent">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-6 col-lg-6 mx-auto">
                    <div class="formContainer">


                        <div class="text-center mb-4">
                            <p style="color: red; font-weight: bold;"><?php echo "$errorStr"; ?></p>
                        </div>

                        <h2 class="p-2 text-center mb-4 h4" id="formHeading">Admin Login</h2>
                        <form action="signin.php" method="post">
                            <div class="form-group mt-3">
                                <label class="mb-2" for="uname">Email <span style="color: red;">*</span></label>
                                <input class="form-control" id="username" name="email" type="text" placeholder="email"
                                    required />
                            </div>
                            <div class="form-group mt-3">
                                <label class="mb-2" for="psw">Password <span style="color: red;">*</span></label>
                                <input class="form-control" id="password" name="psw" placeholder="password"
                                    type="password" required />
                            </div>

                            <div class="form-group mt-3">
                                <a href="forget.php">Forget Password</a>
                            </div>

                            <button id="myBtn" name="login" class="btn btn-success btn-lg w-100 mt-4">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>