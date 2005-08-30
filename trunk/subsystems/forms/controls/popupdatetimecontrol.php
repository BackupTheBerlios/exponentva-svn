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
# $Id: popupdatetimecontrol.php,v 1.8 2005/04/18 15:47:58 filetreefrog Exp $
# MaxxCorp
##################################################

if (!defined('PATHOS')) exit('');

/**
 * Popup Date/Time Picker Control
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
 * Popup Date/Time Picker Control
 *
 * @package Subsystems
 * @subpackage Forms
 */
class popupdatetimecontrol extends formcontrol {
	var $disable_text = "";
	var $showtime = true;

	function name() { return "Popup Date/Time Selector"; }
	function isSimpleControl() { return true; }
	function getFieldDefinition() {
		return array(
			DB_FIELD_TYPE=>DB_DEF_TIMESTAMP);
	}

	function popupdatetimecontrol($default = null, $disable_text = "",$showtime = true) {
		$this->disable_text = $disable_text;
		$this->default = $default;
		$this->showtime = $showtime;
		
		if ($this->default == null) {
			if ($this->disable_text == "") $this->default = time();
			else $this->disabled = true;
		}
		elseif ($this->default == 0) {
			$this->default = time();
		}
	}

	function onRegister(&$form) {
		$form->addScript("popupdatetimecontrol",PATH_RELATIVE."js/PopupDateTimeControl.js");
	}
	
	function controlToHTML($name) {
		ob_start();

		if ($this->default == 0) {
			$this->default = time();
		}
		$imgsrc = PATH_RELATIVE."external/jscalendar/img.gif";
		if (is_readable(THEME_BASE."icons/calendar_trigger.gif")) {
			$imgsrc = THEME_RELATIVE."icons/calendar_trigger.gif";
		}
		
		if (is_readable(THEME_BASE."css/popupdatetimecontrol.css")) {
			echo '<style type="text/css"> @import url('.THEME_RELATIVE.'css/popupdatetimecontrol.css);</style>';
		} else {
			echo '<style type="text/css"> @import url('.PATH_RELATIVE.'css/popupdatetimecontrol.css);</style>';
		}
		
		$default = "";
		if ($this->default == null) {
			$this->default = time;
		}
		$default = strftime("%m/%d/%Y %H:%M",$this->default);
		
		echo '<input type="hidden" name="' . $name . '_hidden" id="' . $name . '_hidden" value="' . $default . '" />';
		echo '<span class="';
 
		if ($this->disabled) {
			echo 'datefield_disabled';
		} else {
			echo 'datefield';
		}
		echo '" id="' . $name . '_span">';
		
		
		if ($this->default == null) {
			echo '&lt;No Date Selected&gt;';
		} else {
			if ($this->showtime) {
				echo strftime("%A, %B %d, %Y %l:%M %P",$this->default);	
			} else {
				echo strftime("%A, %B %d, %Y",$this->default);
			}
		}

		echo '</span>';

		echo '<img align="texttop" src="'.$imgsrc.'" id="'.$name.'_trigger" ';
		if ($this->disabled) {
			echo 'style="visibility: hidden;" ';
		} else {
			echo 'style="cursor: pointer;" ';
		}
		echo 'title="Date selector" onclick="initPopupDateTimeControl_' . $name . '();" onmouseover="this.style.background=\'red\';" onmouseout="this.style.background=\'\'" />';

		if ($this->disable_text != "") {// popupdatetimecontrol_enable(this.form,\''.$name.'\');
			echo '<input align="texttop" style="margin-top: -2px;" type="checkbox" name="'.$name.'_disabled" onChange="popupdatetimecontrol_enable(this.form,\''.$name.'\');" onClick="popupdatetimecontrol_enable(this.form,\''.$name.'\');" ';
			if ($this->disabled) {
				echo ' checked';
			}
			echo '/>'.$this->disable_text;
		} else {
		#	$html .= '<input type="hidden" name="'.$name.'_enabled" value="1" />';
		}
?>
	<script type="text/javascript">
		
		pathosJSIncludeOnce("jscalendar1", "<?PHP echo PATH_RELATIVE ?>external/jscalendar/calendar.js");
		pathosJSIncludeOnce("jscalendar2", "<?PHP echo PATH_RELATIVE ?>external/jscalendar/lang/calendar-<?PHP echo LANG ?>.js");
		pathosJSIncludeOnce("jscalendar3", "<?PHP echo PATH_RELATIVE ?>external/jscalendar/calendar-setup.js");
		
		
		function initPopupDateTimeControl<?PHP echo "_" . $name;?>() {
			Calendar.setup({
				inputField			:    "<?PHP echo $name ?>_hidden",
				ifFormat			:    "%m/%d/%Y %H:%M",
				displayArea			:    "<?PHP echo $name ?>_span",
				<?PHP if ($this->showtime) { ?>
					daFormat		:    "%A, %B %d, %Y %l:%M %P",
					showsTime		:    true,
					singleClick		:    false,
				<?PHP } else {?>
					daFormat		:    "%A, %B %d, %Y",
					singleClick		:    true,
				<?PHP } ?>
				timeFormat			:	"24",
				button				:	"<?PHP echo $name ?>_trigger",
				align				:	"Tl",
				//TODO: write proper timezone handling for Exponent
				date				:	new Date(<?PHP echo $this->default * 1000;?> + (new Date().getTimezoneOffset() * 60 * 1000)),
				step				:	1,
				firstDay			:	<?PHP echo DISPLAY_WEEKS_STARTON?>
			})		
		}
		
		pathosJSregister(initPopupDateTimeControl<?PHP echo "_" . $name;?>);

	</script>
<?PHP
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
	
	function parseData($original_name,$formvalues) {
		if (!isset($formvalues[$original_name.'_disabled'])) {
			return strtotime($formvalues[$original_name.'_hidden']);
			//return $formvalues[$original_name.'_hidden'];
		} else return 0;
	}
	
	function templateFormat($db_data, $ctl) {
		if ($ctl->showtime) {
			return strftime(DISPLAY_DATETIME_FORMAT,$db_data);
		} 
		else {
			return strftime(DISPLAY_DATE_FORMAT, $db_data);
		}
	}
	
	
	function form($object) {
		if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
		pathos_forms_initialize();
	
		$form = new form();
		if (!isset($object->identifier)) {
			$object->identifier = "";
			$object->caption = "";
			$object->showtime = true;
		} 
		pathos_lang_loadDictionary('standard','formcontrols');
		pathos_lang_loadDictionary('standard','core');
		
		$form->register("identifier",TR_FORMCONTROLS_IDENTIFIER,new textcontrol($object->identifier));
		$form->register("caption",TR_FORMCONTROLS_CAPTION, new textcontrol($object->caption));
		$form->register("showtime",TR_FORMCONTROLS_SHOWTIME, new checkboxcontrol($object->showtime,false));
		
		$form->register("submit","",new buttongroupcontrol(TR_CORE_SAVE,"",TR_CORE_CANCEL));
		
		return $form;
	}
	
	function update($values, $object) {
		if ($object == null) {
			$object = new popupdatetimecontrol();
			$object->default = 0;
		}
		if ($values['identifier'] == "") {
			pathos_lang_loadDictionary('standard','formcontrols');
			$post = $_POST;
			$post['_formError'] = TR_FORMCONTROLS_IDENTIFIER_REQUIRED;
			pathos_sessions_set("last_POST",$post);
			return null;
		}
		$object->identifier = $values['identifier'];
		$object->caption = $values['caption'];
		$object->showtime = isset($values['showtime']);
		return $object;
	}
	
}

?>