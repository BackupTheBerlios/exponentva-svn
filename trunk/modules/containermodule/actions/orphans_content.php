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
# $Id: orphans_content.php,v 1.6 2005/04/26 04:40:34 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

// PERM CHECK
	$source_select = array();
	$module = "containermodule";
	$view = "_sourcePicker";
	$clickable_mods = null; // Show all
	$dest = null;
	
	if (pathos_sessions_isset("source_select") && (defined("SOURCE_SELECTOR") || defined("CONTENT_SELECTOR"))) {
		$source_select = pathos_sessions_get("source_select");
		$view = $source_select["view"];
		$module = $source_select["module"];
		$clickable_mods = $source_select["showmodules"];
		$dest = $source_select['dest'];
		
	}
	
	$orphans = array();
	foreach ($db->selectObjects("locationref","module='".$_GET['module']."' AND refcount=0") as $orphan) {
		$obj = null;
		$loc = pathos_core_makeLocation($orphan->module,$orphan->source,$orphan->internal);
		
		if (class_exists($orphan->module)) {
			$modclass = $orphan->module;
			$mod = new $modclass();
			
			ob_start();
			$mod->show("Default",$loc);
			$obj->output = ob_get_contents();
			ob_end_clean();
			
			$obj->info = array(
				"module"=>$mod->name(),
				"source"=>$orphan->source,
				"hasContent"=>$mod->hasContent(),
				"hasSources"=>$mod->hasSources(),
				"hasViews"=>$mod->hasViews(),
				"class"=>$modclass,
				"clickable"=>(($clickable_mods == null || in_array($modclass,$clickable_mods))?1:0)
			);
		} else {
			$obj->output = sprintf(TR_CONTAINERMODULE_MODNOTFOUND,$orphan->module);
			$containers[$i]->info = array(
					"module"=>"Unknown:".$location->mod,
					"source"=>$orphan->source,
					"hasContent"=>0,
					"hasSources"=>0,
					"hasViews"=>0,
					"class"=>$modclass,
					"clickable"=>false
				);
		}
		$obj->moduleLocation = $loc;
		$orphans[] = $obj;
	}

	$template = new template("containermodule","Default");
	$template->assign("singleview",$view);
	$template->assign("singlemodule",$module);

	if ($dest) $template->assign("dest",$dest);
	$template->assign("containers",$orphans);
	$template->output();
// END PERM CHECK

?>