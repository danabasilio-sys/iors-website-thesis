<?php
//audit log function
function logEntry($action,$admin_id,$con)
{
    $key='F3229A0B371ED2D9441B830D21A390C3';
    $date=date('Y-m-d H:i:s');
    $browser=get_browser_name($_SERVER['HTTP_USER_AGENT']);
    $sql="INSERT INTO `audit_log`(`admin_id`, `action`,`browser`,`date_created`) VALUES ($admin_id,AES_ENCRYPT('$action',UNHEX('$key')),AES_ENCRYPT('$browser',UNHEX('$key')),AES_ENCRYPT('$date',UNHEX('$key')))";
    $con->query($sql);
}
//browser used function
function get_browser_name($user_agent){
    $t = strtolower($user_agent);
    $t = " " . $t;
    if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera';
    elseif (strpos($t, 'edg'      )                           ) return 'Edge';
    elseif (strpos($t, 'chrome'    )                           ) return 'Chrome';
    elseif (strpos($t, 'safari'    )                           ) return 'Safari';
    elseif (strpos($t, 'firefox'   )                           ) return 'Firefox';
    elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
    return 'Unknown';
}

function canDeleteAdmins($role)
{
    if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){
        if($role ==0) {
            return true;
        }
    }
    return  false;
}
function canUpdateAdmins($role)
{
    if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){
      return  true;
    }
    return  false;
}

function canManageQuestion($role,$id)
{

    if(isset($_SESSION['is_s_admin']) && $_SESSION['is_s_admin']){
        return true;
    }
    else if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'])
    {
           if($id == $_SESSION['uid']) {
               return true;
           }
    }
    return  false;
}

function toggleSlash($value, $action){
	($action == 'add') ? $search = "'": $search = "\'";
	($action == 'add') ? $replace = "\'": $replace = "'";
    
	// Add or remove slash to avoid MySQL query break
	if ($action == 'add') {
		return str_replace($search, $replace, htmlspecialchars(trim($value)));
	} else {
		return str_replace($search, $replace, trim($value));
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

function notOnlySpecialChars($string){
    $allowed = '/^[ A-Za-z0-9,!;:@?&"()-.\']*$/';
    if (preg_match($allowed, $string)) {
        return $status = array(
            "status" => true,
            "message" => ""
        );
    } else {
        return $status = array(
            "status" => false,
            "message" => "Special Characters not allowed"
        );
    }
}


?>
