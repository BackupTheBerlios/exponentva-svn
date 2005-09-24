<?php

##################################################
#
# Copyright (c) 2004-2005 Maxim Mueller
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
# $Id: personalpageextension.php,v 1.0 2005/09/22 MaxxCorp Exp $
##################################################
class personalpage{
	public $uid;
	public $ppSectionId;
}


class personalpageextension {
	function name() {
		return "Personal Page Extension";
	}

	function author() {
		return "Maxim Mueller";
	}

	function description() {
		return "Don't use it, it's not ready yet! Creates a personal stand-alone page from a pageset.";
	}

	function modifyForm($form,$user) {
		global $db;

		$pagesets = array();
		foreach ($db->selectObjects('section_template','parent=0') as $pageset) {
			$pagesets[$pageset->id] = $pageset->name;
		}
		$pageset[0] = "None";

		$ppEntry = $db->selectObject("user_personalpage", "uid=" . $user->id);
		
		if (isset($ppEntry)){
			$ppactive = true;
		} else {
			$ppactive = false;
		}
	
		//TODO: warn user that choosing a new pageset involves loosing the old page
		//TODO: display pageset selection only if ppactive is true
		//TODO: display a link to the pp

	
		pathos_lang_loadDictionary('extras','personalpageextension');

		$form->register(null,"",new htmlcontrol('<hr size="1" /><b>'.TR_X_PERSONALPAGEEXTENSION_HEADER.'</b>'));
		$form->register("ppactive",TR_X_PERSONALPAGEEXTENSION_PPACTIVE, new checkboxcontrol($ppactive));
		$form->register("pppageset",TR_X_PERSONALPAGEEXTENSION_PAGESET, new dropdowncontrol(0, $pagesets));
				
		return $form;
	}
	
	function saveProfile($values,$user,$is_new) {
		global $db;
		
		
		if ($values["ppactive"]){
			

			//TODO: create new PP with the given pageset if no pre-existant PP or pageset has changed
			//TODO: set the appropriate permissions
			//TODO: discover where $is_new is generated and what it contains

			if (isset($user->ppSectionId) and ($ppEntry->ppPageset != $values['pppageset'] )){
				deletePP($user->ppSectionId);
			}
			
			$personalpage = new personalpage;
			
			$personalpage->uid = $user->id;
			$personalpage->ppSectionId = "someId";

			$db->insertObject($personalpage, "user_personalpage");

			$user->ppSectionId = $personalpage->ppSectionId;

		} else  {
			if (isset($user->ppSectionId)){
				deletePP($user->ppSectionId);
				unset($user->ppSectionId);
			}
		}
		
		
		return $user;
	}
	
	function getProfile($user) {
		global $db;

		$ppEntry = $db->selectObject("user_personalpage", "uid=" . $user->id);
		$user->ppSectionId = $ppEntry->ppSectionId;
		return $user;
	}
	
	function cleanup($user) {
		global $db;
		
		deletePP($user->ppSectionId);
	}
	
	function clear() {
		global $db;
		$db->delete("user_personalpage");
	}
	
	function hasData() {
		global $db;
		return ($db->countObjects("user_personalpage") != 0);
	}
	
	function deletePP($ppSectionId){
		global $db;
		
		$db->delete("section", "id=" . $ppSectionId);
		$db->delete("user_personalpage","ppSectionId=" . $ppSectionId);
	}
	
}

?>