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
# $Id: save_contact.php,v 1.6 2005/02/19 00:32:31 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$contact = null;
if (isset($_POST['id'])) {
	$contact = $db->selectObject('contact_contact','id='.$_POST['id']);
	if ($contact) $loc = unserialize($contact->location_data);
}

if (pathos_permissions_check('configure',$loc)) {
	$contact = contact_contact::update($_POST,$contact);
	$contact->location_data = serialize($loc);
	
	if (isset($contact->id)) {
		$db->updateObject($contact,'contact_contact');
	} else {
		$db->insertObject($contact,'contact_contact');
	}
	pathos_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>