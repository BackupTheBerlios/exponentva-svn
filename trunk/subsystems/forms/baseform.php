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
# $Id: baseform.php,v 1.3 2005/02/19 00:35:55 filetreefrog Exp $
##################################################

/**
 * Base Form Class
 *
 * The basic form
 *
 * @author James Hunt
 * @copyright 2004 James Hunt and the OIC Group, Inc.
 * @version 0.95
 *
 * @package Subsystems
 * @subpackage Forms
 */

/**
 * baseform class
 *
 * @package Subsystems
 * @subpackage Forms
 */
class baseform {
	var $meta    = array();
	var $scripts = array();
	
	var $name    = "form";
	var $method  = "post";
	var $action  = "";
	var $enctype = "";

	function baseform() {
		$this->action = SCRIPT_RELATIVE.SCRIPT_FILENAME;
	}

	function meta($name,$value) {
		if (!is_array($value)) {
			$this->meta[$name] = $value;
		} else {
			foreach ($value as $key=>$val) {
				$this->meta($name."[".$key."]",$val);
			}
		}
		return true;
	}
	
	function location($loc) {
		$this->meta["module"] = $loc->mod;
		$this->meta["src"] = $loc->src;
		$this->meta["int"] = $loc->int;
		return true;
	}
	
	/*
	 * Adds a javascript to the form.
	 * 
	 * This may be used for validation, dynamic controls, etc.
	 *
	 * @param string $name The internal name to reference the script.  This is used
	 *     by the Form object for removing the script later (if desired)
	 * @param string $script The path to the script file, relative  to the BASE of the site.
	 * @return boolean Returns true if a script with the specified internal name
	 *     does not already exist, and the new one was added, or false if not.
	 */
	function addScript($name,$script) {
		if (!isset($this->scripts[$name])) {
			$this->scripts[$name] = $script;
			return true;
		} else return false;
	}
	
	/*
	 * Removes a javascript from the form.
	 *
	 * @param string $name The internal name of the script to remove.  This was
	 *      specified by the addScript() method, and is only used by the Form object.
	 * @return boolean Returns true if the script was successfully  removed.  In
	 *     practice, this method always returns true.
	 */
	function removeScript($name) {
		if (isset($this->scripts[$name])) unset($this->scripts[$name]);
		return true;
	}
	
	function toHTML() {
		return "";
	}
}

?>
