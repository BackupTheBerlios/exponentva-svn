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
# $Id: action_switch.php,v 1.6 2005/02/19 00:32:37 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('workflow',pathos_core_makeLocation('administrationmodule'))) {
	$db->switchValues('workflowaction','rank',$_GET['a'],$_GET['b'],"policy_id='".$_GET['policy_id']."' AND type=".$_GET['type']);
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>