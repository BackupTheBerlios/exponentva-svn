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
# $Id: popup.php,v 1.8 2005/04/18 15:52:48 filetreefrog Exp $
##################################################

define('SCRIPT_EXP_RELATIVE','');
define('SCRIPT_FILENAME','popup.php');

ob_start();

// Initialize the Pathos Framework
require_once('pathos.php');

// Initialize the Theme Subsystem
if (!defined('SYS_THEME')) require_once(BASE.'subsystems/theme.php');

$loc = pathos_core_makeLocation(
	(isset($_GET['module'])?$_GET['module']:''),
	(isset($_GET['src'])?$_GET['src']:''),
	(isset($_GET['int'])?$_GET['int']:'')
);

$SYS_FLOW_REDIRECTIONPATH='popup';

if (pathos_theme_inAction()) {
	pathos_theme_runAction();
} else if (isset($_GET['module']) && isset($_GET['view'])) {
	pathos_flow_set(SYS_FLOW_PUBLIC,SYS_FLOW_SECTIONAL);

	$mod = new $_GET['module']();
	$mod->show($_GET['view'],$loc,(isset($_GET['title'])?$_GET['title']:''));
}

$str = ob_get_contents();
ob_end_clean();

$template = new standalonetemplate('popup_'.(isset($_GET['template'])?$_GET['template']:'general'));
$template->assign('output',$str);
$template->output();

?>