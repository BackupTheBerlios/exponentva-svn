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
# $Id: maint.structure.php,v 1.1 2005/04/18 01:43:55 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

return array(
	'Site Maintenance Settings',
	array(
		'MAINTENANCE_MODE'=>array(
			'title'=>'Maintenance Mode?',
			'description'=>'Whether or not the site is in maintenance mode.  While in maintenance mode, only administrators and acting administrators will be allowed to login.',
			'control'=>new checkboxcontrol(false,true)
		),
		'MAINTENANCE_MSG_HTML'=>array(
			'title'=>'Maintenance Mode Message',
			'description'=>'A message to display to all non-administrators visiting the site.',
			'control'=>new htmleditorcontrol()
		)
	)
);

?>