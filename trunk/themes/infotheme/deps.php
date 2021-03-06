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
# $Id: deps.php,v 1.6 2005/02/26 05:21:24 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

return array(
	'm_containermodule'=>array(
		'name'=>'containermodule',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	'm_navigationmodule'=>array(
		'name'=>'navigationmodule',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	'm_loginmodule'=>array(
		'name'=>'loginmodule',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	'm_previewmodule'=>array(
		'name'=>'previewmodule',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	),
	'm_textmodule'=>array(
		'name'=>'textmodule',
		'type'=>CORE_EXT_MODULE,
		'comment'=>''
	)
);

?>