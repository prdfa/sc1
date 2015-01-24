<?php
$config = dirname(__FILE__) . '/config.php';
require_once( dirname(__FILE__) . "/Social/Auth.php" );
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
} catch (Exception $ex) {
    $error = $ex->getMessage();
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
<div class="container">
    <?php if(!empty($error)): ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Error!</strong> <?php echo $error; ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <img src="<?php echo $userData->photoURL; ?>" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>
                                <?php echo $userData->firstName . " " . $userData->lastName; ?></h4>
                        <?php if($userData->city): ?>
                        <small><cite title="<?php echo $userData->city . ', ' . $userData->country; ?>"><?php echo $userData->city . ', ' . $userData->country; ?> <i class="glyphicon glyphicon-map-marker">
                                </i></cite></small>
                        <?php endif; ?>
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i> <?php echo $userData->email; ?>
                            <br />
                            <?php if ($userData->webSiteURL): ?>
                            <i class="glyphicon glyphicon-globe"></i> <a href="<?php echo $userData->webSiteURL; ?>"><?php echo $userData->webSiteURL; ?></a>
                            <br />
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <a href="logout.php" class="btn btn-primary btn-lg" role="button">Logout</a>
        </div>
    </div>
    <div class="row">
        <div id="content">
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="active"><a href="#full" data-toggle="tab">Full Profile</a></li>
                <?php if (!empty($contacts)): ?>
                <li><a href="#contacts" data-toggle="tab">Contacts</a></li>
                <?php endif; ?>
                <?php if (!empty($timeline)): ?>
                <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                <?php endif; ?>
                <?php if (!empty($activity)): ?>
                <li><a href="#activity" data-toggle="tab">Activity</a></li>
                <?php endif; ?>
            </ul>
            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="full">
                    <table class="table table-striped">
                        <tbody>
                        <?php foreach($userData as $key => $val): ?>
                        <tr>
                            <td><?php echo $key; ?></td>
                            <td><?php echo $val; ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (!empty($contacts)): ?>
                <div class="tab-pane" id="contacts">
                    <div class="container">
                        <div class="row">
                            <?php foreach($contacts as $user_contact): ?>
                            <div class="col-md-10">
                                <img src="<?php echo $user_contact->photoURL; ?>" alt="" class="pull-left img-responsive thumb margin10 img-thumbnail">
                                <em><?php echo $user_contact->displayName; ?> <a href="<?php echo $user_contact->profileURL; ?>" target="_blank"><?php echo $user_contact->profileURL; ?></a></em>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($timeline)): ?>
                <div class="tab-pane" id="timeline">
                    <div class="container">
                        <?php foreach($timeline as $item): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="well well-sm">
                                    <div class="row">
                                        <div class="col-xs-3 col-md-3 text-center">
                                            <img src="<?php echo $item->user->photoURL; ?>" alt=""
                                                 class="img-rounded img-responsive" />
                                        </div>
                                        <div class="col-xs-12 col-md-12 section-box">
                                            <h2>
                                                <?php echo $item->user->displayName; ?> <a href="<?php echo $item->user->profileURL; ?>" target="_blank"><span class="glyphicon glyphicon-new-window">
                            </span></a>
                                            </h2>
                                            <p>
                                                <?php echo $item->text; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (!empty($activity)): ?>
                <div class="tab-pane" id="activity">
                    <div class="container">
                        <?php foreach($activity as $item): ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well well-sm">
                                        <div class="row">
                                            <div class="col-xs-3 col-md-3 text-center">
                                                <img src="<?php echo $item->user->photoURL; ?>" alt=""
                                                     class="img-rounded img-responsive" />
                                            </div>
                                            <div class="col-xs-12 col-md-12 section-box">
                                                <h2>
                                                    <?php echo $item->user->displayName; ?> <a href="<?php echo $item->user->profileURL; ?>" target="_blank"><span class="glyphicon glyphicon-new-window">
                            </span></a>
                                                </h2>
                                                <p>
                                                    <?php echo $item->text; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>