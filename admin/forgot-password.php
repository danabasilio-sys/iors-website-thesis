<?php
include('dbcon/connect.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$email=null;
$email_err=null;
$yes= null;
$error= null;
if(isset($_POST['forgot']))
{

    $email=trim($_POST['email']);
    $valid= true;
    if(empty($email))
    {
        $valid=false;
        $email_err='Email is required';
    }
    if($valid)
    {

         $sql="SELECT * FROM `admin` WHERE `email`='$email'";
         $res=$con->query($sql);
        if($res->num_rows == 1)
        {

          $user=$res->fetch_assoc();
          $token=md5($user['id'].$user['email']);
          $admin_id=$user['id'];
          $sql="UPDATE `forgot_password` SET `consumed`=1, `expired`=1 WHERE `admin_id`=$admin_id";
          $con->query($sql);
          $date=date('Y-m-d H:i:s',strtotime("tomorrow"));
            $sql="INSERT INTO `forgot_password`(`admin_id`, `token`, `consumed`, `expired`, `expiration_date`) VALUES ($admin_id,'$token',0,0,'$date')";
            $res=$con->query($sql);
            if($res)
          {

              try {
                  //Server settings
                  $mail->SMTPDebug = false;
                  $mail->isSMTP();
                  $mail->Host       = 'smtp.gmail.com';
                  $mail->SMTPAuth   = true;
                  $mail->Username   = $your_email; //dbcon/connect.php
                  $mail->Password   = $your_password; //dbcon/connect.php
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                  $mail->Port       = 465;
                  $path=$url.'/recover-password';
                  //Recipients
                  $mail->setFrom($your_email, 'In Our Red Stilettos Admin Panel');
                  $mail->addAddress($email,$user['first_name']);     //Add a recipient
                  $mail->isHTML(true);
                  $mail->Subject = 'Recover Your Password';
                  $mail->Body    ='<a href="'.$path.'?id='.base64_encode($admin_id).'&token='.$token.'">Click here to reset your password</a>';
                  $mail->send();
                  $yes="Please check your Email";
              } catch (Exception $e) {
                  $error="Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }
          }
        }
        else
        {
            $email_err="Email not found";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<header>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/custom.css">
</header>
<body class="hold-transition login-page body">
<div class="login-box">
  <div class="card card-outline card-dark bg-dark text-white">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Admin Panel</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Recover Password</p>
        <?php if ($yes != null) { ?>
            <p class="alert alert-success"><?php echo $yes; ?></p>
        <?php } ?>
        <?php if ($error != null) { ?>
            <p class="alert alert-danger"><?php echo $error; ?></p>
        <?php } ?>
      <form action="#" method="post">
          <div class="mb-3">
              <div class="input-group">
                  <input type="email" class="form-control" placeholder="Email" name="email" required
                         value="<?php echo $email; ?>">
                  <div class="input-group-append">
                      <div class="input-group-text">
                          <span class="fas fa-envelope"></span>
                      </div>
                  </div>
              </div>
              <span class="text-danger"><?php echo $email_err; ?></span>
          </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="forgot" class="btn btn-primary btn-block">Request new password</button>
          </div>
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="login" class="text-white">Login</a>
      </p>
    </div>
  </div>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
