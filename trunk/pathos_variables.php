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
# $Id: pathos_variables.php,v 1.12 2005/03/21 17:15:09 filetreefrog Exp $
##################################################


if (!defined('BASE')) {
	/*
	 * BASE Constant
	 *
	 * The BASE constant is the absolute path on the server filesystem, from the root (/ or C:\)
	 * to the Exponent directory.
	 */
	define('BASE',__realpath(dirname(__FILE__)).'/');
}
/*
 * PATHOS Constant
 *
 * The PATHOS constant defines the current Major.Minor version of Exponent/Pathos (i.e. 0.95).
 * It's definition also signals to other parts of the system that they are operating within the confines
 * of the Pathos Framework.  (Module actions check this -- if it is not defined, they must abort).
 */
define('PATHOS',include(BASE.'pathos_version.php'));

if (!defined('PATH_RELATIVE')) {
	if (isset($_SERVER['DOCUMENT_ROOT'])) {
		/*
		 * PATH_RELATIVE Constant
		 *
		 * The PATH_RELATIVE constant is the web path to the Exponent directory,
		 * from the web root.  It is related to the BASE constant, but different.
		 */
		define('PATH_RELATIVE',str_replace(__realpath($_SERVER['DOCUMENT_ROOT']),'',BASE));
	} else {
		// FIXME: PATH_RELATIVE definition will break in certain parts when the server does not offer the Document_root.
		// FIXME: Notable, it breaks in the installer.
		// This triggers on IIS, which has no DOCUMENT_ROOT.
		define('PATH_RELATIVE',__realpath(dirname($_SERVER['SCRIPT_NAME']) . '/'));
	}
}

if (!defined('HOSTNAME')) {
	if (isset($_SERVER['HTTP_HOST'])) {
		define('HOSTNAME',$_SERVER['HTTP_HOST']);
	} else if (isset($_SERVER['SERVER_NAME'])) {
		define('HOSTNAME',$_SERVER['SERVER_NAME']);
	}
}

if (!defined('URL_BASE')) {
	/*
	 * URL_BASE Constant
	 *
	 * The URL_BASE constant is the base URL of the domain hosting the Exponent site.
	 * It does not include the PATH_RELATIVE information.  The automatic
	 * detection code can figure out if the server is running in SSL mode or not
	 */
	define('URL_BASE',((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://') . HOSTNAME);
}
if (!defined('URL_FULL')) {
	/*
	 * URL_FULL Constant
	 *
	 * The URL_FULL constant is the full URL path to the Exponent directory.  The automatic
	 * detection code can figure out if the server is running in SSL mode or not.
	 */
	define('URL_FULL',URL_BASE.PATH_RELATIVE);
}

if (defined('SCRIPT_EXP_RELATIVE')) {
	define('SCRIPT_RELATIVE',PATH_RELATIVE.SCRIPT_EXP_RELATIVE);
	define('SCRIPT_ABSOLUTE',BASE.SCRIPT_EXP_RELATIVE);
} else {
	ob_start();
	define('SCRIPT_RELATIVE',PATH_RELATIVE);
	define('SCRIPT_ABSOLUTE',BASE);
}

if (!defined('SCRIPT_FILENAME')) {
	define('SCRIPT_FILENAME','index.php');
}

?>