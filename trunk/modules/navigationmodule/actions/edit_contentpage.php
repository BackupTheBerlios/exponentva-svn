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
# $Id: edit_contentpage.php,v 1.4 2005/04/03 07:57:13 filetreefrog Exp $
##################################################

// Bail in case someone has visited us directly, or the Pathos framework is
// otherwise not initialized.
if (!defined('PATHOS')) exit('');

$check_id = -1;
if (isset($_GET['id'])) {
	// Check to see if an id was passed in get.  If so, retrieve that section from
	// the database, and perform an edit on it.
	$section = $db->selectObject('section','id='.$_GET['id']);
	if ($section) {
		$check_id = $section->id;
	}
} else if (isset($_GET['parent'])) {
	// The isset check is merely a precaution.  This action should
	// ALWAYS be invoked with a parent or id value in the GET.
	$section->parent = $_GET['parent'];
	$check_id = $section->parent;
}

if ($check_id != -1 && pathos_permissions_check('manage',pathos_core_makeLocation('navigationmodule','',$check_id))) {
	
	$form = section::form($section);
	$form->meta('module','navigationmodule');
	$form->meta('action','save_contentpage');
	// Create a template for the form output, to allow the themer to optionally
	// change the form titles and captions, and to aide in translation.
	$template = new template('navigationmodule','_form_editContentPage');
	// Assign the concentional 'is_edit' flag to let the view show different text to the
	// use in case of a create and an edit operation.
	$template->assign('is_edit',isset($section->id));
	// Assign the form/s rendered HTML to the template, using the customary
	// name of 'form_html'
	$template->assign('form_html',$form->toHTML());
	$template->output();
} else {
	// User does not have permission to manage sections.  Throw a 403
	echo SITE_403_HTML;
}

?>