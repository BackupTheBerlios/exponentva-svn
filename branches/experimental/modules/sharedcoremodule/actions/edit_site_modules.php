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

if (!defined('EXPONENT')) exit('');

if (exponent_permissions_check('manage_site',exponent_core_makeLocation('SharedCoreModule'))) {
	$site = null;
	if (isset($_GET['site_id'])) {
		$site = $db->selectObject('sharedcore_site','id='.intval($_GET['site_id']));
	}
	
	if ($site) {
		/////
		$form = sharedcore_site::linkForm($site);
		$form->meta('module','SharedCoreModule');
		if (isset($site->id)) {
			$form->meta('action','save_extensions'); // Save without db conf if edit
		} else {
			// Need to go through initial db config for new sites.
			$form->meta('action','edit_site_dbconf');
		}
		
		$form->meta('core_id',$site->core_id);
		$form->meta('name',$site->name);
		$form->meta('path',$site->path);
		$form->meta('relpath',$site->relpath);
		
		$template = new template('SharedCoreModule','_form_editModules');
		$template->assign('form_html',$form->toHTML());
		$template->output();
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>