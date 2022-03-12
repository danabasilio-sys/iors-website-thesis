<?php 
$host = "localhost";
$username="inoureel_inoureel";
$password ="KPVj#@6k(}iF";
$database = "inoureel_db";

$con = mysqli_connect($host, $username, $password, $database);
session_start();
url='https://inourredstilettos.com/admin'; //system base url
    $your_email='inourredstilettos.sa@gmail.com'; //phpmailer gmail
    $your_password='Superadmin1'; //phpmailer gmail
    date_default_timezone_set('Asia/Singapore');
if (!$con) {
    echo "Connection failed!";
    exit();
}

?>