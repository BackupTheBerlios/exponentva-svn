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

/* exdoc
 * The definition of this constant lets other parts
 * of the system know that the Core Subsystem
 * has been included for use.
 * @node Subsystems:Core
 */
define("SYS_CORE",1);

/* exdoc
 * This constant can (and should) be used by other parts of the system
 * for defining and communicating an extension type of module.
 * @node Subsystems:Core
 */
define("CORE_EXT_MODULE",1);
/* exdoc
 * This constant can (and should) be used by other parts of the system
 * for defining and communicating an extension type of theme.
 * @node Subsystems:Core
 */
define("CORE_EXT_THEME",2);
/* exdoc
 * This constant can (and should) be used by other parts of the system
 * for defining and communicating an extension type of subsystem.
 * @node Subsystems:Core
 */
define("CORE_EXT_SUBSYSTEM",3);
/* exdoc
 * This constant can (and should) be used by other parts of the system
 * for defining and communicating an 'extension type' to represent the
 * whole system
 * @node Subsystems:Core
 */
define("CORE_EXT_SYSTEM",4);

/* exdoc
 * Creates a location object, based off of the three arguments passed, and returns it.
 *
 * @param		$mo	The module component of the location.
 * @param		$src	The source component of the location.
 * @param		$int	The internal component of the location.
 * @node Subsystems:Core
 */
//Pathos Compatibility::these functions are deprecated
function pathos_core_makeLocation($mod=null,$src=null,$int=null) {
	return exponent_core_makeLocation($mod,$src,$int);
}
function pathos_core_resolveDependencies($ext_name,$ext_type,$path=null) {
	return exponent_core_resolveDependencies($ext_name,$ext_type,$path);	
}
function pathos_core_makeLink($params) {
	return exponent_core_makeLink($params);
}
function pathos_core_makeSecureLink($params) {
	return exponent_core_makeSecureLink($params);
}
function pathos_core_copyObject($o) {
	return exponent_core_copyObject($o);
}
function pathos_core_decrementLocationReference($loc,$section) {
	return exponent_core_decrementLocationReference($loc,$section);
}
function pathos_core_incrementLocationReference($loc,$section) {
	return exponent_core_incrementLocationReference($loc,$section);
}
function pathos_core_version($full = false, $build = false) {
	return  exponent_core_version($full, $build);
}
function pathos_core_URLisValid($url) {
	return exponent_core_URLisValid($url);
}
function pathos_core_maxUploadSizeMessage() {
	return exponent_core_maxUploadSizeMessage();
}
//End Pathos Compatibility

function exponent_core_makeLocation($mod=null,$src=null,$int=null) {
	$loc = null;
	$loc->mod = ($mod ? $mod : "");
	$loc->src = ($src ? $src : "");
	$loc->int = ($int ? $int : "");
	return $loc;
}

/* exdoc
 * Resolve dependencies for an extension, by looking at the appropriate deps.php file.
 *
 * @param string $ext_name The name of the extension.
 * @param Constant $ext_type The type of extension.  This can be one of the following values:
 *	<ul>
 *		<li>CORE_EXT_SUBSYSTEM</li>
 *		<li>CORE_EXT_THEME</li>
 *		<li>CORE_EXT_MODULE</li>
 *	<ul>
 * @node Subsystems:Core
 */
function exponent_core_resolveDependencies($ext_name,$ext_type,$path=null) {
	if ($path == null) {
		$path = BASE;
	}
	$depfile = '';
	switch ($ext_type) {
		case CORE_EXT_SUBSYSTEM:
			$depfile = $path.'subsystems/'.$ext_name.'.deps.php';
			break;
		case CORE_EXT_THEME:
			$depfile = $path.'themes/'.$ext_name.'/deps.php';
			break;
		case CORE_EXT_MODULE:
			$depfile = $path.'modules/'.$ext_name.'/deps.php';
			break;
		case CORE_EXT_SYSTEM:
			$depfile = $path.'deps.php';
			break;
	}
	
	$deps = array();
	if (is_readable($depfile)) {
		$deps = include($depfile);
		foreach ($deps as $info) {
			$deps = array_merge($deps,exponent_core_resolveDependencies($info['name'],$info['type']));
		}
	}
	
	return $deps;
}

