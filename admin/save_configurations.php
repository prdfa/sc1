<?php
if (empty($_POST)) {
    throw new Exception("Direct access not allowed", 1);
} else {
    if (!empty($_POST["method-type"])) {
        $method_type = $_POST["method-type"];
        if ($method_type == "network-save") {
            $network_type = $_POST["network-type"];
            $app_id = $_POST[$network_type . "-app-id"];
            $app_secret = $_POST[$network_type . "-app-secret"];
            $enabled = (empty($_POST[$network_type . "-enabled"]))? false: true;

            $config = getConfig();

            $config["networks"][$network_type] = array(
                "name" => ucfirst($network_type),
                "enabled" => $enabled,
                "keys"    => array ( "key" => $app_id, "secret" => $app_secret )
            );

            saveConfig($config);

            echo $network_type . " configurations saved successfully";
        } else if ($method_type == "basic-save") {
            $base_url = $_POST["sa-base-url"];
            $log_file = $_POST["sa-log-file"];
            $debug_enabled = (empty($_POST["sa-debug-enabled"]))? false: true;

            $config = getConfig();

            $config["base_url"] = $base_url;
            $config["debug_enabled"] = $debug_enabled;
            $config["log_file"] = $log_file;

            saveConfig($config);

            echo "Basic configurations save successfully";
        } else if ($method_type == "db-save") {
            $db_host = $_POST["sa-db-host"];
            $db_user = $_POST["sa-db-user"];
            $db_password = $_POST["sa-db-password"];
            $db_name = $_POST["sa-db-name"];
            $clmn_username = $_POST["sa-db-clmn-username"];
            $clmn_password = $_POST["sa-db-clmn-password"];
            $clmn_email = $_POST["sa-db-clmn-email"];
            $tbl_users = $_POST["sa-db-tbl-users"];
            $db_enabled = (empty($_POST["sa-db-enabled"]))? false: true;

            $config = getConfig();
            $config["db"]["enabled"] = $db_enabled;
            $config["db"]["host"] = $db_host;
            $config["db"]["username"] = $db_user;
            $config["db"]["password"] = $db_password;
            $config["db"]["dbname"] = $db_name;
            $config["db"]["clmn_user_username"] = $clmn_username;
            $config["db"]["clmn_user_email"] = $clmn_email;
            $config["db"]["clmn_user_password"] = $clmn_password;
            $config["db"]["tbl_users"] = $tbl_users;

            if (!checkTableExists($config["db"],$config["db"]["tbl_users"])) {
                $a = createTableUsers($config["db"]);
                if ($a < 0) {
                    echo "Error occured while creating table: " . $config["db"]["tbl_users"];
                    exit;
                }
            }

            if (!checkTableExists($config["db"], "sa_users_social")) {
                $b = createTableUsersSocial($config["db"]);
                if ($b < 0) {
                    echo "Error occured while creating table: sa_users_social";
                    exit;
                }
            }

            saveConfig($config);

            echo "Db Configuration saved successfully";
        }
    } else {
        echo "Invalid method type";
    }
}

function getConfig() {
    $originalConfig = realpath( dirname( __FILE__ ) )  . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';
    $templateConfig = realpath( dirname( __FILE__ ) )  . DIRECTORY_SEPARATOR . 'config.template.php';

    if ( file_exists( $originalConfig ) ) {
        $config = require_once( $originalConfig );
    } else {
        $config = require_once( $templateConfig );
    }
    return $config;
}

function saveConfig($config) {
    $originalConfig = realpath( dirname( __FILE__ ) )  . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';

    if ( file_exists( $originalConfig ) ) {
        unlink( $originalConfig );
    }
    file_put_contents( $originalConfig, '<?php return ' . var_export($config, true) . ';');
}

function checkTableExists($config, $table_name) {
    $conn = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8', '' . $config['username'] . '', '' . $config['password'] . '');
    $results = $conn->query("SHOW TABLES LIKE '$table_name'");
    return ($results->rowCount() > 0);
}

function createTableUsers($config) {
    $conn = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8', '' . $config['username'] . '', '' . $config['password'] . '');
    $query = "CREATE TABLE IF NOT EXISTS `sa_users` (" .
             "`id` int(11) NOT NULL AUTO_INCREMENT," .
             "`username` varchar(50) DEFAULT NULL," .
             "`password` varchar(50) DEFAULT NULL," .
             "`email` varchar(50) NOT NULL," .
             "PRIMARY KEY (`id`)" .
             ");";
    $createTable = $conn->exec($query);
    return $createTable;
}

function createTableUsersSocial($config) {
    $conn = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8', '' . $config['username'] . '', '' . $config['password'] . '');
    $query = "CREATE TABLE IF NOT EXISTS `sa_users_social` (" .
              "`social_id` bigint(20) NOT NULL AUTO_INCREMENT," .
              "`user_id` bigint(20) DEFAULT NULL," .
              "`identifier` varchar(50) DEFAULT NULL," .
              "`webSiteURL` varchar(250) DEFAULT NULL," .
              "`profileURL` varchar(250) DEFAULT NULL," .
              "`photoURL` varchar(250) DEFAULT NULL," .
              "`displayName` varchar(50) DEFAULT NULL," .
              "`description` varchar(200) DEFAULT NULL," .
              "`firstName` varchar(50) DEFAULT NULL," .
              "`lastName` varchar(50) DEFAULT NULL," .
              "`gender` varchar(20) DEFAULT NULL," .
              "`language` varchar(10) DEFAULT NULL," .
              "`age` varchar(10) DEFAULT NULL," .
              "`birthDay` varchar(5) DEFAULT NULL," .
              "`birthMonth` varchar(5) DEFAULT NULL," .
              "`birthYear` varchar(5) DEFAULT NULL," .
              "`email` varchar(50) DEFAULT NULL," .
              "`emailVerified` varchar(50) DEFAULT NULL," .
              "`phone` varchar(20) DEFAULT NULL," .
              "`address` varchar(200) DEFAULT NULL," .
              "`country` varchar(20) DEFAULT NULL," .
              "`region` varchar(20) DEFAULT NULL," .
              "`city` varchar(20) DEFAULT NULL," .
              "`zip` varchar(15) DEFAULT NULL," .
              "`network_name` varchar(30) NOT NULL," .
              "PRIMARY KEY (`social_id`)" .
            ")";
    $createTable = $conn->exec($query);
    return $createTable;
}