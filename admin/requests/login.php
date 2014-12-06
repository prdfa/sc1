<?php
if (!empty($_POST['admin_login']) && isset($_POST['keep_blank']) && empty($_POST['keep_blank'])) {
    if (!empty($_POST['admin_username']) && !empty($_POST['admin_password'])) {
        $admin_username = FA_secureEncode($_POST['admin_username']);
        $admin_password = FA_secureEncode($_POST['admin_password']);
        $md5_admin_password = md5($admin_password);

        $query_one = "select * from  " . DB_ADMIN_USER . "  WHERE admin_username = '".$admin_username."'";
        $sql_query_one = mysqli_query($dbConnect, $query_one);
        $query_chk_res=mysqli_fetch_assoc($sql_query_one);
        $id_admin =  $query_chk_res['id'];
        $username_admin =  $query_chk_res['admin_username'];
        $password_admin =  $query_chk_res['admin_password'];
        $role_admin =  $query_chk_res['role'];

        //$id_admin = MD_getAdminId($admin_username);
//echo "hii".$id_admin;
      // echo "admin_username: ".$admin_username."<br>username_admin: ".$username_admin."<br>md5_admin_password: ".$md5_admin_password."<br>password_admin: ".$password_admin;
       // die;

       // require('../assets/settings/admin.php');
        
        if ($admin_username == $username_admin && $md5_admin_password == $password_admin) {
            $_SESSION['admin_id'] = $admin_username;
            $_SESSION['admin_password'] = $md5_admin_password;
            $_SESSION['id_admin'] = $id_admin;
            $_SESSION['role_admin'] = $role_admin;
            $_SESSION['config_admin_username'] = $admin_username;
            $_SESSION['config_admin_password'] = $md5_admin_password;

            //echo "in";
           // die;
            header('Location: ?logged_in');
           // die;
        }
    }
}
