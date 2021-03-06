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
# $Id: thumb.php,v 1.8 2005/04/18 01:50:22 filetreefrog Exp $
##################################################

if (defined('PATHOS')) return;

include_once('pathos_bootstrap.php');
// Initialize the Imaging Subsystem (this does not need the Pathos Framework to function)
include_once('subsystems/image.php');

if (isset($_GET['id'])) {
	include_once('subsystems/config/load.php');
	// Initialize the Database Subsystem
	include_once(BASE.'subsystems/database.php');
	$db = pathos_database_connect(DB_USER,DB_PASS,DB_HOST.':'.DB_PORT,DB_NAME);
	
	$file_obj = $db->selectObject('file','id='.$_GET['id']);
	$_GET['file'] = $file_obj->directory.'/'.$file_obj->filename;
}

$file = BASE.$_GET['file'];

$thumb = null;

if (isset($_GET['constraint'])) {
	$thumb = pathos_image_scaleToConstraint($file,$_GET['width'],$_GET['height']);
} else if (isset($_GET['width'])) {
	$thumb = pathos_image_scaleToWidth($file,$_GET['width']);
} else if (isset($_GET['height'])) {
	$thumb = pathos_image_scaleToHeight($file,$_GET['height']);
} else if (isset($_GET['scale'])) {
	$thumb = pathos_image_scaleByPercent($file,$_GET['scale'] / 100);
}

if (is_resource($thumb)) pathos_image_output($thumb,pathos_image_sizeinfo($file));
else pathos_image_showFallbackPreviewImage(BASE,$thumb);

?>
