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
# $Id: articlemodule_config.php,v 1.3 2005/04/25 19:02:15 filetreefrog Exp $
# 2005/09/24 MaxxCorp
##################################################

class articlemodule_config {
	function form($object) {
		global $db;
		
		pathos_lang_loadDictionary('standard','core');
		pathos_lang_loadDictionary('modules','modules');
		
		if (!defined('SYS_FORMS')){
			require_once(BASE.'subsystems/forms.php');
		}
		
		pathos_forms_initialize();
		
		$form = new form();
		if (!isset($object->id)) {
			//TODO: investigate whether it is possible to define
			//default values at a single, central point.
			//possibly supply a database table with default values
			$object->sortorder = 'ASC';
			$object->sortfield = 'rank';
			$object->item_limit = 10;
			
			$object->enable_categories = 0;
			$config->recalc = 0; // No need to recalculate, no categories
			
			//default is to show all categories
			//necessary beacause, although categories are off by default, the user might activate them
			//In Future Exponent serialization/deserialization should be handled in the db layer
			//serialize now to have consistent handling later
			$object->showCategories = serialize(array('-1'));
			
		} else {
			$form->meta('id',$object->id);
		}
		
		//list length, key & sortorder
		$opts  = array('ASC'=>TR_CORE_ASCENDING,'DESC'=>TR_CORE_DESCENDING);
		//get the names of the fields in this table
		$fields = $db->getDataDefinition("article");
		//add flexibility to prepare for later componentization
		$fieldsInclude = array("rank","id");
		$fieldsExclude = array();
		//turn the array into something usable for dropdowncontrol
		foreach(array_keys($fields) as $keyname){
			$fields[$keyname] = $keyname;
		}
		
		//hackish workaround for buggy(PHP5.1cvs 25.09.2005) array_key_exists()
		foreach(array_keys($fields) as $keyname){
			if (in_array($keyname, $fieldsExclude) or (!in_array($keyname, $fieldsInclude) and count($fieldsInclude) >= 1)) {
				unset($fields[$keyname]);
			}
		}

		
		$form->register('item_limit',TR_MODULES_ITEMLIMIT,new textcontrol($object->item_limit));
		$form->register('sortorder',TR_MODULES_SORTORDER, new dropdowncontrol($object->sortorder,$opts));
		$form->register('sortfield',TR_MODULES_SORTFIELD, new dropdowncontrol($object->sortfield,$fields));
				
		
		$form->register('enable_categories',TR_MODULES_ENABLECATS,new checkboxcontrol($object->enable_categories,true));
		
		
		//show only these categories
		//build list of currently defined categories
		$categorylist_noindex = $db->selectObjects("category", "location_data='" . $object->location_data . "'");
		$categorylist = array();
		//turn them into an assoziative array for use in the SelectMultipleControl
		foreach ($categorylist_noindex as $curr_category){
			$categorylist[strval($curr_category->id)] = $curr_category->name;
		}
		
		//add "All" and "Uncategorized" Items to the list
		$categorylist = array('-1'=>TR_CORE_ALL,'0'=>TR_CORE_UNCATEGORIZED) + $categorylist;
		
		//TODO: investigate whether serialization/deserialization should be handled in the db layer
		//TODO: add handling to dynamically Show/hide the control based on the enable_categories checkbox(maybe in the control itself)
		$form->register('showCategories',TR_MODULES_SHOWCATEGORIES, new SelectMultipleControl(unserialize($object->showCategories),$categorylist));
		
				
		$form->register('submit','',new buttongroupcontrol(TR_CORE_SAVE,'',TR_CORE_CANCEL));
		
		return $form;
	}
	
	function update($values,$object) {
		if ($values['item_limit'] > 0) {
			$object->item_limit = $values['item_limit'];
		} else {
			$object->item_limit = 10;
		}
		$object->sortorder = $values['sortorder'];
		$object->sortfield = $values['sortfield'];
		
		$object->enable_categories = isset($values['enable_categories']);
		// Change this later to do some better recalculation detection (more efficient)
		$object->recalc = 1;
		
		//we just need the ids of the categories
		$object->showCategories = serialize($values['showCategories']);
		
		return $object;
	}
}

?>