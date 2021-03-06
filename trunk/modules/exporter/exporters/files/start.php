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
# $Id: start.php,v 1.2 2005/02/19 00:32:32 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$mods = array();
$dh = opendir(BASE.'files');
while (($file = readdir($dh)) !== false) {
	if (is_dir(BASE.'files/'.$file) && $file{0} != '.' && class_exists($file)) {
		$mods[$file] = call_user_func(array($file,'name'));
	}
}

uasort($mods,'strnatcmp');

$template = new template('exporter','_files_modList',$loc);
$template->assign('mods',$mods);
$template->output();

?>