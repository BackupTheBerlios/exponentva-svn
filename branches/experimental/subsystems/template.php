<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Copyright (c) 2006 Maxim Mueller
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################

if (!defined('EXPONENT')) exit('');

/* exdoc
 * The definition of this constant lets other parts of the system know 
 * that the subsystem has been included for use.
 * @node Subsystems:Template
 */
define('SYS_TEMPLATE',1);

define('TEMPLATE_FALLBACK_VIEW',BASE.'views/viewnotfound.tpl');

class basetemplate {
	// Smarty template object.
	var $tpl;
	
	// The full server-side filename of the .tpl file being used.
	// This will be used by modules on the outside, for retrieving view configs.
	var $viewfile = "";
	
	// Name of the view (for instance, 'Default' for 'Default.tpl')
	var $view = "";
	
	// Full server-side directory path of the .tpl file being used.
	var $viewdir = "";
	
	//fix for the wamp/lamp issue
	var $langdir = "";
	//	
	
	/*
	 * Assign a variable to the template.
	 *
	 * @param string $var The name of the variable - how it will be referenced inside the Smarty code
	 * @param mixed $val The value of the variable.
	 */
	function assign($var,$val) {
		$this->tpl->assign($var,$val);
	}
	
	/*
	 * Render the template and echo it to the screen.
	 */
	function output() {
		// Load language constants
		$this->tpl->assign('_TR', exponent_lang_loadFile($this->langdir."/".$this->view.'.php')); //fix lamp issue
		
		$this->tpl->display($this->view.'.tpl');
	}
	
	function register_permissions($perms,$locs) {
		$permissions_register = array();
		if (!is_array($perms)) $perms = array($perms);
		if (!is_array($locs)) $locs = array($locs);
		foreach ($perms as $perm) {
			foreach ($locs as $loc) {
				$permissions_register[$perm] = (exponent_permissions_check($perm,$loc) ? 1 : 0);
			}
		}
		$this->tpl->assign('permissions', $permissions_register);
	}
	
	/*
	 * Render the template and return the result to the caller.
	 */
	function render() { // Caching support?
		// Load language constants
		$this->tpl->assign('_TR',exponent_lang_loadFile($this->viewdir.'/'.$this->view.'.php'));
		return $this->tpl->fetch($this->view.'.tpl');
	}
}
/*
 * Wraps the template system in use, to provide a uniform and consistent
 * interface to templates.
 */
//TODO: prepare this class for multiple template systems
//TODO: implement php5 constructor
class template extends basetemplate {	
	var $module = '';	
	function template($module,$view = null,$loc=null,$caching=false) {
		
		include_once(BASE.'external/Smarty/libs/Smarty.class.php');
		
		// Set up the Smarty template variable we wrap around.
		$this->tpl = new Smarty();
		$this->tpl->php_handling = SMARTY_PHP_REMOVE;
		$this->tpl->plugins_dir[] = BASE . 'subsystems/template/Smarty/plugins';
		
		$this->viewfile = exponent_template_getViewFile("modules", $module, $view);
		$this->viewparams = exponent_template_getViewParams($this->viewfile);
		//$this->viewdir = str_replace(BASE,'',realpath(dirname($this->viewfile)));
		$this->viewdir = realpath(dirname($this->viewfile));
				
		$this->view = substr(basename($this->viewfile),0,-4);
		$this->tpl->template_dir = $this->viewdir;
		
		//fix for the wamp/lamp issue
		$this->langdir = "modules/".$module."/views/";
		//$this->langdir = $this->viewdir;
		//
		

		$this->tpl->compile_dir = BASE.'/views_c';
		$this->tpl->compile_id = md5($this->viewfile);
		
		$expected_view = ($this->viewfile == TEMPLATE_FALLBACK_VIEW ? $view : $this->view);
		
		$this->tpl->assign("__view",$expected_view);
		if ($loc == null) $loc = exponent_core_makeLocation($module);
		$this->tpl->assign("__loc",$loc);
		$this->tpl->assign("__name", $module);
		$this->tpl->assign("__redirect",exponent_flow_get());
		
		// View Config
		global $db;
		$container = $db->selectObject("container","internal='".serialize($loc)."'");
		$this->viewconfig = ($container && $container->view_data != "" ? unserialize($container->view_data) : array());
		$this->tpl->assign("__viewconfig",$this->viewconfig);
		//echo "<xmp>";
		//print_r($this);
		//echo "</xmp>";
	}
	
	
}

/* exdoc
 * 
 * Control Template wrapper
 * 
 * 
 */
class ControlTemplate extends basetemplate {
	
