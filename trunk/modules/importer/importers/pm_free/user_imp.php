<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# Exponent is distributed in the hope that it
# will be useful, but WITHOUT ANY WARRANTY;
# without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR
# PURPOSE.  See the GNU General Public License
# for more details.
#
# You should have received a copy of the GNU
# General Public License along with Exponent; if
# not, write to:
#
# Free Software Foundation, Inc.,
# 59 Temple Place,
# Suite 330,
# Boston, MA 02111-1307  USA
#
# $Id: user_imp.php,v 1.3 2005/02/19 16:53:35 filetreefrog Exp $
##################################################

$opt = $_POST['user_config'];//Set option from previous page
$post = array_merge($_POST,pathos_sessions_get("post"));//Stores POST information in an array

if ($opt == -1) { //User did not select a username conflict resolution option 
	//Sets error messages
	$post['_formError'] = "Please select an option to handle the username conflicts!";
	pathos_sessions_set("last_POST",$post);//Puts $post array in the session for later retrieval
	header("Location: " . $_SERVER['HTTP_REFERER']);//Sends user to username conflict page
	exit;
}
//Grabs pMachine database
$pm_db = pathos_database_connect($post['username'], $post['pwd'], $post['host'].":".$post['port'],$post['dbname'],$post['dbengine'],1);
//Sets pMachine database prefix
$pm_db->prefix = $post['pm_prefix'];

//Creates new user object and assigns default values
$new_user = null;
$new_user->is_admin = 0;
$new_user->is_locked = 0;
$new_user->firstname = "";
$new_user->lastname = "";
$new_user->recv_html = 0;

//Creates array to store user ID mappings
$id_map = array();
//Assigns values from pMachine database to new user object
foreach($pm_db->selectObjects("members") as $pm_user) {
	$new_user->username = $pm_user->username;
	$new_user->password = $pm_user->password;
	$new_user->email = $pm_user->email;
	
	//Create object from Exponent user table that matches the pMachine username
	$exp_user = $db->selectObject("user","username = '".$pm_user->username."'");
//Compares each username in pMachine database against Exponent user table
	if ($exp_user == null) {
//user in pMachine database does not exist in Exponent user table
		$id_map[$pm_user->id] = $db->insertObject($new_user,"user");
	} else {
//User is pMachine user table does match a user in Exponent user table
		//Value in $opt variable tells us how to deal with the conflict
		//Since only $opt value that requires action is 1, use if statement
		if ($opt == 1) {
		$id_map[$pm_user->id] = $exp_user->id;
		//Update Exponent user with data from pMachine user entry
		$db->updateObject($new_user,"user","username = '".$pm_user->username."'");
		}
	}
}
//Gets url data from session
$url = $post['url_array'];
//Stores ID mapping array in session data
$post['id_map'] = $id_map;

//Store daa back into session variable
pathos_sessions_set("post",$post);

//User chose to import pMachine blog data
if ($post['blog_imp'] == 1) {
//Goes to blog import page
	$url['page'] = "blog_conf";
	header("Location: ".pathos_core_makeLink($url));
	exit;
} else {
//Goes to summary page
	$url['page'] = "done";
	header("Location: ".pathos_core_makeLink($url));
	exit;
}
?>
