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
# $Id: class.php,v 1.11 2005/04/18 15:24:57 filetreefrog Exp $
##################################################

class resourcesmodule {
	function name() { return "Resource Manager"; }
	function author() { return "James Hunt"; }
	function description() { return "Manages uploaded files."; }
	
	function hasContent() { return true; }
	function hasViews() { return true; }
	function hasSources() { return true; }
	
	function supportsWorkflow() { return false; }
	
	function permissions($internal = '') {
		pathos_lang_loadDictionary('modules','resourcesmodule');
		if ($internal == '') {
			return array(
				'administrate'=>TR_RESOURCESMODULE_PERM_ADMIN,
				'configure'=>'Configure',
				'post'=>TR_RESOURCESMODULE_PERM_POST,
				'edit'=>TR_RESOURCESMODULE_PERM_EDIT,
				'delete'=>TR_RESOURCESMODULE_PERM_DELETE,
				'manage_approval'=>TR_RESOURCESMODULE_PERM_MANAGEREV
			);
		} else {
			return array(
				'administrate'=>TR_RESOURCESMODULE_PERM_ADMIN,
				'edit'=>TR_RESOURCESMODULE_PERM_EDITONE,
				'delete'=>TR_RESOURCESMODULE_PERM_DELETEONE,
				'manage_approval'=>TR_RESOURCESMODULE_PERM_MANAGEREV
			);
		}
	}
	
	function getLocationHierarchy($loc) {
		if ($loc->int == '') return array($loc);
		else return array($loc,pathos_core_makeLocation($loc->mod,$loc->src));
	}
	
	function show($view,$loc,$title = '') {
		if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
		
		$template = new template('resourcesmodule',$view,$loc);
		
		$directory = 'files/resourcesmodule/' . $loc->src;
		if (!file_exists(BASE.$directory)) {
			$err = pathos_files_makeDirectory($directory);
			if ($err != SYS_FILES_SUCCESS) {
				$template->assign('noupload',1);
				$template->assign('uploadError',$err);
			}
		}
		
		global $db;
		
		$resources = $db->selectObjects('resourceitem',"location_data='".serialize($loc)."'");
		$iloc = pathos_core_makeLocation($loc->mod,$loc->src);
		for ($i = 0; $i < count($resources); $i++) {
			$iloc->int = $resources[$i]->id;
			$resources[$i]->permissions = array(
				'administrate'=>pathos_permissions_check('administrate',$iloc),
				'edit'=>pathos_permissions_check('edit',$iloc),
				'delete'=>pathos_permissions_check('delete',$iloc),
			);
		}
		if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
		usort($resources,'pathos_sorting_byRankAscending');
		
		$rfiles = array();
		foreach ($db->selectObjects('file',"directory='$directory'") as $file) {
			$file->mimetype = $db->selectObject('mimetype',"mimetype='".$file->mimetype."'");
			$rfiles[$file->id] = $file;
		}
		
		$template->assign('moduletitle',$title);
		$template->assign('resources',$resources);
		$template->assign('files',$rfiles);
		
		$template->register_permissions(
			array('administrate','configure','post','edit','delete'),
			$loc);
		
		$template->output($view);
		
	}
	
	function deleteIn($loc) {
		global $db;
		foreach($db->selectObjects('resourceitem',"location_data='".serialize($loc)."'") as $res) {
			foreach ($db->selectObjects('resourceitem_wf_revision','wf_original='.$res->id) as $wf_res) {
				$file = $db->selectObject('file','id='.$wf_res->file_id);
				file::delete($file);
				$db->delete('file','id='.$file->id);
			}
			$db->delete('resourceitem_wf_revision','wf_original='.$res->id);
		}
		rmdir(BASE.'files/resourcesmodule/'.$loc->src);
		$db->delete('resourceitem',"location_data='".serialize($loc)."'");
	}
	
	function copyContent($oloc,$nloc) {
		if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
		$directory = 'files/resourcesmodule/'.$nloc->src;
		if (!file_exists(BASE.$directory) && pathos_files_makeDirectory($directory) != SYS_FILES_SUCCESS) {
			return;
		}
		
		global $db;
		foreach ($db->selectObjects('resourceitem',"location_data='".serialize($oloc)."'") as $r) {
			$file = $db->selectObject('file','id='.$r->file_id);
			
			copy($file->directory.'/'.$file->filename,$directory.'/'.$file->filename);
			$file->directory = $directory;
			unset($file->id);
			$file->id = $db->insertObject($file,'file');
			
			$r->location_data = serialize($nloc);
			$r->file_id = $file->id;
			unset($r->id);
			$db->insertObject($r,'resourceitem');
		}
	}
	
	function spiderContent($item = null) {
		pathos_lang_loadDictionary('modules','resourcesmodule');
		
		global $db;
		
		if (!defined('SYS_SEARCH')) require_once(BASE.'subsystems/search.php');
		
		$search = null;
		$search->category = TR_RESOURCESMODULE_SEARCHTYPE;
		$search->view_link = ''; // FIXME: need a view action
		$search->ref_module = 'resourcesmodule';
		$search->ref_type = 'resourceitem';
		
		if ($item) {
			$db->delete('search',"ref_module='resourcesmodule' AND ref_type='resourceitem' AND original_id=" . $item->id);
			$search->original_id = $item->id;
			$search->body = ' ' . pathos_search_removeHTML($item->description) . ' ';
			$search->title = ' ' . $item->name . ' ';
			$search->location_data = $item->location_data;
			$db->insertObject($search,'search');
		} else {
			$db->delete('search',"ref_module='resourcesmodule' AND ref_type='resourceitem'");
			foreach ($db->selectObjects('resourceitem') as $item) {
				$search->original_id = $item->id;
				$search->body = ' ' . pathos_search_removeHTML($item->description) . ' ';
				$search->title = ' ' . $item->name . ' ';
				$search->location_data = $item->location_data;
				$db->insertObject($search,'search');
			}
		}
		
		return true;
	}
}

?>