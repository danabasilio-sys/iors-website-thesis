<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
function escape($string){
	global $conn;
	return mysqli_real_escape_string($conn,$string);
}

function validate($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = escape($data);   
	return $data;
}

function getUsername(){
    if(isset($_SESSION['username'])){
        return $_SESSION['username'];
    }
    if(isset($_COOKIE['username'])){
        return $_COOKIE['username'];
    }
    return null;
}

function generate_random_otp_code() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function check_username_exists($username){
	global $conn;
     $username = encrypt_decrypt($username,'encrypt');
	$sql = sprintf("SELECT * FROM player_info WHERE username = '%s'",$username);
	$result = mysqli_query($conn,$sql);
	return $result && mysqli_num_rows($result)==1 ? true : false;
}

function check_email_exists($email){
	global $conn;
    $email = encrypt_decrypt($email,'encrypt');
	$sql = sprintf("SELECT * FROM player_info WHERE pre_game_email = '%s' or post_game_email = '%s'",$email,$email);
	$result = mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)>0){
		return true;
	}else{
		return false;
	}
}

function check_pre_game_email_exists($username,$email){
	global $conn;
    $username = encrypt_decrypt($username,'encrypt');
	$email  = encrypt_decrypt($email,'encrypt');
	$sql = sprintf("SELECT * FROM player_info WHERE pre_game_email = '%s' and username='%s'",$email,$username);
	$result = mysqli_query($conn,$sql);
	return $result && mysqli_num_rows($result)==1 ? true : false;
}

function check_post_game_email_exists($email){
	global $conn;
    $email = encrypt_decrypt($email,'encrypt');
	$sql = sprintf("SELECT * FROM player_info WHERE post_game_email = '%s'",$email);
	$result = mysqli_query($conn,$sql);
	return $result && mysqli_num_rows($result)==1 ? true : false;
}

function create_player_info($username,$age,$gender,$race){
	global $conn;
	unset($_SESSION['check_url']);
	unset($_SESSION['user_id']);
	unset($_SESSION['questions']);
	$username = encrypt_decrypt($username,'encrypt');
	$sql = sprintf("INSERT INTO player_info(username, age, gender, race) VALUES('%s', '%s', '%s', '%s')",$username,$age,$gender,$race) ;
    $res = mysqli_query($conn, $sql);
	$_SESSION['user_id'] = mysqli_insert_id($conn);
	$_SESSION['check_url'] = 'pre-game-quiz.php';
	if($res ==true && mysqli_insert_id($conn) == true){
		$query = sprintf("SELECT question_id,question  FROM questions WHERE deleted_at IS NULL");
		$result = mysqli_query($conn, $query);
		$_SESSION['questions'] = mysqli_num_rows($result);
		if(intval($_SESSION['questions']) > 0){
			while(($row = mysqli_fetch_assoc($result))) {
				$all_records[] = $row;
			}
			$_SESSION['questions'] =$all_records;
			shuffle($_SESSION['questions']);
		}
		return true;
	}else{
	
		return false;
	}
}

function save_player_pre_game_score($username,$preGameScore){
	global $conn;
	$preGameScore = intval($preGameScore);
	$username = encrypt_decrypt($username,'encrypt');
    $sql = sprintf("UPDATE player_info SET preGameScore=%d WHERE username='%s'",$preGameScore,$username);
    $res = mysqli_query($conn, $sql);
    return $res;
}

function save_player_post_game_score($username,$postGameScore){
	global $conn;
	$postGameScore = intval($postGameScore);
	$username = encrypt_decrypt($username,'encrypt');
    $sql = sprintf("UPDATE player_info SET postGameScore=%d WHERE username='%s'",$postGameScore,$username);
    $res = mysqli_query($conn, $sql);
    return $res;
}

function save_pre_game_email($username,$email){
	global $conn;
	$username = encrypt_decrypt($username,'encrypt');
	$email = encrypt_decrypt($email,'encrypt');
	$sql = sprintf("UPDATE player_info SET pre_game_email='%s' WHERE username='%s'",$email,$username);
    $res = mysqli_query($conn, $sql);
    return $res;
}

