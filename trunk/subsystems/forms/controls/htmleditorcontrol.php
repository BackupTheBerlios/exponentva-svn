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
# $Id: htmleditorcontrol.php,v 1.6 2005/04/18 15:20:45 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

 
include_once(BASE."subsystems/forms/controls/formcontrol.php"); 
include_once(BASE."external/fckeditor/fckeditor.php"); 
/** 
* HTML Editor Control 
* 
* @package Subsystems 
* @subpackage Forms 
*/class htmleditorcontrol extends formcontrol { 
var $module = ""; 
 
function name() { return "WYSIWYG Editor"; } 
 
function htmleditorcontrol($default="",$module = "",$rows = 20,$cols = 60) { 
$this->default = $default; 
$this->module = $module; // For looking up templates. 
} 
 
function controlToHTML($name) { 
ob_start(); 
if (!defined("CTL_HTMLAREAINIT")) { 
// We are the first htmleditor control. Set up basic initializations 
?>  
 
<?php 
 
$sBasePath = $_SERVER['PHP_SELF'] ; 
$sBasePath = PATH_RELATIVE ; 
 
$oFCKeditor = new FCKeditor($name) ; 
$oFCKeditor->BasePath = $sBasePath."external/fckeditor/"; 
$oFCKeditor->Value = $this->default ; 
 
$oFCKeditor->ToolbarSet = 'Default' ; 
$oFCKeditor->Height= '300' ;
 
?> 
<SCRIPT TYPE="text/javascript" LANGUAGE="JavaScript"> 
oFCKeditor.Config['CustomConfigurationsPath']= $sBasePath . 'conf/fckconfig.js'; 
// --> 
</SCRIPT> 
<? 
$oFCKeditor->Create() ; 
?> 
 
<br> 
 
 
<?php 
define("CTL_HTMLAREAINIT",1); 
} 
// all setup has been done. 
?> 
<script type="text/javascript"> 
htmleditorcontrols[htmleditorcontrols.length] = "<?php echo $name; ?>"; 
</script> 
 
<?php 
$html = ob_get_contents(); 
ob_end_clean(); 
return $html; 
} 
 
function parseData($name, $values, $for_db = false) { 
$html = $values[$name]; 
if ($html == "<br />\r\n") $html = ""; 
return $html; 
} 
} 
 
?>














