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
# $Id: pathos_setup.php,v 1.7 2005/04/26 04:44:35 filetreefrog Exp $
##################################################

// Set up sessions to use cookies, NO MATTER WHAT
ini_set('session.use_cookies',1);
// Set the save_handler to files
ini_set('session.save_handler','files');

if (DEVELOPMENT) {
	// In development mode, we need to turn on full throttle error reporting.
	// Display all errors (some production servers have this set to off)
	ini_set('display_errors',1);
	// Up the ante on the error reporting so we can see notices as well.
	ini_set('error_reporting',E_ALL);
	// This is rarely set to true, but the first time it is, we'll be ready.
	ini_set('ignore_repeated_errors',0);
} else {
	// We can't be showing errors in a production environment...
	ini_set('display_errors',0);
	ini_set('ignore_repeated_errors',1);
}

if (DEVELOPMENT >= 2) {
	function debug($str) { echo $str.'<br /><br />'; }
	function dump_debug($var) { var_dump($var);echo '<br /><br />'; }
} else {
	function debug($str) { }
	function dump_debug($var) { }
}

// The following code was lifted from phpMyAdmin, but then again, this is Open Source, right?

// Determines platform (OS), browser and version of the user
// Based on a phpBuilder article:
//   see http://www.phpbuilder.net/columns/tim20000821.php
if (!defined('PATHOS_USER_OS')) {
    // 1. Platform
	if (!isset($_SERVER['HTTP_USER_AGENT'])) {
		$_SERVER['HTTP_USER_AGENT'] = 'Unknown';
	}
	
    if (strstr($_SERVER['HTTP_USER_AGENT'], 'Win')) {
        define('PATHOS_USER_OS', 'Win');
    } else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Mac')) {
        define('PATHOS_USER_OS', 'Mac');
    } else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Linux')) {
        define('PATHOS_USER_OS', 'Linux');
    } else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Unix')) {
        define('PATHOS_USER_OS', 'Unix');
    } else if (strstr($_SERVER['HTTP_USER_AGENT'], 'OS/2')) {
        define('PATHOS_USER_OS', 'OS/2');
    } else {
        define('PATHOS_USER_OS', 'Other');
    }

    // 2. browser and version
    // (must check everything else before Mozilla)
	$log_version = array();
    if (preg_match('@Opera(/| )([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        define('PATHOS_USER_BROWSER_VERSION', $log_version[2]);
        define('PATHOS_USER_BROWSER', 'OPERA');
    } else if (preg_match('@MSIE ([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        define('PATHOS_USER_BROWSER_VERSION', $log_version[1]);
        define('PATHOS_USER_BROWSER', 'IE');
    } else if (preg_match('@OmniWeb/([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        define('PATHOS_USER_BROWSER_VERSION', $log_version[1]);
        define('PATHOS_USER_BROWSER', 'OMNIWEB');
    } else if (preg_match('@(Konqueror/)(.*)(;)@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        define('PATHOS_USER_BROWSER_VERSION', $log_version[2]);
        define('PATHOS_USER_BROWSER', 'KONQUEROR');
    } else if (preg_match('@Mozilla/([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)
               && preg_match('@Safari/([0-9]*)@', $_SERVER['HTTP_USER_AGENT'], $log_version2)) {
        define('PATHOS_USER_BROWSER_VERSION', $log_version[1] . '.' . $log_version2[1]);
        define('PATHOS_USER_BROWSER', 'SAFARI');
    } else if (preg_match('@Mozilla/([0-9].[0-9]{1,2})@', $_SERVER['HTTP_USER_AGENT'], $log_version)) {
        define('PATHOS_USER_BROWSER_VERSION', $log_version[1]);
        define('PATHOS_USER_BROWSER', 'MOZILLA');
    } else {
        define('PATHOS_USER_BROWSER_VERSION', 0);
        define('PATHOS_USER_BROWSER', 'OTHER');
    }
}

if (!defined('PATHOS_SERVER_OS')) {
	switch (strtoupper(PHP_OS)) {
		case 'LINUX':
			define('PATHOS_SERVER_OS','Linux');
			break;
		case 'WIN32':
		case 'WINNT':
			define('PATHOS_SERVER_OS','Windows');
			break;
		case 'DARWIN':
			define('PATHOS_SERVER_OS','Mac');
			break;
		case 'AIX':
		case 'SUNOS':
			define('PATHOS_SERVER_OS','UNIX');
			break;
		case 'OS/2':
			define('PATHOS_SERVER_OS','OS/2');
			break;
		default:
			define('PATHOS_SERVER_OS','Unknown');
	}
}

?>