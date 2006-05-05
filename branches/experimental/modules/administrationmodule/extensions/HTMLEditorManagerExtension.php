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

class HTMLEditorManagerExtension extends Extension {
	function __construct() {
		$i18n = exponent_lang_loadFile('modules/AdministrationModule/extensions/ToolbarDesignerExtension.php');
		
		// does not make sense yet, just for safe keeping
		return array(
			SITE_WYSIWYG_EDITOR=>array(
				'htmlarea_configs'=>array(
					'title'=>$i18n['toolbar_settings'],
					'module'=>'AdministrationModule',
					'action'=>'view'
				)
			)
		);
	}
}	
?>