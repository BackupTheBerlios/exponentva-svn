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
# $Id: done.php,v 1.3 2005/04/26 02:57:43 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");
if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");

$template = new template("importer", "_pm_done");

//initialize the form stuff
pathos_forms_initialize();
$form = new form();
$post = array_merge($_POST,pathos_sessions_get("post"));
//echo "<xmp>";
//print_r($post['id_map']);
//echo "</xmp>";

if ($post['user_imp']) {//Checks for pMachine user imports
	$form->register(null,"",new htmlcontrol("<b>The following users were imported:</b>"));
	//Grabs User ID Map from session data
	$id_map = $post['id_map'];
//Displays all users imported from pMachine Database
	foreach ($id_map as $user_id) {
		//Grabs user object from user table for each ID in the ID map
		$exp_user = $db->selectObject("user","id = '".$user_id."'");
		//Displays username on a new line
		$form->register(null,"",new htmlcontrol($exp_user->username));
	}
	$form->register(null,"",new htmlcontrol("<br />"));
}

if ($post['blog_imp']) {//Checks for pMachine weblog post imports
//Displays number of web log posts and comments imported from pMachine database
	//Display number of posts imported.
	$form->register(null,"",new htmlcontrol("<b>".$post['weblogs']." Web Log posts were imported.</b><br />&nbsp;"));
	//Display number of comments imported
	$form->register(null,"",new htmlcontrol("<b>".$post['comments']." Web Log comments were imported.</b>"));
}

$template->assign("form_html",$form->tohtml());
$template->output();

?>
