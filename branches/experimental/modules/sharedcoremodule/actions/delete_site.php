<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Written and Designed by James Hunt
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

if (!defined('EXPONENT')) exit('');

if (exponent_permissions_check('manage_site',exponent_core_makeLocation('SharedCoreModule'))) {
	$site = null;
	if (isset($_GET['id'])) {
		$site = $db->selectObject('sharedcore_site','id='.intval($_GET['id']));
	}
	
	if ($site) {
		if (!defined('SYS_SHAREDCORE')) include_once(BASE.'subsystems/sharedcore.php');
		exponent_sharedcore_clear($site->path,true);
		
		$db->delete('sharedcore_site','id='.$site->id);
		$db->delete('sharedcore_extension','site_id='.$site->id);
		exponent_flow_redirect();
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>