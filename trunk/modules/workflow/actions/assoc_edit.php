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
# $Id: assoc_edit.php,v 1.8 2005/04/18 15:50:44 filetreefrog Exp $
##################################################

// Part of the Administration Panel:Workflow category

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('workflow',pathos_core_makeLocation('administrationmodule'))) {
	
	if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
	pathos_forms_initialize();
	
	pathos_lang_loadDictionary('standard','core');
	pathos_lang_loadDictionary('modules','workflow');
	
	$form = new form();
	$policies = array();
	
	$assoc = $db->selectObject('approvalpolicyassociation',"module='".$_GET['m']."' AND is_global=1");
	if (!$assoc) $assoc->policy_id = 0;
	
	foreach ($db->selectObjects('approvalpolicy') as $pol) {
		$policies[$pol->id] = $pol->name;
	}
	uasort($policies,'strnatcasecmp');
	
	$realpol = array(0=>TR_WORKFLOW_NOPOLICY);
	foreach ($policies as $key=>$pol) $realpol[$key] = $pol;
	
	$form->register('policy',TR_WORKFLOW_POLICY,new dropdowncontrol($assoc->policy_id,$realpol));
	$form->register('submit','',new buttongroupcontrol(TR_CORE_SAVE,'',TR_CORE_CANCEL));
	
	$form->meta('module','workflow');
	$form->meta('action','assoc_save');
	$form->meta('m',$_GET['m']);
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