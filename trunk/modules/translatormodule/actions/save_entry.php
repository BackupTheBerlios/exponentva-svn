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
# $Id: save_entry.php,v 1.3 2005/03/13 20:40:47 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$loc = pathos_core_makeLocation('translatormodule');

$entry = null;
if (isset($_POST['id'])) {
	$entry = $db->selectObject('translation_dictentry','id='.$_POST['id']);
	if ($entry) {
		$loc = pathos_core_makeLocation('translatormodule','',$entry->lang_id);
	}
}

if (pathos_permissions_check('configure',$loc)) {
	$entry = translation_dictentry::update($_POST,$entry);
	
	if (isset($entry->id)) {
		$db->updateObject($entry,'translation_dictentry');
	} else {
		$db->insertObject($entry,'translation_dictentry');
	}
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>