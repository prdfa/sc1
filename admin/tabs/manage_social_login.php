<?php
function manage_social_login() {
global $config;
?>


    <!-- Bootstrap core CSS -->
    <link href="/admin/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/assets/bootstrap/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


<div class="container">
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h2 class="text-success">Social Login</h2>
        <p>
            Welcome to Social Login Configration. In this page you can;
            <ul>
                <li>Configure network credentials</li>
                <li>Enable/Disable network provider</li>
                <li>Test socia login login for each network</li>
                
            </ul>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">Basic Configurations</h3>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="sa-base-url" class="col-sm-2 control-label">Base Url</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-base-url" placeholder="Base Url">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-log-file" class="col-sm-2 control-label">Log File</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-log-file" placeholder="Log File">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-debug-enabled" class="col-sm-2 control-label">Debug Enabled?</label>
                    <div class="col-sm-6">
                        <input type="checkbox" name="sa-debug-enabled"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success btn-basic-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                    </div>
                </div>
                <input type="hidden" name="method-type" value="basic-save"/>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">Social Nettwork Configurations</h3>
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#facebook">
                                <i class="fa fa-facebook fa-lg"></i> Facebook Configurations
                            </a>
                        </h4>
                    </div>
                    <div id="facebook" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <div class="alert alert-info">Learn more about creating Facebook app <a href="http://huseyinbabal.net/how-to-create-facebook-app-for-your-website/" target="_blank">here</a></div>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="facebook-app-id" class="col-sm-2 control-label">App ID</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-id" name="facebook-app-id" placeholder="App ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="facebook-app-secret" class="col-sm-2 control-label">App Secret</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-secret" name="facebook-app-secret" placeholder="App Secret">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="facebook-enabled" class="col-sm-2 control-label">Enabled?</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="facebook-enabled" id="facebook-enabled" class="network-enabled"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-success btn-network-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                        <a href="../login.php?network=facebook" class="btn btn-info btn-network-test" target="_blank"><i class="glyphicon glyphicon-play"></i> Test</a>
                                    </div>
                                </div>
                                <input type="hidden" name="network-type" value="facebook"/>
                                <input type="hidden" name="method-type" value="network-save"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#twitter">
                                <i class="fa fa-twitter fa-lg"></i> Twitter Configurations
                            </a>
                        </h4>
                    </div>
                    <div id="twitter" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="alert alert-info">Learn more about creating Twitter app <a href="http://huseyinbabal.net/how-to-create-twitter-app-for-your-website/" target="_blank">here</a></div>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="twitter-app-id" class="col-sm-2 control-label">API Key</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-id" name="twitter-app-id" placeholder="API Key">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="twitter-app-secret" class="col-sm-2 control-label">API Secret</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-secret" name="twitter-app-secret" placeholder="API Secret">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="twitter-enabled" class="col-sm-2 control-label">Enabled?</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="twitter-enabled" class="network-enabled"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-success btn-network-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                        <a href="../login.php?network=twitter" class="btn btn-info btn-network-test" target="_blank"><i class="glyphicon glyphicon-play"></i> Test</a>
                                    </div>
                                </div>
                                <input type="hidden" name="network-type" value="twitter"/>
                                <input type="hidden" name="method-type" value="network-save"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#linkedin">
                                <i class="fa fa-linkedin fa-lg"></i> Linkedin Configurations
                            </a>
                        </h4>
                    </div>
                    <div id="linkedin" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="alert alert-info">Learn more about creating Linkedin app <a href="http://huseyinbabal.net/how-to-create-linkedin-app-for-your-website/" target="_blank">here</a></div>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="linkedin-app-id" class="col-sm-2 control-label">API Key</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-id" name="linkedin-app-id" placeholder="API Key">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="linkedin-app-secret" class="col-sm-2 control-label">Secret Key</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-secret" name="linkedin-app-secret" placeholder="Secret Key">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="linkedin-enabled" class="col-sm-2 control-label">Enabled?</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="linkedin-enabled" class="network-enabled"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-success btn-network-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                        <a href="../login.php?network=linkedin" class="btn btn-info btn-network-test" target="_blank"><i class="glyphicon glyphicon-play"></i> Test</a>
                                    </div>
                                </div>
                                <input type="hidden" name="network-type" value="linkedin"/>
                                <input type="hidden" name="method-type" value="network-save"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#google">
                                <i class="fa fa-google-plus fa-lg"></i> Google Configurations
                            </a>
                        </h4>
                    </div>
                    <div id="google" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="alert alert-info">Learn more about creating Google app <a href="http://huseyinbabal.net/how-to-create-google-app-for-your-website/" target="_blank">here</a></div>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="google-app-id" class="col-sm-2 control-label">Client ID</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-id" name="google-app-id" placeholder="Client ID">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="google-app-secret" class="col-sm-2 control-label">Client Secret</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-secret" name="google-app-secret" placeholder="Client Secret">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="google-enabled" class="col-sm-2 control-label">Enabled?</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="google-enabled" class="network-enabled"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-success btn-network-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                        <a href="../login.php?network=google" class="btn btn-info btn-network-test" target="_blank"><i class="glyphicon glyphicon-play"></i> Test</a>
                                    </div>
                                </div>
                                <input type="hidden" name="network-type" value="google"/>
                                <input type="hidden" name="method-type" value="network-save"/>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#yahoo">
                                <i class="fa fa-smile-o fa-lg"></i> Yahoo Configurations
                            </a>
                        </h4>
                    </div>
                    <div id="yahoo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="alert alert-info">Learn more about creating Yahoo app <a href="http://huseyinbabal.net/how-to-create-yahoo-app-for-your-website/" target="_blank">here</a></div>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="yahoo-app-id" class="col-sm-2 control-label">Consumer Key</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-id" name="yahoo-app-id" placeholder="Consumer Key">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="yahoo-app-secret" class="col-sm-2 control-label">Consumer Secret</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control app-secret" name="yahoo-app-secret" placeholder="Consumer Secret">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="yahoo-enabled" class="col-sm-2 control-label">Enabled?</label>
                                    <div class="col-sm-6">
                                        <input type="checkbox" name="yahoo-enabled" class="network-enabled"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-success btn-network-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                                        <a href="../login.php?network=yahoo" class="btn btn-info btn-network-test" target="_blank"><i class="glyphicon glyphicon-play"></i> Test</a>
                                    </div>
                                </div>
                                <input type="hidden" name="network-type" value="yahoo"/>
                                <input type="hidden" name="method-type" value="network-save"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-primary">DB Configurations</h3>
            <div class="alert alert-warning"><strong>Warning!</strong> If you enable db, social network data will be saved to your db!</div>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="sa-db-host" class="col-sm-2 control-label">DB Host</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-db-host" placeholder="DB Host">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-db-user" class="col-sm-2 control-label">DB User</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-db-user" placeholder="DB User">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-db-password" class="col-sm-2 control-label">DB Password</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-db-password" placeholder="DB Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-db-name" class="col-sm-2 control-label">DB Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-db-name" placeholder="DB Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-db-tbl-users" class="col-sm-2 control-label">Users Table Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-db-tbl-users" placeholder="Users Table Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-db-clmn-username" class="col-sm-2 control-label">Username Column Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-db-clmn-username" placeholder="Username Column Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-db-clmn-password" class="col-sm-2 control-label">Password Column Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-db-clmn-password" placeholder="Password Column Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-db-clmn-email" class="col-sm-2 control-label">Email Column Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="sa-db-clmn-email" placeholder="Email Column Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="sa-db-enabled" class="col-sm-2 control-label">Enabled?</label>
                    <div class="col-sm-6">
                        <input type="checkbox" name="sa-db-enabled" class="db-enabled"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success btn-db-save"><i class="glyphicon glyphicon-floppy-disk"></i> Save</button>
                    </div>
                </div>
                <input type="hidden" name="method-type" value="db-save"/>
            </form>
        </div>
    </div>

</div> <!-- /container -->

<!-- modal for messages -->
<div class="modal fade" id="sa-message" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="sa-message-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/admin/jquery.js"></script>
<script src="/admin/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/admin/assets/bootstrap/js/installation.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
    });
</script>


<?php } ?>