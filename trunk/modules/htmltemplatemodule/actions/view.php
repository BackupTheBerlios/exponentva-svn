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
# $Id: view.php,v 1.4 2005/02/19 00:32:32 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

// PERM CHECK
	$t = null;
	if (isset($_GET['id'])) $t = $db->selectObject("htmltemplate","id=".$_GET['id']);
	if ($t) {
		pathos_flow_set(SYS_FLOW_PROTECTED,SYS_FLOW_ACTION);
	
		$template = new template("htmltemplatemodule","_view",$loc);
		
		$template->assign("template",$t);
		$template->register_permissions(
			array("administrate","edit","delete"),
			$loc);
		$template->output();
	} else echo SITE_404_HTML;
// END PERM CHECK

?>