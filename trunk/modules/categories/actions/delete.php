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
# $Id: delete.php,v 1.4 2005/03/21 17:15:25 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$cat = null;
if (isset($_GET['id'])) $cat = $db->selectObject("category","id=".$_GET['id']);
if ($cat) {
	$loc = unserialize($cat->location_data);
	$loc->mod = $_GET['orig_module'];
	if (pathos_permissions_check('manage_categories',$loc)) {
		$db->delete("category","id=".$cat->id);
		$db->decrement('category', 'rank', 1, "location_data='".serialize($loc)."' AND rank > ".$cat->rank);
		pathos_flow_redirect();
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;
}

?>