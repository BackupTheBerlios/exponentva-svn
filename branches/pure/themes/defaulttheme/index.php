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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html>	<head>		<?php echo exponent_theme_headerInfo($section); ?>		<link rel="stylesheet" title="default" href="<?php echo THEME_RELATIVE; ?>style.css" />
	</head>		<body onload="exponentJSinitialize();">
	<?php exponent_theme_sourceSelectorInfo(); ?>		<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="width:100%; table-layout: fixed;<?php if (defined("SOURCE_SELECTOR")) echo 'border:3px dashed black;'; ?>">
			<tr><!--
				This is row is intended to work around the table-layout: fixed CSS situation:
				  - Since this table is a fixed-layout, it will try to create cell widths based
				    on explicit width values.  However, since the first row is the colspanned
				    header row, it takes that width and just divides by two.  This row inserts
				    blank columns to blend in with the background and set 'proper' cell widths.
			-->
				<td width="200" style="width: 200px" bgcolor="339bcc">
				</td>
				<td bgcolor="339bcc">
				</td>
			</tr>			<tr>				<td height="75" colspan="2" align="left" valign="top" bgcolor="339bcc"><img src="<?php echo THEME_RELATIVE; ?>images/title.gif" width="550" height="75" title="Exponent Content Management System" alt="Exponent Content Management System" /></td>			</tr>			<tr>				<td colspan="2" height="1" bgcolor="000000"></td>			</tr>			<tr>				<td colspan="2" height="20" bgcolor="339bcc" align="right" id="topNavContainer">
					<?php exponent_theme_showModule("navigationmodule","Top Nav"); ?>
				</td>			</tr>			<tr>				<td colspan="2" height="1" bgcolor="000000"></td>			</tr>			<tr>				<td id="leftSidebarContainer" width="175" align="left" valign="top" bgcolor="99cc33" style="padding-left: 10px; padding-top: 20px; padding-right: 10px; width: 175px;">
					<?php						exponent_theme_showModule("loginmodule","Default");
						echo "<br /><hr size='1' /><br />";
						exponent_theme_showModule("navigationmodule","Full Hierarchy");
						#exponent_theme_showModule("navigationmodule","Marked Hierarchy");
						#exponent_theme_showModule("navigationmodule","Collapsing Hierarchy");
						#exponent_theme_showModule("navigationmodule","Expanding Hierarchy");					?>
				</td>				<td align="left" valign="top" style="padding-left: 20px; padding-right: 20px; padding-top: 20px;">
					<?php
					if (!exponent_theme_inAction()) {
						exponent_theme_showModule("navigationmodule","Breadcrumb");
						echo "<br />";
						echo "<br />";
					}
					
					exponent_theme_main();
					?>
					<br /><br />
					<?php
					exponent_theme_showModule("textmodule","Default","Footer","@footer");
					?>
				</td>			</tr>		</table>	</body></html>
