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
# $Id: view_all_news.php,v 1.5 2005/04/18 15:24:51 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$config = $db->selectObject("newsmodule_config","location_data='".serialize($loc)."'");
if ($config == null) {
	$config->sortorder = "ASC";
	$config->item_limit = 10;
}

$canviewapproval = false;
if ($user) $canviewapproval = pathos_permissions_check("approve",$loc) || pathos_permissions_check("manage_approval",$loc);
if (!$canviewapproval) { // still not able to view
	foreach($db->selectObjects("newsitem","location_data='" . serialize($loc) . "' AND (publish = 0 or publish <= " . time() . ") AND (unpublish = 0 or unpublish > " . time() . ") AND approved != 0") as $post) {
		if ($user && $user->id == $post->poster) {
			$canviewapproval = true;
			break;
		}
	}
}


$template = new template("newsmodule",(isset($_GET['view']) ? $_GET['view']:"Default"),$loc);
$template->register_permissions(
	array("administrate","configure","add_item","delete_item","edit_items","manage_approval"),
	$loc
);

$news = $db->selectObjects("newsitem","location_data='" . serialize($loc) . "' AND (publish = 0 or publish <= " . time() . ") AND (unpublish = 0 or unpublish > " . time() . ") AND approved != 0 ORDER BY posted " . $config->sortorder);
if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
usort($news,($config->sortorder == "DESC" ? "pathos_sorting_byPostedDescending" : "pathos_sorting_byPostedAscending"));
for ($i = 0; $i < count($news); $i++) {
	$nloc = null;
	$nloc->mod = $loc->mod;
	$nloc->src = $loc->src;
	$nloc->int = $news[$i]->id;
	
	$news[$i]->permissions = array(
		"edit_item"=>((pathos_permissions_check("edit_item",$loc) || pathos_permissions_check("edit_item",$nloc)) ? 1 : 0),
		"delete_item"=>((pathos_permissions_check("delete_item",$loc) || pathos_permissions_check("delete_item",$nloc)) ? 1 : 0),
		"administrate"=>((pathos_permissions_check("administrate",$loc) || pathos_permissions_check("administrate",$nloc)) ? 1 : 0)
	);
}
// EVIL WORKFLOW
$in_approval = $db->countObjects("newsitem_wf_info","location_data='".serialize($loc)."'");
$template->assign("canview_approval_link",$canviewapproval);
$template->assign("in_approval",$in_approval);
$template->assign("news",$news);
$template->assign("morenews",0);

$template->output();

?>