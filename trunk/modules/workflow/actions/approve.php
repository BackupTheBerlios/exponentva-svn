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
# $Id: approve.php,v 1.5 2005/04/18 15:33:05 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$info = $db->selectObject($_GET['datatype']."_wf_info","real_id=".$_GET['id']);
$object = $db->selectObject($_GET['datatype']."_wf_revision","wf_original=".$_GET['id']." AND wf_major=".$info->current_major." AND wf_minor=".$info->current_minor);
$state = unserialize($object->wf_state_data);

$rloc = unserialize($object->location_data);
if (pathos_permissions_check("approve",$rloc) || ($user && $user->id == $state[0][0])) {
	if (!defined('SYS_WORKFLOW')) require_once(BASE.'subsystems/workflow.php');
	pathos_workflow_processApproval($_GET['id'],$_GET['datatype'],SYS_WORKFLOW_APPROVE_APPROVE);
} else {
	echo SITE_403_HTML;
}

?>