<?php
$config = require_once( "config.php" );
require_once( "Social/Auth.php" );
$socialauth = new Social_Auth( $config );

/**
 * This part is for eail check. For example, after twitter auth for first time signup, we are promting
 * user for email. When save clicked, we are checking email existance
 */
if (!empty($_POST["check_email"])) {
    $user = Social_Auth::dao()->getUserByEmailAndNetwork($_POST["check_email"], $_POST["network"]);
    if ($user) {
        $res = array(
            "response" => "Email already exists",
            "result" => false
        );
    } else {
        $network = Social_Auth::getAdapter($_POST["network"]);
        $user_profile = $network->getUserProfile();
        $user_profile->email = $_POST["check_email"];
        Social_Auth::dao()->saveUserSocial($user_profile, $_POST["network"]);
        $res = array(
            "response" => "success",
            "result" => true
        );
        $userInfo = Social_Auth::dao()->getUserByUsernameOrEmail($_POST["check_email"]);
        Social_Auth::session()->set("SA_USER", $userInfo);
    }

    /**
     * Forgot password section
     */
} elseif (!empty($_POST["forgot_password"])) {
    $user = Social_Auth::dao()->getUserByUsernameOrEmail($_POST["forgot_email"]);
    if ($user) {
        $pass = Social_Auth::dao()->randomString();
        $md5 = md5( $pass );
        $resetResult = Social_Auth::dao()->resetPassword($_POST["forgot_email"], $md5);
        if ($resetResult) {
            $to      = $_POST["forgot_email"];
            $subject = 'Password Reset';
            $message = 'hello';
            $headers = 'From: socialauth@huseyinbabal.net' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            $message = "Hi,\nYour new password is: " . $pass . "\n";
            mail($to, $subject, $message, $headers);
        }
    }
    $res = array(
        "response" => "If your email is registered, we have sent you a new password",
        "result" => true
    );
    /**
     * Normal signup
     */
} elseif (!empty($_POST["signup"])) {
    $email = $_POST["signup_email"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    $checkUser = Social_Auth::dao()->getUserByUsernameOrEmail($email);
    if ($checkUser) {
        $res = array(
            "response" => "Email already exists",
            "result" => false
        );
    } else {
        Social_Auth::dao()->signupUser($email, $password1);
        $userCheck = Social_Auth::dao()->getUserByemailAndPassword($email, $password1);
        Social_Auth::session()->set( "SA_USER", $userCheck );
        $res = array(
            "response" => "Sucessfully registered!",
            "result" => true
        );
    }
// Normal login
} elseif (!empty($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $userCheck = Social_Auth::dao()->getUserByemailAndPassword($email, $password);
    if ($userCheck) {
        Social_Auth::session()->set( "SA_USER", $userCheck );
        $res = array(
            "response" => "Successfully logged in",
            "result" => true
        );
    } else {
        $res = array(
            "response" => "Login failed",
            "result" => false
        );
    }
} else {
    $res = array(
        "response" => "Direct access is not allowed",
        "result" => false
    );
}

echo json_encode($res);
