<?php

##################################################
#
# Copyright (c) 2004-2005 OIC Group, Inc.
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

if (!defined('PATHOS')) exit('');

if (pathos_permissions_check('database',pathos_core_makeLocation('administrationmodule'))) {
	$page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : 'start');
	$exporter = (isset($_REQUEST['exporter']) ? $_REQUEST['exporter'] : '');
	$file = BASE.'modules/exporter/exporters/'.$exporter.'/'.$page.'.php';
	if ($exporter != '' && is_readable($file) && is_file($file)) {
		include($file);
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>