function save_post_game_email($username,$email){
	global $conn;
	$username = encrypt_decrypt($username,'encrypt');
	$email = encrypt_decrypt($email,'encrypt');
    $sql = sprintf("UPDATE player_info SET post_game_email='%s' WHERE username='%s'",$email,$username);
    $res = mysqli_query($conn, $sql);
    return $res;
}

function save_pre_game_otp_for_username($username,$otp){
	global $conn;
	$username = encrypt_decrypt($username,'encrypt');
    $sql = sprintf("UPDATE player_info SET pre_game_verification_code='%s' WHERE username='%s'",$otp,$username);
    $res = mysqli_query($conn, $sql);
    return $res;
}

function save_post_game_otp_for_username($username,$otp){
	global $conn;
	$username = encrypt_decrypt($username,'encrypt');
    $sql = sprintf("UPDATE player_info SET post_game_verification_code='%s' WHERE username='%s'",$otp,$username);
    $res = mysqli_query($conn, $sql);
    return $res;
}

function get_pre_game_email_for_username($username){
	global $conn;
	$username = encrypt_decrypt($username,'encrypt');
	$sql = sprintf("SELECT pre_game_email FROM player_info WHERE username = '%s'",$username);
    $res = mysqli_query($conn, $sql);
    if($res && mysqli_num_rows($res)==1){
    	$row = mysqli_fetch_assoc($res);
    	return encrypt_decrypt($row['pre_game_email'],'decrypt');	
    }
    return false;
}

function check_pre_game_otp_exists_for_username($username,$otp){
	global $conn;
	$username = encrypt_decrypt($username,'encrypt');
	$sql = sprintf("SELECT * FROM player_info WHERE username = '%s' and pre_game_verification_code= '%s'",$username,$otp);
    $res = mysqli_query($conn, $sql);
    if($res && mysqli_num_rows($res)==1){
    	$sql = sprintf("UPDATE player_info SET pre_game_email_verified_at='%s' WHERE username='%s'",date('Y-m-d H:i:s',time()),$username);
    	$res = mysqli_query($conn, $sql);
    	return true;
    }
    return false;
}

function check_post_game_otp_exists_for_username($username,$otp){
	global $conn;
	$username = encrypt_decrypt($username,'encrypt');
	$sql = sprintf("SELECT * FROM player_info WHERE username='%s' and post_game_verification_code='%s'",$username,$otp);
    $res = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($res);
    if($res && mysqli_num_rows($res)==1){
    	$sql = sprintf("UPDATE player_info SET post_game_email_verified_at='%s' WHERE username='%s'",date('Y-m-d H:i:s',time()),$username);
    	$res = mysqli_query($conn, $sql);
    	return true;
    }
    return false;
}

function send_otp($email,$username,$otp){
//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);
	try {   
        $mail->Host       = 'mail.inourredstilettos.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'info@inourredstilettos.com';                     //SMTP username
        $mail->Password   = '6lLG+vzA$P1{';                              //SMTP password
        $mail->Port       = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
	    //Recipients
	    $mail->setFrom('info@inourredstilettos.com', 'Info');
	    $mail->addAddress($email, $username);     //Add a recipient
	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = 'OTP Verification code';
	    $mail->Body    = 'Hello '.$username.',<br> Here is your OTP Verification code: <b>'.$otp.'</b>';
	    $mail->send();
	    return true;
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	    return false;
	}
}
function encrypt_decrypt($username, $type){
	// Store the cipher method
	$ciphering = "AES-128-CTR";	
	// Use OpenSSl Encryption method
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	// Non-NULL Initialization Vector for encryption
	$iv = '1234567891011121';
	// Store the encryption key
	$key = "IORS";
	if ($type == "encrypt") {
		// Use openssl_encrypt() function to encrypt the data
		return openssl_encrypt($username, $ciphering, $key, $options, $iv);
	} 
	elseif ($type == "decrypt") {
		// Use openssl_decrypt() function to decrypt the data
		return openssl_decrypt ($username, $ciphering, $key, $options, $iv);
	}
	else{
		return "Invalid method";
	}
}
