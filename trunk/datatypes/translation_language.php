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
# $Id: translation_language.php,v 1.2 2005/04/25 19:02:17 filetreefrog Exp $
##################################################

class translation_language {
	function form($object) {
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		pathos_forms_initialize();
		
		$form = new form();
		if (!isset($object->id)) {
			$object->name = '';
			$object->lang = '';
			$object->charset = '';
			$object->author = '';
			$object->locale = '';
			$object->default_view = '';
		} else {
			$form->meta('id',$object->id);
		}
		
		$form->register('name','Name',new textcontrol($object->name));
		$form->register('author','Author(s)',new textcontrol($object->author));
		$form->register('lang','Lang Code',new textcontrol($object->lang,5));
		$form->register('charset','Character Set',new textcontrol($object->charset,15));
		$form->register('locale','Locale',new textcontrol($object->locale));
		$form->register('default_view','Default View Name',new textcontrol($object->default_view));
		
		$form->register('submit','',new buttongroupcontrol('Save','','Cancel'));
		return $form;
	}
	
	function update($values,$object) {
		$object->name = $values['name'];
		$object->author = $values['author'];
		$object->lang = $values['lang'];
		$object->charset = $values['charset'];
		$object->locale = $values['locale'];
		$object->default_view = $values['default_view'];
		return $object;
	}
}

?>