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
# $Id: view_gallery.php,v 1.5 2005/02/24 20:14:14 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$gallery = null;
if (isset($_GET['id'])) $gallery = $db->selectObject("imagegallery_gallery","id=".$_GET['id']);

if ($gallery) {
	pathos_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_ACTION);

	$loc = unserialize($gallery->location_data);
	
	$totalimages = $db->countObjects("imagegallery_image","gallery_id=".$gallery->id);
	$currentpage = (isset($_GET['page']) ? $_GET['page'] : 0);
	$perpage = $gallery->perpage;
	$totalpages = ceil($totalimages/$perpage);
	if ($totalpages == 0) $totalpages = 1;
	
	if ($currentpage >= $totalpages || $currentpage < 0) $currentpage = 0;
	
	$images = $db->selectObjects("imagegallery_image","gallery_id=".$gallery->id . ' ORDER BY rank ASC '.$db->limit($perpage,($currentpage*$perpage)));
	for ($i = 0; $i < count($images); $i++) {
		$images[$i]->file = $db->selectObject("file","id=".$images[$i]->file_id);
	}
	
	$table = array();
	for ($i = 0; $i < count($images);) {
		$tmp = array();
		for ($j = 0; $j < $gallery->perrow && $i < count($images); $j++, $i++) {
			$tmp[] = $images[$i];
		}
		$table[] = $tmp;
	}
	
	$iloc = pathos_core_makeLocation($loc->mod,$loc->src);
	$iloc->int = $gallery->id;
	$gallery->permissions = array(
		"administrate"=>pathos_permissions_check("administrate",$iloc),
		"edit"=>pathos_permissions_check("edit",$iloc),
		"delete"=>pathos_permissions_check("delete",$iloc),
		"manage"=>pathos_permissions_check("manage",$iloc)
	);
	
	$template = new template("imagegallerymodule","_view_gallery",$iloc);
	$template->register_permissions(
		array("administrate","edit","delete","manage"),
		$iloc
	);
	
	$template->assign("gallery",$gallery);
	$template->assign("images",$images);
	$template->assign("table",$table);
	
	$template->assign("currentpage",$currentpage+1);
	$template->assign("nextpage",$currentpage+1);
	$template->assign("prevpage",$currentpage-1);
	$template->assign("totalimages",$totalimages);
	$template->assign("totalpages",$totalpages);
	
	$template->output();
} else {
	echo SITE_404_HTML;
}

?>