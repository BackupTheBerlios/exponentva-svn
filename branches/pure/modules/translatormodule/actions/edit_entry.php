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
# $Id: edit_entry.php,v 1.3 2005/03/13 20:40:47 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$loc = pathos_core_makeLocation('translatormodule');

$entry = null;
if (isset($_GET['id'])) {
	$entry = $db->selectObject('translation_dictentry','id='.$_GET['id']);
	if ($entry) {
		$_GET['type'] = explode('/',$entry->dictionary);
		$_GET['name'] = $_GET['type'][1];
		$_GET['type'] = $_GET['type'][0];
		$_GET['key'] = $entry->constant;
	} else {
		echo SITE_404_HTML;
		return;
	}
} else {
	$entry->lang_id = $_GET['lang_id'];
	$entry->dictionary = $_GET['type'].'/'.$_GET['name'];
	$entry->constant = $_GET['key'];
}

if ($entry) {
	$loc = pathos_core_makeLocation('translatormodule','',$entry->lang_id);
}

if (pathos_permissions_check('configure',$loc)) {
	$form = translation_dictentry::form($entry);
	$form->meta('action','save_entry');
	$form->meta('module','translatormodule');
	
	$template = new template('translatormodule','_form_editEntry');
	$template->assign('form_html',$form->toHTML());
	
	$constants = translatormodule::parseDictionary($_GET['type'],$_GET['name'],'en');
	$template->assign('ref_value',$constants[$_GET['key']]);
	$template->assign('key',$_GET['key']);
	
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>