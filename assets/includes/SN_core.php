<?php


function FA_get_dare_categories() {
    global $config, $dbConnect;

    $dare_categories = array();

    $query="SELECT * FROM ".DB_DARE_CATEGORIES_MST." WHERE status='1' ";
    $query_category=mysqli_query($dbConnect,$query);

    while($sql_fetch = mysqli_fetch_array($query_category)){
        $dare_categories[$sql_fetch['id']] = $sql_fetch['name'];
    }

    return $dare_categories;
}

function FA_get_dare_level(){

    global $config, $dbConnect;

    $dare_level = array();

    $query="SELECT * FROM ".DB_DARE_LEVEL_MST." WHERE status='1' ";
    $query_level=mysqli_query($dbConnect,$query);

    while($sql_fetch = mysqli_fetch_array($query_level)){
        $dare_level[$sql_fetch['id']] = $sql_fetch['name'];
    }

    return $dare_level;
}

function FA_get_dare_condition(){

    global $config, $dbConnect;

    $dare_condition = array();

    $query="SELECT * FROM ".DB_DARE_CONDITION_MST." WHERE status='1' ";
    $query_condition=mysqli_query($dbConnect,$query);

    while($sql_fetch = mysqli_fetch_array($query_condition)){
        $dare_condition[$sql_fetch['id']] = $sql_fetch['name'];
    }

    return $dare_condition;
}




function FA_getStories_recent($data=array( 'type' => 'all', 'after_post_id' => 0, 'publisher_id' => 0, 'limit' => 4, 'exclude_activity' => false)) {
    global $dbConnect, $sk, $user;



    if (empty($data['type'])) {
        $data['type'] = 'all';
    }

    $subquery_one = "id>0";


    $query_text = "SELECT id FROM " . DB_POSTS . " AS p1 WHERE " . $subquery_one;
    $default_type = "('none','share')";
    //   echo $query_text;
    //   die();



    if (empty($data['limit']) or !is_numeric($data['limit']) or $data['limit'] < 1) {
        $data['limit'] = 10;
    }

    $query_text .= " AND active=1 and activity_text='' AND recipient_id NOT IN (SELECT id FROM " . DB_GROUPS . " WHERE group_privacy='secret') and hidden=0 and type2 in ".$default_type." AND type3 in ('open','friend') GROUP BY post_id ORDER BY id DESC LIMIT " . $data['limit'];

    //  echo $query_text;die();
    //  echo $query_text;die();

    if (isset($query_text))  {
        $get = array();
        $sql_query = mysqli_query($dbConnect, $query_text);

        while ($sql_fetch = mysqli_fetch_assoc($sql_query) ) {
            $story = FA_getStory($sql_fetch['id']);

            if (is_array($story)) {
                $get[] = $story;
            }
        }
    }

    return $get;
}

function FA_getStories_most_like($data=array( 'type' => 'all', 'after_post_id' => 0, 'publisher_id' => 0, 'limit' => 4, 'exclude_activity' => false)) {
    global $dbConnect, $sk, $user;

    $post_id=array();
    $query="select `post_id` from ".DB_POSTS." where `type2` ='like' and `type1`='story' and active=1 AND recipient_id NOT IN (SELECT id FROM " . DB_GROUPS . " WHERE group_privacy='secret') order by id desc";

    $query_lik=mysqli_query($dbConnect,$query);

    while($query_lik_res=mysqli_fetch_array($query_lik)){
        $post_id[]=$query_lik_res['post_id'];
    }


    if (empty($data['type'])) {
        $data['type'] = 'all';
    }

    $subquery_one = "id>0";


    $query_text = "SELECT id FROM " . DB_POSTS . " AS p1 WHERE " . $subquery_one;

    $default_type = "('none','share')";





    if (empty($data['limit']) or !is_numeric($data['limit']) or $data['limit'] < 1) {
        $data['limit'] = 10;
    }

    $query_text .= " and post_id in (".implode(",",$post_id).") AND active=1 AND activity_text='' and hidden=0 and type2 in ".$default_type." AND type3 in ('open','friend') GROUP BY post_id ORDER BY id DESC LIMIT " . $data['limit'];

     // echo $query_text;die();
    //  echo $query_text;die();

    if (isset($query_text))  {
        $get = array();
        $sql_query = mysqli_query($dbConnect, $query_text);

        while ($sql_fetch = mysqli_fetch_assoc($sql_query) ) {
            $story = FA_getStory($sql_fetch['id']);

            if (is_array($story)) {
                $get[] = $story;
            }
        }
    }

    return $get;
}

