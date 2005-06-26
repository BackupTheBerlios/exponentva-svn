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
 * $Id: _viewcontacts.tpl,v 1.6 2005/02/19 00:32:34 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="moduletitle inbox_moduletitle">{#i18n_formtitle#}</div>
<div style="border-top: 1px solid lightgrey; border-bottom: 1px solid lightgrey; padding: 1em;">
{#i18n_header#}</div>
<br /><br />
<b>{#i18n_personallist#}</b>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header inbox_header">{#i18n_title#}</td>
		<td class="header inbox_header">{#i18n_description#}</td>
		<td class="header inbox_header"></td>
	</tr>
{foreach from=$groups item=group}
	<tr>
		<td valign="top">{$group->name}</td>
		<td valign="top">{$group->description}</td>
		<td valign="top">
			<a href="{link action=edit_list id=$group->id}">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" />
			</a>
			<a href="{link action=delete_list id=$group->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
			</a>
		</td>
	</tr>
{foreachelse}
	<tr>
		<td colspan="4">
		<i>{#i18n_noitemsfound#}</i>
		</td>
	</tr>
{/foreach}
</table>
<a class="mngmntlink inbox_mngmntlink" href="{link action=edit_list}">{#i18n_create#}</a>

<hr size="1" />
<b>{#i18n_blockedusers#}</b>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header inbox_header">{#i18n_name#}</td>
		<td class="header inbox_header">{#i18n_username#}</td>
		<td class="header inbox_header"></td>
	</tr>
{foreach from=$banned item=contact}
	<tr>
		<td valign="top">{$contact->user->firstname} {$contact->user->lastname}</td>
		<td valign="top">{$contact->user->username}</td>
		<td valign="top">
			<a href="{link action=unban id=$contact->id}" onClick="return confirm('{#i18n_action_confirm#}');">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="{#i18n_unblock#}" alt="{#i18n_unblock#}"/>
			</a>
		</td>
	</tr>
{foreachelse}
	<tr>
		<td colspan="4">
		<i>{#i18n_noitemsfound#}</i>
		</td>
	</tr>
{/foreach}
</table>
<a class="mngmntlink inbox_mngmntlink" href="{link action=ban_user}">{#i18n_block#}</a>
<hr size="1" />
<a class="mngmntlink inbox_mngmntlink" href="{link action=inbox}">{#i18n_back#}</a>