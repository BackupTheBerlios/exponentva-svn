<?php
##################################################
#
# Copyright (c) 2005 Maxim Mueller
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
# $Id: function.includeMiscFiles.php,v 1.0 MaxxCorp Exp $
##################################################
/*
 * This function creates html loaders for - currently - JS and CSS Files 
 */
function smarty_function_includeMiscFiles($params,&$smarty) {
	
	include_once("libSmartyHelpers.php");	
	
	$loc = $smarty->_tpl_vars['__loc'];
	$myModule = $loc->mod;
	$myView = $smarty->_tpl_vars['__view'];

	//CSS
	$myCSSOriginals = glob2keyedArray(glob(BASE . "modules/" . $myModule . "/css/" . $myView . "*.css"));
	$myCSSOverrides = glob2keyedArray(glob(THEME_ABSOLUTE . "modules/" . $myModule . "/css/" . $myView . "*.css"));
		
	$myCSS = array_merge($myCSSOriginals,$myCSSOverrides);
	
	foreach($myCSS as $myCSSFile){
		echo "<link rel='stylesheet' type='text/css' href='" . absolute2relative($myCSSFile) . "'></link>";
	}
	
	//JavaScript
	$myJSOriginals = glob2keyedArray(glob(BASE . "modules/" . $myModule . "/js/" . $myView . "*.js"));
	$myJSOverrides = glob2keyedArray(glob(THEME_ABSOLUTE . "modules/" . $myModule . "/js/" . $myView . "*.js"));

	$myJS = array_merge($myJSOriginals,$myJSOverrides);

	foreach($myJS as $myJSFile){
		echo "<script type='text/javascript' src='" . absolute2relative($myJSFile) . "'></script>";
	}

}

?>