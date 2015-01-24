<?php
if ( ! session_id() ){
    if( ! session_start() ){
        throw new Exception( "In order to use Social Login, you need to start session with 'session_start()'", 1 );
    }
}

/**
 * Check if any error exists
 */
$error = "";
if (!empty($_GET["error"])) {
    $error = trim( strip_tags(  $_GET["error"] ) );
}

if( isset( $_GET["network"] ) && $_GET["network"] ) {
    $config = dirname(__FILE__) . '/config.php';
    require_once( dirname(__FILE__) . '/Social/Auth.php' );

    try{
        $socialAuth = new Social_Auth( $config );

        $network = trim( strip_tags( $_GET["network"] ) );

        $adapter = $socialAuth->authenticate( $network );

        $socialAuth->redirect( "profile.php?network=$network" );

    } catch( Exception $e ) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Social Login</title>

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
    <?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Error!</strong> <?php echo $error; ?>
    </div>
    <a href="login.php">Go to main page</a>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <ul>
                <li><a href="examples/login_1.php"> Login Demo 1</a></li>
                <li><a href="examples/login_2.php"> Login Demo 2</a></li>
                <li><a href="examples/login_3.php"> Login Demo 3</a></li>
                <li><a href="examples/login_4.php"> Login Demo 4</a></li>
            </ul>
        </div>
    </div>
</div>




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/admin/jquery.js"></script>
<script src="/admin/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
