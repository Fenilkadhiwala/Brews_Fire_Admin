<?php

session_name("admin");
session_start();


// session_destroy();

unset($_SESSION['adminId']);

header("location:index.php");

exit();
?>