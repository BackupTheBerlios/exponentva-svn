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
# $Id: translation_dictentry.php,v 1.2 2005/04/25 19:02:17 filetreefrog Exp $
##################################################

class translation_dictentry {
	function form($object) {
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		pathos_forms_initialize();
		
		$form = new form();
		if (!isset($object->id)) {
			$object->value = '';
		} else {
			$form->meta('id',$object->id);
		}
		
		$form->meta('lang_id',$object->lang_id);
		$form->meta('constant',$object->constant);
		$form->meta('dictionary',$object->dictionary);
		$form->register('value','',new texteditorcontrol($object->value,10,40));
		$form->register('submit','',new buttongroupcontrol('Save','','Cancel'));
		return $form;
	}
	
	function update($values,$object) {
		$object->lang_id = $values['lang_id'];
		$object->dictionary = $values['dictionary'];
		$object->constant = $values['constant'];
		$object->value = str_replace(array('\r','\n'),'',$values['value']);
		return $object;
	}
}

?>