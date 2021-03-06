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
# $Id: af_edit.php,v 1.5 2005/02/19 00:32:29 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$af = null;
if (isset($_GET['id'])) {
	$af = $db->selectObject('banner_affiliate','id='.$_GET['id']);
}

if (pathos_permissions_check('manage_af',$loc)) {
	$form = banner_affiliate::form($af);
	$form->meta('module','bannermodule');
	$form->meta('action','af_save');
	
	$template = new template('bannermodule','_form_af_edit',$loc);
	$template->assign('form_html',$form->toHTML());
	$template->assign('is_edit',isset($_GET['id']));
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>