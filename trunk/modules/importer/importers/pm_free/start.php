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
# $Id: start.php,v 1.3 2005/04/26 02:57:43 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");

$template = new template("importer", "_pm_start");
$post = array();
$post['url_array'] = array("module"=>"importer",
					"action"=>"page",
					"importer"=>"pm_free");

pathos_sessions_set("post",$post);

//initialize the form stuff
pathos_forms_initialize();
//Setup the meta data (hidden values)
$form = database_importer::form();
$form->meta("module","importer");
$form->meta("action","page");
$form->meta("page","db_connect");
$form->meta("importer","pm_free");
$form->register("user_imp","Import pMachine Users",new checkboxcontrol());
$form->register("blog_imp","Import pMachine Blog",new checkboxcontrol());
$form->register("submit", "", new buttongroupcontrol("Submit",null, "Cancel"));

$template->assign("form_html",$form->tohtml());
$template->output();

?>
