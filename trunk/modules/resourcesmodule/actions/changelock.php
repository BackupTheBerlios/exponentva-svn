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
# $Id: changelock.php,v 1.4 2005/02/19 00:32:36 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$item = $db->selectObject("resourceitem","id=".$_GET['id']);
if ($item ) {
	if ($user) {
		if ($item->flock_owner == 0) {
			$item->flock_owner = $user->id;
		} else if ($item->flock_owner == $user->id || $user->is_acting_admin == 1) {
			$item->flock_owner = 0;
		}
		$db->updateObject($item,"resourceitem");
		pathos_flow_redirect();
	}
} else {
	echo SITE_404_HTML;
}

?>