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
# $Id: saveupdatedfile.php,v 1.6 2005/04/18 15:24:57 filetreefrog Exp $
##################################################
//GREP:HARDCODEDTEXT
if (!defined("PATHOS")) exit("");

$resource = $db->selectObject("resourceitem","id=".$_POST['id']);
if ($resource) {
	$loc = unserialize($resource->location_data);
	$iloc = pathos_core_makeLocation($loc->mod,$loc->src,$resource->id);
	
	if (pathos_permissions_check("edit",$loc) || pathos_permissions_check("edit",$iloc)) {
	
		if ($_FILES['file']['error'] != UPLOAD_ERR_OK) {
			pathos_lang_loadDictionary('modules','filemanagermodule');
			switch($_FILES["file"]["error"]) {
					case UPLOAD_ERR_INI_SIZE:
					case UPLOAD_ERR_FORM_SIZE:
						echo TR_FILEMANAGER_FILETOOLARGE;
						break;
					case UPLOAD_ERR_PARTIAL:
						echo TR_FILEMANAGER_PARTIALFILE;
						break;
					case UPLOAD_ERR_NO_FILE:
						echo TR_FILEMANAGER_NOFILEUPLOADED;
						break;
				}
		} else {
			$directory = "files/resourcesmodule/".$loc->src;
			$file = file::update("file",$directory,null,time()."_".$_FILES['file']['name']);
			$id = $db->insertObject($file,"file");
			$resource->file_id = $id;
			
			$resource->editor = $user->id;
			$resource->edited = time();
			
			if (isset($_POST['checkin']) && ($user->is_acting_admin == 1 || $user->id == $resource->flock_owner)) {
				$resource->flock_owner = 0;
			}
			
			if (!defined("SYS_WORKFLOW")) require_once(BASE."subsystems/workflow.php");
			pathos_workflow_post($resource,"resourceitem",$loc);
		}
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;
}

?>