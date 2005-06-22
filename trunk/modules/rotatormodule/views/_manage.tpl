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
 * $Id: _manage.tpl,v 1.4 2005/02/19 00:32:36 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tr>
		<td class="header rotator_header">{#i18n_content#}</td>
		<td class="header rotator_header"></td>
	</tr>
	{foreach from=$items item=item}
	<tr>
		<td valign="top">{$item->text}</td>
		<td valign="top">
			{if $permissions.manage == 1}
			<a href="{link action=edit_item id=$item->id}">
				<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
			</a>
			<a href="{link action=delete_item id=$item->id}">
				<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
			</a>
			{/if}
		</td>
	</tr>
	<tr><td colspan="2"><hr size="1" /></td></tr>
	{foreachelse}
		<tr><td colspan="2" align="center"><i>{#i18n_noitemsfound#}</i></td></tr>
	{/foreach}
</table>

{if $permissions.manage == 1}			
<a href="{link action=edit_item}">{#i18n_create#}</a>
{/if}