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
# $Id: profileext_manage.php,v 1.6 2005/04/18 15:33:34 filetreefrog Exp $
##################################################

// Part of the User Management category

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('user_management',pathos_core_makeLocation('administrationmodule'))) {
	if (!defined('SYS_USERS')) require_once(BASE.'subsystems/users.php');
	pathos_users_includeProfileExtensions();
	
	pathos_flow_set(SYS_FLOW_PROTECTED,SYS_FLOW_ACTION);
	
	$template = new template('administrationmodule','_profileextManager',$loc);
	
	pathos_users_clearDeletedExtensions(); // This will clear db of deleted exts.
	
	$exts = $db->selectObjects('profileextension');
	
	if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
	usort($exts,'pathos_sorting_byRankAscending');
	
	for ($i = 0; $i < count($exts); $i++) {
		$exts[$i]->name = call_user_func(array($exts[$i]->extension,'name'));
		$exts[$i]->author = call_user_func(array($exts[$i]->extension,'author'));
		$exts[$i]->description = call_user_func(array($exts[$i]->extension,'description'));
	}
	
	$unused = pathos_users_listUnusedExtensions();
	foreach ($unused as $i) {
		$unused[$i] = null;
		$unused[$i]->name = call_user_func(array($i,'name'));
		$unused[$i]->author = call_user_func(array($i,'author'));
		$unused[$i]->description = call_user_func(array($i,'description'));
		$unused[$i]->hasData = call_user_func(array($i,'hasData'));
	}
	
	$template->assign('extensions',$exts);
	$template->assign('unused',$unused);
	$template->assign('haveMore',count($unused) == 0 ? 0 : 1);
	
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>