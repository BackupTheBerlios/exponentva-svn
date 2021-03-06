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

define('SCRIPT_EXP_RELATIVE','modules/workflow/');
define('SCRIPT_FILENAME','assoc_save.php');

include_once('../../exponent.php');

if (!defined('EXPONENT')) exit('');

if (exponent_permissions_check('workflow',exponent_core_makeLocation('administrationmodule'))) {
	if (isset($_POST['s'])) {
		$assoc = $db->selectObject('approvalpolicyassociation',"module='".$_POST['m']."' AND source='".$_POST['s']."' AND is_global=0");
		if ($assoc) {
			$assoc->policy_id = $_POST['policy'];
			if ($assoc->policy_id == 0) $db->delete('approvalpolicyassociation',"module='".$_POST['m']."' AND source='".$_POST['s']."' AND is_global=0");
			else $db->updateObject($assoc,'approvalpolicyassociation',"module='".$_POST['m']."' AND source='".$_POST['s']."' AND is_global=0");
		} else {
			if ($_POST['policy'] != 0) {
				$assoc->module = $_POST['m'];
				$assoc->source = $_POST['s'];
				$assoc->policy_id = intval($_POST['policy']);
				$assoc->is_global = 0;
				$db->insertObject($assoc,'approvalpolicyassociation');
			}
		}
	} else {
		// Save global
		$assoc = $db->selectObject('approvalpolicyassociation',"module='".$_POST['m']."' AND is_global=1");
		if ($assoc) {
			$assoc->policy_id = $_POST['policy'];
			$db->updateObject($assoc,'approvalpolicyassociation',"module='".$_POST['m']."' AND is_global=1");
		} else {
			// new
			$assoc->module = $_POST['m'];
			$assoc->policy_id = $_POST['policy'];
			$assoc->is_global = 1;
			$db->insertObject($assoc,'approvalpolicyassociation');
		}
	}
	header('Location: ' . $_POST['redirect']);
	exit();
} else {
	echo SITE_403_HTML;
}

?>