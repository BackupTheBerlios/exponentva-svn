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
# $Id: view_thread.php,v 1.4 2005/04/26 03:03:16 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$bb = null;
$post = $db->selectObject("bb_post","id=".$_GET['id']);
if ($post && $post->parent != 0) $post = $db->selectObject("bb_post","id=".$post->parent);
if ($post) $bb = $db->selectObject("bb_board","id=".$post->board_id);

if ($post && $bb) {
	$loc = unserialize($bb->location_data);
	pathos_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_ACTION);
	$loc->int = "b".$bb->id;

	$replies = $db->selectObjects("bb_post","parent=".$post->id);
	
	$users = array();
	if (!defined("SYS_USERS")) require_once(BASE."subsystems/users.php");
	$users[$post->poster] = pathos_users_getUserById($post->poster);
	$post->poster = $users[$post->poster];
	for ($i = 0; $i < count($replies); $i++) {
		if (!isset($users[$replies[$i]->poster])) $users[$replies[$i]->poster] = pathos_users_getUserById($replies[$i]->poster);
		$replies[$i]->poster = $users[$replies[$i]->poster];
	}
	
	$template = new template("bbmodule","_view_thread",$loc);
	$template->assign("thread",$post);
	$template->assign("replies",$replies);
	$template->register_permissions(
		array("administrate","create_thread","delete_thread","edit_post","reply"),
		$loc
	);
	$template->assign("monitoring",($user && $db->selectObject("bb_threadmonitor","user_id=".$user->id." AND thread_id=".$post->id) != null ? 1 : 0));
	$template->assign("loggedin",($user!= null ? 1 : 0));
	$template->output();
	
} else {
	echo SITE_404_HTML;
}

?>