{*
 *
 * Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * Exponent is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR
 * PURPOSE.  See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU
 * General Public License along with Exponent; if
 * not, write to:
 *
 * Free Software Foundation, Inc.,
 * 59 Temple Place,
 * Suite 330,
 * Boston, MA 02111-1307  USA
 *
 * $Id: Default.tpl,v 1.2 2005/02/19 00:37:08 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{if $smarty.const.PREVIEW_READONLY == 1}
<i>{#i18n_loggedin_info#}</i><br />
{/if}
{if $loggedin == true || $smarty.const.PREVIEW_READONLY == 1}
<table cellpadding="0" cellspacing="0" border="0" style="margin-left:10px;margin-right:7px;margin-top:5px;margin-bottom: 10px;">
	<tr>
		<td><img src="{$smarty.const.THEME_RELATIVE}images/corner_topleft.gif" /></td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/side_top_blank.gif); background-repeat: repeat-x;"></td>
		<td><img src="{$smarty.const.THEME_RELATIVE}images/corner_topright.gif" /></td>
	</tr>
	<tr>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/titleside_left.gif); background-repeat: repeat-y;"></td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/title_bg.gif)">
			<div style="font-weight: bold; font-size: 12pt;">User Menu</div>
		</td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/titleside_right.gif); background-repeat: repeat-y;"></td>
	</tr>
	<tr>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/side_left.gif); background-repeat: repeat-y"></td>
		<td width="100%" style="background-image: url({$smarty.const.THEME_RELATIVE}images/middle_bg.gif); text-align: justify">

			<div class="login_welcom">{#i18n_greeting#}, {$user->firstname} {$user->lastname}</div>
			<a href="{link action=editprofile}">{#i18n_editprofile#}</a><br />
			<a href="{link action=changepass}">{#i18n_editpassword#}</a><br />
			<a href="{link action=logout}">{#i18n_logout#}</a><br />

		</td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/side_right.gif); background-repeat: repeat-y"></td>
	</tr>
	<tr>
		<td><img src="{$smarty.const.THEME_RELATIVE}images/corner_bottomleft.gif" /></td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/side_bottom.gif); background-repeat: repeat-x"></td>
		<td><img src="{$smarty.const.THEME_RELATIVE}images/corner_bottomright.gif" /></td>
	</tr>
</table>
{/if}
{if $smarty.const.PREVIEW_READONLY == 1}
<hr size="1" />
<i>{#i18n_loggedout_info#}</i><br />
{/if}
{if $loggedin == false || $smarty.const.PREVIEW_READONLY == 1}
<table cellpadding="0" cellspacing="0" border="0" style="margin-left:10px;margin-right:7px;margin-top:5px;margin-bottom: 10px;">
	<tr>
		<td><img src="{$smarty.const.THEME_RELATIVE}images/corner_topleft.gif" /></td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/side_top_blank.gif); background-repeat: repeat-x;"></td>
		<td><img src="{$smarty.const.THEME_RELATIVE}images/corner_topright.gif" /></td>
	</tr>
	<tr>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/titleside_left.gif); background-repeat: repeat-y;"></td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/title_bg.gif)">
			<div style="font-weight: bold; font-size: 12pt;">User Menu</div>
		</td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/titleside_right.gif); background-repeat: repeat-y;"></td>
	</tr>
	<tr>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/side_left.gif); background-repeat: repeat-y"></td>
		<td width="100%" style="background-image: url({$smarty.const.THEME_RELATIVE}images/middle_bg.gif); text-align: justify">
		
			<form method="post" action="?">
				<input type="hidden" name="action" value="login" />
				<input type="hidden" name="module" value="loginmodule" />
				<input type="text" name="username" id="login_username" size="15" /><br />
				<input type="password" name="password" id="login_password" size="15" /><br />
				<input type="submit" value="{#i18n_submit#}" /><br />
			</form>
			{if $smarty.const.SITE_ALLOW_REGISTRATION == 1}
			<a href="{link action=createuser}">{#i18n_create#}</a><br />
			<a href="{link action=resetpass}">{#i18n_retrievepassword#}</a><br />
			{/if}
			
		</td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/side_right.gif); background-repeat: repeat-y"></td>
	</tr>
	<tr>
		<td><img src="{$smarty.const.THEME_RELATIVE}images/corner_bottomleft.gif" /></td>
		<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/side_bottom.gif); background-repeat: repeat-x"></td>
		<td><img src="{$smarty.const.THEME_RELATIVE}images/corner_bottomright.gif" /></td>
	</tr>
</table>
{/if}
