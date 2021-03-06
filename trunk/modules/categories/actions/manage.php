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
# $Id: manage.php,v 1.9 2005/04/18 15:22:30 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$mloc = pathos_core_makeLocation($_GET['orig_module'], $loc->src, $loc->int);

if (pathos_permissions_check('manage_categories',$mloc)) {
	pathos_flow_set(SYS_FLOW_PROTECTED,SYS_FLOW_ACTION);
	
	$categories = $db->selectObjects("category","location_data='".serialize($mloc)."'");
	if (pathos_template_getModuleViewFile($mloc->mod,"_cat_manageCategories",false) == TEMPLATE_FALLBACK_VIEW) {
		$template = new template("categories","_cat_manageCategories",$loc);
	} else {
		$template = new template($mloc->mod,"_cat_manageCategories",$loc);
	}	
	if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
	usort($categories, "pathos_sorting_byRankAscending");
	$template->assign("origmodule", $_GET['orig_module']);
	$template->assign("categories",$categories);
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>