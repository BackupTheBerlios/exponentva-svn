<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
# All Changes as of 6/1/05 Copyright 2005 James Hunt
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
# $Id: edit_report.php,v 1.3 2005/11/22 01:16:07 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

$f = null;
$rept = null;
if (isset($_GET['id'])) {
	$f = $db->selectObject('formbuilder_form','id='.intval($_GET['id']));
}

if ($f) {
	if (pathos_permissions_check('editreport',unserialize($f->location_data))) {
		$floc = unserialize($f->location_data);
		$rept = $db->selectObject('formbuilder_report','form_id='.$f->id);
	
		$form = formbuilder_report::form($rept);
		$form->location($loc);
		$form->meta('action','save_report');
		$form->meta('id',$rept->id);
		$form->meta('m',$floc->mod);
		$form->meta('s',$floc->src);
		$form->meta('i',$floc->int);
		echo $form->toHTML();
		
	} else {
		echo SITE_403_HTML;
	}
} else {
	echo SITE_404_HTML;
}

?>