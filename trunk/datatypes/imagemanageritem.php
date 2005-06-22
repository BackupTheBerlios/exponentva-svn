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
# $Id: imagemanageritem.php,v 1.7 2005/04/18 15:47:45 filetreefrog Exp $
##################################################

class imagemanageritem {
	function form($object) {
		pathos_lang_loadDictionary('standard','core');
		pathos_lang_loadDictionary('modules','imagemanagermodule');
		
		if (!defined('SYS_FORMS')) require_once(BASE.'subsystems/forms.php');
		pathos_forms_initialize();
		
		$form = new form();
		if (!isset($object->id)) {
			$object->name = '';
			$object->description = '';
			$object->scale = 20;
		} else {
			$form->meta('id',$object->id);
		}
		$form->register('name',TR_IMAGEMANAGERMODULE_NAME,new textcontrol($object->name));
		$form->register('description',TR_IMAGEMANAGERMODULE_DESCRIPTION, new texteditorcontrol($object->description));
		if (!isset($object->id)) {
			$form->register('maxsizemsg','',new htmlcontrol(pathos_core_maxUploadSizeMessage()));
			$form->register('file',TR_IMAGEMANAGERMODULE_IMAGE,new uploadcontrol());
		}
		$form->register('scale',TR_IMAGEMANAGERMODULE_SCALE,new textcontrol($object->scale));
		$form->register('submit','',new buttongroupcontrol(TR_CORE_SAVE,'',TR_CORE_CANCEL));
		
		return $form;
	}
	
	function update($values,$object) {
		$object->name = $values['name'];
		$object->description = $values['description'];
		$object->scale = $values['scale'];
		return $object;
	}
}

?>