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
# $Id: changepass.php,v 1.9 2005/04/18 15:50:24 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

if ($user) {
	if (!defined('SYS_USERS')) require_once('subsystems/users.php');
	if (!defined('SYS_FORMS')) require_once('subsystems/forms.php');
	pathos_forms_initialize();
	
	pathos_lang_loadDictionary('modules','loginmodule');
	
	$form = new form();
	$form->location($loc);
	$form->meta('action','savepass');
	$form->register('oldpass',TR_LOGINMODULE_OLDPASS,new passwordcontrol());
	$form->register('pass1',TR_LOGINMODULE_NEWPASS,new passwordcontrol());
	$form->register('pass2',TR_LOGINMODULE_CONFIRMPASS,new passwordcontrol());
	
	$form->register('submit','',new buttongroupcontrol(TR_LOGINMODULE_CHANGEBTN));
	
	$template = new template('loginmodule','_form_changePassword',$loc);
	$template->assign('form_html',$form->toHTML());
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>