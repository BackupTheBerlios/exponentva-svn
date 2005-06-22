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
# $Id: order_images.php,v 1.4 2005/02/24 20:14:14 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$gallery = $db->selectObject("imagegallery_gallery","id=".$_GET['gid']);
if ($gallery) {
	$loc = unserialize($gallery->location_data);
	$loc->int = $gallery->id;

	if (pathos_permissions_check("manage",$loc)) {
		$a = $db->selectObject("imagegallery_image","gallery_id='".$_GET['gid']."' AND rank=".$_GET['a']);
		$b = $db->selectObject("imagegallery_image","gallery_id='".$_GET['gid']."' AND rank=".$_GET['b']);
		
		$tmp = $a->rank;
		$a->rank = $b->rank;
		$b->rank = $tmp;
		
		$db->updateObject($a,"imagegallery_image");
		$db->updateObject($b,"imagegallery_image");
		
		pathos_flow_redirect();
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;
}

?>