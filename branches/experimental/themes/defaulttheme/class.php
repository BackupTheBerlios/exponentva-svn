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

if (class_exists('defaulttheme')) return;

class defaulttheme {
	function name() { return "Default Theme"; }
	function author() { return "Shane Thomison"; }
	function description() { return "This is the default theme for Exponent."; }
}

?>