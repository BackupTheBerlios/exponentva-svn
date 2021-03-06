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
# $Id: banner_click.php,v 1.6 2005/04/18 15:21:56 filetreefrog Exp $
##################################################

define('SCRIPT_EXP_RELATIVE','modules/bannermodule/');
define('SCRIPT_FILENAME','banner_click.php');

include_once('../../pathos.php');

// Process click
$banner = $db->selectObject('banner_ad','id='.$_GET['id']);
if (!defined('SYS_DATETIME')) require_once(BASE.'subsystems/datetime.php');
$start = pathos_datetime_startOfDayTimestamp(time());
$clicks = $db->selectObject('banner_click','ad_id='.$banner->id.' AND date=$start');
if ($clicks != null) {
	$clicks->clicks++;
	$db->updateObject($clicks,'banner_click');
} else {
	$clicks->clicks = 1;
	$clicks->ad_id = $banner->id;
	$clicks->date = $start;
	$db->insertObject($clicks,'banner_click');
}

if (substr($banner->url,0,7) != 'http://') $banner->url = 'http://' . $banner->url;
header('Location: ' . $banner->url);

?>