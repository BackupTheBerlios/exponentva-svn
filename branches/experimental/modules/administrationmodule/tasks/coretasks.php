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

if (!defined('EXPONENT')) exit('');

$i18n = exponent_lang_loadFile('modules/AdministrationModule/tasks/coretasks.php');

$stuff = array(
	$i18n['user_management']=>array(
		'useraccounts'=>array(
			'title'=>$i18n['user_accounts'],
			'module'=>'AdministrationModule',
			'action'=>'useraccounts'),
		'usersessions'=>array(
			'title'=>$i18n['user_sessions'],
			'module'=>'AdministrationModule',
			'action'=>'usersessions'),
		'groupaccounts'=>array(
			'title'=>$i18n['group_accounts'],
			'module'=>'AdministrationModule',
			'action'=>'groupaccounts'),
		'profiledefinitions'=>array(
			'title'=>$i18n['profile_definitions'],
			'module'=>'AdministrationModule',
			'action'=>'profileext_manage')
	),
	$i18n['extensions']=>array(
		'managemodules'=>array(
			'title'=>$i18n['manage_modules'],
			'module'=>'AdministrationModule',
			'action'=>'managemodules'),
		'managethemes'=>array(
			'title'=>$i18n['manage_themes'],
			'module'=>'AdministrationModule',
			'action'=>'managethemes'),
		'managesubsystems'=>array(
			'title'=>$i18n['manage_subsystems'],
			'module'=>'AdministrationModule',
			'action'=>'managesubsystems'),
		'upload_extension'=>array(
			'title'=>$i18n['upload_extension'],
			'module'=>'AdministrationModule',
			'action'=>'upload_extension')
	),
	$i18n['database']=>array(
		'orphanedcontent'=>array(
			'title'=>$i18n['archived_modules'],
			'module'=>'AdministrationModule',
			'action'=>'orphanedcontent'),
		'installdatabase'=>array(
			'title'=>$i18n['install_tables'],
			'module'=>'AdministrationModule',
			'action'=>'installtables'),
		'trimdatabase'=>array(
			'title'=>$i18n['trim_database'],
			'module'=>'AdministrationModule',
			'action'=>'trimdatabase'),
		'optimizedatabase'=>array(
			'title'=>$i18n['optimize_database'],
			'module'=>'AdministrationModule',
			'action'=>'optimizedatabase'),
		'import'=>array(
			'title'=>$i18n['import_data'],
			'module'=>'importer',
			'action'=>'list_importers'),
		'export'=>array(
			'title'=>$i18n['export_data'],
			'module'=>'exporter',
			'action'=>'list_exporters'),
	),
	$i18n['configuration']=>array(
		'configuresite'=>array(
			'title'=>$i18n['configure_site'],
			'module'=>'AdministrationModule',
			'action'=>'configuresite'),
		'mimetypes'=>array(
			'title'=>$i18n['file_types'],
			'module'=>'filemanager',
			'action'=>'admin_mimetypes'),
		'manage_policies'=>array(
			'title'=>$i18n['workflow_policies'],
			'module'=>'workflow',
			'action'=>'admin_manage_policies'),
		'sysinfo'=>array(
			'title'=>$i18n['system_info'],
			'module'=>'AdministrationModule',
			'action'=>'sysinfo'),
	)
);
global $user;
if (!$user || $user->is_admin == 0) {
	unset($stuff[$i18n['database']]['import']);
}

return $stuff;

?>