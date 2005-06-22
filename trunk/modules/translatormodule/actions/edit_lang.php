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
# $Id: edit_lang.php,v 1.4 2005/03/13 20:40:47 filetreefrog Exp $
##################################################

if (!defined("PATHOS")) exit("");

$loc = pathos_core_makeLocation('translatormodule');

$lang = null;
if (isset($_GET['id'])) {
	$lang = $db->selectObject('translation_language','id='.$_GET['id']);
	if ($lang) {
		$loc = pathos_core_makeLocation('translatormodule','',$lang->id);
	}
}

if (pathos_permissions_check('configure',$loc)) {
	$form = translation_language::form($lang);
	$form->meta('module','translatormodule');
	$form->meta('action','save_lang');
	
	$template = new template('translatormodule','_form_editLang');
	$template->assign('form_html',$form->toHTML());
	$template->output();
} else {
	echo SITE_403_HTML;
}

?>