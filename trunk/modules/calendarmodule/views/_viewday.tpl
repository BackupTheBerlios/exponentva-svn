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
 * $Id: _viewday.tpl,v 1.5 2005/02/19 00:32:30 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewday time=$prevday}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}left.png" title="{#i18n_previous#}" alt="{#i18n_previous#}" /></a>
<span style="font-weight: bold; font-size: 16px">{$now|format_date:"%A, %B %e, %Y"}</span>
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewday time=$nextday}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}right.png" title="{#i18n_next#}" alt="{#i18n_next#}" /></a>
<br />
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewweek time=$now}" title="{#i18n_viewweek_desc#}" alt="{#i18n_viewweek_desc#}">{#i18n_viewweek#}</a>
<br /><hr size="1" />
<table cellpadding="2" cellspacing="0" width="100%" border="0">
{assign var=count value=0}
{foreach from=$events item=event}
	{assign var=count value=1}
	<tr><td style="padding-left: 15px">
		<a class="mngmntlink calendar_mngmntlink" href="{link action=view id=$event->id date_id=$event->eventdate->id}">{$event->title}</a>
		{if $permissions.administrate == 1 || $event->permissions.administrate == 1}
			<a href="{link action=userperms int=$event->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
			<a href="{link action=groupperms int=$event->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
		{/if}
		{if $permissions.edit == 1 || $event->permissions.edit == 1}
			{if $event->approved == 1}
			<a href="{link action=edit id=$event->id date_id=$event->eventdate->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" /></a>&nbsp;
			{else}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.disabled.png" title="{#i18n_editdisabledinapproval_desc#}" alt="{#i18n_editdisabledinapproval_desc#}" />
			{/if}
		{/if}
		{if $permissions.delete == 1 || $event->permissions.delete == 1}
			{if $event->approved == 1}
				{if $event->is_recurring == 0}
				<a href="{link action=delete id=$event->id}" onClick="return confirm('{#i18n_delete_confirm#}');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" /></a>
				{else}
				<a href="{link action=delete_form date_id=$event->eventdate->id id=$event->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" /></a>
				{/if}
			{else}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.disabled.png" title="{#i18n_deletedisabledinapproval_desc#}" alt="{#i18n_deletedisabledinapproval_desc#}" />
			{/if}
		{/if}
		{if $permissions.manage_approval == 1}
			<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=revisions_view id=$event->id}" title="{#i18n_viewrevisionhistory_desc#}" alt="{#i18n_viewrevisionhistory_desc#}">{#i18n_revisions#}</a>
		{/if}
		<div style="padding-left: 10px">
			<b>{if $event->is_allday == 1}{#i18n_allday#}{else}
			{$event->eventstart|format_date:"%l:%M %P"} - {$event->eventend|format_date:"%l:%M %P"}
			{/if}</b><br />
			{$event->body|summarize:"html":"para"}
		</div>
	</td></tr>
{/foreach}
{if $count == 0}
	<tr><td><i>{#i18n_noitemsfound#}</i></td></tr>
{/if}
</table>