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
# $Id: user_conf.php,v 1.4 2005/04/26 02:57:43 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");

$template = new template("importer", "_pm_user_conf");

//initialize the form stuff
pathos_forms_initialize();
//Setup the meta data (hidden values)
$form = new form();
$form->meta("module","importer");
$form->meta("action","page");
$form->meta("page","user_imp");
$form->meta("importer","pm_free");

$user_config_array = Array(
	"-1"=>"",
	"1"=>"Update existing users",
	"2"=>"Only import non-existing users");

$form->register("user_config","User Conflict Options: ", new dropdowncontrol("-1", $user_config_array));
$form->register("submit","", new buttongroupcontrol("Submit",null,null));

$template->assign("form_html",$form->tohtml());
$template->output();

?>
