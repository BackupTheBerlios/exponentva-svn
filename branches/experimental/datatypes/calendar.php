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

class calendar {
	function form($object) {
		global $user;
		
		$i18n = exponent_lang_loadFile('datatypes/calendar.php');
	
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		exponent_forms_initialize();
		
		$form = new form();
		if (!isset($object->id)) {
			$object->title = '';
			$object->body = '';
			$object->eventdate = null;
			$object->eventdate->id = 0;
			$object->eventdate->date = time();
			$object->eventstart = time();
			$object->eventend = time()+3600;
			$object->is_allday = 0;
			$object->is_recurring = 0;
		} else {
			$form->meta('id',$object->id);
		}
		
		$form->addScript("switchControl" , exponent_core_abs2rel(array_shift(exponent_core_resolveFilePaths("forms", "", "js", "switchControl"))));
		
		$form->register('title',$i18n['title'],new textcontrol($object->title));
		$form->register('body',$i18n['body'],new htmleditorcontrol($object->body));
		
		$form->register(null,'', new htmlcontrol('<hr size="1" />'));
		
		if ($object->is_recurring == 1) {
			$form->register(null,'',new htmlcontrol($i18n['remove_warning'],false));
		}
		$form->register('eventdate',$i18n['eventdate'],new PopupDateTimeControl($object->eventdate->date,'',false));
		
		$cb = new checkboxcontrol($object->is_allday,true);
		#Warning: when the box returns true, we have to switch OFF the time controls
		$cb->jsHooks = array('onClick'=>'Exponent.Forms.switchControl(\'eventstart_TimeControl\', this.checked ? false : true); Exponent.Forms.switchControl(\'eventend_TimeControl\', this.checked ? false : true);');
		$form->register('is_allday',$i18n['is_allday'],$cb);
		
		#Warning: when the box returns true, we have to switch OFF the time controls
		$form->register('eventstart',$i18n['eventstart'],new TimeControl($object->eventstart, $object->is_allday ? false : true));
		$form->register('eventend',$i18n['eventend'],new TimeControl($object->eventend, $object->is_allday ? false : true));
		
		if (!isset($object->id)) {
			$customctl = file_get_contents(BASE.'modules/CalendarModule/form.part');
			$datectl = new PopupDateTimeControl($object->eventstart+365*86400,'',false);
			$customctl = str_replace('%%UNTILDATEPICKER%%',$datectl->controlToHTML('untildate'),$customctl);
			$form->register('recur',$i18n['recurrence'],new customcontrol($customctl));
		} else if ($object->is_recurring == 1) {
			// Edit applies to one or more...
			$template = new template('CalendarModule','_recur_dates');
			global $db;
			$eventdates = $db->selectObjects('eventdate','event_id='.$object->id);
			if (!defined('SYS_SORTING')) require_once(BASE.'subsystems/sorting.php');
			if (!function_exists('exponent_sorting_byDateAscending')) {
				function exponent_sorting_byDateAscending($a,$b) {
					return ($a->date > $b->date ? 1 : -1);
				}
			}
			//Pathos Compatibility::this is deprecated
			if (@defined(PATHOS)){
				if (!function_exists('pathos_sorting_byDateAscending')) {
					function pathos_sorting_byDateAscending($a,$b) {
						return exponent_sorting_byDateAscending($a,$b);
					}
				}
			}
			//End Pathos Compatibility
			usort($eventdates,'exponent_sorting_byDateAscending');
			if (isset($object->eventdate)) $template->assign('checked_date',$object->eventdate);
			$template->assign('dates',$eventdates);
			$form->register(null,'',new htmlcontrol('<hr size="1"/>'.$i18n['recurrence_warning']));
			$form->register(null,'',new htmlcontrol('<table cellspacing="0" cellpadding="2" width="100%">'.$template->render().'</table>'));
		
			$form->meta('date_id',$object->eventdate->id); // Will be 0 if we are creating.
		}
		
		$form->register('submit','',new buttongroupcontrol($i18n['save'],'',$i18n['cancel']));
		
		return $form;
	}
	
	function update($values,$object) {
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		exponent_forms_initialize();
		
		$object->title = $values['title'];
		
		$object->body = preg_replace('/<br ?\/>$/','',trim($values['body']));
		
		$object->is_allday = (isset($values['is_allday']) ? 1 : 0);
		
		$object->eventstart = TimeControl::parseData('eventstart',$values);
		$object->eventend = TimeControl::parseData('eventend',$values);
		
		if (!isset($object->id)) {
			global $user;
			$object->poster = $user->id;
			$object->posted = time();
		}
		
		return $object;
	}
}

?>