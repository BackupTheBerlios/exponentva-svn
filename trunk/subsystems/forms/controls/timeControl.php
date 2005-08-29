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
# $Id: timeControl.php,v 1.0 2005/08/27 MaxxCorp Exp $
# based on the datetimecontrol class by Greg Otte, James Hunt
##################################################

if (!defined('PATHOS')) exit('');

/**
 * Time Control
 *
 * @author MaxxCorp
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
class timeControl extends formcontrol {
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
	function timeControl($default = 0, $showControl = true) {
		if (!defined("SYS_DATETIME")) {
			require_once(BASE."subsystems/datetime.php");
		}
		
		if ($default == 0) {
			$default = time();
		}
		
		$this->default = $default;
		$this->showControl = $showControl;
	}

	function toHTML($label,$name) {
		return parent::toHTML($label,$name);
	}
	
	function controlToHTML($name) {
		// initialize the time if none was set on instantiation
		if ($this->default == 0) {
			$this->default = time();
		} else {			
			//get only the time part of the timestamp
			$myDate = getdate($this->default);
			$this->default = $myDate["hours"] * 60 * 60 + $myDate["minutes"] * 60;
		}
		
		
		ob_start();
			
			if (is_readable(THEME_ABSOLUTE."css/timeControl.css")) {
				echo '<style type="text/css"> @import url('.THEME_RELATIVE.'css/timeControl.css);</style>';
			} else {
				echo '<style type="text/css"> @import url('.PATH_RELATIVE.'css/timeControl.css);</style>';
			}		
?>

<div class="timeControl" id='jscalendar<?PHP echo "_".$name; ?>'>
	<input type="hidden" id="<?PHP echo $name; ?>_timestamp" name="<?PHP echo $name; ?>_timestamp" value="<?PHP echo $this->default; ?>" />
	<script type="text/javascript">
		pathosJSIncludeOnce("jscalendar1", "<?PHP echo PATH_RELATIVE; ?>external/jscalendar/calendar.js");
		pathosJSIncludeOnce("jscalendar2", "<?PHP echo PATH_RELATIVE; ?>external/jscalendar/lang/calendar-<?PHP echo LANG; ?>.js");
		pathosJSIncludeOnce("jscalendar3", "<?PHP echo PATH_RELATIVE; ?>external/jscalendar/calendar-setup.js");
		
<?PHP		
		if (is_readable(THEME_ABSOLUTE."js/timeControl.js")) {
				echo "		pathosJSIncludeOnce('timeControl', '" . THEME_ABSOLUTE . "js/timeControl.js');";
			} else {
				echo "		pathosJSIncludeOnce('timeControl', '" .  PATH_RELATIVE . "js/timeControl.js');";
			}	
?>


		//callback from jscalendar
		function timeChanged<?PHP echo "_" . $name; ?>(calendar) {
			// PHP works with second instead of ms as basic time unit
			var timestamp =	(calendar.date.getHours() * 60 * 60
							+ calendar.date.getMinutes() * 60);
			


			myTimestamp = document.getElementById('<?PHP echo $name; ?>_timestamp');
	
			myTimestamp.setAttribute("value",timestamp);
			//};
		};
		
		function initTimeControl<?PHP echo "_" . $name; ?> (){
			Calendar.setup({
					flat			: 'jscalendar<?PHP echo "_" . $name; ?>', // unique ID of the calendars parent
					firstDay		: <?PHP echo DISPLAY_WEEKS_STARTON; ?>,
					//TODO: write proper timezone handling for Exponent
					date			: new Date(<?PHP echo $this->default * 1000;?> + (new Date(<?PHP echo $this->default * 1000;?>).getTimezoneOffset() * 60 * 1000)),
					weekNumbers		: false,
					showsTime		: true,
					timeFormat		: <?PHP echo pathos_datetime_hourFormat();?>,
					flatCallback	: timeChanged<?PHP echo "_" . $name; ?>			// our callback function
			});
		};
		
		function setInitState<?PHP echo "_" . $name; ?> () {
			//server-generated: is Timecontrol active(= is it no allday event) ?
			pathos_forms_switch_time("<?PHP echo $name; ?>", this.form, <?PHP echo ($this->showControl ? 'true' : 'false'); ?>);
		
		}
		
		
		pathosJSregister(initTimeControl<?PHP echo "_" . $name; ?>);
		pathosJSregister(setInitState<?PHP echo "_" . $name; ?>);
			
				
	</script>
</div>

<?PHP
			
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
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
		if ($ctl->showControl) {
			return strftime(DISPLAY_TIME_FORMAT, $db_data);
		}
		else {
			return "";
		}
	}
	
	function form($object) {
		if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
		pathos_forms_initialize();
	
		$form = new form();
		if (!isset($object->identifier)) {
			$object->identifier = "";
			$object->caption = "";
			$object->showControl = true;
		} 
		
		pathos_lang_loadDictionary('standard','formcontrols');
		pathos_lang_loadDictionary('standard','core');
		
		$form->register("identifier",TR_FORMCONTROLS_IDENTIFIER,new textcontrol($object->identifier));
		$form->register("caption",TR_FORMCONTROLS_CAPTION, new textcontrol($object->caption));
		$form->register("showControl",TR_FORMCONTROLS_SHOWCONTROL, new checkboxcontrol($object->showControl,false));
		
		$form->register("submit","",new buttongroupcontrol(TR_CORE_SAVE,"",TR_CORE_CANCEL));
		
		return $form;
	}
	
	function update($values, $object) {
		if ($object == null) { 
			$object = new timeControl();
			$object->default = 0; //This will force the control to always show the current time as default
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
		$object->showControl = isset($values['showControl']);
		return $object;
	}
}

?>
