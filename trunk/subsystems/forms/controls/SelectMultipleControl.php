<?php

##################################################
#
# Copyright (c) 2005 Maxim Mueller
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
# SelectMultipleControl v1.0 18.10.2005 MaxxCorp, based on dropdowncontrol by filetreefrog
##################################################

if (!defined('PATHOS')) exit('');

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
	
	function form($object) {
		if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
		pathos_forms_initialize();
	
		$form = new form();
		if (!isset($object->identifier)) {
			$object->identifier = "";
			$object->caption = "";
			$object->default = array();
			$object->size = 1;
			$object->items = array();
		} 
		
		pathos_lang_loadDictionary('standard','formcontrols');
		pathos_lang_loadDictionary('standard','core');
		
		$form->register("identifier",TR_FORMCONTROLS_IDENTIFIER,new textcontrol($object->identifier));
		$form->register("caption",TR_FORMCONTROLS_CAPTION, new textcontrol($object->caption));
		$form->register("items",TR_FORMCONTROLS_ITEMS, new listbuildercontrol($object->items,null));
		$form->register("default",TR_FORMCONTROLS_DEFAULT, new textcontrol($object->default));
		$form->register("size",TR_FORMCONTROLS_SIZE, new textcontrol($object->size,3,false,2,"integer"));
		$form->register("required",TR_FORMCONTROLS_REQUIRED, new checkboxcontrol(@$object->required,false)); 
		
		$form->register("submit","",new buttongroupcontrol(TR_CORE_SAVE,'',TR_CORE_CANCEL));
		
		return $form;
	}
	
	function update($values, $object) {
		if ($values['identifier'] == "") {
			$post = $_POST;
			$post['_formError'] = "Identifier is required.";
			pathos_sessions_set("last_POST",$post);
			return null;
		}
		if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
		pathos_forms_initialize();
		if ($object == null) $object = new SelectMultipleControl();
		$object->identifier = $values['identifier'];
		$object->caption = $values['caption'];
		$object->default = $values['default'];
		$object->items = listbuildercontrol::parseData($values,'items',true);
		$object->size = (intval($values['size']) <= 0)?1:intval($values['size']);
		$object->required = isset($values['required']);
		return $object;
	}
}

?>
