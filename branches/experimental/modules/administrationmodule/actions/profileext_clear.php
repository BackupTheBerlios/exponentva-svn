<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

// Part of the User Management category

if (!defined('EXPONENT')) exit('');

if (exponent_permissions_check('user_management',exponent_core_makeLocation('AdministrationModule'))) {
	if (!defined('SYS_USERS')) require_once(BASE.'subsystems/users.php');
	exponent_users_includeProfileExtensions();
	$existing = $db->selectObject('profileextension',"extension='".preg_replace('/[^A-Za-z0-9_ ]/','',$_GET['ext'])."'");
	if ($existing == null) {
		call_user_func(array($_GET['ext'],'clear'));
	}
	exponent_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>