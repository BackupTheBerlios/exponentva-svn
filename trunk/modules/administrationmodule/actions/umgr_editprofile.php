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
# $Id: umgr_editprofile.php,v 1.9 2005/04/18 15:48:51 filetreefrog Exp $
##################################################

// Part of the User Management category

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('user_management',pathos_core_makeLocation('administrationmodule'))) {
	if (!defined('SYS_USERS')) require_once(BASE.'subsystems/users.php');
	if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
	pathos_forms_initialize();

	$u = pathos_users_getUserById($_GET['id']);
	if ($u == null) {
		$u->is_admin = 0;
		$u->is_acting_admin = 0;
	}
	$u = pathos_users_getFullProfile($u);
	$form = pathos_users_form($u);
	$form->meta('module','administrationmodule');
	$form->meta('action','umgr_saveuser');
	
	if ($user->is_admin == 1 && $u->is_admin == 0) {
		// Super user editting a 'lesser' user.
		pathos_lang_loadDictionary('modules','administrationmodule');
		$form->registerBefore('submit','is_acting_admin',TR_ADMINISTRATIONMODULE_ISADMIN,new checkboxcontrol($u->is_acting_admin,true));
	}
	
	$template = new template('administrationmodule','_umgr_editprofile',$loc);
	$template->assign('form_html',$form->toHTML());
	$template->assign('is_edit',isset($u->id)?1:0);
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>