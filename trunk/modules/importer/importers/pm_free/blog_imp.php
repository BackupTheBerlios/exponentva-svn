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
# $Id: blog_imp.php,v 1.2 2005/02/19 16:53:35 filetreefrog Exp $
##################################################

//Grabs session data
$post = array_merge($_POST,pathos_sessions_get("post"));
//Grab value for weblog module location selected in popup window
$src = $post['hidden'];
//Grabs URL info from $post - first time it may need it
$url = $post['url_array'];
if ($src == null){
//User didn't select a location to import blog to
//Sends back to location selection page.
	$url['page'] = "blog_conf";
	echo "<div class='error'><b>No location selected!</b></div>";
	echo "Click <a href=".pathos_core_makeLink($url).">here</a> to select a Web Log location.";
	return;

}
//Stores location for later use ine this file
$l = pathos_core_makeLocation("weblogmodule", $src);
//Grabs pMachine database
$pm_db = pathos_database_connect($post['username'], $post['pwd'], $post['host'].":".$post['port'],$post['dbname'],$post['dbengine'],1);
$pm_db->prefix = $post['pm_prefix'];

//Accesses or creates ID Mapping array (pm_user_id->exp_user_id)
if (isset($post['id_map'])){
//ID Mapping was set by user import process
	//Creates array to store user ID mappings
	$id_map = $post['id_map'];
} else {
//User import process was not selected
	//Creates array to store user ID mappings
	$id_map = array();
	foreach ($pm_db->selectObjects("members") as $pm_user) {
		//Create object from Exponent user table that matches the pMachine username
		$exp_user = $db->selectObject("user","username = '".$pm_user->username."'");
		//If the usernames actually matched up, pair up the user ID #s
		if ($exp_user != null) {
			$id_map[$pm_user->id] = $exp_user->id;
		}
	}
	//Stores id_map in session data
	$post['id_map'] = $id_map;
}
//Flag to tell whether or not the pMachine authors exist in Exponent
$all_matched = true;

//###AUTHOR CHECK
//Author check in blog posts
foreach ($pm_db->selectObjects("weblog") as $pm_blog) {
	$pm_user = $pm_db->selectObject("members","id = '".$pm_blog->member_id."'");
	if ($db->selectObject("user","username ='".$pm_user->username."'") == null) {
	//Check failed - author does not exist in Exponent database
		$all_matched = false;
		break;
	}
}
//Author check passed on web log posts - checking comments
if ($all_matched == true) {
	foreach ($pm_db->selectObjects("comments") as $pm_comment) {
		$pm_user = $pm_db->selectObject("members","id = '".$pm_comment->member_id."'");
		if ($db->selectObject("user","username ='".$pm_user->username."'") == null) {
		//Check failed - author does not exist in Exponent database
			$all_matched = false;
			break;
	}
}
}


if ($all_matched == false) {
//Check failed - send error message that prompts the user to run the user account importer
	$url['page'] = "start";
	echo "<div class='error'><b>Problem Encountered</b><br />";
	echo "One or more authors of pMachine Free weblog posts or comments do not exist as Exponent users.<br />";
	echo "You should import the pMachine Free users as well.</div>";
	echo "Click <a href=".pathos_core_makeLink($url).">here</a> to run the importer again.";
	return;
}

//Author check passed
//Remove any existing content in the weblog module location selected
if (isset($post['overwrite'])) {
	weblogmodule::deleteIn($l);
}
//Creates variable for counting web logs and comments
$num_weblogs = 0;
$num_comments = 0;
//Goes through each pMachine blog entry
foreach ($pm_db->selectObjects("weblog") as $pm_blog) {
	$exp_blog = null;

	$exp_blog->title = $pm_blog->title;
	//Converts new lines to <br> formatting
	if ($pm_blog->nl2brBody == 1) {
  	$exp_blog->body = nl2br($pm_blog->body);
	} else {
  		$exp_blog->body = $pm_blog->body;
	}
	$exp_blog->is_private = 0;
	$exp_blog->poster = $pm_blog->member_id;
	$exp_blog->posted = $pm_blog->t_stamp;
	$exp_blog->edited = 0;
	$exp_blog->editor = 0;
	$exp_blog->location_data = serialize($l);	
	//Gets Exponent blog ID from inserting the web log post
	$exp_blog->id = $db->insertObject($exp_blog, "weblog_post");
	
	//Add comments for the current weblog post
	foreach ($pm_db->selectObjects("comments", "post_id = '".$pm_blog->post_id."'") as $pm_comment) {
		$exp_comment = null;
		$exp_comment->posted = $pm_comment->t_stamp;
   	$exp_comment->poster = $id_map[$pm_comment->member_id];
   	$exp_comment->id = $pm_comment->comment_id;
   	$exp_comment->parent_id = $exp_blog->id;
   	$exp_comment->body = $pm_comment->body;
		//insert the comment
   	$db->insertObject($exp_comment, "weblog_comment");
		$num_comments++;
  }
	$num_weblogs++;
}
//Stores weblog and comment counter in $post and then stores $post in session
$post['weblogs'] = $num_weblogs;
$post['comments'] = $num_comments;
pathos_sessions_set("post",$post);

//Creates re-direct URL
$url['page'] = "done";
header("Location: ".pathos_core_makeLink($url));
exit;
?>
