<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
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
# $Id: addressextension.php,v 1.7 2005/02/26 05:21:24 filetreefrog Exp $
##################################################

class addressextension {
	function name() { return "Address Extension"; }
	function author() { return "James Hunt"; }
	function description() { return "Stores an address for the user."; }

	function modifyForm($form,$user) { // new if !isset($user->id)
	
		pathos_lang_loadDictionary('extras','addressextension');
	
		if (!isset($user->user_address) || $user->user_address == null) {
			$user->user_address = addressextension::_blankAddress();
		}
		$form->register(null,"",new htmlcontrol('<hr size="1" /><b>'.TR_X_ADDRESSEXTENSION_HEADER.'</b>'));
		$form->register("address1",TR_X_ADDRESSEXTENSION_ADDRESS, new textcontrol($user->user_address->address1));
		$form->register("address2",TR_X_ADDRESSEXTENSION_ADDRESS2, new textcontrol($user->user_address->address2));
		$form->register("city",TR_X_ADDRESSEXTENSION_CITY, new textcontrol($user->user_address->city));
		$form->register("state",TR_X_ADDRESSEXTENSION_STATE, new textcontrol($user->user_address->state));
		$form->register("zip",TR_X_ADDRESSEXTENSION_ZIPCODE, new textcontrol($user->user_address->zip));
		$form->register("country",TR_X_ADDRESSEXTENSION_COUNTRY, new textcontrol($user->user_address->country));
		
		return $form;
	}
	
	function saveProfile($values,$user,$is_new) {
		global $db;
		$db->delete("user_address","uid=".$user->id);
		
		$address = null;
		$address->uid = $user->id;
		$address->address1 = $values['address1'];
		$address->address2 = $values['address2'];
		$address->city = $values['city'];
		$address->state = $values['state'];
		$address->zip = $values['zip'];
		$address->country = $values['country'];
		
		$db->insertObject($address,"user_address");
		
		$user->user_address = $address;
		unset($user->user_address->uid);
		return $user;
	}
	
	function getProfile($user) {
		global $db;
		if (!isset($user->id)) {
			$user->user_address = addressextension::_blankAddress();
		} else {
			$user->user_address = $db->selectObject("user_address","uid=".$user->id);
		}
		return $user;
	}
	
	function cleanup($user) {
		global $db;
		$db->delete("user_address","uid=".$user->id);
	}
	
	function clear() {
		global $db;
		$db->delete("user_address");
	}
	
	function hasData() {
		global $db;
		return ($db->countObjects("user_address") != 0);
	}
	
	function _blankAddress() {
		$address = null;
		$address->address1 = "";
		$address->address2 = "";
		$address->city = "";
		$address->state = "";
		$address->zip = "";
		$address->country = "";
		return $address;
	}
}

?>