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
# $Id: resourceitem.php,v 1.5 2005/03/29 16:56:02 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

return array(
	'id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID,
		DB_PRIMARY=>true,
		DB_INCREMENT=>true),
	'name'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>100),
	'description'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>10000),
	'location_data'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>250),
	'file_id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'flock_owner'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'approved'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
	'posted'=>array(
		DB_FIELD_TYPE=>DB_DEF_TIMESTAMP),
	'poster'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'edited'=>array(
		DB_FIELD_TYPE=>DB_DEF_TIMESTAMP),
	'editor'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'rank'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
);

?>