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

if (!defined('EXPONENT')) exit('');

/**
 * Check Box Control
 *
 * An HTML checkbox
 *
 * @author James Hunt, Greg Otte
 * @copyright 2004-2006 OIC Group, Inc.
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
 * Check Box Control class
 *
 * An HTML checkbox
 *
 * @package Subsystems
 * @subpackage Forms
 */
class checkboxcontrol extends formcontrol {
	var $flip = false;
	var $jsHooks = array();
	
	function name() { return "Checkbox"; }
	function isSimpleControl() { return true; }
	
	function getFieldDefinition() { 
		return array(
			DB_FIELD_TYPE=>DB_DEF_BOOLEAN);
	}

	function checkboxcontrol($default = false,$flip = false) {
		$this->default = $default;
		$this->flip = $flip;
		$this->jsHooks = array();
	}
	
	function toHTML($label,$name) {
		if (!$this->flip) return parent::toHTML($label,$name);
		else {
			$html = "<tr><td valign=\"top\">&nbsp;</td><td style='padding-left: 5px;' valign=\"top\">";
			$html .= $this->controlToHTML($name);
			$html .= "&nbsp;$label</td></tr>";
			return $html;
		}
	}
	
	function controlToHTML($name) {
		$html = '<input type="checkbox" name="' . $name . '" value="1"';
		if ($this->default) $html .= ' checked="checked"';
		if ($this->tabindex >= 0) $html .= ' tabindex="' . $this->tabindex . '"';
		if ($this->accesskey != "") $html .= ' accesskey="' . $this->accesskey . '"';
		if ($this->disabled) $html .= ' disabled';
		foreach ($this->jsHooks as $type=>$val) {
			$html .= ' '.$type.'="'.$val.'"';
		}
		$html .= ' />';
		return $html;
	}
	
	function parseData($name, $values, $for_db = false) {
		return isset($values[$name])?1:0;
	}
	
	function templateFormat($db_data, $ctl) {
		return ($db_data==1)?"Yes":"No";
	}
	
	function form($object) {
		$i18n = exponent_lang_loadFile('subsystems/forms/controls/checkboxcontrol.php');
	
		if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
		exponent_forms_initialize();
	
		$form = new form();
		if (!isset($object->identifier)) {
			$object->identifier = "";
			$object->caption = "";
			$object->default = false;
			$object->flip = false;
		} 
		
		$form->register("identifier",$i18n['identifier'],new textcontrol($object->identifier));
		$form->register("caption",$i18n['caption'], new textcontrol($object->caption));
		$form->register("default",$i18n['default'], new checkboxcontrol($object->default,false));
		$form->register("flip",$i18n['caption_right'], new checkboxcontrol($object->flip,false));
		
		$form->register("submit","",new buttongroupcontrol($i18n['save'],'',$i18n['cancel']));
		
		return $form;
	}
	
	function update($values, $object) {
		if ($object == null) $object = new checkboxcontrol();
		if ($values['identifier'] == "") {
			$i18n = exponent_lang_loadFile('subsystems/forms/controls/checkboxcontrol.php');
		
			$post = $_POST;
			$post['_formError'] = $i18n['id_required'];
			exponent_sessions_set("last_POST",$post);
			return null;
		}
		$object->identifier = $values['identifier'];
		$object->caption = $values['caption'];
		$object->default = isset($values['default']);
		$object->flip = isset($values['flip']);
		return $object;
	}
	
}

?>
