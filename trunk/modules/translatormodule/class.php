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
# $Id: class.php,v 1.4 2005/03/13 20:40:46 filetreefrog Exp $
##################################################

class translatormodule {
	function name() { return 'Translation Dictionary Manager'; }
	function description() { return 'Eases the process of managing dictionaries for one or more languages.'; }
	function author() { return 'James Hunt'; }
	
	function hasSources() { return false; }
	function hasContent() { return true; }
	function hasViews() { return true; }
	
	function supportsWorkflow() { return false; }
	
	function permissions($internal = "") {
		if ($internal == '') {
			return array(
				'administrate'=>'Administrate',
				'configure'=>'Manage All Languages',
			);
		} else {
			return array(
				'administrate'=>'Administrate',
				'configure'=>'Manage This Language',
			);
		}
	}
	
	function show($view,$loc = null, $title = '') {
		global $db;
		
		$template = new template('translatormodule',$view,$loc);
		
		$langs = array();
		$lloc = pathos_core_makeLocation('translatormodule');
		foreach ($db->selectObjects('translation_language') as $lang) {
			$lloc->int = $lang->id;
			$lang->permissions = array(
				'administrate'=>(pathos_permissions_check('administrate',$lloc) ? 1 : 0),
				'configure'=>(pathos_permissions_check('configure',$lloc) ? 1 : 0),
			);
			$langs[] = $lang;
		}
		
		$template->assign('languages',$langs);
		$template->assign('dictionaries',translatormodule::dictionaries());
		$template->assign('moduletitle',$title);
		$template->register_permissions(
			array('administrate','configure'),$loc);
		
		$template->output();
	}
	
	function getLocationhierarchy($loc) {
		if ($loc->int == '') {
			return array($loc);
		} else {
			return array(
				$loc,
				pathos_core_makeLocation($loc->mod,$loc->src,'')
			);
		}
	}
	
	function deleteIn($loc) {
		$db->delete('translation_language','');
		$db->delete('translation_dictentry','');
	}
	
	function copyContent($oloc,$nloc) {
		// Do nothing, no such thing as sources
	}
	
	function dictionaries() {
		$dicts = array();
		
		$type_base = BASE.'subsystems/lang/en/';
		$type_dh = opendir($type_base);
		
		while (($type = readdir($type_dh)) !== false) {
			if ($type{0} != '.' && $type != 'CVS' && is_dir($type_base.$type)) {
				$dicts[$type] = array();
				
				$dict_base = $type_base.$type.'/';
				$dict_dh = opendir($dict_base);
				
				while (($dict = readdir($dict_dh)) !== false) {
					if (substr($dict,-4,4) == '.php') {
						$dicts[$type][] = substr($dict,0,-4);
					}
				}
			}
		}
		
		return $dicts;
	}
	
	function parseDictionary($type,$name,$lang,$path = null) {
		if ($path == null) {
			$path = BASE;
		}
		$file = $path.'subsystems/lang/'.$lang.'/'.$type.'/'.$name.'.php';
		
		$lines = array_map('trim',file($file));
		$constants = array();
		foreach ($lines as $line) {
			if (substr($line,0,6) == 'define') {
				$line = preg_split("/',\s*'/",substr($line,8,-3));
				$constants[$line[0]] = $line[1];
			}
		}
		
		return $constants;
	}
	
	function spiderContent() {
		// Do nothing, nothing to search
	}
}

?>