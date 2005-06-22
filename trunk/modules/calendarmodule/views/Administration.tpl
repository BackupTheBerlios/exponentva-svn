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
 * $Id: Administration.tpl,v 1.4 2005/03/21 17:15:25 filetreefrog Exp $
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
	<a href="{link action=configure _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" title="{#i18n_editconfig_desc#}" alt="{#i18n_editconfig_desc#}" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
{if $moduletitle != ""}<div class="moduletitle calendar_moduletitle">{$moduletitle}</div>{/if}
<table cellspacing="0" cellpadding="4" border="0" width="100%">
	<tr>
		<td class="header calendarcontentheader">{#i18n_eventtitle#}</td>
		<td class="header calendarcontentheader">{#i18n_when#}</td>
		{if $modconfig->enable_categories == 1}
		<td class="header calendarcontentheader">{#i18n_category#}</td>
		{/if}
		<td class="header calendarcontentheader">&nbsp;</td>
	</tr>
{foreach from=$items item=item}
	<tr>
		<td><a class="mngmntlink calendar_mngmntlink" href="{link action=view id=$item->id date_id=$item->eventdate->id}">{$item->title}</a></td>
		<td>{if $item->is_allday == 1}{$item->eventstart|format_date:$smarty.const.DISPLAY_DATE_FORMAT}{else}{$item->eventstart|format_date:"%a %b %e, %l:%M %P"} - {$item->eventend|format_date:"%l:%M %P"}{/if}</td>
		{if $modconfig->enable_categories == 1}
		<td>{assign var=catid value=$item->category_id}
			<b>
			{if $__viewconfig.colorize == 1}<span style="color: {$categories[$catid]->color}">{$categories[$catid]->name}</span>{else}{$categories[$catid]->name}{/if}
			</b>
		</td>
		{/if}
		<td>
			{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
				{if $permissions.administrate == 1 || $item->permissions.administrate == 1}
					<a class="mngmntlink calendar_mngmntlink" href="{link action=userperms int=$item->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstoitem_desc#}" alt="{#i18n_assignuserpermissionstoitem_desc#}" /></a>
					<a class="mngmntlink calendar_mngmntlink" href="{link action=groupperms int=$item->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
				{/if}
			{/permissions}
			{permissions level=$smarty.const.UILEVEL_NORMAL}
				{if $permissions.edit == 1 || $item->permissions.edit == 1}
					{if $item->approved == 1}
					<a class="mngmntlink calendar_mngmntlink" href="{link action=edit id=$item->id date_id=$item->eventdate->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" /></a>
					{else}
					<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.disabled.png" title="{#i18n_editdisabledinapproval_desc#}" alt="{#i18n_editdisabledinapproval_desc#}" />
					{/if}
				{/if}
				{if $permissions.delete == 1 || $item->permissions.delete == 1}
					{if $item->approved == 1}
					{if $item->is_recurring == 0}
					<a class="mngmntlink calendar_mngmntlink" href="{link action=delete id=$item->id}" onClick="return confirm('{#i18n_delete_confirm#}');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" /></a>
					{else}
					<a class="mngmntlink calendar_mngmntlink" href="{link action=delete_form id=$item->id date_id=$item->eventdate->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" /></a>
					{/if}
					{else}
					<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.disabled.png" title="{#i18n_deletedisabledinapproval_desc#}" alt="{#i18n_deletedisabledinapproval_desc#}" />
					{/if}
				{/if}
				{if $permissions.manage_approval == 1}
					<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=revisions_view id=$item->id}" title="{#i18n_viewrevisionhistory_desc#}" alt="{#i18n_viewrevisionhistory_desc#}">{#i18n_revisions#}</a>
				{/if}
			{/permissions}
		</td>
	</tr>
{foreachelse}
	<tr><td colspan="2" align="center"><i>{#i18n_noitemsfound#}</a></td></tr>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.post == 1}
<a class="mngmntlink calendar_mngmntlink" href="{link action=edit id=0}" title="{#i18n_create_desc#}" alt="{#i18n_create_desc#}">{#i18n_create#}</a>
{/if}
<br />
{if $in_approval != 0 && $canview_approval_link == 1}
<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=summary}" title="{#i18n_viewapprovals_desc#}" alt="{#i18n_viewapprovals_desc#}">{#i18n_viewapprovals#}</a>
{/if}
{if $modconfig->enable_categories == 1}
{if $permissions.manage_categories == 1}
<br />
<a href="{link module=categories orig_module=calendarmodule action=manage}" class="mngmntlink calendar_mngmntlink">{#i18n_managecategories#}</a>
{else}
<br />
<a class="mngmntlink calendar_mngmntlink" href="#" onClick="window.open('{$smarty.const.PATH_RELATIVE}/popup.php?module=categories&m={$__loc->mod}&action=view&src={$__loc->src}','legend','width=200,height=200,title=no,status=no'); return false" title="{#i18n_viewcategories_desc#}" alt="{#i18n_viewcategories_desc#}">{#i18n_viewcategories#}</a>
{/if}
{/if}
{/permissions}