/* exdoc
 * Return a full URL, given the desired querystring arguments as an associative array.
 *
 * This function does take into account the SEF URLs settings and the SSL urls in the site config.
 *
 * @param Array $params An associative array of the desired querystring parameters.
 * @node Subsystems:Core
 */
function exponent_core_makeLink($params) {
	$link = (ENABLE_SSL ? NONSSL_URL : URL_BASE);
#	if (SEF_URLS == 0) {
		$link .= SCRIPT_RELATIVE . SCRIPT_FILENAME . "?";
		foreach ($params as $key=>$value) {
			$value = chop($value);
			$key = chop($key);
			if ($value != "") $link .= urlencode($key)."=".urlencode($value)."&";
		}
		$link = substr($link,0,-1);
		return htmlspecialchars($link,ENT_QUOTES);
/*	} else {
		$link .= SCRIPT_RELATIVE  . SCRIPT_FILENAME . "/";
		ksort($params);
		foreach ($params as $key=>$value) {
			$value = chop($value);
			$key = chop($key);
			if ($value != "") $link .= urlencode($key)."/".urlencode($value)."/";
		}
		$link = substr($link,0,-1);
		return $link;
	}
*/
}


/* exdoc
 * Return a full URL, given the desired querystring arguments as an associative array.
 *
 * This function does take into account the SEF URLs settings and the SSL urls in the site config,
 * and uses the SSL url is the site is configured to use SSL.  Otherwise, it works exactly like
 * exponent_core_makeLink.
 *
 * @param Array $params An associative array of the desired querystring parameters.
 * @node Subsystems:Core
 */
function exponent_core_makeSecureLink($params) {
	if (!ENABLE_SSL) return exponent_core_makeLink($params);
	$link = SSL_URL . SCRIPT_FILENAME . "?";
	foreach ($params as $key=>$value) {
		$value = chop($value);
		$key = chop($key);
		if ($value != "") $link .= urlencode($key)."=".urlencode($value)."&";
	}
	$link = substr($link,0,-1);
	return $link;
}

/* exdoc
 * Put in place to get around the strange assignment
 * semantics in PHP5 (assign by ref not value)
 * @param Object $o The object to copy.  An exact duplicate of this will be returned.
 * @node Subsystems:Core
 */
function exponent_core_copyObject($o) {
	$new = null;
	foreach (get_object_vars($o) as $var=>$val) $new->$var = $val;
	return $new;
}

/* exdoc
 * Decrement the reference counts for a given location.  This is used by the Container Module,
 * and probably won't be needed by 95% of the code in Exponent.
 *
 * @param Location $loc The location object to decrement references for.
 * @param integer $section The id of the section that the location exists in.
 * @node Subsystems:Core
 */
function exponent_core_decrementLocationReference($loc,$section) {
	global $db;
	$oldLocRef = $db->selectObject("locationref","module='".$loc->mod."' AND source='".$loc->src."' AND internal='".$loc->int."'");
	$oldSecRef = $db->selectObject("sectionref", "module='".$loc->mod."' AND source='".$loc->src."' AND internal='".$loc->int."' AND section=$section");
	
	$oldLocRef->refcount -= 1;
	$oldSecRef->refcount -= 1;
	
	$db->updateObject($oldLocRef,"locationref","module='".$loc->mod."' AND source='".$loc->src."' AND internal='".$loc->int."'");
	$db->updateObject($oldSecRef,"sectionref","module='".$loc->mod."' AND source='".$loc->src."' AND internal='".$loc->int."' AND section=$section");
}

/* exdoc
 * Increment the reference counts for a given location.  This is used by the Container Module,
 * and probably won't be needed by 95% of the code in Exponent.
 *
 * @param Location $loc The location object to increment references for.
 * @param integer $section The id of the section that the location exists in.
 * @node Subsystems:Core
 */
