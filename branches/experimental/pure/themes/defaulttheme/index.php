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
	</head>
	<?php exponent_theme_sourceSelectorInfo(); ?>
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
			</tr>
					<?php exponent_theme_showModule("navigationmodule","Top Nav"); ?>
				</td>
					<?php
						echo "<br /><hr size='1' /><br />";
						exponent_theme_showModule("navigationmodule","Full Hierarchy");
						#exponent_theme_showModule("navigationmodule","Marked Hierarchy");
						#exponent_theme_showModule("navigationmodule","Collapsing Hierarchy");
						#exponent_theme_showModule("navigationmodule","Expanding Hierarchy");
				</td>
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
				</td>