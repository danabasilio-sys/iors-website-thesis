<?php
include('dbcon/connect.php');
include('includes/functions.php');
$email=null;
$token=null;
$password=null;
$cpassword=null;
$password_err=null;
$cpassword_err=null;
$error=null;
$yes=null;
$token_id=null;
if(isset($_GET['id']) && isset($_GET['token']))
{
    $id=base64_decode($_GET['id']);
    $token=$_GET['token'];
    $sql="SELECT * FROM `forgot_password` WHERE `admin_id`=$id AND `token`='$token' AND `expired`=0 AND `consumed`=0 ORDER BY `reset_id` DESC";
    $res=$con->query($sql);
    if($res->num_rows !=1)
    {
        exit('Token Expired');
    }
    else
    {
        $r=$res->fetch_assoc();
        $token_id=$r['reset_id'];
    }
}
else
{
    header('location:login');
}
if(isset($_POST['recover']))
{
    $password=trim($_POST['password']);
    $cpassword=trim($_POST['cpassword']);
    $valid=true;
    if(empty($password))
    {
        $valid=false;
        $password_err="Password is required";
    }
    if(empty($cpassword))
    {
        $valid=false;
        $cpassword_err="Confirm Password is required";
    }
    if (strlen($password) < 8)
    {
        $valid=false;
        $password_err="Password should be at least 8 characters in length";
    }
    if (strlen($password) > 16)
    {
        $valid=false;
        $password_err="Password can't be greater than 16 characters";
    }
    if(preg_match('@[^\w]@', $password)){
        $valid=false;
        $password_err="Only letters and numbers allowed";
    }
    if($password != $cpassword)
    {
        $valid=false;
        $cpassword_err="Password Not matched";
    }
    if($valid)
    {
        $pass=hash('sha256',$password);
        $sql="UPDATE `admin` SET `password`='$pass'  WHERE `id`=$id ";
        $res=$con->query($sql);
        if($res)
        {
            $sql="UPDATE `forgot_password` SET `consumed`=1,`expired`=1  WHERE `reset_id`=$token_id";
            $con->query($sql);
            $yes="Password updated successfully";
        }
        else
        {
            $error="Facing Error try Again!";
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
      <p class="login-box-msg">Enter new password here</p>
        <?php if ($yes != null) { ?>
            <p class="alert alert-success"><?php echo $yes; ?></p>
        <?php } ?>
        <?php if ($error != null) { ?>
            <p class="alert alert-danger"><?php echo $error; ?></p>
        <?php } ?>
      <form action="#" method="post">
          <div class="mb-3">
              <div class="input-group">
                  <input type="password" class="form-control" placeholder="Password" name="password">
                  <div class="input-group-append">
                      <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                      </div>
                  </div>
              </div>
              <span class="text-danger"><?php echo $password_err; ?></span>
          </div>
          <div class="mb-3">
              <div class="input-group">
                  <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
                  <div class="input-group-append">
                      <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                      </div>
                  </div>
              </div>
              <span class="text-danger"><?php echo $cpassword_err; ?></span>
          </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="recover" class="btn btn-primary btn-block">Change password</button>
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
