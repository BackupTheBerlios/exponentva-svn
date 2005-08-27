<?php
##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc., Maxim Mueller
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
# $Id: htmleditorcontrol.php,v 1.6 2005/04/18 15:20:45 filetreefrog Exp $
# v 2.0 2005/08/23 MaxxCorp
##################################################

if (!defined('PATHOS')) exit('');

 
include_once(BASE."subsystems/forms/controls/formcontrol.php"); 
 
/** 
* HTML Editor Control 
* 
* @package Subsystems 
* @subpackage Forms 
*/
class htmleditorcontrol extends formcontrol { 
	var $module = ""; 


	function name() {
		return SITE_WYSIWYG_EDITOR;
	}


	function htmleditorcontrol($default="",$module = "",$rows = 20,$cols = 60) { 
		$this->default = $default; 
		$this->module = $module; // For looking up templates. 
	} 

	
	function controlToHTML($name) {
		
		$PATH_TO_INCs = BASE . "external/editors/";

		if(is_readable($PATH_TO_INCs . SITE_WYSIWYG_EDITOR . '.glue')){
			include($PATH_TO_INCs . SITE_WYSIWYG_EDITOR . '.glue');
			//TODO: handle fallback here
			return $html;
		}
		else {
			echo "Sorry, the " . SITE_WYSIWYG_EDITOR . " WYSIWYG Editor is not installed";
		}
	}


	function parseData($name, $values, $for_db = false) {
		$html = $values[$name];
		if (trim($html) == "<br />") $html = "";
		return $html;
	}

}
?>














