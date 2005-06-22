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
# $Id: import.php,v 1.4 2005/04/26 03:01:57 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$loc = pathos_core_makeLocation('translatormodule');
if (pathos_permissions_check('configure',$loc)) {
	if ($_FILES['file']['error'] != UPLOAD_ERR_OK) {
		pathos_lang_loadDictionary('modules','filemanager');
		switch($_FILES['file']['error']) {
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
	
		if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
	
		$tmpdir = BASE.'tmp/translation_'.uniqid('').'/';
		pathos_files_makeDirectory($tmpdir,0777,true);
		if (is_dir($tmpdir)) {
			include_once(BASE.'external/Tar.php');
			
			$tar = new Archive_Tar($_FILES['file']['tmp_name'],'gz');
			
			$return = $tar->extract($tmpdir);
			if (!$return) {
				echo '<br />Error extracting TAR archive<br />';
			} else if (!file_exists($tmpdir.'subsystems/lang') || !is_dir($tmpdir.'subsystems/lang')) {
				echo '<br />Invalid archive format<br />';
			} else {
				// Keep going
				$base = $tmpdir.'subsystems/lang/';
				$dh = opendir($base);
				while (($file = readdir($dh)) !== false) {
					if (is_dir($base.$file) && $file{0} != '.' && $file != 'CVS' && is_readable($base.$file.'.php')) {
						echo '1:'.$base.$file.'<br />';
						$lang = null;
						$lang_info = include($base.$file.'.php');
						if (is_array($lang_info)) {
							$lang->name = $lang_info['name'];
							$lang->author = $lang_info['author'];
							$lang->charset = $lang_info['charset'];
							$lang->locale = $lang_info['locale'];
							$lang->default_view = $lang_info['default_view'];
							$lang->lang = $file; // i.e. 'en' or 'de'
							
							$lang->id = $db->insertObject($lang,'translation_language');
							
							// Set up an entry for later
							$entry = null;
							$entry->lang_id = $lang->id;
							
							$langdir = $base.$file.'/';
							$langdh = opendir($langdir);
							while (($type = readdir($langdh)) !== false) {
								if (is_dir($langdir.$type) && $type{0} != '.' && $type != 'CVS') {
									echo '2:'.$langdir.$type.'<br />';
									$typedir = $langdir.$type.'/';
									$typedh = opendir($typedir);
									
									while (($dictionary = readdir($typedh)) !== false) {
										if (substr($typedir.$dictionary,-4,4) == '.php') {
											$dictionary = substr($dictionary,0,-4);
											echo '3:'.$dictionary.'<br />';
											$constants = translatormodule::parseDictionary($type,$dictionary,$file,$tmpdir);
											
											$entry->dictionary = $type.'/'.$dictionary;
											
											foreach ($constants as $constant=>$value) {
												$entry->constant = $constant;
												$entry->value = $value;
												
												$db->insertObject($entry,'translation_dictentry');
											}
										}
									}
									closedir($typedh);
								}
							}
							closedir($langdh);
						}
					}
				}
			}
			pathos_flow_redirect();
		} else {
			echo 'Unable to create tmp dir.';
		}
	}
} else {
	echo SITE_403_HTML;
}



?>