	//PHP5 constructor
	function __constructor($control, $view = "Default", $loc = null) {
		ControlTemplate($control, $view , $loc=null);
	}
	
	//PHP4 fallback constructor
	function ControlTemplate($control, $view = "Default", $loc = null) {
		
		include_once(BASE.'external/Smarty/libs/Smarty.class.php');
		
		// Set up the Smarty template variable we wrap around.
		$this->tpl = new Smarty();
		$this->tpl->php_handling = SMARTY_PHP_REMOVE;
		$this->tpl->plugins_dir[] = BASE . 'subsystems/template/Smarty/plugins';
		
		//autoload filters
		$this->tpl->autoload_filters = array('post' => array('includeMiscFiles'));
		
		$this->viewfile = exponent_template_getViewFile("controls", $control, $view);
		$this->viewdir = realpath(dirname($this->viewfile));
				
		$this->view = substr(basename($this->viewfile),0,-4);
		$this->tpl->template_dir = $this->viewdir;
		
		$this->tpl->compile_dir = BASE.'/views_c';
		$this->tpl->compile_id = md5($this->viewfile);
		
		$this->tpl->assign("__view", $this->view);
		$this->tpl->assign("__name", $control);
		$this->tpl->assign("__redirect", exponent_flow_get());
	}
}

/*
 * Form Template Wrapper
 *
 * This class wraps is used for site wide forms.  
 *
 * @package Subsystems
 * @subpackage Template
 */
class formtemplate extends basetemplate {
	function formtemplate($form, $view) {
		
		include_once(BASE.'external/Smarty/libs/Smarty.class.php');
		
		$langdir = (LANG == 'en' ? '' : LANG.'/');
	
		$this->tpl = new Smarty();
		$this->tpl->php_handling = SMARTY_PHP_REMOVE;
		$this->tpl->plugins_dir[] = BASE . 'subsystems/template/Smarty/plugins';
		
		$this->viewfile = exponent_template_getViewFile("forms", $form , $view);
		
		$this->view = substr(basename($this->viewfile),0,-4);
		$this->viewdir = realpath(dirname($this->viewfile));
		
		$this->tpl->template_dir = $this->viewdir;
		$this->tpl->compile_dir = BASE.'views_c';
		
		$this->tpl->compile_id = md5($this->viewfile);
		
		$this->tpl->assign("__view",$this->view);
		$this->tpl->assign("__name", $form);
		$this->tpl->assign("__redirect",exponent_flow_get());
	}
	
	
}

class filetemplate extends basetemplate {
	function filetemplate($file) {
		
		include_once(BASE.'external/Smarty/libs/Smarty.class.php');
		
		$this->tpl = new Smarty();
		//$this->tpl->security = true;
		$this->tpl->php_handling = SMARTY_PHP_REMOVE;
		$this->tpl->plugins_dir[] = BASE . 'subsystems/template/Smarty/plugins';
		
		$this->view = substr(basename($file),0,-4);
		$this->viewdir = realpath(dirname($file));
		
		$this->tpl->template_dir = $this->viewdir;
		// Make way for i18n
		// $this->tpl->compile_dir = $this->viewdir."_c";
		$this->tpl->compile_dir = BASE.'/views_c';
		$this->tpl->compile_id = md5($this->viewfile);
		
		$this->tpl->assign("__view", $this->view);
		$this->tpl->assign("__redirect",exponent_flow_get());
	}
}

/*
 * Standalone Template Class
 *
 * A standalone template is a template (tpl) file found in either
 * THEME_ABSOLUTE/views or BASE/views, which uses
 * the corresponding views_c directory for compilation.
 * 
 * @param string $view The name of the standalone view.
 */
class standalonetemplate extends basetemplate {
	function standalonetemplate($view) {
		
		include_once(BASE.'external/Smarty/libs/Smarty.class.php');
		
		$this->tpl = new Smarty();
		//$this->tpl->security = true;
		$this->tpl->php_handling = SMARTY_PHP_REMOVE;
		$this->tpl->plugins_dir[] = BASE . 'subsystems/template/Smarty/plugins';
		
		$file = exponent_template_getViewFile("", "", $view);
		
		$this->view = substr(basename($file),0,-4);
		$this->viewdir = str_replace(BASE,'',realpath(dirname($file)));
		
		$this->tpl->template_dir = $this->viewdir;
		// Make way for i18n
		// $this->tpl->compile_dir = $this->viewdir."_c";
		$this->tpl->compile_dir = BASE.'/views_c';
		$this->tpl->compile_id = md5($this->viewfile);
		
		$this->tpl->assign("__view",$view);
		$this->tpl->assign("__redirect",exponent_flow_get());
	}
}

