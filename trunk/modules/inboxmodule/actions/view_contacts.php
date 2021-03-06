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
# $Id: view_contacts.php,v 1.6 2005/04/18 15:24:02 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

if ($user) {
	pathos_flow_set(SYS_FLOW_PROTECTED,SYS_FLOW_ACTION);
	
	if (!defined("SYS_USERS")) require_once(BASE."subsystems/users.php");
	
	$groups = $db->selectObjects("inbox_contactlist","owner=".$user->id);
	
	$banned = $db->selectObjects("inbox_contactbanned","owner=".$user->id);
	for ($i = 0; $i < count($banned); $i++) {
		$banned[$i]->user = pathos_users_getUserById($banned[$i]->user_id);
	}
	
	$template = new template("inboxmodule","_viewcontacts",$loc);
	#$template->assign("contacts",$contacts);
	$template->assign("groups",  $groups);
	$template->assign("banned",  $banned);
	$template->output();
}

?>