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
# $Id: index.php,v 1.4 2005/02/26 05:21:24 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	</head>
	<?php pathos_theme_sourceSelectorInfo(); ?>
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
					<?php pathos_theme_showModule("navigationmodule","Top Nav"); ?>
				</td>
					<?php
						echo "<br /><hr size='1' /><br />";
						pathos_theme_showModule("navigationmodule","Full Hierarchy");
						#pathos_theme_showModule("navigationmodule","Marked Hierarchy");
						#pathos_theme_showModule("navigationmodule","Collapsing Hierarchy");
						#pathos_theme_showModule("navigationmodule","Expanding Hierarchy");
				</td>
					<?php
					if (!pathos_theme_inAction()) {
						pathos_theme_showModule("navigationmodule","Breadcrumb");
						echo "<br />";
						echo "<br />";
					}
					
					pathos_theme_main();
					?>
					<br /><br />
					<?php
					pathos_theme_showModule("textmodule","Default","Footer","@footer");
					?>
				</td>