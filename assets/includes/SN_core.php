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

    $query_text .= " AND active=1 and activity_text='' and hidden=0 and type2 in ".$default_type."  GROUP BY post_id ORDER BY id DESC LIMIT " . $data['limit'];

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
    $query="select count(`post_id`) as post_id_count,`post_id` from posts where `type2` ='like' and `type1`='story' and active=1 order by post_id_count desc";
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

    $query_text .= " and post_id in (".implode(",",$post_id).") AND active=1 activity_text='' and hidden=0 and type2 in ".$default_type." GROUP BY post_id ORDER BY id DESC LIMIT " . $data['limit'];

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




?>