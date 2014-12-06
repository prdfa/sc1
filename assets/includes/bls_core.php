<?php
/* * * * * * * * * * * * * *
Gang Group
Copyright (c) 2014

Author bls
Date: 01/Dec/2014
* * * * * * * * * * * * * */

/**
 * Inserts Gallery Record in the Masters db table
 */
function BLS_createGallery($data=0) {
	
	if ($GLOBALS['logged'] !== true) {
	 return false;
	} // end of if ($GLOBALS['logged'] !== true).

	global $dbConnect, $user;

	if (!is_array($data)) {
	 return false;
	} // end of if (!is_array($data)).
		
	if (!empty($data['name']) && !empty($data['description'])) {
	 $owner_id	  = $_SESSION['user_id'];			
	 $name		  = FA_secureEncode($data['name']);		
	 $description = FA_secureEncode($data['description']);
	 $current_dt  = time();
	 $ip_address  = $_SERVER['REMOTE_ADDR'];
	 
	 // DB_GALLERY_MST is defined in tables.php
	 $query     = "INSERT INTO ". DB_GALLERY_MST ." (owner_id, name, description, record_status, created_dt, comments, ip_address) VALUES ($owner_id, '$name', '$description', 'new', $current_dt, 'CREATED THRU FRONTEND', '$ip_address')";
	 $sql_query = mysqli_query($dbConnect, $query);
	 if ($sql_query) {
	 	
	 	$get = array(
           'id' => 1,
           'username' => 2,
        );
        return $get; // just a fake array to return something so that the code works in request.php
	 	
	 } // end of if ($sql_query).	 
	 
	} // end of if (!empty($data['name']) && !empty($data['description'])).
	
} // end of function BLS_createGallery($data=0).

/**
 * Get count of Galleries that belong to current logged in User.
 */
function BLS_countManagedGalleries() {
	if ($GLOBALS['logged'] !== true) {
		return false;
	}

	global $dbConnect, $user;
	$get = array();

	$query_one = "SELECT COUNT(id) AS count FROM " . DB_GALLERY_MST . " WHERE record_status != 'delete' AND owner_id = " . $user['id'];
	$sql_query_one = mysqli_query($dbConnect, $query_one);
	$sql_fetch = mysqli_fetch_assoc($sql_query_one);

	return $sql_fetch['count'];
} // end of function BLS_countManagedGalleries().

/**
 * Get details of Galleries that belong to current logged in User.
 */
function BLS_getManagedGalleries() {
	if ($GLOBALS['logged'] !== true) {
		return array();
	}

	global $dbConnect, $user;
	$get = array();
	$query_one = "SELECT * FROM " . DB_GALLERY_MST . " WHERE record_status != 'delete' AND owner_id = " . $user['id'];
	$sql_query_one = mysqli_query($dbConnect, $query_one);

	while ($sql_fetch_one = mysqli_fetch_assoc($sql_query_one)) {
	 $get[] = $sql_fetch_one;
	}

	return $get;
} // end of function BLS_getManagedGalleries().