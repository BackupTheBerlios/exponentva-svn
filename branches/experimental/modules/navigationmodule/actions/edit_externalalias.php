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

// Bail in case someone has visited us directly, or the Exponent framework is
// otherwise not initialized.
if (!defined('EXPONENT')) exit('');

$check_id = 0;

// FIXME: Allow non-administrative users to manage certain
// FIXME: parts of the section hierarchy.
if ($user && $user->is_acting_admin == 1) {
	$section = null;
	if (isset($_GET['id'])) {
		// Check to see if an id was passed in get.  If so, retrieve that section from
		// the database, and perform an edit on it.
		$section = $db->selectObject('section','id='.intval($_GET['id']));
	} else if (isset($_GET['parent'])) {
		// The isset check is merely a precaution.  This action should
		// ALWAYS be invoked with a parent or id value in the GET.
		$section->parent = $_GET['parent'];
	}
} else if (isset($_GET['parent'])) {
	// The isset check is merely a precaution.  This action should
	// ALWAYS be invoked with a parent or id value in the GET.
	$section->parent = $_GET['parent'];
	$check_id = $section->parent;
}

if ($check_id != -1 && exponent_permissions_check('manage',exponent_core_makeLocation('NavigationModule','',$check_id))) {
	$form = section::externalAliasForm($section);
	$form->meta('module','NavigationModule');
	$form->meta('action','save_externalalias');
	// Create a template for the form's output, to allow the themer to optionally
	// change the form title and caption.  This will help with translation.
	$template = new template('NavigationModule','_form_editExternalAlias');
	// Assign the customary 'is_edit' flag with the template, so that the view can show different
	// text to the user if they are creating a new alias or editing an existing one.
	$template->assign('is_edit',isset($section->id));
	// Assign the form's rendered HTML output to the tempalte using the
	// conventional name of 'form_html'.
	$template->assign('form_html',$form->toHTML());
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>
