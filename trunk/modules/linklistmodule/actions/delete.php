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
# $Id: delete.php,v 1.1 2005/03/13 19:17:05 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$item = null;
if (isset($_GET['id'])) {
	//TODO: devise a way to infer the database table from the data in the GET request, perhaps send item type
	$item = $db->selectObject('linklist_link', 'id='.$_GET['id']);
}

if ($item != null) {
	$loc = unserialize($item->location_data);

	if (pathos_permissions_check('delete', $loc)) {
		$db->delete('linklist_link',' id='.$item->id);
		pathos_flow_redirect();
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;
}

?>