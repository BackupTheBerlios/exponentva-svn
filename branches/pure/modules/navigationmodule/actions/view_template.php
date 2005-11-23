<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
# All Changes as of 6/1/05 Copyright 2005 James Hunt
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
# $Id: view_template.php,v 1.6 2005/11/22 01:16:10 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

if ($user && $user->is_acting_admin == 1) {
	$page = null;
	if (isset($_GET['id'])) {
		$page = $db->selectObject('section_template','id='.intval($_GET['id']));
	}
	
	if ($page) {
		pathos_flow_set(SYS_FLOW_PROTECTED,SYS_FLOW_ACTION);
	
		$template = new template('navigationmodule','_view_template',$loc);
		$template->assign('template',$page);
		$template->assign('subs',navigationmodule::getTemplateHierarchyFlat($page->id));
		
		$template->output();
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>