<?php
include_once('dbcon/connect.php');
include('includes/functions.php');
$action='Logged out.';
logEntry($action,$_SESSION['uid'],$con);
session_destroy();
header('location:login');
?>
