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

if (exponent_permissions_check('manage_core',exponent_core_makeLocation('SharedCoreModule'))) {
	$core = null;
	if (isset($_GET['id'])) {
		$core = $db->selectObject('sharedcore_core','id='.intval($_GET['id']));
	}
	
	if ($core) {
		$db->delete('sharedcore_core','id='.$core->id);
		
		if (!defined('SYS_SHAREDCORE')) include_once(BASE.'subsystems/sharedcore.php');
		foreach ($db->selectObjects('sharedcore_site','core_id='.$core->id) as $site) {
			$db->delete('sharedcore_extension','site_id='.$site->id);
			exponent_sharedcore_clear($site->path,true);
		}
		
		$db->delete('sharedcore_site','core_id='.$core->id);
		exponent_flow_redirect();
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>