<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

// Part of the Extensions category.

if (!defined('EXPONENT')) exit('');

if (exponent_permissions_check('extensions',exponent_core_makeLocation('AdministrationModule'))) {
	if (!defined('SYS_FILES')) require_once(BASE.'subsystems/files.php');
	
	$ext_filename = BASE . "/tmp/uploads/" . session_id();
	
	$files = array();
	foreach (exponent_files_listFlat($ext_filename,true, null,array(), $ext_filename) as $key=>$f) {
		if ($key != '/archive.tar' && $key != '/archive.tar.gz' && $key != '/archive.tar.bz2' && $key != '/archive.zip') {
			$files[] = array(
				'absolute'=>$key,
				'relative'=>$f,
				'canCreate'=>exponent_files_canCreate(BASE . substr($key, 1)),
				'ext'=>substr($f,-3,3)
			);
		}
	}
	
	$template = new template('AdministrationModule', '_upload_filesList', $loc);
	$template->assign('relative', $ext_filename);
	$template->assign('files', $files);
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>