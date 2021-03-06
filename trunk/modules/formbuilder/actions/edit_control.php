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
# $Id: edit_control.php,v 1.5 2005/04/18 15:23:32 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
pathos_forms_initialize();

$f = $db->selectObject("formbuilder_form","id=".(isset($_REQUEST['form_id'])?$_REQUEST['form_id']:0));
if ($f) {
	if (pathos_permissions_check("editform",unserialize($f->location_data))) {
		if (isset($_POST['control_type']) && $_POST['control_type']{0} == ".") {
			$htmlctl = new htmlcontrol();
			$htmlctl->identifier = uniqid("");
			$htmlctl->caption = "";
			switch ($_POST['control_type']) {
				case ".break":
					$htmlctl->html = "<br />";
					break;
				case ".line":
					$htmlctl->html = "<hr size='1' />";
					break;
			}
			$ctl->name = uniqid("");
			$ctl->caption = "";
			$ctl->data = serialize($htmlctl);
			$ctl->form_id = $f->id;
			$ctl->is_readonly = 1;
			if (!$db->countObjects("formbuilder_control","form_id=".$f->id)) $ctl->rank = 0;
			else $ctl->rank = $db->max("formbuilder_control","rank","form_id","form_id=".$f->id)+1;
			$db->insertObject($ctl,"formbuilder_control");
			pathos_flow_redirect();
		} else {
			$control_type = "";
			$ctl = null;
			if (isset($_GET['id'])) {
				$control = $db->selectObject("formbuilder_control","id=".$_GET['id']);
				if ($control) {
					$ctl = unserialize($control->data);
					$ctl->identifier = $control->name;
					$ctl->caption = $control->caption;
					$ctl->id = $control->id;
					$control_type = get_class($ctl);
					$f->id = $control->form_id;
				}
			}
			if ($control_type == "") $control_type = $_POST['control_type'];
			$form = call_user_func(array($control_type,"form"),$ctl);
			$form->location($loc);
			if ($ctl) { 
				$form->controls['identifier']->disabled = true;
				$form->meta("id",$ctl->id);
				$form->meta("identifier",$ctl->identifier);
			}
			$form->meta("action","save_control");
			$form->meta('control_type',$control_type);
			$form->meta('form_id',$f->id);
			
			echo $form->toHTML();
		}
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;
}

?>