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
# $Id: db_recover.php,v 1.9 2005/02/19 00:40:17 filetreefrog Exp $
##################################################

define('SCRIPT_EXP_RELATIVE','');
define('SCRIPT_FILENAME','db_recover.php');

// Initialize the Pathos Framework
include_once(dirname(realpath(__FILE__)).'/pathos.php');

pathos_lang_loadDictionary('standard','dbrecover');

exit(TR_DBRECOVER_RECOVERYDISABLED);

// If we made it here, the user has enabled the Database Recovery Script manually.

// Save the old user data, in case current user is actually logged in.
$oldu = $user;
// Temproarily elevate the current user to admin status, to 
// allow them to install tables.
$user->is_admin = 1;
$user->is_acting_admin = 1;

// The $loc variable would normally be created by the Pathos framework
// when running the action we are about to include.  Here, we synthetically
// create the location, so that the action doesn't freak out.
$loc = pathos_core_makeLocation('administrationmodule');

// Simulate running the Install Tables action.
include_once(dirname(__realpath(__FILE__)).'/modules/administrationmodule/actions/installtables.php');

// In case something is screwed up in the database, we need to 
// create some records.

// Create the default administrative account (username:admin, password:admin)
// if there are no users in the user table.
if ($db->tableIsEmpty('user')) {
	echo TR_DBRECOVER_CREATEDEFAULTADMIN.'<br />';
	$user = null;
	$user->username = 'admin';
	$user->password = md5('admin');
	$user->is_admin = 1;
	// This wont work for other users subsystems
	$db->insertObject($user,'user');
}

// If no modules have been activated, we will not be able to activate any modules
// through the Administration Control Panel, usually because we won't
// be able to add the inactive Admin Control Panel to get access to the module
// manager.  Activate at least the Administrative Module if there are no modules.
if ($db->tableIsEmpty('modstate')) {
	echo TR_DBRECOVER_ACTIVATEADMINMOD.'<br />';
	$modstate = null;
	$modstate->module = 'administrationmodule';
	$modstate->active = 1;
	$db->insertObject($modstate,'modstate');
}

// If therer are no sections in the database, we should create a default Home section
// so that the user at least has a starting page.
if ($db->tableIsEmpty('section')) {
	echo TR_DBRECOVER_CREATEDEFAULTSECTION.'<br />';
	$section = null;
	$section->name = TR_DBRECOVER_DEFAULTSECTION;
	$section->public = 1;
	$section->active = 1;
	$section->rank = 0;
	$section->parent = 0;
	$sid = $db->insertObject($section,'section');
}
//GREP:VIEWIFY
?>
