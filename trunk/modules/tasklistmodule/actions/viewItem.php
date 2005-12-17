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
# $Id: view_article.php,v 1.3 2005/03/13 18:57:28 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");
	$item = null;
	if (isset($_GET['id'])) {
		$item = $db->selectObject("tasklist_task","id=".$_GET['id']);
		if ($item != null) {
			$loc = unserialize($item->location_data);
		} else {
			echo SITE_404_HTML;
		}
	}	

	// tasklist specific transform, to be broken out later
	$item->body = $item->description;
		
	$template = new template("tasklistmodule","_viewItem",$loc);
	$template->assign('item', $item);
	$template->register_permissions(array('manage'),$loc);
	$template->output();


?>