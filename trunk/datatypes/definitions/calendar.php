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
# $Id: calendar.php,v 1.5 2005/02/19 00:39:00 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

return array(
	'id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID,
		DB_PRIMARY=>true,
		DB_INCREMENT=>true),
	'location_data'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>200),
	'title'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>100),
	'body'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>10000),
	'eventstart'=>array(
		DB_FIELD_TYPE=>DB_DEF_TIMESTAMP),
	'eventend'=>array(
		DB_FIELD_TYPE=>DB_DEF_TIMESTAMP),
	'posted'=>array(
		DB_FIELD_TYPE=>DB_DEF_TIMESTAMP),
	'poster'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'edited'=>array(
		DB_FIELD_TYPE=>DB_DEF_TIMESTAMP),
	'editor'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'approved'=>array(
		DB_FIELD_TYPE=>DB_DEF_BOOLEAN),
	'is_allday'=>array(
		DB_FIELD_TYPE=>DB_DEF_BOOLEAN),
	'is_recurring'=>array(
		DB_FIELD_TYPE=>DB_DEF_BOOLEAN),
	'category_id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'feedback_form'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>100),
	'feedback_email'=>array(
		DB_FIELD_TYPE=>DB_DEF_STRING,
		DB_FIELD_LEN=>1000)
);

?>