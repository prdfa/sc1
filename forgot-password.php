<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>SocialAuth v4.0 Examples</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="padding: 40px 15px;">
<style>
    .form-signin{
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }


    .login-input {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .login-input-pass {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }


    .signup-input {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .signup-input-confirm {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }



    .create-account {
        text-align: center;
        width: 100%;
        display: block;
    }

    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .btn-center{
        width: 50%;
        text-align: center;
        margin: inherit;
    }

    .social-login-btn {
        margin: 5px;
        width: 20%;
        font-size: 250%;
        padding: 0;
    }

    .social-login-more {
        width: 45%;
    }

    .social-google {
        background-color: #da573b;
        border-color: #be5238;
    }
    .social-google:hover{
        background-color: #be5238;
        border-color: #9b4631;
    }

    .social-twitter {
        background-color: #1daee3;
        border-color: #3997ba;
    }
    .social-twitter:hover {
        background-color: #3997ba;
        border-color: #347b95;
    }

    .social-facebook {
        background-color: #4c699e;
        border-color: #47618d;
    }
    .social-facebook:hover {
        background-color: #47618d;
        border-color: #3c5173;
    }

    .social-linkedin {
        background-color: #4875B4;
        border-color: #466b99;
    }
    .social-linkedin:hover {
        background-color: #466b99;
        border-color: #3b5a7c;
    }
</style>

<div class="container">

    <script id="metamorph-1-start" type="text/x-placeholder"></script><script id="metamorph-21-start" type="text/x-placeholder"></script>

    <div class="container text-center">
        <form class="form-signin" data-ember-action="2" onsubmit="return false;" action="">
            <h2 class="form-signin-heading">Reset Password</h2>

            <small class="text-muted">Enter your email address.</small>
            <br><br>
            <input type="hidden" name="forgot_password" value="true">
            <div class="form-group" id="password-reset-div">
                <label class="control-label" for="forgot_email" style="display: none;">Invalid email</label>
                <input id="forgot_email" class="ember-view ember-text-field form-control login-input" placeholder="Email Address" type="text" name="forgot_email" value=""/>
            </div>

            <script id="metamorph-22-start" type="text/x-placeholder"></script><script id="metamorph-22-end" type="text/x-placeholder"></script>
            <br/>
            <button class="btn btn-lg btn-primary btn-block btn-center" type="button" data-bindattr-3="3" id="reset-password">Reset Password</button>
        </form>
    </div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            var emailPattern = /^([\w\.-]{1,64}@[\w\.-]{1,252}\.\w{2,4})$/i;
            $("#reset-password").on("click", function() {
                var email = $("#forgot_email").val();
                if (emailPattern.test(email)) {
                    $("#password-reset-div").removeClass("has-error");
                    $("#password-reset-div .control-label").hide();
                    $.post("finish-signup.php", {forgot_password: true, forgot_email: email})
                        .done(function(response) {
                            alert(response);
                        });
                } else {
                    $("#password-reset-div").addClass("has-error");
                    $("#password-reset-div .control-label").show();
                    return;
                }
            });
        });
    </script>
</body>
</html>