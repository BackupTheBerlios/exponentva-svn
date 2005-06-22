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
# $Id: view_dictionary.php,v 1.4 2005/03/13 20:40:47 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$lang = null;
if (isset($_GET['lang_id'])) {
	$lang = $db->selectObject('translation_language','id='.$_GET['lang_id']);
}

if ($lang) {
	pathos_flow_set(SYS_FLOW_PROTECTED,SYS_FLOW_ACTION);

	$ref_constants = translatormodule::parseDictionary($_GET['type'],$_GET['name'],'en');
	$these_constants = array();
	foreach ($db->selectObjects('translation_dictentry',"lang_id='".$lang->id."' AND dictionary='".$_GET['type'].'/'.$_GET['name']."'") as $entry) {
		$these_constants[$entry->constant] = $entry;
	}
	
	$added_constants = array_diff(array_keys($ref_constants),array_keys($these_constants));
	$removed_constants = array_diff(array_keys($these_constants),array_keys($ref_constants));
	
	$all_constants = array_merge(array_keys($these_constants),$added_constants);
	usort($all_constants,'strnatcmp');
	
	$template = new template('translatormodule','_viewDictionary');
	$template->assign('d_type',$_GET['type']);
	$template->assign('d_name',$_GET['name']);
	$template->assign('lang',$lang);
	
	$template->assign('ref_constants',$ref_constants);
	$template->assign('these_constants',$these_constants);
	
	$template->assign('added_constants',$added_constants);
	$template->assign('removed_constants',$removed_constants);
	$template->assign('all_constants',$all_constants);
	
	$template->register_permissions(
		array('administrate','configure'),$loc);
	
	$template->output();
} else {
	echo SITE_404_HTML;
}

?>