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
# $Id: assoc_edit.php,v 1.10 2005/11/22 01:16:13 filetreefrog Exp $
##################################################

define('SCRIPT_EXP_RELATIVE','modules/workflow/');
define('SCRIPT_FILENAME','assoc_edit.php');

include_once('../../pathos.php');

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('workflow',pathos_core_makeLocation('administrationmodule'))) {

	$i18n = pathos_lang_loadFile('modules/workflow/assoc_edit.php');
	
	if (!defined('SYS_FORMS')) include_once(BASE.'subsystems/forms.php');
	pathos_forms_initialize();
	
	$form = new form();
	$policies = array();
	
	// GREP:SECURITY -- SQL is created from _GET parameter that is non-numeric.  Needs to be sanitized.	
	$assoc = $db->selectObject('approvalpolicyassociation',"module='".$_GET['m']."' AND source='".$_GET['s']."'");
	if (!$assoc) $assoc = $db->selectObject('approvalpolicyassociation',"module='".$_GET['m']."' AND is_global='1'");
	if (!$assoc) $assoc->policy_id = 0;
	
	if (!defined('SYS_WORKFLOW')) include_once(BASE.'subsystems/workflow.php');
	if (pathos_workflow_moduleUsesDefaultPolicy($_GET['m'],$_GET['s'])) $assoc->policy_id = 0;
	
	foreach ($db->selectObjects('approvalpolicy') as $pol) {
		$policies[$pol->id] = $pol->name;
	}
	uasort($policies,'strnatcasecmp');
	
	$realpol = array();
	$defaultpol = pathos_workflow_getDefaultPolicy($_GET['m']);
	if ($defaultpol) {
		$realpol = array(-1=>$i18n['no_policy'],0=>sprintf($i18n['default_policy'],$defaultpol->name));
	} else {
		$realpol = array(-1=>$i18n['no_policy'],0=>sprintf($i18n['default_policy'],$i18n['no_policy']));
	}
	foreach ($policies as $key=>$name) $realpol[$key] = $name;
	
	$form->register('policy',$i18n['policy'],new dropdowncontrol($assoc->policy_id,$realpol));
	$form->register('submit','',new buttongroupcontrol($i18n['save']));
	
	$form->action = URL_FULL.'modules/workflow/assoc_save.php';
	$form->meta('module','workflow');
	$form->meta('action','assoc_save');
	$form->meta('m',$_GET['m']);
	$form->meta('redirect',$_SERVER['HTTP_REFERER']);
	if (isset($_GET['s'])) {
		$form->meta('s',$_GET['s']);
	}
	
	
	$template = new template('workflow','_form_editassoc');
	$template->assign('form_html',$form->toHTML());
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>