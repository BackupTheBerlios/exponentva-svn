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
 * Popup Date/Time Picker Control
 *
 * @author James Hunt
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
 * Popup Date/Time Picker Control
 *
 * @package Subsystems
 * @subpackage Forms
 */
class PopupDateTimeControl extends formcontrol {
	var $disable_text = "";
	var $showtime = true;

	function name() { return "Popup Date/Time Selector"; }
	function isSimpleControl() { return true; }
	function getFieldDefinition() {
		return array(
			DB_FIELD_TYPE=>DB_DEF_TIMESTAMP);
	}

	function PopupDateTimeControl($default = null, $disable_text = "",$showtime = true) {
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
	
	function controlToHTML($name) {
		ob_start();

		if ($this->default == 0) {
			$this->default = time();
		}
		$imgsrc = PATH_RELATIVE."external/jscalendar/img.gif";
		if (is_readable(THEME_ABSOLUTE."icons/calendar_trigger.gif")) {
			$imgsrc = THEME_RELATIVE."icons/calendar_trigger.gif";
		}
		
		if (is_readable(THEME_ABSOLUTE."css/PopupDateTimeControl.css")) {
			echo '<style type="text/css"> @import url('.THEME_RELATIVE.'subsystems/forms/controls/PopupDateTimeControl/css/Default.css);</style>';
		} else {
			echo '<style type="text/css"> @import url('.PATH_RELATIVE.'subsystems/forms/controls/PopupDateTimeControl/css/Default.css);</style>';
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
		echo 'title="Date selector" onclick="initPopupDateTimeControl_' . $name . '();" class="highlight_on_hover"/>';

		if ($this->disable_text != "") {// PopupDateTimeControl_enable(this.form,\''.$name.'\');
			echo '<input align="texttop" style="margin-top: -2px;" type="checkbox" name="'.$name.'_disabled" onChange="PopupDateTimeControl_enable(this.form,\''.$name.'\');" onClick="PopupDateTimeControl_enable(this.form,\''.$name.'\');" ';
			if ($this->disabled) {
				echo ' checked="checked"';
			}
			echo '/>'.$this->disable_text;
		} else {
		#	$html .= '<input type="hidden" name="'.$name.'_enabled" value="1" />';
		}
?>
	<script type="text/javascript">
		
		Exponent.includeOnce("jscalendar1", "<?PHP echo PATH_RELATIVE ?>external/jscalendar/calendar.js");
		Exponent.includeOnce("jscalendar2", "<?PHP echo PATH_RELATIVE ?>external/jscalendar/lang/calendar-<?PHP echo LANG ?>.js");
		Exponent.includeOnce("jscalendar3", "<?PHP echo PATH_RELATIVE ?>external/jscalendar/calendar-setup.js");
		Exponent.includeOnce("PopupDateTimeControl", "<?PHP echo PATH_RELATIVE ?>subsystems/forms/controls/PopupDateTimeControl/js/Default.js");
		
		function initPopupDateTimeControl<?PHP echo "_" . $name;?>() {
			Calendar.setup({
				inputField			:    "<?PHP echo $name; ?>_hidden",
				ifFormat			:    "%m/%d/%Y %H:%M",
				displayArea			:    "<?PHP echo $name; ?>_span",
				<?PHP if ($this->showtime) { ?>
					daFormat		:    "%A, %B %d, %Y %l:%M %P",
					showsTime		:    true,
					singleClick		:    false,
				<?PHP } else {?>
					daFormat		:    "%A, %B %d, %Y",
					singleClick		:    true,
				<?PHP } ?>
				timeFormat			:	"<?PHP echo exponent_datetime_getHourFormat(); ?>",
				button				:	"<?PHP echo $name; ?>_trigger",
				align				:	"Tl",
				//TODO: write proper timezone handling for Exponent
				date				:	new Date(<?PHP echo $this->default * 1000;?> + (new Date().getTimezoneOffset() * 60 * 1000)),
				step				:	1,
				firstDay			:	<?PHP echo DISPLAY_WEEKS_START_ON?>
			})		
		}
		
		Exponent.register('initPopupDateTimeControl<?PHP echo "_" . $name;?>()');

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
		exponent_forms_initialize();
	
		$form = new form();
		if (!isset($object->identifier)) {
			$object->identifier = "";
			$object->caption = "";
			$object->showtime = true;
		} 
		
		$i18n = exponent_lang_loadFile('subsystems/forms/controls/PopupDateTimeControl.php');
		
		$form->register("identifier",$i18n['identifier'],new textcontrol($object->identifier));
		$form->register("caption",$i18n['caption'], new textcontrol($object->caption));
		$form->register("showtime",$i18n['showtime'], new checkboxcontrol($object->showtime,false));
		
		$form->register("submit","",new buttongroupcontrol($i18n['save'],"",$i18n['cancel']));
		return $form;
	}
	
	function update($values, $object) {
		if ($object == null) {
			$object = new PopupDateTimeControl();
			$object->default = 0;
		}
		if ($values['identifier'] == "") {
			$i18n = exponent_lang_loadFile('subsystems/forms/controls/PopupDateTimeControl.php');
			$post = $_POST;
			$post['_formError'] = $i18n['id_req'];
			exponent_sessions_set("last_POST",$post);
			return null;
		}
		$object->identifier = $values['identifier'];
		$object->caption = $values['caption'];
		$object->showtime = isset($values['showtime']);
		return $object;
	}
	
}

?>