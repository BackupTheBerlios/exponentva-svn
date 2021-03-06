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
# $Id: picked_source.php,v 1.3 2005/04/18 15:23:32 filetreefrog Exp $
##################################################

	if (!defined("PATHOS")) exit("");

	$f1_loc = pathos_core_makeLocation($_GET['sm'],$_GET['ss']);
	$f1 = $db->selectObject("formbuilder_form","location_data='".serialize($f1_loc)."'");
	
	$f2_loc = pathos_core_makeLocation($_GET['m'],$_GET['s']);
	$f2 = $db->selectObject("formbuilder_form","location_data='".serialize($f2_loc)."'");
	
	if ($f1 && $f2) {
		if (pathos_permissions_check("editform",unserialize($f2->location_data))) {
			$controls  = $db->selectObjects("formbuilder_control","form_id=".$f1->id);
			if (!defined("SYS_SORTING")) require_once(BASE."subsystems/sorting.php");
			usort($controls,"pathos_sorting_byRankAscending");
			
			foreach ($controls as $control) {
				$count = 0;
				$name = $control->name;
				$rank = $db->max("formbuilder_control","rank","form_id","form_id=".$f2->id);
				//insure that we have a unique name;
				while ($db->countObjects("formbuilder_control","form_id=".$f2->id." and name='".$name."'")) {
					$count++;
					$name = $control->name . $count;
				}
				$control->name = $name;
				unset($control->id);
				$control->rank = ++$rank;
				$control->form_id = $f2->id;
				$db->insertObject($control,"formbuilder_control");
			}
			formbuilder_form::updateTable($f2);
			
			echo '<script>window.opener.location = window.opener.location; window.close();</script>';
		} else echo SITE_403_HTML;
	} else echo SITE_404_HTML;
?>