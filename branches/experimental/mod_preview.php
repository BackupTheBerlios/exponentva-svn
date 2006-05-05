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

define('SCRIPT_EXP_RELATIVE','');
define('SCRIPT_FILENAME','mod_preview.php');

// Initialize the Exponent Framework
include_once('exponent.php');

$i18n = exponent_lang_loadFile('mod_preview.php');

$SYS_FLOW_REDIRECTIONPATH='previewreadonly';

$previewFile = exponent_core_resolveFilePaths("", "", "", "module_preview.php");
if ($previewFile != false) {
	include_once(array_shift($previewFile));
} else {
	echo $i18n['no_preview'];
}

?>