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
# $Id: saveprofile.php,v 1.7 2005/04/18 15:24:22 filetreefrog Exp $
##################################################
 
if (!defined('PATHOS')) exit('');

if ($user) {
	if (!defined('SYS_USERS')) require_once('subsystems/users.php');
	$user = pathos_users_update($_POST,$user);
	$user = pathos_users_saveUser($user);
	$user = pathos_users_saveProfileExtensions($_POST,$user,false);
	$_SESSION[SYS_SESSION_KEY]['user'] = $user;
	
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>