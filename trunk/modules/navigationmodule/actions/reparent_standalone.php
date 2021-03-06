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
# $Id: reparent_standalone.php,v 1.2 2005/02/19 00:32:34 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

if ($user && $user->is_acting_admin == 1) {
	$standalone = $db->selectObject('section','parent=-1 AND id='.$_POST['page']);
	if ($standalone) {
		$standalone->parent = $_POST['parent'];
		$standalone->rank = $_POST['rank'];
		$db->increment('section','rank',1,'parent='.$standalone->parent.' AND rank >= '.$standalone->rank);
		$db->updateObject($standalone,'section');
		pathos_flow_redirect();
	} else {
		echo SITE_404_HTML;
	}
} else {
	echo SITE_403_HTML;
}

?>