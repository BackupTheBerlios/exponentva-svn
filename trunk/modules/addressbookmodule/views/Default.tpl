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
 * $Id: Default.tpl,v 1.7 2005/04/26 04:40:06 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}" alt="{#i18n_editconfig_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
<div class="moduletitle addressbook_moduletitle">{$moduletitle}</div>
<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header addressbook_header">{#i18n_name#}</td>
		<td class="header addressbook_header">{#i18n_email#}</td>
		<td class="header addressbook_header">{#i18n_phone#}</td>
		<td class="header addressbook_header">&nbsp;</td>
	</tr>
{foreach from=$contacts item=contact}
	<tr>
		<td>{$contact->firstname} {$contact->lastname}</td>
		<td>{$contact->email|hide_email}</td>
		<td>{$contact->phone}</td>
		<td>
			{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
				{if $permissions.administrate == true || $contact->permissions.administrate == true}
					<a href="{link action=userperms int=$contact->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstoitem_desc#}" alt="{#i18n_assignuserpermissionstoitem_desc#}" /></a>&nbsp;
					<a href="{link action=groupperms int=$contact->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstoitem_desc#}" alt="{#i18n_assigngrouppermissionstoitem_desc#}" /></a>
				{/if}
			{/permissions}
			{permissions level=$smarty.const.UILEVEL_NORMAL}
				{if $permissions.edit == 1 || $contact->permissions.edit == 1}
					<a class="mngmntlink addressbook_mngmntlink" href="{link action=edit id=$contact->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" />
					</a>
				{/if}
				{if $permissions.delete == 1 || $contact->permissions.delete == 1}
					<a class="mngmntlink addressbook_mngmntlink" href="{link action=delete id=$contact->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
					</a>
				{/if}
			{/permissions}
			<a class="mngmntlink addressbook_mngmntlink" href="{link action=view id=$contact->id}">
				<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}view.png" title="{#i18n_view_desc#}" alt="{#i18n_view_desc#}" />
			</a>
		</td>
	</tr>
{foreachelse}
	<tr>
		<td colspan="5"><i>{#i18n_noitemsfound#}</i></td>
	</tr>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.post == 1}
<a class="mngmntlink addressbook_mngmntlink" href="{link action=edit}" title="{#i18n_create_desc#}" alt="{#i18n_create_desc#}">{#i18n_create#}</a>
{/if}
{/permissions}