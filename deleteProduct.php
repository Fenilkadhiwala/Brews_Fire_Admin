<?php

include "./connection/connect.php";

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];

    $upQ = "DELETE FROM `products` WHERE id='$pid'";
    $upRes = mysqli_query($con, $upQ);

    if ($upRes) {
        header("location:allProduct.php");
    }

}

?>