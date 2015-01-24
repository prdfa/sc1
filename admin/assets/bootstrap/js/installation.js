/**
 Core script to handle the entire theme and core functions
 **/
var App = function () {

    var handleNetworkSave = function () {
        jQuery(".btn-network-save").on("click", function() {
            var form = $(this).closest("form");
            $.ajax({
                url: "save_configurations.php",
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    message(response, 'success');
                }
            });

        });
    }

    var handleNetworkEnabled = function() {
        jQuery(".network-enabled").change(function() {
            if($(this).is(':checked')) {
                var form = $(this).closest("form");
                var appId = form.find(".app-id");
                var appSecret = form.find(".app-secret");

                if (appId.val().length < 1 || appSecret.val().length < 1) {
                    message("You need to provide App ID and Secret in order to enable specified network", "danger");
                }
            }
        });
    }

    var handleThemeChange = function() {
        jQuery("#sa-theme").change(function() {
            var theme = $(this).val();
            $("#sa-theme-area").load("../themes/" + theme + ".html");
        });
    }

    var handleDbSave = function() {
        jQuery(".btn-db-save").on("click", function() {
            var form = $(this).closest("form");
            $.ajax({
                url: "save_configurations.php",
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    message(response, 'success');
                }
            });
        });
    }

    var handleBasicSave = function() {
        jQuery(".btn-basic-save").on("click", function() {
            var form = $(this).closest("form");
            $.ajax({
                url: "save_configurations.php",
                method: "POST",
                data: form.serialize(),
                success: function(response) {
                    message(response, 'success');
                }
            });
        });
    }

    var message = function(message, type) {
        $("#sa-message-body").html("");
        $("#sa-message-body").html('<p class="text-' + type + '">' + message + '</p>');
        $("#sa-message").modal();
    }

    var handleGetConf = function() {
        jQuery.get("get_configurations.php", function(response) {
            var config = JSON.parse(response);

            $('input[name="sa-base-url"]').val(config.base_url);
            $('input[name="sa-log-file"]').val(config.log_file);
            $('input[name="sa-debug-enabled"]').attr('checked', config.debug_enabled);

            $('input[name="facebook-app-id"]').val(config.networks.facebook.keys.key);
            $('input[name="facebook-app-secret"]').val(config.networks.facebook.keys.secret);
            $('input[name="facebook-enabled"]').attr('checked', config.networks.facebook.enabled);

            $('input[name="twitter-app-id"]').val(config.networks.twitter.keys.key);
            $('input[name="twitter-app-secret"]').val(config.networks.twitter.keys.secret);
            $('input[name="twitter-enabled"]').attr('checked', config.networks.twitter.enabled);

            $('input[name="linkedin-app-id"]').val(config.networks.linkedin.keys.key);
            $('input[name="linkedin-app-secret"]').val(config.networks.linkedin.keys.secret);
            $('input[name="linkedin-enabled"]').attr('checked', config.networks.linkedin.enabled);

            $('input[name="google-app-id"]').val(config.networks.google.keys.key);
            $('input[name="google-app-secret"]').val(config.networks.google.keys.secret);
            $('input[name="google-enabled"]').attr('checked', config.networks.google.enabled);

            $('input[name="yahoo-app-id"]').val(config.networks.yahoo.keys.key);
            $('input[name="yahoo-app-secret"]').val(config.networks.yahoo.keys.secret);
            $('input[name="yahoo-enabled"]').attr('checked', config.networks.yahoo.enabled);

            $('input[name="sa-db-host"]').val(config.db.host);
            $('input[name="sa-db-user"]').val(config.db.username);
            $('input[name="sa-db-password"]').val(config.db.password);
            $('input[name="sa-db-name"]').val(config.db.dbname);
            $('input[name="sa-db-tbl-users"]').val(config.db.tbl_users);
            $('input[name="sa-db-clmn-username"]').val(config.db.clmn_user_username);
            $('input[name="sa-db-clmn-email"]').val(config.db.clmn_user_email);
            $('input[name="sa-db-clmn-password"]').val(config.db.clmn_user_password);
            $('input[name="sa-db-enabled"]').attr('checked', config.db.enabled);
        })
    }

    return {
        init: function () {
            handleNetworkSave();
            handleNetworkEnabled();
            handleThemeChange();
            handleDbSave();
            handleBasicSave();
            handleGetConf();
        }
    };

}();