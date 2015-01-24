<?php
$config = dirname(__FILE__) . '/config.php';
require_once( dirname(__FILE__) . "/Social/Auth.php" );
//require_once($_SERVER['DOCUMENT_ROOT'].'/assets/includes/connect.php');
session_cache_limiter('none');
session_start();

// Include 'config.php' file
require('/assets/includes/config.php');

// Connect to SQL Server
$dbConnect = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_name);

// Check connection
if (mysqli_connect_errno($dbConnect)) {
	exit(mysqli_connect_error());
}
require_once($_SERVER['DOCUMENT_ROOT'].'/assets/includes/timezones.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/assets/includes/tables.php');
require($_SERVER['DOCUMENT_ROOT']."/assets/includes/smtpmail/smtp.php");
require($_SERVER['DOCUMENT_ROOT']."/assets/includes/smtpmail/sasl/sasl.php");
function FA_secureEncode($string, $censorship=true) {
	global $dbConnect;
	$string = trim($string);
	$string = mysqli_real_escape_string($dbConnect, $string);
	$string = htmlspecialchars($string, ENT_QUOTES);
	$string = str_replace('\\r\\n', '<br>',$string);
	$string = str_replace('\\r', '<br>',$string);
	$string = str_replace('\\n\\n', '<br>',$string);
	$string = str_replace('\\n', '<br>',$string);
	$string = str_replace('\\n', '<br>',$string);
	$string = stripslashes($string);
	$string = str_replace('&amp;#', '&#',$string);

	if ($censorship == true) {
		global $config;
		$censored_words = explode(",", $config['censored_words']);

		foreach ($censored_words as $censored_word) {
			$censored_word = trim($censored_word);
			$string = str_replace($censored_word, '***', $string);
		}
	}

	return $string;
}
$error = "";
try {
    $socialAuth = new Social_Auth( $config );

    $network = trim( strip_tags( $_GET["network"] ) );


    if( !  $socialAuth->isNetworkConnected( $network ) ){
        header( "Location: login.php?error=You are not connected to network $network." );
    }
    $adapter = $socialAuth->getAdapter( $network );
		
    $userData = $adapter->getUserProfile();
    $contacts = $adapter->getUserContacts();
    $timeline = $adapter->getUserActivity( "timeline" );
    $activity = $adapter->getUserActivity( "me" );
    //insert into table and auto login and send password as email
    
    $firstName = FA_secureEncode($userData->firstName);
    $lastName = FA_secureEncode($userData->lastName);
    $username = FA_secureEncode($userData->email);
    $email = FA_secureEncode($userData->email);
    $password = trim(rand(100000,999999));
    $md5_password = md5($password);
    $gender = FA_secureEncode($userData->gender);
    $birthday = $userData->birthDay.'-'.$userData->birthMonth.'-'.$userData->birthYear.'';
    $current_city = $userData->city;
    $hometown = $userData->city;
    $about = $userData->displayName;
    if(!empty($username)){
    $query_one = "INSERT INTO " . DB_ACCOUNTS . " (active,about,cover_id,email,email_verified,name,password,time,type,username) VALUES (1,'$about',0,'$email','1','$name','$md5_password'," . time() . ",'user','$username')";
    $sql_query_one = mysqli_query($dbConnect, $query_one);
    if ($sql_query_one) {
    	$user_id = mysqli_insert_id($dbConnect);
    	$query_two = "INSERT INTO " . DB_USERS . " (id,birthday,gender,current_city,hometown) VALUES ($user_id,'$birthday','$gender','$current_city','$hometown')";
    	$sql_query_two = mysqli_query($dbConnect, $query_two);
    	
    	//$res = file_get_contents('request.php?t=auto_login&login_id='.$username.'&login_password='.$password.'');
    	//shhot an email with login credential
    	
    	
    	
    	printf('<script type="text/javascript">window.location = "%s";</script>','request.php?t=auto_login&login_id='.$username.'&login_password='.$password.'&email='.$email.'');
    	if ($sql_query_two) {
    		$get = FA_getUser($user_id, true);
    		print_r($get);
    	}
    }
    else{
    	echo $_SESSION['social_signUp_msg'] = 'Email Is Already Registered';
    	printf('<script type="text/javascript">window.location = "%s";</script>','/signup/');
    }
    }
    else{ //if no email found or username
    	echo $_SESSION['social_signUp_msg'] = 'We Could not find any email associated with this account';
    	printf('<script type="text/javascript">window.location = "%s";</script>','/signup/');
    }
    //
    print_r($userData);
    print_r($contacts);
    die;
    
    
} catch (Exception $ex) {
    $error = $ex->getMessage();
}
?>
