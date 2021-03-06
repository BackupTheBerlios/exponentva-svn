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
# $Id: deps.php,v 1.7 2005/02/26 05:21:22 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

return array(
	's_autoloader'=>array(
		'name'=>'autoloader',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_core'=>array(
		'name'=>'core',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_config'=>array(
		'name'=>'config',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_database'=>array(
		'name'=>'database',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_flow'=>array(
		'name'=>'flow',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_forms'=>array(
		'name'=>'forms',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_files'=>array(
		'name'=>'files',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_info'=>array(
		'name'=>'info',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_image'=>array(
		'name'=>'image',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_lang'=>array(
		'name'=>'lang',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_modules'=>array(
		'name'=>'modules',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_permissions'=>array(
		'name'=>'permissions',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_template'=>array(
		'name'=>'template',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_theme'=>array(
		'name'=>'theme',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_sessions'=>array(
		'name'=>'sessions',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_sorting'=>array(
		'name'=>'sorting',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_users'=>array(
		'name'=>'users',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	's_workflow'=>array(
		'name'=>'workflow',
		'type'=>CORE_EXT_SUBSYSTEM,
		'comment'=>''
	),
	
	// Modules
	'm_administrationmodule'=>array(
		'name'=>'administrationmodule',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	'm_common'=>array(
		'name'=>'common',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	'm_workflow'=>array(
		'name'=>'workflow',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	'm_filemanager'=>array(
		'name'=>'filemanager',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	'm_info'=>array(
		'name'=>'info',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	
	't_portaltheme'=>array(
		'name'=>'portaltheme',
		'type'=>CORE_EXT_THEME,
		'comment'=>''
	)
);

?>
