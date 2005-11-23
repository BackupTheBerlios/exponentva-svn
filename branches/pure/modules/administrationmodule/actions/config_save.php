<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
# All Changes as of 6/1/05 Copyright 2005 James Hunt
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
# $Id: config_save.php,v 1.9 2005/11/22 01:16:04 filetreefrog Exp $
##################################################

// Part of the Configuration category

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('configuration',pathos_core_makeLocation('administrationmodule'))) {
	if (!defined('SYS_CONFIG')) require_once(BASE.'subsystems/config.php');
	
	$continue = true;
	if ($user->is_admin == 1) { // Only do the database stuff if we are a super admin
		$errors = '';
		
		$i18n = pathos_lang_loadFile('modules/administrationmodule/actions/config_save.php');
		
		// Test the prefix
		if (preg_match("/[^A-Za-z0-9]/",$_POST['c']['DB_TABLE_PREFIX'])) {
			$continue = false;
			$errors .= $i18n['bad_prefix'];
		}
		
		// Test the database connection
		$newdb = pathos_database_connect($_POST['c']['DB_USER'],$_POST['c']['DB_PASS'],$_POST['c']['DB_HOST'].":".$_POST['c']['DB_PORT'],$_POST['c']['DB_NAME'],$_POST['c']['DB_ENGINE']);
		$newdb->prefix = $_POST['c']['DB_TABLE_PREFIX'] . '_';
		
		if (!$newdb->isValid()) {
			$continue = false;
			$errors .= $i18n['cant_connect'];
		}
		
		if ($continue) {
			$status = $newdb->testPrivileges();
			foreach ($status as $type=>$flag) {
				if (!$flag) {
					$continue = false;
					$errors .= sprintf($i18n['perm_denied'],$type);
				}
			}
		}
	}
	
	$template = new template('administrationmodule','_config_results');
	
	if ($continue) {
		pathos_config_saveConfiguration($_POST);
		$ob = "";
		if ($user->is_admin == 1) {
			$i18n = pathos_lang_loadFile('db_recover.php');
		
			$db = $newdb;
			ob_start();
			include_once(BASE.'modules/administrationmodule/actions/installtables.php');
			$ob = ob_get_contents();
			ob_end_clean();
			if ($db->tableIsEmpty('user')) {
				$user = null;
				$user->username = 'admin';
				$user->password = md5('admin');
				$user->is_admin = 1;
				$user->is_acting_admin = 1;
				$db->insertObject($user,'user');
			}
			
			if ($db->tableIsEmpty('modstate')) {
				$modstate = null;
				$modstate->module = 'administrationmodule';
				$modstate->active = 1;
				$db->insertObject($modstate,'modstate');
			}
			
			if ($db->tableIsEmpty('section')) {
				$section = null;
				$section->name = $i18n['home'];
				$section->public = 1;
				$section->active = 1;
				$section->rank = 0;
				$section->parent = 0;
				$sid = $db->insertObject($section,'section');
			}
		}
		$template->assign('success',1);
	} else {
		$template->assign('success',0);
		$template->assign('errors',$errors);
	}
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>