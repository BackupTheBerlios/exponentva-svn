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
# $Id: savegroupperms.php,v 1.5 2005/04/18 15:22:39 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

if (pathos_permissions_check("administrate",$loc)) {
	$groups = explode(";",$_POST['permdata']);
	if (!defined("SYS_USERS")) require_once(BASE."subsystems/users.php");
	foreach ($groups as $group_str) {
		$perms = explode(":",$group_str);
		if ($perms[0] == 0) { // Anonymous Users
			$g->id = 0;
		} else {
			$g = pathos_users_getGroupById($perms[0]);
		}
		pathos_permissions_revokeAllGroup($g,$loc);
		for ($i = 1; $i < count($perms); $i++) {
			pathos_permissions_grantGroup($g,$perms[$i],$loc);
		}
	}
	pathos_permissions_triggerRefresh();
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>