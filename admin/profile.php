<?php
include('includes/header.php');
include('includes/functions.php');
$fname = null;
$fname_err = null;
$lname = null;
$lname_err = null;
$email = null;
$password = null;
$crpassword = null;
$cpassword = null;
$email_err = null;
$password_err = null;
$cpassword_err = null;
$crpassword_err = null;
$yes = null;
$error = null;
$uid=$_SESSION['uid'];
$sql="SELECT * FROM `admin` WHERE `id`=$uid";
$res=$con->query($sql);
$r=$res->fetch_assoc();
$email=$r['email'];
$current_password=$r['password'];
$fname = $r['first_name'];
$lname = $r['last_name'];
if (isset($_POST['profile'])) {
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
        $newpassword = trim($_POST['password']);
        $crpassword = trim($_POST['crpassword']);
        $cpassword = trim($_POST['cpassword']);
        $valid = true;
        if (empty($fname)) {
            $valid = false;
            $fname_err = "First Name is required";
        }
        if (empty($lname)) {
            $valid = false;
            $lname_err = "Last Name is required";
        }
        if (empty($email)) {
            $valid = false;
            $email_err = "Email is required";
        }
        if (empty($password)) {
            // $valid = false;
            // $password_err = "Password is required";
        }
        if($crpassword!=null && hash('sha256',$crpassword) != $current_password)
        {
            $valid=false;
            $crpassword_err="Your current password is wrong";
        }
        if (empty($crpassword) && ($newpassword!="" || $cpassword!="")) {
            $valid = false;
            $crpassword_err = "Please enter the current password";
        }
        if ($newpassword!=null && strlen($newpassword) < 8)
        {
            $valid=false;
            $password_err="Password should be at least 8 characters";
        }
        if ($newpassword!=null && strlen($newpassword) > 16)
        {
            $valid=false;
            $password_err="Password can't be greater then 16 characters";
        }
        if($newpassword!=null && preg_match('@[^\w]@', $newpassword)){
            $valid=false;
            $password_err="Only letters and numbers allowed";
        }
        if($newpassword!=null && !empty($newpassword) && $newpassword != $cpassword){
            $valid=false;
            $cpassword_err="Please confirm your password";
        }
        if ($cpassword!=null && empty($cpassword)) {
            $valid = false;
            $cpassword_err = "Confirm Password is required";
        }
        if ($cpassword!=null && $newpassword != $cpassword) {
            $valid = false;
            $cpassword_err = "Password does not match";
        }
        if ($valid) {
            $uid=$_SESSION['uid'];
            $sql = "SELECT * FROM `admin` WHERE `email` = '$email' AND `id` !=$uid";
            $res=$con->query($sql);
            if ($res->num_rows == 0) {
                $date=date('Y-m-d H:i:s');
                if($newpassword == $cpassword && $newpassword!=null && $cpassword!=null && $crpassword!=null){
                    $pass = hash('sha256',$newpassword); 
                }else{
                    $pass = $current_password;
                }
                $sql = "UPDATE `admin` SET `email`='$email',`password`='$pass', `first_name`='$fname', `last_name`='$lname', `updated_at`='$date' WHERE `id`=$uid";
                $res=$con->query($sql);
                if ($res) {
                    $action='Updated Profile';
                    logEntry($action,$_SESSION['uid'],$con);
                    $yes = "Updated Successfully";
                } else {
                    $error = "Facing error try Again!";
                }
            } else {
                $valid = false;
                $email_err = "Email already taken";
            }
        }
    }   
}
?>
<div class="row pt-3">
    <div class="col-md-6 offset-md-3">
        <div class="card card-dark bg-dark text-white">
            <div class="card-header">
                <h3 class="card-title">Update Your Login Information</h3>
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
                            <input type="text" class="form-control" placeholder="First Name" name="fname" value="<?php echo $fname; ?>">
                            <span class="text-danger"><?php echo $fname_err; ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>">
                            <span class="text-danger"><?php echo $lname_err; ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>">
                            <span class="text-danger"><?php echo $email_err; ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="crpassword">
                            <span class="text-danger"><?php echo $crpassword_err; ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <span class="text-danger"><?php echo $password_err; ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" placeholder="Confirm password" name="cpassword">
                            <span class="text-danger"><?php echo $cpassword_err ?></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="profile" class="btn btn-primary">Submit</button>
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
