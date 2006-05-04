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
	<?php exponent_theme_sourceSelectorInfo(); ?>
				<table width="655" border="0" cellspacing="0" cellpadding="0">
							<table width="541" border="0" cellspacing="0" cellpadding="0">
										<?php exponent_theme_showModule("navigationmodule","Top Nav"); ?>
									</td>
						</td>
						<?php
						if (exponent_theme_inAction()) {
							?><td width="554" height="239" colspan="2" valign="top" style="padding: 10px"><?php
							exponent_theme_runAction();
						} else {
							?><td width="180" height="239" align="left" valign="top">
								<table width="180" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td colspan="3">&nbsp;</td>
									</tr>
									<tr>
										<td height="221">&nbsp;</td>
										<td width="160" align="left" valign="top" class="footer">
									<?php exponent_theme_showModule("loginmodule","Default"); ?>
									<?php exponent_theme_showModule("previewmodule","Default"); ?>
									<br /><hr size="1"/><br /><?php
								exponent_theme_showModule("navigationmodule","Children Only");
								?><br /><hr size="1"/><br /><?php
								exponent_theme_showSectionalModule("containermodule","Default","","@left");
								?><br /><hr size="1"/><br /><?php
								exponent_theme_showSectionalModule("containermodule","Default","","@right");
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
									exponent_theme_showModule("textmodule","Default","","Header Text");
									exponent_theme_mainContainer();
							?></td>
								</tr>
							</table>
						</td><?php
						}
						?>
					<table width="750" border="0" cellspacing="0" cellpadding="0">
								<table width="374" border="0" cellspacing="0" cellpadding="0">
										<?php exponent_theme_showModule("textmodule","Default","","footer"); ?>
										</td>
									</tr>
							</td>
				</td>