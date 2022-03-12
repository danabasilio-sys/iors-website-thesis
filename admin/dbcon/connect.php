<?php
try
{
    $con=new mysqli('localhost', 'inoureel_inoureel', 'KPVj#@6k(}iF','inoureel_db'); //host,user,password,dbname
    session_start();
    $url='https://inourredstilettos.com/admin'; //system base url
    $your_email='inourredstilettos.sa@gmail.com'; //phpmailer gmail
    $your_password='Superadmin1'; //phpmailer gmail
    date_default_timezone_set('Asia/Singapore');

}
catch(PDOException $e)
{
    die("connection failed: ".$e->getmessage());
}

?>