function FA_check_user_type($user_id){
    global $dbConnect, $sk, $user;

    $query_text = "SELECT type FROM " . DB_ACCOUNTS . " WHERE id='".$user_id."' ";

    $sql_query = mysqli_query($dbConnect, $query_text);

    $sql_fetch = mysqli_fetch_assoc($sql_query);
      if($sql_fetch['type']=="user"){
          $return_val="friend";
      } else {
          $return_val=$sql_fetch['type'];
      }
    return $return_val;
}

function FA_isGangAdmin_other($group_id=0, $admin_id=0) {
    if ($GLOBALS['logged'] !== true) {
        return false;
    }

    global $dbConnect, $user;

    if (empty($group_id) or !is_numeric($group_id) or $group_id < 1) {
        return false;
    }

    if (empty($admin_id) or $admin_id == 0) {
        $admin_id = $user['id'];

        if (FA_isBlocked($group_id)) {
            return false;
        }
    }

    if (!is_numeric($admin_id) or $admin_id < 1) {
        return false;
    }

    $group_id = FA_secureEncode($group_id);
    $admin_id = FA_secureEncode($admin_id);

   $query_one = "SELECT id FROM " . DB_GANG_ADMINS . " WHERE admin_id=$admin_id AND group_id!=$group_id AND active=1";
    $sql_query_one = mysqli_query($dbConnect, $query_one);

    if (mysqli_num_rows($sql_query_one) == 1) {
        return true;
    }
}

function FA_isGangmember($group_id=0, $admin_id=0) {
    if ($GLOBALS['logged'] !== true) {
        return false;
    }

    global $dbConnect, $user;

    if (empty($group_id) or !is_numeric($group_id) or $group_id < 1) {
        return false;
    }

    if (empty($admin_id) or $admin_id == 0) {
        $admin_id = $user['id'];

        if (FA_isBlocked($group_id)) {
            return false;
        }
    }

    if (!is_numeric($admin_id) or $admin_id < 1) {
        return false;
    }

    $group_id = FA_secureEncode($group_id);
    $admin_id = FA_secureEncode($admin_id);

    $query_one = "SELECT id FROM " . DB_FOLLOWERS . " WHERE follower_id=$admin_id AND following_id=$group_id AND active=1";
    $sql_query_one = mysqli_query($dbConnect, $query_one);

    if (mysqli_num_rows($sql_query_one) == 1) {
        return true;
    }
}

function FA_Gangname($admin_id=0) {
    if ($GLOBALS['logged'] !== true) {
        return false;
    }

    global $dbConnect, $user;



    if (empty($admin_id) or $admin_id == 0) {
        $admin_id = $user['id'];
    }

    if (!is_numeric($admin_id) or $admin_id < 1) {
        return false;
    }

    $admin_id = FA_secureEncode($admin_id);

    $query_one = "SELECT following_id FROM " . DB_FOLLOWERS . " WHERE follower_id=$admin_id AND active=1";
    $sql_query_one = mysqli_query($dbConnect, $query_one);

    if (mysqli_num_rows($sql_query_one)) {
        while($sql_query_one_res = mysqli_fetch_array($sql_query_one)){
           $following_id[]=$sql_query_one_res['following_id'];
        }
        $query_one_gang = "SELECT * FROM " . DB_ACCOUNTS . " WHERE id in (".implode(",",$following_id).") and type='gang' AND active=1";
        $sql_query_one_gang = mysqli_query($dbConnect, $query_one_gang);
        $sql_query_one_gang_res=mysqli_fetch_array($sql_query_one_gang);
        return $sql_query_one_gang_res;
    } else {
        return "";
    }
}

