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
# $Id: edit_record.php,v 1.7 2005/04/18 15:49:37 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
pathos_forms_initialize();

$f = $db->selectObject("formbuilder_form","id=".$_GET['form_id']);
$data = $db->selectObject("formbuilder_".$f->table_name,"id=".$_GET['id']);
$controls = $db->selectObjects("formbuilder_control","form_id=".$_GET['form_id']);

if ($f && $data && $controls) {
	if (pathos_permissions_check("editdata",unserialize($f->location_data))) {
		if (!defined("SYS_SORTING")) require_once(BASE."subsystems/sorting.php");
		usort($controls,"pathos_sorting_byRankAscending");
		
		$form = new form();
		foreach ($controls as $c) {
			$ctl = unserialize($c->data);
			$ctl->_id = $c->id;
			$ctl->_readonly = $c->is_readonly;
			if ($c->is_readonly == 0) {
				$name = $c->name;
				$ctl->default = $data->$name;
			}
			$form->register($c->name,$c->caption,$ctl);
		}
		$form->register(uniqid(""),"", new htmlcontrol("<br><br>"));
		$form->register("submit","",new buttongroupcontrol("Save","","Cancel"));
		$form->meta("action","submit_form");
		$form->meta("m",$loc->mod);
		$form->meta("s",$loc->src);
		$form->meta("i",$loc->int);
		$form->meta("id",$f->id);
		$form->meta("data_id",$data->id);
		$form->location($loc);
		
		$template = new template("formbuilder","_view_form");
		$template->assign("form_html",$form->toHTML($f->id));
		$template->assign("form",$f);
		$template->assign("edit_mode",1);
		$template->output();
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;	
}

?>