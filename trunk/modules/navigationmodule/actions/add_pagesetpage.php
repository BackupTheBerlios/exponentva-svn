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
# $Id: add_pagesetpage.php,v 1.4 2005/04/03 07:57:13 filetreefrog Exp $
##################################################

// Bail in case someone has visited us directly, or the Pathos framework is
// otherwise not initialized.
if (!defined('PATHOS')) exit('');

$check_id = -1;
$section = null;
if (isset($_GET['parent'])) {
	// The isset check is merely a precaution.  This action should
	// ALWAYS be invoked with a parent or id value in the GET.
	$section->parent = $_GET['parent'];
	$check_id = $section->parent;
}
	
if ($check_id != -1 && pathos_permissions_check('manage',pathos_core_makeLocation('navigationmodule','',$check_id))) {
	if (!isset($section->id)) {
		// Adding pagesets only works for adding, not editting.
		$form = section::pagesetForm($section);
		$form->meta('module','navigationmodule');
		$form->meta('action','save_pagesetpage');
		// Create a template for the form output, so that the themer can
		// optionally change the form title and caption
		$template = new template('navigationmodule','_form_addPagesetPage');
		// Assign the form's rendered HTML, with the customary name 'form_html'
		$template->assign('form_html',$form->toHTML());
		$template->output();
	} else {
		// User is trying to edit a pageset page.  This is an error.
		// FIXME: Need some sort of Internal Server Error message.
		// FIXME: For now, using SITE_404_HTML.
		echo SITE_404_HTML;
	}
} else {
	// User does not have permission to manage sections.  Throw a 403
	echo SITE_403_HTML;
}

?>