function FA_getgangmember_list($gang_id=0,$member_id=0){
    if ($GLOBALS['logged'] !== true) {
        return false;
    }

    global $dbConnect, $user;



    if (empty($gang_id) or $gang_id == 0) {
        return false;
    }
    $member_list="";

    $query_one = "SELECT follower_id FROM " . DB_FOLLOWERS . " WHERE following_id=$gang_id AND active=1";
    $sql_query_one = mysqli_query($dbConnect, $query_one);
    if (mysqli_num_rows($sql_query_one)) {
        while($sql_query_one_res = mysqli_fetch_array($sql_query_one)){
            $query_one_gang = "SELECT * FROM " . DB_ACCOUNTS . " WHERE id =".$sql_query_one_res['follower_id']." and type='user' AND active=1";
            $sql_query_one_gang = mysqli_query($dbConnect, $query_one_gang);
            $sql_query_one_gang_res=mysqli_fetch_array($sql_query_one_gang);
            if($member_id==$sql_query_one_gang_res['id']){
                $member_list .="<option value='".$sql_query_one_gang_res['id']."' selected>".$sql_query_one_gang_res['name']."</option>";
            } else {
                $member_list .="<option value='".$sql_query_one_gang_res['id']."'>".$sql_query_one_gang_res['name']."</option>";
            }

        }
        $member_list .="<option value='reject'>Reject Dare</option>";
    }
    return $member_list;



}

function FA_add_gangmember_dare($member_id,$post_id){
    if ($GLOBALS['logged'] !== true) {
        return false;
    }

    global $dbConnect, $user;

    if(!empty($member_id) && !empty($post_id)){
        $query_one = "UPDATE " . DB_POSTS . " SET type4='".$member_id."' WHERE id='".$post_id."' ";
        $sql_query_one = mysqli_query($dbConnect, $query_one);

         $query_one1 = "INSERT INTO ".DB_GANGPOST_MEMBER_MAPPING." (`id`, `post_id`, `member_id`, `time`, `timestamp`) VALUES (NULL, '".$post_id."', '".$member_id."', ".time().", CURRENT_TIMESTAMP);";
        //die();
        $sql_query_one = mysqli_query($dbConnect, $query_one1);
        if($member_id!="-1"){
            $query_post="SELECT * FROM ".DB_POSTS." where id='".$post_id."' ";
            $query_post_sql = mysqli_query($dbConnect, $query_post);
            $query_post_sql_res=mysqli_fetch_assoc($query_post_sql);

             $gang_name=FA_getUser_Name($query_post_sql_res['recipient_id']);


            $query_three = "INSERT INTO " . DB_NOTIFICATIONS . " (timeline_id,active,notifier_id,post_id,text,time,type,url) VALUES (" .$member_id. ",1," . $query_post_sql_res['recipient_id'] . "," . $post_id . ",'You have a dare on ".$gang_name."'," . time() . ",'perform_dare_gang','index.php?tab1=story&id=".$post_id."')";
            $sql_query_three = mysqli_query($dbConnect, $query_three);
        }

        return true;
    } else {
        return false;
    }


}

function FA_getUser_Name($user_id){
    if ($GLOBALS['logged'] !== true) {
        return false;
    }

    global $dbConnect, $user;
    if(!empty($user_id)){
        $query_one = "SELECT name from " . DB_ACCOUNTS . "  WHERE id='".$user_id."' ";
        $sql_query_one = mysqli_query($dbConnect, $query_one);
        $sql_query_one_res=mysqli_fetch_assoc($sql_query_one);
        return $sql_query_one_res['name'];
    } else {
        return " ";
    }
}

function FA_Gangcount($admin_id=0) {
    if ($GLOBALS['logged'] !== true) {
        return false;
    }

    global $dbConnect, $user;



    if (empty($admin_id) or $admin_id == 0) {
        $admin_id = $user['id'];
    }

    if (!is_numeric($admin_id) or $admin_id < 1) {
        return false;
    }

    $admin_id = FA_secureEncode($admin_id);

    $query_one = "SELECT following_id FROM " . DB_FOLLOWERS . " WHERE follower_id=$admin_id AND active=1";
    $sql_query_one = mysqli_query($dbConnect, $query_one);

    if (mysqli_num_rows($sql_query_one)) {
        while($sql_query_one_res = mysqli_fetch_array($sql_query_one)){
            $following_id[]=$sql_query_one_res['following_id'];
        }
        $query_one_gang = "SELECT * FROM " . DB_ACCOUNTS . " WHERE id in (".implode(",",$following_id).") and type='gang' AND active=1";
        $sql_query_one_gang = mysqli_query($dbConnect, $query_one_gang);
        $sql_query_one_gang_count=mysqli_num_rows($sql_query_one_gang);
        return $sql_query_one_gang_count;
    } else {
        return 0;
    }
}





?>