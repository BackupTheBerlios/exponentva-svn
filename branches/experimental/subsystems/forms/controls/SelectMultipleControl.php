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
 * Select Multiple Control
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
 * Select Multiple Control
 *
 * @package Subsystems
 * @subpackage Forms
 */
class SelectMultipleControl extends formcontrol {
	var $items = array();
	var $size = 1;
	var $jsHooks = array();
	
	function name() { return "Multiple Selections List"; }
	function isSimpleControl() { return true; }
	function getFieldDefinition() {
		return array(
			DB_FIELD_TYPE=>DB_DEF_STRING,
			DB_FIELD_LEN=>255);
	}
	
	function SelectMultipleControl($default = array(),$items = array()) {
		$this->default = $default;
		$this->items = $items;
		$this->required = false;
	}
	
	function controlToHTML($name) {
		//it took me AGES to find out that the [] in the name are required, to be able to retrieve multiple options
		$html = '<select id="' . $name . '[]" name="' . $name . '[]" multiple="multiple"';
		if ($this->disabled) $html .= ' disabled="disabled"';
		if ($this->tabindex >= 0) $html .= ' tabindex="' . $this->tabindex . '"';
		foreach ($this->jsHooks as $hook=>$action) {
			$html .= " $hook=\"$action\"";
		}
		if ($this->required) {
			$html .= 'required="'.rawurlencode($this->default).'" caption="'.rawurlencode($this->caption).'" ';
		}
		$html .= '>';
		foreach ($this->items as $value=>$caption) {
			$html .= '<option value="' . $value . '"';
			foreach($this->default as $curr_default){
				if ($value == $curr_default) {
					$html .= ' selected="selected"';
				}
			}
			$html .= '>' . $caption . '</option>';
		}
		$html .= '</select>';
		return $html;
	}
	
	function parseData($formvalues, $name, $forceindex = false) {
		$values = array();
		if ($formvalues[$name] == "") return array();
		foreach (explode("|!|",$formvalues[$name]) as $value) {
			if ($value != "") {
				if (!$forceindex) {
					$values[] = $value;
				}
				else {
					$values[$value] = $value;
				}
			}
		}
		return $values;
	}
	
	function form($object) {
		if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
		exponent_forms_initialize();
	
		$form = new form();
		if (!isset($object->identifier)) {
			$object->identifier = "";
			$object->caption = "";
			$object->default = array();
			$object->size = 1;
			$object->items = array();
		} 
		
		$i18n = exponent_lang_loadFile('subsystems/forms/controls/SelectMultipleControl.php');
		
		$form->register("identifier",$i18n['identifier'],new textcontrol($object->identifier));
		$form->register("caption",$i18n['caption'], new textcontrol($object->caption));
		$form->register("items",$i18n['items'], new listbuildercontrol($object->items,null));
		$form->register("default",$i18n['default'], new textcontrol($object->default));
		$form->register("size",$i18n['size'], new textcontrol($object->size,3,false,2,"integer"));
		$form->register("required",$i18n['required'], new checkboxcontrol(@$object->required,false)); 
		
		$form->register("submit","",new buttongroupcontrol($i18n['save'],'',$i18n['cancel']));
		
		return $form;
	}
	
	function update($values, $object) {
		if ($values['identifier'] == "") {
			$post = $_POST;
			$i18n = exponent_lang_loadFile('subsystems/forms/controls/SelectMultipleControl.php');
			$post['_formError'] = $i18n['id_req'];
			exponent_sessions_set("last_POST",$post);
			return null;
		}
		if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
		exponent_forms_initialize();
		if ($object == null) $object = new SelectMultipleControl();
		$object->identifier = $values['identifier'];
		$object->caption = $values['caption'];
		$object->default = $values['default'];
		$object->items = SelectMultipleControl::parseData($values,'items',true);
		$object->size = (intval($values['size']) <= 0)?1:intval($values['size']);
		$object->required = isset($values['required']);
		return $object;
	}
}

?>
