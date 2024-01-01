<?php
include "./connection/connectCustomer.php";

if (isset($_GET['oid'])) {
    $oid = $_GET['oid'];

    $delQ = "UPDATE `orders` SET delivery_status=1 WHERE cust_id='$oid'";

    $delRes = mysqli_query($conCust, $delQ);

    if ($delRes) {
        header("location:newOrders.php");
    }
}

?>