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
# $Id: save_upload.php,v 1.1 2005/05/04 19:11:32 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$collection = null;
if (isset($_POST['collection_id'])) {
	$collection = $db->selectObject('file_collection','id='.$_POST['collection_id']);
}
$loc = pathos_core_makeLocation('filemanagermodule');

if ($collection) {
	// PERM CHECK
		$file = file::update($_POST['file'], 'files', 'files.php', null);
		if (is_object($file)) {
			$file->name = $_POST['name'];
			$file->collection_id = $collection->id;
			$db->insertObject($file,$_POST['name']);
			pathos_flow_redirect();
		} else {
			echo $file;
		}
	// END PERM CHECK
} else {
	echo SITE_404_HTML;
}

?>