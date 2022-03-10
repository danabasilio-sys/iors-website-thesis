<?php
include('dbcon/connect.php');
include('includes/functions.php');
$email = null;
$password = null;
$email_err = null;
$password_err = null;
$yes = null;
$error = null;
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $valid = true;
    if (empty($email)) {
        $valid = false;
        $email_err = "Email is required";
    }
    if (empty($password)) {
        $valid = false;
        $password_err = "Password is required";
    }
    if ($valid) {
        $pass=hash('sha256',$password);
        $sql = "SELECT * FROM `admin` WHERE `email`='$email' AND `password`='$pass'";
         $res=$con->query($sql);
        if ($res->num_rows == 1) {
            $user=$res->fetch_assoc();
            $_SESSION['uid']=$user['id'];
            $_SESSION['is_login']=true;
            $_SESSION['name']=$user['first_name'];
            $_SESSION['email']=$user['email'];
            $_SESSION['role']=$user['admin_role'];
            if($user['admin_role'] == 0) {
                $_SESSION['is_s_admin'] = true;
            }
            if($user['admin_role'] == 1){
                $_SESSION['is_admin'] = true;
            }
            $action='Logged in the system';
            logEntry($action,$user['id'],$con);
            header('location:index');
        } else {
            $valid = false;
            $error = "Account not found";
        }
    }
}
if(isset($_SESSION['uid']) && intval($_SESSION['uid']) > 0 && isset($_SESSION['is_login']) && $_SESSION['is_login']===true){
    header('location:index');
}
?>
<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="dist/css/custom.css">
</header>
<body class="hold-transition login-page body">
<div class="login-box">
    <div class="card card-outline card-dark bg-dark text-white">
        <div class="card-header text-center">
            <a href="#" class="h1"><b>ADMIN PANEL</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Login Page</p>
            <?php if ($yes != null) { ?>
                <p class="alert alert-success"><?php echo $yes; ?></p>
            <?php } ?>
            <?php if ($error != null) { ?>
                <p class="alert alert-danger"><?php echo $error; ?></p>
            <?php } ?>
            <form action="#" method="post">
                <div class="mb-3">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email" name="email"
                               value="<?php echo $email; ?>">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <span class="text-danger"><?php echo $email_err; ?></span>
                </div>
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
                <div class="row">
                    <div class="col-8">
                    </div>

                    <div class="col-4">
                        <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
            <p class="mb-1">
                <a href="forgot-password" class="text-white">Forgot Password?</a>
            </p>
        </div>

    </div>

</div>

<script src="plugins/jquery/jquery.min.js"></script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
