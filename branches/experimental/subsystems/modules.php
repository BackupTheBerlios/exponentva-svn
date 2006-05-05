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

/* exdoc
 * The definition of this constant lets other parts of the system know 
 * that the subsystem has been included for use.
 * @node Subsystems:Modules
 */
define('SYS_MODULES',1);

/* exdoc
 * This includes all modules available to the system, for use later.
 * Maxim says: This seems actually only necessary in PHP4 where there is no __autoload()
 * @node Subsystems:Modules
 */
function exponent_modules_initialize() {
	$classFiles = exponent_core_resolveFilePaths("modules", "", "", "*Module.php");
	if ($classFiles != false) {
		foreach ($classFiles as $classFile) {
			if (exponent_modules_moduleExists(basename($classFile, ".php"))) {
				include_once($classFile);
			}
		}
	}
}

/* exdoc
 * Looks through the modules directory and returns a list of
 * all module class names that exist in the system.  No activity
 * state check is made, so inactive modules will also be listed.
 * Returns the list of module class names.
 * @node Subsystems:Modules
 */
function exponent_modules_list() {
	return exponent_core_buildNameList("modules", "", "", "*Module.php");
}

/* exdoc
 * Looks through the database returns a list of all module class
 * names that exist in the system and have been turned on by
 * the administrator.  Inactive modules will not be included.
 * Returns the list of active module class names.
 * @node Subsystems:Modules
 */
function exponent_modules_listActive() {
	global $db;
	$modulestates = $db->selectObjects("modstate","active='1'");
	$modules = array();
	foreach ($modulestates as $state) {
		if (class_exists($state->module)) $modules[] = $state->module;
	}
	return $modules;
}

/* exdoc
 * Looks through the current theme and standard js directories to find
 * the javascript form validation file for a given form in a module. Returns
 * he filename of the Javascript Validation script, or "" if one was not found.
 *
 * @param string $module The classname of the module.
 * @param string $formname The name of the form
 * @node Subsystems:Modules
 */
function exponent_modules_getJSValidationFile($module,$formname) {
	$validationFile = exponent_core_resolveFilePaths("modules", $module, "js", $formname . ".validate.js");
	if ($validationFile != false) {
		return $validationFile;
	} else {
		return "";
	}
}

/* exdoc
 * Populate Template for module manager -- THIS NEEDS CHANGED
 * @node Subsystems:Modules
 */
function exponent_modules_moduleManagerFormTemplate($template) {
	$modules = exponent_modules_list();
	natsort($modules);
	
	global $db;
	$moduleInfo = array();
	foreach ($modules as $module) {
		$mod = new $module();
		$modstate = $db->selectObject("modstate","module='$module'");
		
		$moduleInfo[$module] = null;
		$moduleInfo[$module]->class = $module;
		$moduleInfo[$module]->name = $mod->name();
		$moduleInfo[$module]->author = $mod->author();
		$moduleInfo[$module]->description = $mod->description();
		$moduleInfo[$module]->active = ($modstate != null ? $modstate->active : 0);
	}
	if (!defined('SYS_SORTING')) include_once(BASE.'subsystems/sorting.php');
	uasort($moduleInfo,"exponent_sorting_byNameAscending");
	
	$template->assign("modules",$moduleInfo);
	return $template;
}

/* exdoc
 * This is used to verify that a module directory has all the required
 * directories and files.  Used mainly by the module upload feature to
 * ensure that the uploaded archive does in fact contain a module. Returns
 * true if the directory has valid module structure and false if it does not.
 *
 * @param string $basedir The absolute path to the module directory
 * @node Subsystems:Modules
 */
function exponent_modules_verifyModule($basedir) {
	
// TODO: better do a hashckeck from a trusted source(=exponent website service)

// disabled because of changes to file structure
	// class.php
//	if (	!file_exists("$basedir/class.php") ||
//		!is_file("$basedir/class.php") ||
//		!is_readable("$basedir/class.php")	) return false;
	
	// actions
	if (file_exists("$basedir/actions") && (
		!is_dir("$basedir/actions") ||
		!is_readable("$basedir/actions"))) return false;
	
	// views
	if (file_exists("$basedir/views") && (
		!is_dir("$basedir/views") ||
		!is_readable("$basedir/views"))) return false;
	
	// views_c
	if (file_exists("$basedir/views_c") && (
		!is_dir("$basedir/views_c") ||
		!is_readable("$basedir/views_c"))) return false;
		
	return true;
}

/* exdoc
 * Checks to see if a module exists in the system.  No activity
 * check is made, so inactive modules still exist, according to this
 * method (no this is not a bug) Returns  true of the module exists, false if it was not found.
 * @node Subsystems:Modules
 */
function exponent_modules_moduleExists($name) {
	return (file_exists(BASE."modules/$name") && is_dir(BASE."modules/$name") && is_readable(BASE."modules/$name.php"));
}

?>