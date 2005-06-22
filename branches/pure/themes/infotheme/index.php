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
	<?php pathos_theme_sourceSelectorInfo(); ?>
				<table width="655" border="0" cellspacing="0" cellpadding="0">
							<table width="541" border="0" cellspacing="0" cellpadding="0">
										<?php pathos_theme_showModule("navigationmodule","Top Nav"); ?>
									</td>
						</td>
						<?php
						if (pathos_theme_inAction()) {
							?><td width="554" height="239" colspan="2" valign="top" style="padding: 10px"><?php
							pathos_theme_runAction();
						} else {
							?><td width="180" height="239" align="left" valign="top">
								<table width="180" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>
									<tr>
										<td height="221">&nbsp;</td>
										<td width="160" align="left" valign="top" class="footer">
									<?php pathos_theme_showModule("loginmodule","Default"); ?>
									<?php pathos_theme_showModule("previewmodule","Default"); ?>
									<br /><hr size="1"/><br /><?php
								pathos_theme_showModule("navigationmodule","Children Only");
								?><br /><hr size="1"/><br /><?php
								pathos_theme_showSectionalModule("containermodule","Default","","@left");
								?><br /><hr size="1"/><br /><?php
								pathos_theme_showSectionalModule("containermodule","Default","","@right");
								?></td>
										<td>&nbsp;</td>
									</tr>
								</table>
							</td>
							<td width="374" align="center" valign="top">
							
								<table width="374" border="0" cellspacing="5" cellpadding="0">
									<tr>
										<td align="left" valign="top">
									<?php
									pathos_theme_showModule("textmodule","Default","","Header Text");
									pathos_theme_mainContainer();
							?></td>
								</tr>
							</table>
						</td><?php
						}
						?>
					<table width="750" border="0" cellspacing="0" cellpadding="0">
								<table width="374" border="0" cellspacing="0" cellpadding="0">
										<?php pathos_theme_showModule("textmodule","Default","","footer"); ?>
										</td>
									</tr>
							</td>
				</td>