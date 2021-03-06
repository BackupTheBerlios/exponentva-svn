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
# $Id: save_upload.php,v 1.5 2005/02/19 00:32:32 filetreefrog Exp $
##################################################
//GREP:HARDCODEDTEXT

if (!defined("PATHOS")) exit("");

if (pathos_permissions_check("create",$loc)) {
	$t = null;
	if (isset($_POST['id'])) $t = $db->selectObject("htmltemplate","id=".$_POST['id']);
	
	$t = htmltemplate::update($_POST,$t);

	$directory = "files/htmltemplatemodule";
	if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
		$file = file::update("file",$directory,null);
		if ($file != null) {
			$t->body = file_get_contents(BASE.$directory."/".$file->filename);
			unlink(BASE.$directory."/".$file->filename);
			
			if (isset($t->id)) $db->updateObject($t,"htmltemplate");
			else $db->insertObject($t,"htmltemplate");
			pathos_flow_redirect();
		}
	} else {
		$post = $_POST;
		pathos_lang_loadDictionary('modules','filemanager');
		switch($_FILES["file"]["error"]) {
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				$post['_formError'] = TR_FILEMANAGER_FILETOOLARGE;
				break;
			case UPLOAD_ERR_PARTIAL:
				$post['_formError'] = TR_FILEMANAGER_PARTIALFILE;
				break;
			case UPLOAD_ERR_NO_FILE:
				$post['_formError'] = TR_FILEMANAGER_NOFILEUPLOADED;
				break;
		}
		pathos_sessions_set("last_POST",$post);
		header("Location: " . $_SERVER['HTTP_REFERER']);
	}
} else {
	echo SITE_403_HTML;
}

?>