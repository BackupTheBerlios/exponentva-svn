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
# $Id: install_extension.php,v 1.8 2005/04/18 15:33:33 filetreefrog Exp $
##################################################
//GREP:HARDCODEDTEXT

// Part of the Extensions category

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('extensions',pathos_core_makeLocation('administrationmodule'))) {
	if ($_FILES['mod_archive']['error'] != UPLOAD_ERR_OK) {
		pathos_lang_loadDictionary('modules','filemanager');
		switch($_FILES['mod_archive']['error']) {
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				echo TR_FILEMANAGER_FILETOOLARGE.'<br />';
				break;
			case UPLOAD_ERR_PARTIAL:
				echo TR_FILEMANAGER_PARTIALFILE.'<br />';
				break;
			case UPLOAD_ERR_NO_FILE:
				echo TR_FILEMANAGER_NOFILEUPLOADED.'<br />';
				break;
		}
	} else {
		$basename = basename($_FILES['mod_archive']['name']);
		// Check future radio buttons
		// for now, try auto-detect
		$compression = null;
		$ext = '';
		if (substr($basename,-4,4) == '.tar') {
			$compression = null;
			$ext = '.tar';
		} else if (substr($basename,-7,7) == '.tar.gz') {
			$compression = 'gz';
			$ext = '.tar.gz';
		} else if (substr($basename,-4,4) == '.tgz') {
			$compression = 'gz';
			$ext = '.tgz';
		} else if (substr($basename,-8,8) == '.tar.bz2') {
			$compression = 'bz2';
			$ext = '.tar.bz2';
		} else if (substr($basename,-4,4) == '.zip') {
			$compression = 'zip';
			$ext = '.zip';
		}
		
		if ($ext == '') {
			pathos_lang_loadDictionary('modules','administrationmodule');
			echo TR_ADMINISTRATIONMODULE_BADARCHIVE.'<br />';
		} else {
			if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
		
			// Look for stale sessid directories:
			$sessid = session_id();
			if (file_exists(BASE."extensionuploads/$sessid") && is_dir(BASE."extensionuploads/$sessid")) pathos_files_removeDirectory("extensionuploads/$sessid");
			$return = pathos_files_makeDirectory("extensionuploads/$sessid");
			if ($return != SYS_FILES_SUCCESS) {
				switch ($return) {
					case SYS_FILES_FOUNDFILE:
					case SYS_FILES_FOUNDDIR:
						echo 'Found file or directory in the way.<br />';
						break;
					case SYS_FILES_NOTWRITABLE:
						echo 'Destination parent is not writable.<br />';
						break;
					case SYS_FILES_NOTREADABLE:
						echo 'Destination parent is not readable.<br />';
						break;
				}
			}
			
			$dest = BASE."extensionuploads/$sessid/archive$ext";
			move_uploaded_file($_FILES['mod_archive']['tmp_name'],$dest);
			
			if ($compression != 'zip') {// If not zip, must be tar
				include_once(BASE.'external/Tar.php');
				
				$tar = new Archive_Tar($dest,$compression);
				
				PEAR::setErrorHandling(PEAR_ERROR_PRINT);
				$return = $tar->extract(dirname($dest));
				if (!$return) {
					echo '<br />Error extracting TAR archive<br />';
				} else {
					header('Location: ' . URL_FULL . 'index.php?module=administrationmodule&action=verify_extension&type=tar');
				}
			} else { // must be zip
				include_once(BASE.'external/Zip.php');
				
				$zip = new Archive_Zip($dest);
				
				PEAR::setErrorHandling(PEAR_ERROR_PRINT);
				if ($zip->extract(array('add_path'=>dirname($dest))) == 0) {
					echo '<br />Error extracting ZIP archive:<br />';
					echo $zip->_error_code . ' : ' . $zip->_error_string . '<br />';
				} else {
					header('Location: ' . URL_FULL . 'index.php?module=administrationmodule&action=verify_extension&type=zip');
				}
			}
		}
	}
} else {
	echo SITE_403_HTML;
}

?>