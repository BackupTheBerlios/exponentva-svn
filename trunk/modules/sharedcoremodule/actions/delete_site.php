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
# $Id: delete_site.php,v 1.6 2005/04/18 15:25:12 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('manage_site',pathos_core_makeLocation('sharedcoremodule'))) {
	$site = null;
	if (isset($_GET['id'])) {
		$site = $db->selectObject('sharedcore_site','id='.$_GET['id']);
	}
	
	if ($site) {
		if (!defined('SYS_SHAREDCORE')) require_once(BASE.'subsystems/sharedcore.php');
		pathos_sharedcore_clear($site->path,true);
		
		$db->delete('sharedcore_site','id='.$site->id);
		$db->delete('sharedcore_extension','site_id='.$site->id);
		pathos_flow_redirect();
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>