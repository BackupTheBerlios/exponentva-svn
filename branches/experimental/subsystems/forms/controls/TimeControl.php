<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Copyright (c) 2005-2006 Maxim Mueller
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

/**
 * Time Control
 *
 * @author Maxim Mueller
 * @copyright 2005 Maxim Mueller
 * @version 0.97
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
 * Time Control
 *
 * @package Subsystems
 * @subpackage Forms
 */
class TimeControl extends formcontrol {
	var $showControl = true;
	
	function name() {
		return "Time Widget";
	}
	
	function isSimpleControl() {
		return true;
	}
	
	function getFieldDefinition() {
		return array(
			DB_FIELD_TYPE=>DB_DEF_TIMESTAMP);
	}
	
	/**
	 * constructor
	 * 
	 * Parameters:
	 * $default -> intitialize with this unix timestamp
	 * $showControl -> indicate whether this control should be displayed or hidden 
	 * 
	 */ 
	function TimeControl($default = 0, $showControl = true) {
		if (!defined("SYS_DATETIME")) {
			require_once(BASE."subsystems/datetime.php");
		}
		
		if ($default == 0) {
			$default = time();
		}
		
		$this->default = $default;
		//get only the time part of the timestamp
		$myDate = getdate($this->default);
		$this->default = $myDate["hours"] * 60 * 60 + $myDate["minutes"] * 60;
	
		
		$this->showControl = $showControl;
	}

	function toHTML($label,$name) {
		return parent::toHTML($label,$name);
	}
	
	//TODO: Full MVC
	function controlToHTML($name) {
		// initialize the time if none was set on instantiation
		if ($this->default == 0) {
			$this->default = time();
		}			
		//get only the time part of the timestamp
		$myDate = getdate($this->default);
		$this->default = $myDate["hours"] * 60 * 60 + $myDate["minutes"] * 60;
	
		
		$template = new ControlTemplate("TimeControl");
		$template->assign('name', $name);
		$template->assign('timestamp', $this->default);
		$template->assign('hourformat', exponent_datetime_getHourFormat());
		$template->assign('showcontrol', $this->showControl ? "true" : "false");
		
		return $template->render();
	}
	
	function onRegister(&$form) {
	}
	
	function parseData($original_name,$formvalues,$for_db = false) {
		$time = 0;		
		if (isset($formvalues[$original_name . "_timestamp"])) {
			$time = $formvalues[$original_name . '_timestamp'];
		}
		
		return $time;
	}
	
	function templateFormat($db_data, $ctl) {
		return strftime(DISPLAY_TIME_FORMAT, $db_data);
	}
	
	function form($object) {
		if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
		exponent_forms_initialize();
	
		$form = new form();
		if (!isset($object->identifier)) {
			$object->identifier = "";
			$object->caption = "";
			$object->showControl = true;
		} 
		
		$i18n = exponent_lang_loadFile('subsystems/forms/controls/TimeControl.php');
		
		$form->register("identifier",$i18n['identifier'],new textcontrol($object->identifier));
		$form->register("caption",$i18n['caption'], new textcontrol($object->caption));
		$form->register("showControl",$i18n['show_control'], new checkboxcontrol($object->showControl,false));
		
		$form->register("submit","",new buttongroupcontrol($i18n['save'],"",$i18n['cancel']));
		
		return $form;
	}
	
	function update($values, $object) {
		if ($object == null) { 
			$object = new TimeControl();
			$object->default = 0; //This will force the control to always show the current time as default
		}
		if ($values['identifier'] == "") {
			$i18n = exponent_lang_loadFile('subsystems/forms/controls/TimeControl.php');
			$post = $_POST;
			$post['_formError'] = $i18n['id_req'];
			exponent_sessions_set("last_POST",$post);
			return null;
		}
		$object->identifier = $values['identifier'];
		$object->caption = $values['caption'];
		$object->showControl = isset($values['showControl']);
		return $object;
	}
}

?>
