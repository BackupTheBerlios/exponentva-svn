{*
 * Copyright (c) 2004-2006 OIC Group, Inc.
 * Written and Designed by James Hunt
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * GPL: http://www.gnu.org/licenses/gpl.txt
 *
 *}
<table width="85" border="0" cellspacing="0" cellpadding="0">
	{foreach from=$sections item=section}
	{if $section->depth == 0}
	<tr>
		<td align="left" valign="top">
			<table width="85" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="84" bgcolor="#FFFFFF" style="padding-left: 5px">
					{if $section->active == 1}
					<a href="{$section->link}" class="navlink sidenav">{$section->name}</a>
					{else}
					{$section->name}
					{/if}
					</td>
					<td width="8" align="left" valign="bottom" style="background-color: #fff"><img src="{$smarty.const.THEME_RELATIVE}images/jde_button_rt.gif" width="8" height="8"/></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="8"></td>
	</tr>
	{/if}
	{/foreach}
	<tr><td align="center">
	{permissions level=$smarty.const.UILEVEL_NORMAL}
	{if $canManage == 1}
	[ <a class="navlink" href="{link action=manage}">manage</a> ]
	{/if}
	{/permissions}
	</td></tr>
</table>