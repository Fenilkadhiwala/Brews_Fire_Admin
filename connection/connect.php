<?php

$lh = "localhost";
$un = "root";
$ps = "";
$db = "brewsfireadmin";




$con = new mysqli($lh, $un, $ps, $db);

if (!$con) {
    die($con);
}

?>