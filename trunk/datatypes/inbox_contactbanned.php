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
# $Id: inbox_contactbanned.php,v 1.7 2005/04/18 15:47:45 filetreefrog Exp $
##################################################

class inbox_contactbanned {
	function form($object) {
	
		pathos_lang_loadDictionary('modules','inboxmodule');
		pathos_lang_loadDictionary('standard','core');
		
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		pathos_forms_initialize();
		
		$form = new form();
		if (!defined('SYS_USERS')) require_once(BASE.'subsystems/users.php');
		
		$users = array();
		foreach (pathos_users_getAllUsers() as $u) {
			$users[$u->id] = $u->firstname . ' ' . $u->lastname . ' (' . $u->username . ')';
		}
		
		global $db,$user;
		foreach ($db->selectObjects('inbox_contactbanned','owner='.$user->id) as $b) {
			unset($users[$b->user_id]);
		}
		
		$form->register('uid',TR_INBOXMODULE_USER,new dropdowncontrol(0,$users));
		$form->register('submit','',new buttongroupcontrol(TR_INBOXMODULE_BLOCKUSER,'',TR_CORE_CANCEL));
		
		return $form;
	}
	
	function update($values,$object) {
		
		return $object;
	}
}

?>