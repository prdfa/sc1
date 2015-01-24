<?php
class Social_User_Dao {
    protected $conn;
    protected $table_users = 'sa_users';
    protected $table_users_social = 'sa_users_social';
    protected $column_username = null;
    protected $column_password = null;
    protected $column_email = null;

    function __construct( $config ) {
        $this->column_username = $config['clmn_user_username'];
        $this->column_email = $config['clmn_user_email'];
        $this->column_password = $config['clmn_user_password'];
        $this->table_users = $config['tbl_users'];
        try {
            $this->conn = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'] . ';charset=utf8', '' . $config['username'] . '', '' . $config['password'] . '');
        } catch(PDOException $e) {
            Social_Logger::error("###Social_User_Dao->_construct couldnt connect database: " . $e->getMessage());
            throw new Social_Exception( "Couldn't connect database, check your db credentials or database name" );
            exit;
        }
    }


    /**
     * Gets user info by username and password.
     * Username here can be username or email. Set md5 false
     * if you do not want to use md5 encypting while stroing password
     *
     * @param $username
     * @param $password
     * @param $md5
     */
    public function getUserByUsernameOrEmail($username_or_email) {
        $sth = $this->conn->prepare("SELECT * FROM $this->table_users WHERE ($this->column_username = :username OR $this->column_email = :email)");
        $sth->bindParam(':username', $username_or_email);
        $sth->bindParam(':email', $username_or_email);
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    public function getUserByemailAndPassword($email, $password) {
        $sth = $this->conn->prepare("SELECT * FROM $this->table_users WHERE ($this->column_email = :email AND $this->column_password = :password)");
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', md5($password));
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    /**
     * Returns user social profile by using unique network identifier and network name
     * @param $identifier
     * @param $network
     * @return mixed
     */
    public function getUserByIdentifierAndNetwork($identifier, $network) {
        $sth = $this->conn->prepare("SELECT * FROM $this->table_users_social WHERE identifier = :identifier AND network_name = :network_name");
        $sth->bindParam(':identifier', $identifier);
        $sth->bindParam(':network_name', $network);
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    /**
     * Returns user social profile by using unique email and network name
     * @param email
     * @param $network
     * @return mixed
     */
    public function getUserByEmailAndNetwork($email, $network) {
        $sth = $this->conn->prepare("SELECT * FROM $this->table_users_social WHERE email = :email AND network_name = :network");
        $sth->bindParam(':email', $email);
        $sth->bindParam(':network', $network);
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }

    public function resetPassword($email, $new_pass) {
        $sql = "UPDATE $this->table_users SET $this->column_password = ? WHERE $this->column_email = ?";
        $sth = $this->conn->prepare($sql);
        $result = $sth->execute(array($new_pass, $email));
        return $result;
    }

    /**
     * Saves basic user info to main user table
     * @param $user
     */
    public function saveUser($user) {
        $userInfo = $this->getUserByUsernameOrEmail($user->email);
        $userId = null;
        if (!empty($userInfo)) {
            $result = $userInfo;
        } else {
            $sth = $this->conn->prepare("INSERT INTO $this->table_users ($this->column_username, $this->column_email, $this->column_password) VALUES (:username, :email, :password)");
            $passwd = "";
            $username = "";
            if ($user->password) {
                $passwd = md5($user->password);
            }
            $sth->bindParam(":username", $user->username);
            $sth->bindParam(":email", $user->email);
            $sth->bindParam(":password", $passwd);

            $result = $sth->execute();
        }
        return $result;
    }

    public function signupUser($email, $password, $username = null) {
        $sth = $this->conn->prepare("INSERT INTO $this->table_users ($this->column_username, $this->column_email, $this->column_password) VALUES (:username, :email, :password)");
        $passwd = md5( $password );
        $sth->bindParam(":username", $username);
        $sth->bindParam(":email", $email);
        $sth->bindParam(":password", $passwd);

        $result = $sth->execute();
        return $result;
    }

    /**
     * Saves user's social profile data to social user table
     * @param $user_social
     * @param $network_name
     * @return bool
     */
    public function saveUserSocial($user_social, $network_name) {
        $social_profile = $this->getUserByIdentifierAndNetwork($user_social->identifier, $network_name);
        if ($social_profile) {
            $keys = "";
            $values = array();
            foreach ($user_social as $key => $value) {
                $keys .= "$key=?,";
                array_push($values, $value);
            }
            substr($keys, -1);
            array_push($values, $user_social->identifier);
            array_push($values, $network_name);

            $sql = "UPDATE $this->table_users_social SET ";
            $sql .= $keys;
            $sql .= " WHERE identifier = ? AND network_name = ?";
            $sth = $this->conn->prepare($sql);
            $result = $sth->execute($values);
        } else {
            $userInfo = $this->getUserByUsernameOrEmail($user_social->email);
            if (!$userInfo) {
                $user_model = new Social_User();
                $user_model->email = $user_social->email;
                $this->saveUser($user_model);
                $userInfo = $this->getUserByUsernameOrEmail($user_social->email);
            }

            $user_info = (array)$user_social;
            $user_info["user_id"] = $userInfo["id"];
            $user_info["network_name"] = $network_name;

            $columnString = implode(',', array_keys($user_info));
            $valueString = implode(',', array_fill(0, count($user_info), '?'));


            $sql = "INSERT INTO $this->table_users_social ($columnString) VALUES ($valueString)";

            $sth = $this->conn->prepare($sql);

            $result = $sth->execute(array_values($user_info));
        }
        return $result;
    }

    /**
     * Generates random string
     * @return string
     */
    function randomString() {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randstring = '';
        for ($i = 0; $i < 8; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }

}