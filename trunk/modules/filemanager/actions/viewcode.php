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
# $Id: viewcode.php,v 1.6 2005/04/18 15:23:13 filetreefrog Exp $
##################################################
//GREP:HARDCODEDTEXT
if (!defined('PATHOS')) exit('');

$template = new template('filemanager','_viewcode',$loc);

$file = $_GET['file'];
$path = realpath(BASE.$file);
if (strpos($path,BASE) != 0) {
	$template->assign('error','security');
} else {
	$ext = substr($path,-3,3);
	if ($ext != 'tpl' && $ext != 'php') {
		$template->assign('error','invalid');
	} else {
		$contents = file_get_contents($path);
		if ($ext == 'php') {
			if (!defined('SYS_INFO')) require_once(BASE.'subsystems/info.php');	
			$contents = pathos_info_highlightPHP($contents);
		} else $contents = '<xmp>'.$contents.'</xmp>';
	
		$template->assign('error','');
		$template->assign('code',$contents);
	}
}
$template->output();

?>