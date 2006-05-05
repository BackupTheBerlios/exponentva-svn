<?php

##################################################
#
# Copyright (c) 2006 Maxim Mueller
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

if (!defined("EXPONENT")) exit("");

if (exponent_permissions_check('edit',exponent_core_makeLocation('AdministrationModule'))) {
	$config = null;
	if (isset($_POST['id'])) $config = $db->selectObject('toolbar_' . SITE_WYSIWYG_EDITOR,'id='.intval($_POST['id']));
	$config->name = $_POST['config_name'];
	$config->data = $_POST['config'];
	
	if (isset($_POST['config_activate'])) {
		$active = $db->selectObject('toolbar_' . SITE_WYSIWYG_EDITOR,'active=1');
		$active->active = 0;
		$db->updateObject($active,'toolbar_' . SITE_WYSIWYG_EDITOR);
		$config->active = 1;
	}
	
	$db->updateObject($config,'toolbar_' . SITE_WYSIWYG_EDITOR);
	
	exponent_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>
