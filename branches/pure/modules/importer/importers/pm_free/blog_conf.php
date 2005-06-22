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
# $Id: blog_conf.php,v 1.3 2005/04/26 02:57:43 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");

$template = new template("importer", "_pm_blog_conf");

//initialize the form stuff
pathos_forms_initialize();
//Setup the meta data (hidden values)
$form = new form();
$form->meta("module","importer");
$form->meta("action","page");
$form->meta("page","blog_imp");
$form->meta("importer","pm_free");
$form->meta("hidden","");
$form->register(null,"",new htmlcontrol("<p><a class='mngmntlink container_mngmntlink' href='' onClick=\"openSelector('weblogmodule','modules/importer/importers/pm_free/picked_source.php?dummy','importer','_pm_src_picker'); return false;\">Select Web Log Location</a></p><p>"));
$form->register("overwrite","Delete existing Exponent entries",new checkboxcontrol(true));
$form->register(null,"",new htmlcontrol('</p><br />'));
$form->register("submit", "", new buttongroupcontrol("Continue",null,"Cancel"));
$template->assign("form_html",$form->tohtml());
$template->output();

?>
