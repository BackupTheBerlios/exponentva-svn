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
# $Id: customcontrol.php,v 1.4 2005/04/18 15:20:45 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

/**
 * Custom Control
 *
 * @author James Hunt
 * @copyright 2004 James Hunt and the OIC Group, Inc.
 * @version 0.95
 *
 * @package Subsystems
 * @subpackage Forms
 */

/**
 * Manually include the class file for formcontrol, for PHP4
 * (This does not adversely affect PHP5)
 */
require_once(BASE."subsystems/forms/controls/formcontrol.php");

/**
 * Custom Control
 *
 * @package Subsystems
 * @subpackage Forms
 */
class customcontrol extends formcontrol {
	var $html;
	
	function name() { return "Custom Control"; }
	
	function parseData($name, $values, $for_db = false) {
		return;
	}
	function customcontrol($html = "") {
		$this->html = $html;
	}

	function controlToHTML($name) {
		return $this->html;
	}
}

?>
