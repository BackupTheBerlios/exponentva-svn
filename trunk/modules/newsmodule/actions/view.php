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
# $Id: view.php,v 1.6 2005/04/03 08:08:45 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

pathos_flow_set(SYS_FLOW_PROTECTED,SYS_FLOW_ACTION);
if (isset($_GET['id'])) {
	$news = $db->selectObject("newsitem","id=" . $_GET['id']);
} else if (isset($_GET['internal_name'])) {
	$news = $db->selectObject("newsitem","internal_name='" . $_GET['internal_name']."'");
}
if ($news != null) {
	$loc = unserialize($news->location_data);
	$iloc = $loc;
	$iloc->int = $news->id;
	
	$news->permissions = array(
		"edit_item"=>((pathos_permissions_check("edit_item",$loc) || pathos_permissions_check("edit_item",$iloc)) ? 1 : 0),
		"delete_item"=>((pathos_permissions_check("delete_item",$loc) || pathos_permissions_check("delete_item",$iloc)) ? 1 : 0),
		"administrate"=>((pathos_permissions_check("administrate",$loc) || pathos_permissions_check("administrate",$iloc)) ? 1 : 0)
	);
	
	
	$news->real_posted = ($news->publish != 0 ? $news->publish : $news->posted);
	
	$view = (isset($_GET['view']) ? $_GET['view'] : "_viewSingle");
	$template = new Template("newsmodule",$view,$loc);
	
	$template->assign("newsitem",$news);
	$template->assign("loc",$loc);
	
	$template->output();
} else {
	echo SITE_404_HTML;
}

?>