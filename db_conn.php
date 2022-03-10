<?php

$sname = "localhost";
$uname = "inoureel_inoureel";
$password ="KPVj#@6k(}iF";
$db_name = "inoureel_db";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
    exit();
}

?>