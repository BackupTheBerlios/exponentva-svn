<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

return array(
	'id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID,
		DB_PRIMARY=>true,
		DB_INCREMENT=>true),
	'ad_id'=>array(
		DB_FIELD_TYPE=>DB_DEF_ID),
	'clicks'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
	'views'=>array(
		DB_FIELD_TYPE=>DB_DEF_INTEGER),
	'date'=>array(
		DB_FIELD_TYPE=>DB_DEF_TIMESTAMP)
);

?>