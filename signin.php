<?php

include "./connection/connect.php";

if (isset($_POST['login'])) {


    $email = $_POST['email'];
    $psw = $_POST['psw'];

    $query = "SELECT * FROM `admin` WHERE email='$email' AND psw='$psw'";


    $result = mysqli_query($con, $query);

    $rows = mysqli_fetch_assoc($result);

    if ($rows) {

        session_name("admin");
        session_start();
        $_SESSION['adminId'] = $rows['id'];
        $_SESSION['fname'] = $rows['fname'];
        $_SESSION['lname'] = $rows['lname'];
        header("location:dashboard.php");
    } else {

        $error = "Wrong Username or Password";

        session_name("admin");
        session_start();
        $_SESSION['error'] = $error;
        header("location:index.php");

    }

}

?>