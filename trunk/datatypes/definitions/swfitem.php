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
# $Id: swfitem.php,v 1.5 2005/03/21 17:15:11 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

return array(
	'id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID,
		DB_PRIMARY=>true,
		DB_INCREMENT=>true),
	'name'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>100,
		DB_INDEX=>10),
	'bgcolor'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>12),
	'height'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
	'width'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
	'alignment'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
	'swf_id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'alt_image_id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'location_data'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>200),
	'loop'=>array(
		DB_FIELD_TYPE=>DB_DEF_BOOLEAN)
);
?>