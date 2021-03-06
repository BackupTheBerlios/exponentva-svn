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
# $Id: sef.structure.php,v 1.7 2005/04/03 08:05:53 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

pathos_lang_loadDictionary('config','sef');

return array(
	'Meaningful URLs',
	array(
		'MEANINGFUL_URLS'=>array(
			'title'=>TR_CONFIG_MEANINGFUL_URLS,
			'description'=>TR_CONFIG_MEANINGFUL_URLS_DESC,
			'control'=>new checkboxcontrol(false,true)
		),
		'MEANINGFUL_NAV_URLS'=>array(
			'title'=>TR_CONFIG_MEANINGFUL_NAV_URLS,
			'description'=>TR_CONFIG_MEANINGFUL_NAV_URLS_DESC,
			'control'=>new checkboxcontrol(false,true)
		),
	)
);

?>