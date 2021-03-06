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
# $Id: login.php,v 1.9 2005/04/18 15:51:47 filetreefrog Exp $
##################################################

define('SCRIPT_EXP_RELATIVE','');
define('SCRIPT_FILENAME','login.php');

ob_start();

// Initialize the Pathos Framework
require_once('pathos.php');

// Initialize the Sessions Subsystem
if (!defined('SYS_SESSIONS')) require_once(BASE.'subsystems/sessions.php');
// Initialize the Theme Subsystem
if (!defined('SYS_THEME')) require_once(BASE.'subsystems/theme.php');

if (pathos_sessions_loggedIn()) {
	$SYS_FLOW_REDIRECTIONPATH = 'pathos_default';
	pathos_flow_redirect();
	exit('Redirecting...');
} else if (isset($_REQUEST['module']) && isset($_REQUEST['action'])) {
	$SYS_FLOW_REDIRECTIONPATH = 'loginredirect'; 
	pathos_theme_runAction();
	loginmodule::show(DEFAULT_VIEW,null);
} else {
	$SYS_FLOW_REDIRECTIONPATH = 'loginredirect'; 
	pathos_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_SECTIONAL);
	loginmodule::show(DEFAULT_VIEW,null);
}

$template = new standalonetemplate('loginredirect');

$template->assign('output',ob_get_contents());
ob_end_clean();
$template->output();

?>