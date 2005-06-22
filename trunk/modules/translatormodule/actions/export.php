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
# $Id: export.php,v 1.4 2005/04/26 03:01:57 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$loc = pathos_core_makeLocation('translatormodule');

$lang = null;
if (isset($_GET['id'])) {
	$lang = $db->selectObject('translation_language','id='.$_GET['id']);
	if ($lang) {
		$loc = pathos_core_makeLocation('translatormodule','',$lang->id);
	}
}

if (pathos_permissions_check('configure',$loc)) {
	if ($lang) {
		$tmpdir = BASE.'tmp/translation_'.uniqid('');
		@mkdir($tmpdir);
		if (is_dir($tmpdir)) {
			$langdir = $tmpdir.'/subsystems/lang/'.$lang->lang.'/';
			if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
			pathos_files_makeDirectory($langdir,0777,true);
			
			// Write out the language description file.
			$fh = fopen($tmpdir.'/subsystems/lang/'.$lang->lang.'.php','w');
			fwrite($fh,"<?php\r\n\r\nreturn array(\r\n");
			fwrite($fh,"\t'name'=>'".addslashes($lang->name)."',\r\n");
			fwrite($fh,"\t'author'=>'".addslashes($lang->author)."',\r\n");
			fwrite($fh,"\t'charset'=>'".addslashes($lang->charset)."',\r\n");
			fwrite($fh,"\t'locale'=>'".addslashes($lang->locale)."',\r\n");
			fwrite($fh,"\t'default_view'=>'".addslashes($lang->default_view)."',\r\n");
			fwrite($fh,");\r\n\r\n?>");
			fclose($fh);
			
			// For collecting and sorting the dictionary entries;
			$data = array();
			foreach ($db->selectObjects('translation_dictentry','lang_id='.$lang->id) as $entry) {
				if (!isset($data[$entry->dictionary])) {
					$data[$entry->dictionary] = array();
				}
				$data[$entry->dictionary][$entry->constant] = $entry->value;
			}
			
			foreach ($data as $dictionary=>$values) {
				pathos_files_makeDirectory(dirname($langdir.$dictionary),0777,true);
				
				$fh = fopen($langdir.$dictionary.'.php','w');
				fwrite($fh,"<?php\r\n\r\n");
				
				foreach ($values as $key=>$value) {
					fwrite($fh,"\tdefine('".$key."','".addslashes($value)."');\r\n");
				}
				
				fwrite($fh,"\r\n\r\n?>");
				fclose($fh);
			}
			
			include_once(BASE."external/Tar.php");
			$fname = tempnam(BASE.'/tmp','translation_');
			$tar = new Archive_Tar($fname,'gz');
			$tar->createModify($tmpdir,'',$tmpdir);
			
			ob_end_clean();
			header('Content-Type: application/x-gzip');
			header('Content-Disposition: inline; filename="exponent-languagepack-'.$lang->lang.'.tar.gz"');
			$fh = fopen($fname,'rb');
			while (!feof($fh)) {
				echo fread($fh,8192);
			}
			fclose($fh);
			unlink($fname);
			pathos_files_removeDirectory($tmpdir);

		} else {
			echo 'Could not create default directory.';
		}
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>