/*
 * Retrieve View File
 *
 * Looks in the theme and the /views directory for a .tpl file
 * corresponding to the passed view.
 *
 * @param string $type One of "modules"", "controls"", "forms" or ""
 * @param string $name The name the object we are requesting a view from
 * @param string $view The name of the requested view
 *
 * @return string The full filepath of the view template
 */
function exponent_template_getViewFile($type="", $name="", $view) {
	$viewfilepath = array_shift(exponent_core_resolveFilePaths($type, $name, "tpl", $view));
	if ($viewfilepath != false) {
		return $viewfilepath;
	} else if ($view != DEFAULT_VIEW) {
		// If we get here, try it with a different view.
		return exponent_template_getViewFile($type, $name, DEFAULT_VIEW);
	} else {
		// Something is really screwed up.
		// Fall back to something that won't error.
		return TEMPLATE_FALLBACK_VIEW;
	}
}

//backward compatibility wrapper
function exponent_template_getModuleViewFile($name, $view, $recurse=true) {
	return exponent_template_getViewFile("modules", $name, $view);
}

// I thing these still need to be i18n-ized
function exponent_template_getViewConfigForm($module,$view,$form,$values) {
	$form_file = "";
	$filepath = array_shift(exponent_core_resolveFilePaths("modules", $module , "form" , $view));
	if ($filepath != false) {
		$form_file = $filepath;
	}
	
	if (!defined("SYS_FORMS")) require_once(BASE."subsystems/forms.php");
	exponent_forms_initialize();
	
	if ($form == null) $form = new form();
	if ($form_file == "") return $form;
	
	$form->register(null,"",new htmlcontrol("<hr size='1' /><b>Layout Configuration</b>"));
	
	$fh = fopen($form_file,"r");
	while (($control_data = fgetcsv($fh,65536,"\t")) !== false) {
		$data = array();
		foreach ($control_data as $d) {
			if ($d != "") $data[] = $d;
		}
		if (!isset($values[$data[0]])) $values[$data[0]] = 0;
		if ($data[2] == "checkbox") {
			$form->register("_viewconfig[".$data[0]."]",$data[1],new checkboxcontrol($values[$data[0]],true));
		} else if ($data[2] == 'text') {
			$form->register("_viewconfig[".$data[0]."]",$data[1],new textcontrol($values[$data[0]]));
		} else {
			$options = array_slice($data,3);
			$form->register("_viewconfig[".$data[0]."]",$data[1],new dropdowncontrol($values[$data[0]],$options));
		}
	}
	
	$form->register("submit","",new buttongroupcontrol("Save","","Cancel"));
	
	return $form;
}

function exponent_template_getViewConfigOptions($module,$view) {
	$form_file = "";
	$filepath = array_shift(exponent_core_resolveFilePaths("modules", $module, "form", $view));
	if ($filepath != false) {
		$form_file = $filepath;
	}
	if ($form_file == "") return array(); // no form file, no options
	
	$fh = fopen($form_file,"r");
	$options = array();
	while (($control_data = fgetcsv($fh,65536,"\t")) !== false) {
		$data = array();
		foreach ($control_data as $d) {
			if ($d != "") $data[] = $d;
		}
		$options[$data[0]] = $data[1];
	}
	return $options;
}

function exponent_template_getFormTemplates($type) {
	$forms = array();
	
	//Get the forms from the base form diretory
	$formFiles = exponent_core_resolveFilePaths("forms", $type, "tpl", "[!_]*");
	foreach($formFiles as $formFile) {
		$forms[substr(basename($formFile), 0, -4)] = substr(basename($formFile), 0, -4);
	}
	return $forms;
}


/* exdoc
 * Looks through the module's views directory and returns
 * all non-internal views that are found there.
 * Returns an array of all standard view names.
 * This array is unsorted.
 *
 * @param string $module The classname of the module to get views for.
 * @node Subsystems:Template
 */
function exponent_template_listModuleViews($module,$lang = LANG) {
	$views = array();
	//Get the views
	$viewFiles = exponent_core_resolveFilePaths("modules", $module, "tpl", "[!_]*");
	foreach($viewFiles as $viewFile) {
		$views[] = substr(basename($viewFile), 0, -4);
	}
	return $views;

}

function exponent_template_getViewParams($viewfile) {
	$base = substr($viewfile,0,-4);
	$vparam = null;
	if (is_readable($base.'.config')) {
		$vparam = include($base.'.config');
	}
	return $vparam;
}


?>