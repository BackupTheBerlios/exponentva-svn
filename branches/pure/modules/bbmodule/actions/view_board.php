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
# $Id: view_board.php,v 1.4 2005/04/26 03:03:16 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$bb = $db->selectObject("bb_board","id=".$_GET['id']);

$loc = unserialize($bb->location_data);
pathos_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_ACTION);
if (!defined("SYS_USERS")) require(BASE."subsystems/users.php");
$users = array();
$posts = $db->selectObjects("bb_post","board_id=".$bb->id . " AND parent=0");
for ($i = 0; $i < count($posts); $i++) {
	if (!isset($users[$posts[$i]->poster])) $users[$posts[$i]->poster] = pathos_users_getUserById($posts[$i]->poster);
	$posts[$i]->user = $users[$posts[$i]->poster];
	if ($posts[$i]->editted != 0) {
		if (!isset($users[$posts[$i]->editor])) $users[$posts[$i]->editor] = pathos_users_getUserById($posts[$i]->poster);
		$posts[$i]->editor = $users[$posts[$i]->editor];
	}
}


if (!defined("SYS_SORTING")) require_once(BASE."subsystems/sorting.php");
if (!function_exists("pathos_sorting_byUpdatedDescending")) {
	function pathos_sorting_byUpdatedDescending($a,$b) {
		return ($a->updated > $b->updated ? -1 : 1);
	}
}
usort($posts,"pathos_sorting_byUpdatedDescending");

$bbloc = pathos_core_makeLocation($loc->mod,$loc->src,"b".$bb->id);

$template = new template("bbmodule","_view",$loc);
$template->assign("board",$bb);
$template->assign("threads",$posts);
$template->register_permissions(
	array("administrate","configure","create_thread","delete_thread"),
	$bbloc
);

$template->assign("monitoring",($user && $db->selectObject("bb_boardmonitor","user_id=".$user->id." AND board_id=".$bb->id) != null ? 1 : 0));
$template->assign("loggedin",($user!= null ? 1 : 0));
$template->output();

?>