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
# $Id: htmlarea_saveconfig.php,v 1.5 2005/02/19 00:32:28 filetreefrog Exp $
##################################################

// Part of the HTMLArea category

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('htmlarea',pathos_core_makeLocation('administrationmodule'))) {
	$config = null;
	if (isset($_POST['id'])) $config = $db->selectObject('htmlareatoolbar','id='.$_POST['id']);
	$config->name = $_POST['config_name'];
	$config->data = array();
	foreach (explode(':',$_POST['config']) as $line) {
		$line = trim($line);
		if ($line != '') {
			$i = count($config->data);
			$config->data[] = array();
			foreach (explode(';',$line) as $icon) {
				$config->data[$i][] = $icon; // MAY need to strip off ed
			}
		}
	}
	$config->data = serialize($config->data);
	
	if (isset($_POST['config_activate'])) {
		$active = $db->selectObject('htmlareatoolbar','active=1');
		$active->active = 0;
		$db->updateObject($active,'htmlareatoolbar');
		$config->active = 1;
	}
	
	if (isset($config->id)) {
		$db->updateObject($config,'htmlareatoolbar');
	} else {
		$db->insertObject($config,'htmlareatoolbar');
	}
	
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>