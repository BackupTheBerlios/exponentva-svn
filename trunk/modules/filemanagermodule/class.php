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
# $Id: class.php,v 1.1 2005/05/04 19:11:32 filetreefrog Exp $
##################################################

class filemanagermodule {
	function name() { return 'Exponent File Manager'; }
	function description() { return 'Manages all uploaded files for the site.'; }
	function author() { return 'James Hunt'; }
	
	function hasSources() { return false; }
	function hasContent() { return true; }
	function hasViews() { return true; }
	
	function supportsWorkflow() { return false; }
	
	function permissions($internal = "") {
		if ($internal == "") {
			return array(
				"administrate"=>"Administrate",
				"configure"=>"Configure",
			);
		} else {
			return array(
				"administrate"=>"Administrate",
				"configure"=>"Configure",
			);
		}
	}
	
	function show($view,$loc = null, $title = "") {
		$loc = pathos_core_makeLocation('filemanagermodule');
		
		global $db;
		$collections = $db->selectObjects('file_collection');
		
		$template = new template('filemanagermodule',$view,$loc);
		$template->assign('collections',$collections);

		$template->assign('moduletitle', $title);
		$template->output();
	}
	
	function deleteIn($loc) {
	
	}
	
	function copyContent($oloc,$nloc) {
	
	}
}

?>