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
# $Id: save.php,v 1.7 2005/04/18 15:24:51 filetreefrog Exp $
##################################################
//GREP:HARDCODEDTEXT2
if (!defined("PATHOS")) exit("");

$news = null;
$iloc = null;

if (isset($_POST['id'])) {
	$news = $db->selectObject("newsitem","id=" . $_POST['id']);
	if ($news != null) {
		$loc = unserialize($news->location_data);
		$iloc = pathos_core_makeLocation($loc->mod,$loc->src,$news->id);
	}
	$news->editor = $user->id;
	$news->edited = time();
} else {
	$news->posted = time();
	$news->poster = ($user?$user->id:0);
}

if ((isset($news->id) && pathos_permissions_check("edit_item",$loc)) || 
	(!isset($news->id) && pathos_permissions_check("add_item",$loc)) ||
	($iloc != null   && pathos_permissions_check("edit_item",$iloc)) 
) {
	
	$news = newsitem::update($_POST,$news);
	if (!isset($news->id) && $db->countObjects('newsitem',"internal_name='".$news->internal_name."'")) {
		unset($_POST['internal_name']);
		$_POST['_formError'] = 'That Internal Name is already taken';
		pathos_sessions_set('last_POST',$_POST);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit('');
	}
	
	$news->location_data = serialize($loc);
	
	$channels = array();
	if (isset($_POST['channels'])) {
		$channels = array_flip($_POST['channels']);
	}
	
	if (!defined("SYS_WORKFLOW")) require_once(BASE."subsystems/workflow.php");
	pathos_workflow_post($news,"newsitem",$loc,$channels);
} else {
	echo SITE_403_HTML;
}

?>