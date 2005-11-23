<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
# All Changes as of 6/1/05 Copyright 2005 James Hunt
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
# $Id: class.php,v 1.11 2005/11/22 01:16:08 filetreefrog Exp $
##################################################

class htmltemplatemodule {
	function name() { return pathos_lang_loadKey('modules/htmltemplatemodule/class.php','module_name'); }
	function description() { return pathos_lang_loadKey('modules/htmltemplatemodule/class.php','module_description'); }
	function author() { return 'James Hunt'; }
	
	function hasSources() { return false; }
	function hasContent() { return true; }
	function hasViews() { return true; }
	
	function supportsWorkflow() { return false; }
	
	function permissions($internal = '') {
		$i18n = pathos_lang_loadFile('modules/htmltemplatemodule/class.php');
		return array(
			'administrate'=>$i18n['perm_administrate'],
			'create'=>$i18n['perm_create'],
			'edit'=>$i18n['perm_edit'],
			'delete'=>$i18n['perm_delete']
		);
	}
	
	function show($view,$loc = null,$title = '') {
		if (
			pathos_permissions_check('administrate',$loc) ||
			pathos_permissions_check('create',$loc) ||
			pathos_permissions_check('edit',$loc) ||
			pathos_permissions_check('delete',$loc)
		) {
			$template = new template('htmltemplatemodule',$view,$loc);
			
			$template->assign('noupload',0);
			$template->assign('uploadError','');
				
			if (!defined('SYS_FILES')) include_once(BASE.'subsystems/files.php');
			$directory = 'files/htmltemplatemodule/' . $loc->src;
			if (!file_exists(BASE.$directory)) {
				$err = pathos_files_makeDirectory($directory);
				if ($err != SYS_FILES_SUCCESS) {
					$template->assign('noupload',1);
					$template->assign('uploadError',$err);
				}
			}
			
			global $db;
			$templates = $db->selectObjects('htmltemplate');
			for ($i = 0; $i < count($templates); $i++) {
				$assocs = $db->selectObjects('htmltemplateassociation','template_id='.$templates[$i]->id);
				if (count($assocs) == 1 && $assocs[0]->global == 1) {
					$templates[$i]->global_assoc = 1;
				} else {
					$templates[$i]->global_assoc = 0;
					$templates[$i]->associations = $assocs;
				}
			}
			
			$template->assign('moduletitle',$title);
			$template->assign('templates',$templates);
			$template->register_permissions(
				array('administrate','create','edit','delete'),
				pathos_core_makeLocation('htmltemplatemodule'));
			
			$template->output();
		}
	}
	
	function deleteIn($loc) {
		global $db;
	
		$db->delete('htmltemplate');
		$db->delete('htmltemplateassociation');
	}
	
	function spiderContent($item = null) {
		// Do nothing, no content
		return false;
	}
	
	function copyContent($from_loc,$to_loc) {
		// Do nothing, no content
	}
}

?>