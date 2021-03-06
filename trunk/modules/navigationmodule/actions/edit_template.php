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
# $Id: edit_template.php,v 1.5 2005/04/03 07:57:14 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

if ($user && $user->is_acting_admin == 1) {
	$page = null;
	if (isset($_GET['id'])) {
		$page = $db->selectObject('section_template','id='.$_GET['id']);
	}
	if ($page == null) {
		$page->parent = (isset($_GET['parent']) ? $_GET['parent'] : 0);
	}
	
	$form = section_template::form($page);
	$form->meta('module','navigationmodule');
	$form->meta('action','save_template');
	
	$template = new template('navigationmodule','_form_editTemplate',$loc);
	$template->assign('form_html',$form->toHTML());
	$template->assign('is_top',($page->parent == 0 ? 1 : 0));
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>