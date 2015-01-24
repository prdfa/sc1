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
    <link href="/admin/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="padding: 40px 15px;">

<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">SignUp</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="forgot-password.php">Forgot password?</a></div>
            </div>

            <div style="padding-top:30px" class="panel-body">

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="loginform" class="form-horizontal" role="form">

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="signup-email" type="text" class="form-control" name="signup-email" value="" placeholder="Email">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="signup-password" type="password" class="form-control" name="signup-password" placeholder="Password">
                    </div>

                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="signup-password-confirm" type="password" class="form-control" name="signup-password-confirm" placeholder="Password(Confirm)">
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <a href="#" class="btn btn-success" id="btn-signup">Signup  </a>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/admin/jquery.js"></script>
    <script src="/admin/assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            var emailPattern = /^([\w\.-]{1,64}@[\w\.-]{1,252}\.\w{2,4})$/i;
            $("#btn-signup").on("click", function() {
                var email = $("#signup-email").val();
                var pass1 = $("#signup-password").val();
                var pass2 = $("#signup-password-confirm").val();
                if (!emailPattern.test(email)) {
                    alert("Invalid email!");
                    return false;
                }

                if(pass1.length < 1 || pass2.length < 1 || pass1 != pass2) {
                    alert("Passwords must match or password length greater than 0");
                    return false;
                }

                $.post("finish-signup.php", {signup_email: email, password1: pass1, password2: pass2, signup: true})
                    .done(function(response) {
                        alert(response);
                    });
            });
        });
    </script>
</body>
</html>