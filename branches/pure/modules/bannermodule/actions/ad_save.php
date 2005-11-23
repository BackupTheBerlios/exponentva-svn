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
# $Id: ad_save.php,v 1.6 2005/11/22 01:16:04 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$banner = null;
if (isset($_POST['id'])) {
	$banner = $db->selectObject('banner_ad','id='.$_POST['id']);
	$loc = unserialize($banner->location_data);
}

if (pathos_permissions_check('manage',$loc)) {
	
	$banner = banner_ad::update($_POST,$banner);
	$banner->location_data = serialize($loc);
	
	if (!isset($banner->file_id)) {
		$directory = 'files/bannermodule/'.$loc->src;
		$file = file::update('file',$directory,null);
		if (is_object($file)) {
			$banner->file_id = $db->insertObject($file,'file');
			$db->insertObject($banner,'banner_ad');
		} else {
			// If file::update() returns a non-object, it should be a string.  That string is the error message.
			$post = $_POST;
			$post['_formError'] = $file;
			pathos_sessions_set('last_POST',$post);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	} else {
		$db->updateObject($banner,'banner_ad');
	}
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>