function exponent_core_incrementLocationReference($loc,$section) {
	global $db;
	$newLocRef = $db->selectObject("locationref","module='".$loc->mod."' AND source='".$loc->src."' AND internal='".$loc->int."'");
	$is_new = false; // For the is_original sectionref attribute
	if ($newLocRef != null) {
		// Pulled an existing source.  Update refcount
		$newLocRef->refcount += 1;
		$db->updateObject($newLocRef,"locationref","module='".$loc->mod."' AND source='".$loc->src."' AND internal='".$loc->int."'");
	} else {
		$is_new = true;
		// New source.  Populate reference
		$newLocRef->module   = $loc->mod;
		$newLocRef->source   = $loc->src;
		$newLocRef->internal = $loc->int;
		$newLocRef->refcount = 1;
		$db->insertObject($newLocRef,"locationref");
		
		// Go ahead and assign permissions on contained module.
		$perms = call_user_func(array($loc->mod,"permissions"));
		global $user;
		foreach (array_keys($perms) as $perm) {
			exponent_permissions_grant($user,$perm,$loc);
		}
		exponent_permissions_triggerSingleRefresh($user);
	}
	
	$newSecRef = $db->selectObject("sectionref", "module='".$loc->mod."' AND source='".$loc->src."' AND internal='".$loc->int."' AND section=$section");
	if ($newSecRef != null) {
		// Pulled an existing source for this section.  Update refcount
		$newSecRef->refcount += 1;
		$db->updateObject($newSecRef,"sectionref","module='".$loc->mod."' AND source='".$loc->src."' AND internal='".$loc->int."' AND section=$section");
	} else {
		// New source for this section.  Populate reference
		$newSecRef->module   = $loc->mod;
		$newSecRef->source   = $loc->src;
		$newSecRef->internal = $loc->int;
		$newSecRef->section = $section;
		$newSecRef->refcount = 1;
		$newSecRef->is_original = ($is_new ? 1 : 0);
		$db->insertObject($newSecRef,"sectionref");
	}
}

/* exdoc
 * Return a string of the current version number.
 *
 * @param bool $full Whether or not to return a full verison number.  If passed as true,
 *	a string in the form of '0.96.3-beta5' will be returned.  Otherwise, '0.96' would be returned.
 * @param bool $build Whether or not to return the build date in the string.
 * @node Subsystems:Core
 */
function exponent_core_version($full = false, $build = false) {
	if (!defined("EXPONENT_VERSION_MAJOR")) include_once(BASE."exponent_version.php");
	$vers = EXPONENT_VERSION_MAJOR.".".EXPONENT_VERSION_MINOR;
	if ($full) {
		$vers .= ".".EXPONENT_VERSION_REVISION;
		if (EXPONENT_VERSION_TYPE != "") $vers .= "-".EXPONENT_VERSION_TYPE.EXPONENT_VERSION_ITERATION;
	}
	if ($build) {
		$vers .= " (Build Date: ".strftime("%D",EXPONENT_VERSION_BUILDDATE).")";
	}
	return $vers;
}

/* exdoc
 * This function checks a full URL against a set of
 * known protocls (like http and https) and determines
 * if the URL is valid.  Returns true if the URL is valid,
 * and false if otherwise.
 *
 * @param string $url The URL to test for validity
 * @node Subsystems:Core
 */
function exponent_core_URLisValid($url) {
	return (
		substr($url,0,7) == "http://" ||
		substr($url,0,8) == "https://" ||
		substr($url,0,7) == "mailto:" ||
		substr($url,0,6) == "ftp://"
	);
}

/* exdoc
 * Generates and returns a message stating the current maximum accepted size of
 * uploaded files.  It intelligently parses the php.ini configuration, so that settings of
 * 2K and 2048 are treated identically.
 * @node Subsystems:Core
 */
function exponent_core_maxUploadSizeMessage() {
	$size = ini_get("upload_max_filesize");
	$size_msg = "";
	$type = substr($size,-1,1);
	$shorthand_size = substr($size,0,-1);
	switch ($type) {
		case 'M':
			$size_msg = $shorthand_size . ' MB';
			break;
		case 'K':
			$size_msg = $shorthand_size . ' kB';
			break;
		case 'G': // PHP5 +
			$size_msg = $shorthand_size . ' GB';
			break;
		default:
			if ($size >= 1024*1024*1024) { // Gigs
				$size_msg = round(($size / (1024*1024*1024)),2) . " GB";
			} else if ($size >= 1024*1024) { // Megs
				$size_msg = round(($size / (1024*1024)),2) . " MB";
			} else if ($size >= 1024) { // Kilo
				$size_msg = round(($size / 1024),2) . " kB";
			} else {
				$size_msg = $size . " bytes";
			}
	}
	$i18n = exponent_lang_loadFile('subsystems/core.php');
	return sprintf($i18n['max_upload'],$size_msg);
}

?>