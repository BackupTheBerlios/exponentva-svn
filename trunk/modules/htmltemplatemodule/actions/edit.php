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
# $Id: edit.php,v 1.5 2005/04/18 15:23:18 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");


$t = null;
if (isset($_GET['id'])) {
	$t = $db->selectObject("htmltemplate","id=".$_GET['id']);
}

if (	(!$t && pathos_permissions_check("create",$loc)) ||
	($t  && pathos_permissions_check("edit",$loc))
) {
	
	if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
	pathos_forms_initialize();
	
	$form = htmltemplate::form($t);
	$form->meta("module","htmltemplatemodule");
	$form->meta("action","save");
	
	$template = new template("htmltemplatemodule","_form_edit",$loc);
	$template->assign("is_edit",(isset($t->id) ? 1 : 0));
	$template->assign("form_html",$form->toHTML());
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>