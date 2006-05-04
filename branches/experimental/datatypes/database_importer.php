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

class database_importer {
	function form() {
		
		$i18n = exponent_lang_loadFile('datatypes/database_importer.php');
	
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		exponent_forms_initialize();

		$form = new form();
		//Form is created to collect information from the user
		//Values set previously (defaults or user-entered) are displayed
		$form->register('dbengine',$i18n['db_type'],new dropdowncontrol('',exponent_database_backends()));
		$form->register('host',$i18n['db_host'],new textcontrol(DB_HOST));
		$form->register('port',$i18n['db_port'],new textcontrol(DB_PORT));
		$form->register('dbname',$i18n['db_name'],new textcontrol(''));
		$form->register('username',$i18n['db_username'],new textcontrol(DB_USER));
		$form->register('pwd',$i18n['db_userpwd'],new passwordcontrol(''));
		
		return $form;
	}
}
?>
