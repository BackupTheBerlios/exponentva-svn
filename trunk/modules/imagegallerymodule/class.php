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
# $Id: class.php,v 1.7 2005/05/09 05:53:47 filetreefrog Exp $
##################################################

class imagegallerymodule {
	function name() { return 'Image Gallery'; }
	function description() { return 'Allows a user to post images to galleries.'; }
	function author() { return 'James Hunt'; }
	
	function hasSources() { return true; }
	function hasContent() { return true; }
	function hasViews() { return true; }
	
	function supportsWorkflow() { return false; }
	
	function getLocationHierarchy($loc) {
		return array(pathos_core_makeLocation($loc->mod,$loc->src),$loc);
	}
	
	function permissions($internal = '') {
		if ($internal == '') {
			return array(
				'administrate'=>'Administrate',
				'configure'=>'Configure',
				'create'=>'Create Galleries',
				'edit'=>'Edit Galleries',
				'delete'=>'Delete Galleries',
				'manage'=>'Manage Gallery Images'
			);
		} else {
			return array(
				'administrate'=>'Administrate',
				'configure'=>'Configure',
				'edit'=>'Edit Gallery',
				'delete'=>'Delete Gallery',
				'manage'=>'Manage Gallery Images'
			);
		}
	}
	
	function show($view,$loc = null, $title = '') {
		$template = new template("imagegallerymodule",$view,$loc);
		
		if (!defined('SYS_FILES')) require(BASE.'subsystems/files.php');
		$directory = 'files/imagegallerymodule/'.$loc->src;
		if (!file_exists(BASE.$directory)) {
			$err = pathos_files_makeDirectory($directory);
			if ($err != SYS_FILES_SUCCESS) {
				pathos_lang_loadDictionary('modules','filemanager');
				$template->assign('noupload',1);
				$template->assign('uploadError',$err);
			}
		}
		
		global $db;
		
		$galleries = $db->selectObjects('imagegallery_gallery',"location_data='".serialize($loc)."'");
		$iloc = pathos_core_makeLocation($loc->mod,$loc->src);
		for ($i = 0; $i < count($galleries); $i++) {
			$iloc->int = $galleries[$i]->id;
			$galleries[$i]->permissions = array(
				'edit'=>pathos_permissions_check('edit',$iloc),
				'delete'=>pathos_permissions_check('delete',$iloc)
			);
		}
		
		$template->assign('galleries',$galleries);
		$template->assign('moduletitle',$title);
		$template->register_permissions(
			array('administrate','create','edit','delete','manage'),
			$loc);
		$template->output();
	}
	
	function deleteIn($loc) {
		global $db;
		foreach ($db->selectObjects('imagegallery_gallery',"location_data='".serialize($loc)."'") as $gallery) {
			$db->delete('imagegallery_image','gallery_id='.$gallery->id);
		}
		$db->delete('imagegallery_gallery',"location_data='".serialize($loc)."'");
	}
	
	function copyContent($oloc,$nloc) {
		global $db;
		$basedirectory = 'files/imagegallerymodule/'.$nloc->src;
		
		foreach ($db->selectObjects('imagegallery_gallery',"location_data='".serialize($oloc)."'") as $gallery) {
			$old_id = $gallery->id;
			unset($gallery->id);
			$gallery->location_data = serialize($nloc);
			$gallery->id = $db->insertObject($gallery,'imagegallery_gallery');
			
			$directory = $basedirectory . '/gallery'.$gallery->id;
			if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
			if (!file_exists(BASE.$directory) && pathos_files_makeDirectory($directory) != SYS_FILES_SUCCESS) {
				return;
			}
			
			foreach ($db->selectObjects('imagegallery_image','gallery_id='.$old_id) as $image) {
				$file = $db->selectObject('file','id='.$image->file_id);
				copy(BASE.$file->directory.'/'.$file->filename,BASE.$directory.'/'.$file->filename);
				if (file_exists(BASE.$directory.'/'.$file->filename)) {
					$file->directory = $directory;
					unset($file->id);
					$image->file_id = $db->insertObject($file,'file');
					
					unset($image->id);
					$image->gallery_id = $gallery->id;
					$db->insertObject($image,'imagegallery_image');
				}
			}
		}
	}
	
	function spiderContent($item = null) {
		// FIXME:For now, no searching in the gallery mod
		return false;
	}
}

?>