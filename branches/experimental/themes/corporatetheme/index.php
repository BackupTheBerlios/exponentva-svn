<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<?php echo exponent_theme_headerInfo($section); ?>
		<link rel="stylesheet" title="default" href="<?php echo THEME_RELATIVE; ?>style.css" />
	</head>
	
	<body onload="exponentJSinitialize();" topmargin="0" leftmargin="0" bottommargin="0" rightmargin="0">
	<?php exponent_theme_sourceSelectorInfo(); ?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
		<tr>
			<td rowspan="10" width="50%" height="100%" background="<?php echo THEME_RELATIVE;?>images/bg1222.jpg" style="background-position:right top; background-repeat:repeat-y"></td>
			<td rowspan="10" width="1" bgcolor="#000000"></td>
			<td colspan="4">
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td rowspan="3"><img src="<?php echo THEME_RELATIVE;?>images/lefttop.jpg"></td>
					<td width="686" height="32" background="<?php echo THEME_RELATIVE;?>images/top.jpg"></td>
					<td rowspan="3"><img src="<?php echo THEME_RELATIVE;?>images/righttop.jpg"></td>
				</tr>
				<tr>
					<td><img width="686" height="120" src="<?php echo THEME_RELATIVE;?>images/name.jpg"></td>
				</tr>
				<tr>
					<td height="28" valign="top" style="padding-left: 20px; padding-top: 3px; background-image: url(<?php echo THEME_RELATIVE;?>images/title_bg.gif); border-top: 5px solid lightblue; ">
						
						<?php exponent_theme_showModule("NavigationModule","Top Nav"); ?>
					</td>
				</tr>
			</table>
			</td>
			<td rowspan="10" width="1" bgcolor="#000000"></td>
			<td rowspan="10" width="50%" height="100%" background="<?php echo THEME_RELATIVE;?>images/bg1223.jpg" style="background-position:left top; background-repeat:repeat-y"></td>	
		</tr>
		<tr>
			<td valign="top" width="55" height="100%" background="<?php echo THEME_RELATIVE;?>images/l01.gif"><img src="<?php echo THEME_RELATIVE;?>images/left.gif"></td>
			<td valign="top" height="100%" width="215" style="padding: 5px">
			<?php
			exponent_theme_showModule("LoginModule","Default");
			exponent_theme_showModule("PreviewModule","Default");
			exponent_theme_showModule("NavigationModule","Children Only");
			exponent_theme_showSectionalModule("ContainerModule","Narrow","","@sidebar");
			?>
			</td>
			<td valign="top" height="100%" width="471" style="border: 0px solid blue; padding-right: 15px">
			
			<table cellpadding="0" width="100%" cellspacing="0" border="0" height="100%" style="padding-left: 10px; margin-right: 10px">
				
				<tr>
					<td><br /></td>
				</tr>
				<?php exponent_theme_showModule("NavigationModule","Breadcrumb"); ?>
				<tr>
					<td height="100%" valign="top" style="padding-top: 20px">
						<?php exponent_theme_main(); ?>
					</td>
				</tr>
				
			</table>
			</td>
			<td valign="top" width="59" height="100%" background="<?php echo THEME_RELATIVE;?>images/l02.gif"><img src="<?php echo THEME_RELATIVE;?>images/right.gif"></td>
		</tr>
		<tr>
			<td colspan="4" style="padding-left: 10px; padding-right: 10px">
				<?php exponent_theme_showModule("TextModule","Wide","","copyright"); ?>
			</td>
		</tr>
		</table>
	</body>
</html>