<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Copyright (c) 2005-2006 Maxim Mueller
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

if (!defined('EXPONENT')) exit('');

$themes = array();
$themeFiles = exponent_core_resolveFilePaths("themes", "", "", "*Theme.php");
if ($themeFiles != false) {
	foreach ($themeFiles as $themeFile) {
		// Need to avoid the duplicate theme problem. e.g. it has been loaded before
		// needed because php4 does not have __autoload()
		$themeClass = basename($themeFile, ".php");
		if (!class_exists($themeClass)) {
			include_once($themeFile);
		}
		
		if (class_exists($themeClass)) {
			// Need to avoid instantiating non-existent classes.
			$t = new $themeClass();
			$themes[$themeClass] = $t->name();
		}
	}
}
uasort($themes,'strnatcmp');

$i18n = exponent_lang_loadFile('conf/extensions/display.structure.php');

return array(
	$i18n['title'],
	array(
		'DISPLAY_THEME_REAL'=>array(
			'title'=>$i18n['theme_real'],
			'description'=>$i18n['theme_real_desc'],
			'control'=>new dropdowncontrol(null,$themes)
		),
		'DISPLAY_ATTRIBUTION'=>array(
			'title'=>$i18n['attribution'],
			'description'=>$i18n['attribution_desc'],
			'control'=>new dropdowncontrol(null,array('firstlast'=>'John Doe','lastfirst'=>'Doe, John','first'=>'John','username'=>'jdoe'))
		),
		'DISPLAY_DATETIME_FORMAT'=>array(
			'title'=>$i18n['datetime_format'],
			'description'=>$i18n['datetime_format_desc'],
			'control'=>new dropdowncontrol(null,exponent_config_dropdownData('datetime_format'))
		),
		'DISPLAY_DATE_FORMAT'=>array(
			'title'=>$i18n['date_format'],
			'description'=>$i18n['date_format_desc'],
			'control'=>new dropdowncontrol(null,exponent_config_dropdownData('date_format'))
		),
		'DISPLAY_TIME_FORMAT'=>array(
			'title'=>$i18n['time_format'],
			'description'=>$i18n['time_format_desc'],
			'control'=>new dropdowncontrol(null,exponent_config_dropdownData('time_format'))
		),
		'DISPLAY_WEEKS_START_ON'=>array(
			'title'=>$i18n['weeks_start_on'],
			'description'=>$i18n['weeks_start_on_desc'],
			'control'=>new dropdowncontrol(null,exponent_config_dropdownData('weeks_start_on'))
		)
	)
);

?>
