{*
 *
 * Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc., Maxim Mueller
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
 * $Id: Monthly\040List.tpl,v 1.11 2005/03/21 17:15:25 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<a href="{link _common=1 view=Default action=show_view time=$time}">{#i18n_calendarview#}</a>&nbsp;&nbsp;|&nbsp;&nbsp;{#i18n_listview#}<br />
<a href="#" onClick="window.open('popup.php?module=calendarmodule&src={$__loc->src}&view=Monthly List&template=printerfriendly&time={$time}','printer','title=no,scrollbars=no,width=800,height=600'); return false">{#i18n_printview#}</a>
<br />
<a class="mngmntlink calendar_mngmntlink" href="{link action=show_view _common=1 view='Monthly List' time=$prev_timestamp}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}left.png"/></a>
<b>{#i18n_viewmonthof#} {$time|format_date:"%B %Y"}</b>
<a class="mngmntlink calendar_mngmntlink" href="{link action=show_view _common=1 view='Monthly List' time=$next_timestamp}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}right.png"/></a>
<br /><br />
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}" alt="{#i18n_editconfig_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{/permissions}
{foreach from=$days item=events key=ts}
	{if_elements array=$events}
	<div class="sectiontitle">
	{$ts|date_format:$smarty.const.DISPLAY_DATE_FORMAT}
	</div>
	{assign var=none value=1}
	{foreach from=$events item=event}
		{assign var=none value=0}
		<div class="paragraph">
		<a class="mngmntlink calendar_mngmntlink" href="{link action=view id=$event->id date_id=$event->eventdate->id}">{$event->title}</a>
		{if $event->is_allday == 0}&nbsp;{$event->eventstart|date_format:$smarty.const.DISPLAY_TIME_FORMAT} - {$event->eventend|date_format:$smarty.const.DISPLAY_TIME_FORMAT}{/if}
		{if $permissions.edit == 1 || $event->permissions.edit == 1 || $permissions.delete == 1 || $event->permissions.delete == 1 || $permissions.administrate == 1 || $event->permissions.administrate == 1}
		<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		{/if}
		{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
		{if $permissions.administrate == 1 || $event->permissions.administrate == 1}
		<a class="mngmntlink calendar_mngmntlink" href="{link action=userperms int=$event->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstoitem_desc#}" alt="{#i18n_assignuserpermissionstoitem_desc#}" /></a>
		<a class="mngmntlink calendar_mngmntlink" href="{link action=groupperms int=$event->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstoitem_desc#}" alt="{#i18n_assigngrouppermissionstoitem_desc#}" /></a>
		{/if}
		{/permissions}
		{permissions level=$smarty.const.UILEVEL_NORMAL}
		{if $permissions.edit == 1 || $event->permissions.edit == 1}
			{if $event->approved == 1}
			<a class="mngmntlink calendar_mngmntlink" href="{link action=edit id=$event->id date_id=$event->eventdate->id}" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" /></a>
			{else}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.disabled.png" title="{#i18n_editdisabledinapproval_desc#}" alt="{#i18n_editdisabledinapproval_desc#}" />
			{/if}
		{/if}
		{if $permissions.delete == 1 || $event->permissions.delete == 1}
			{if $event->approved == 1}
			{if $event->is_recurring == 0}
			<a class="mngmntlink calendar_mngmntlink" href="{link action=delete id=$event->id}" onClick="return confirm('{#i18n_delete_confirm#}');" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" /></a>
			{else}
			<a class="mngmntlink calendar_mngmntlink" href="{link action=delete_form id=$event->id date_id=$event->eventdate->id}" onClick="return confirm('{#i18n_delete_confirm#}');" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" /></a>
			{/if}
			{else}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.disabled.png" title="{#i18n_deletedisabledinapproval_desc#}" />
			{/if}
		{/if}
		{if $permissions.manage_approval == 1}
			<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=revisions_view id=$event->id}">
				{#i18n_revisions#}
			</a>
		{/if}
		{/permissions}
		</div>
		<br />
	{/foreach}
	{if $none == 1}
		<div class="paragraph"><strong>{#i18n_noitemsfound#}</strong></div>
	{/if}
	<br />
	{/if_elements}
{/foreach}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.post == 1}
<a class="mngmntlink calendar_mngmntlink" href="{link action=edit id=0}">{#i18n_create#}</a><br />
{/if}
{if $in_approval != 0 && $canview_approval_link == 1}
<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=summary}">{#i18n_viewapprovals#}</a>
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