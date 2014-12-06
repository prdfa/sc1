<?php
if (isset($_POST['insert_admin']) && isset($_POST['keep_blank']) && empty($_POST['keep_blank']) && $logged_in == true) {
    $saved = false;

    if (!empty($_POST['admin_username']) && !empty($_POST['admin_password'])) {

        $admin_username = FA_secureEncode($_POST['admin_username']);
        $admin_password = FA_secureEncode($_POST['admin_password']);
        $md5_admin_password = md5($admin_password);

        if (preg_match('/^[A-Za-z0-9_]+$/', $admin_username)) {
           // echo "hiiqq";
           // echo "INSERT INTO " . DB_ADMIN_USER . " (`id`,`admin_username`,`admin_password`,`role`,`datetime`)  VALUES ('','".$admin_username."','".$md5_admin_password."','2',NOW())";

            $query = "INSERT INTO " . DB_ADMIN_USER . " (`id`,`admin_username`,`admin_password`,`role`,`datetime`)  VALUES ('','".$admin_username."','".$md5_admin_password."','2',NOW())";
            $sql_query = mysqli_query($dbConnect, $query);
            //die;

            if ($sql_query) {
                $saved = true;
            }
        }
    }
    
    if ($saved == true) {
        $post_message = '<div class="post-success">Admin login details Added!</div>';
    } else {
        $post_message = '<div class="post-failure">Failed to save changes. Please do not keep required fields empty.</div>';
        
        if (!preg_match('/^[A-Za-z0-9_]+$/', $admin_username)) {
            $post_message = '<div class="post-failure">Invalid username.</div>';
        }
        
        if (empty($_POST['admin_password'])) {
            $post_message = '<div class="post-failure">You cannot keep password field empty. Please retype your current password if you don\'t want to change it.</div>';
        }
    }
}
