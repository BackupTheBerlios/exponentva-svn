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
# $Id: profileext_save.php,v 1.5 2005/02/19 00:32:28 filetreefrog Exp $
##################################################

// Part of the User Management category

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('user_management',pathos_core_makeLocation('administrationmodule'))) {
	$ext = null;
	if (isset($_GET['id'])) $ext = $db->selectObject('profileextension','id='.$_GET['id']);
	
	$ext->extension = $_GET['ext'];
	if (!isset($ext->id)) {
		// Get rank, append to end.
		$ext->rank = $db->max('profileextension','rank');
		if ($ext->rank === null) {
			$ext->rank = 0;
		} else {
			$ext->rank++;
		}
		$db->insertObject($ext,'profileextension');
	} else {
		$db->updateObject($ext,'profileextension');
	}
	
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>