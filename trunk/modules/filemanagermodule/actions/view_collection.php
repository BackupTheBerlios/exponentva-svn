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
# $Id: view_collection.php,v 1.1 2005/05/04 19:11:32 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$collection = null;
if (isset($_GET['id'])) {
	$collection = $db->selectObject('file_collection','id='.$_GET['id']);
} else {
	$collection->id = 0;
	$collection->name = 'Uncategorized Files';
	$collection->description = 'Theses files have not been categorized yet,';
}
$loc = pathos_core_makeLocation('filemanagermodule');

if ($collection) {
	pathos_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_ACTION);
	
	$template = new template('filemanagermodule','_view');
	$template->assign('collection',$collection);
	
	$files = $db->selectObjects('file','collection_id='.$collection->id);
	if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
	usort($files,'pathos_sorting_byPostedDescending');
	$template->assign('files',$files);
	$template->assign('numfiles',count($files));
	
	$template->output();
} else {
	echo SITE_404_HTML;
}

?>