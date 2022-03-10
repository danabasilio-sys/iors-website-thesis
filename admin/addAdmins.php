<?php
include('includes/header.php');
include('includes/functions.php');
if (!$_SESSION['is_s_admin']){
    ?>
    <script>
        window.location.href='index'
    </script>
    <?php
}
$fname = null;
$lname = null;
$email = null;
$password = null;
$cpassword = null;
$fname_err = null;
$lname_err = null;
$email_err = null;
$password_err = null;
$cpassword_err = null;
$role= null;
$role_err= null;
$yes = null;
$error = null;
if (isset($_POST['register'])) {
    $validinput = true;
    $check = notOnlySpecialChars($_POST['fname']);
    if($check['status'] === false){
        $validinput = false;
        $fname_err = $check['message'];
    }
    $check = notOnlySpecialChars($_POST['lname']);
    if($check['status'] === false){
        $validinput = false;
        $lname_err = $check['message'];
    }
    $check = notOnlySpecialChars($_POST['email']);
    if($check['status'] === false){
        $validinput = false;
        $email_err = $check['message'];
    }    
    if($validinput){
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $cpassword = trim($_POST['cpassword']);
        $role= trim($_POST['role']);
        //error checking
        $valid = true;
        if (empty($fname)) {
            $valid = false;
            $fname_err = "First Name is required";
        }
        if (ctype_alpha(str_replace(' ', '', $fname)) === false)  {
            $fname_err = 'First Name must contain letters and spaces only';
            $valid=false;
        }
        if (empty($lname)) {
            $valid = false;
            $lname_err = "Last Name is required";
        }
        if (ctype_alpha(str_replace(' ', '', $lname)) === false)  {
            $lname_err = 'Last Name must contain letters and spaces only';
            $valid=false;
        }
        if (empty($email)) {
            $valid = false;
            $email_err = "Email is required";
        }
        if (empty($password)) {
            $valid = false;
            $password_err = "Password is required";
        }
        if (empty($cpassword)) {
            $valid = false;
            $cpassword_err = "Confirm Password is required";
        }
        if (strlen($password) < 8)
        {
            $valid=false;
            $password_err="Password must be at least 8 characters";
        }
        if (strlen($password) > 16)
        {
            $valid=false;
            $password_err="Password must not exceed 16 characters";
        }
        //last 2 ifs if together
        /*if (strlen($password) < 8 || strlen($password) > 16)
        {
            $valid = false;
            $password_err = "Password should be between 8-16 characters";
        }*/
        if(preg_match('@[^\w]@', $password)){
            $valid=false;
            $password_err="Only letters and numbers allowed";
        }
        if ($password != $cpassword) {
            $valid = false;
            $cpassword_err = "Password does not match";
        }
        //if($role == 0)
        //{
        //    $sql = "SELECT * FROM `admin` WHERE `admin_role` = 0";
        //    $res=$con->query($sql);
        //    if($res->num_rows == 2)
        //    {
        //        $valid =false;
        //        $role_err="Only 2 super admins allowed";
        //    }
        //}
        if ($valid) {
                    $sql = "SELECT * FROM `admin` WHERE `email` = '$email'";
                    $res=$con->query($sql);
            if ($res->num_rows == 0) {

                $date=date('Y-m-d H:i:s');
                $pass=hash('sha256',$password);
                 $sql = "INSERT INTO `admin` (`first_name`, `last_name`, `email`, `password`,`admin_role`,`created_at`) VALUES ('$fname','$lname','$email','$pass',$role,'$date')";
                 $res=$con->query($sql);
                if ($res === true) {
                    $action='Added Admin: '.$email;
                    logEntry($action,$_SESSION['uid'],$con);
                    $yes = "Registered successfully";
                } else {
                    $error = "Admin registration error. Try again.";
                }
            } else {
                $valid = false;
                $email_err = "Email is already taken";
            }
        }
    }
}
?>
<!--input fields -->
<div class="row pt-3">
    <div class="col-md-6 offset-md-3">
        <div class="card card-dark bg-dark text-white">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Add new Admin</h3>
                    <a class="btn btn-sm btn-secondary" href="admins">Back</a>
                </div>
            </div>
            <form action="#" method="post">
                <div class="card-body">
                    <?php if ($yes != null) { ?>
                        <p class="alert alert-success"><?php echo $yes; ?></p>
                    <?php } ?>
                    <?php if ($error != null) { ?>
                        <p class="alert alert-danger"><?php echo $error; ?></p>
                    <?php } ?>
                <div class="mb-3">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="First name" required name="fname"  value="<?php echo $fname; ?>">
                        <span class="text-danger"><?php echo $fname_err; ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last name" required name="lname"  value="<?php echo $lname; ?>">
                        <span class="text-danger"><?php echo $lname_err; ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" required name="email"  value="<?php echo $email; ?>">
                        <span class="text-danger"><?php echo $email_err; ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" >
                        <span class="text-danger"><?php echo $password_err; ?></span>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm password" name="cpassword">
                        <span class="text-danger"><?php echo $cpassword_err ?></span>
                    </div>
                </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Role</label><br>
                            <select class="select" name="role">
                                <option value="0">Super Admin</option>
                                <option value="1">Admin</option>
                            </select>
                            <span class="text-danger"><?php echo $role_err;?></span>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="register" class="btn btn-primary">Submit</button>
                    </div>

                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
