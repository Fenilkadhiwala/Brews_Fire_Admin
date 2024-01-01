<?php

$lh = "localhost";
$un = "root";
$ps = "";
$db = "brewsfire";




$conCust = new mysqli($lh, $un, $ps, $db);

if (!$conCust) {
    die($conCust);
}

?>