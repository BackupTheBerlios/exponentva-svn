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
# $Id: save.php,v 1.5 2005/03/21 17:15:27 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$cat = null;
if (isset($_POST['id'])) $cat = $db->selectObject("category","id=".$_POST['id']);
if ($cat) {
	$loc = unserialize($cat->location_data);
} else {
	$loc->mod = $_POST['orig_module']; // Only need to update the module.
	$cat->rank = $db->max('category', 'rank', 'location_data', "location_data='".serialize($loc)."'");
	if ($cat->rank === null) {
		$cat->rank = 0;
	} else { 
		$cat->rank ++;
	}
}
if (pathos_permissions_check('manage_categories',$loc)) {
	$cat = category::update($_POST,$cat);
	$cat->location_data = serialize($loc);
	if (isset($cat->id)) {
		$db->updateObject($cat,"category");
	} else {
		$db->insertObject($cat,"category");
	}
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>