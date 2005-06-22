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
# $Id: db_connect.php,v 1.2 2005/02/19 16:53:35 filetreefrog Exp $
##################################################

$temp_db = pathos_database_connect($_POST['username'], $_POST['pwd'], $_POST['host'].":".$_POST['port'],$_POST['dbname'],$_POST['dbengine'],1);

//Merge $_POST with session "post" array
$post = array_merge($_POST,pathos_sessions_get("post"));

if ($temp_db->isValid() == false) { //FAILURE - Could not connect to database - you're screwed
	unset($post['pwd']);
	$post['_formError'] = $temp_db->error(); 
	pathos_sessions_set("last_POST",$post);
	header("Location: " . $_SERVER['HTTP_REFERER']);
} else { //SUCCESS - Connection database was good
	//User didn't select anything to import - user_imp & blog_imp is empty
	if ((isset($_POST['blog_imp']) == false) && (isset($_POST['user_imp']) == false)) {
		$post = $_POST;
	  	$post['_formError'] = "You must select something to import from the pMachine Free database";
  		pathos_sessions_set("last_POST",$post);
 		header("Location: " . $_SERVER['HTTP_REFERER']);
		exit;
	}
	$temp_db->prefix = "pm_";
//Sets import options to simpler binary values for later retrieval	
	if (isset($_POST['blog_imp']) == false) {
		$post['blog_imp'] = 0;
	} else {
		$post['blog_imp'] = 1;
	}
	if (isset($_POST['user_imp']) == false) {
		$post['user_imp'] = 0;
	} else {
	  $post['user_imp']= 1;
	}

	$post['pm_prefix']= "pm_";//Sets pMachine's database prefix in the session for later retrieval
	//$post['pm_user_conf'] = 0;//Sets default value for user account conflict checking
	
	//Grabs url info from the session
	$url = $post['url_array'];
	
	//Stores $post array in session
	pathos_sessions_set("post",$post);
			
	//If the user selected to import users
	if ($post['user_imp'] == 1) {
		//Grabs pMachine user table
		//Checks each pMachine username against Exponent usernames
		foreach($temp_db->selectObjects("members") as $pm_user) {
			//pMachine username matches Exponent username
			if($db->selectObject("user","username = '".$pm_user->username."'") != null) {
				//takes user to user account conflict options page
				$url['page'] = 'user_conf';
				header("Location: ".pathos_core_makeLink($url));
				exit;
			}
		}
		//No conflicts exist between the pMachine user table and the Exponent user table
		//Goes to user importing page
		$url['page'] = 'user_imp';
		header("Location: ".pathos_core_makeLink($url)); 
		exit;
	}
	//User did not choose to import users, but did choose to import blog
	else if ($post['blog_imp'] == 1) {
		//Goes to blog importing page
		$url['page'] = 'blog_conf';
 		header("Location: ".pathos_core_makeLink($url));		
		exit;
	}
}

?>
