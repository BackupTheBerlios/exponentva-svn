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
# $Id: optimizedatabase.php,v 1.5 2005/02/19 00:32:28 filetreefrog Exp $
##################################################

// Part of the Database category

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('database',pathos_core_makeLocation('administrationmodule'))) {
	$before = $db->databaseInfo();
	foreach (array_keys($before) as $table) {
		$db->optimize($table);
	}
	$after = $db->databaseInfo();
	
	$template = new Template('administrationmodule','_optimizedatabase',$loc);
	$template->assign('before',$before);
	$template->assign('after',$after);
	
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>