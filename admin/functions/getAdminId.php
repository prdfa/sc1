<?php
function MD_getAdminId($admin_username) {
    global $dbConnect;

    $query_one = "select * from  " . DB_ADMIN_USER . "  WHERE admin_username = '".$admin_username."'";
    $sql_query_one = mysqli_query($dbConnect, $query_one);
    $query_chk_res=mysqli_fetch_assoc($sql_query_one);
    return $query_chk_res['id'];
    //echo "hiiiiiiiiiiiiiii".$query_chk_res['id'];
   // die;
}
