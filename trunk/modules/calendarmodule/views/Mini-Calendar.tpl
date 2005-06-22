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
 * $Id: Mini-Calendar.tpl,v 1.6 2005/02/19 00:32:30 filetreefrog Exp $
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
{/permissions}
<table cellspacing="0" cellpadding="2" border="0" width="160">
<tr><td align="center" class="calendar_header" colspan="7">{if $moduletitle != ""}{$moduletitle} {/if}{$now|format_date:"%B"}</td></tr>
	<tr>
		<td align="center" class="calendar_miniday">{#i18n_sunday_short#}</td>
		<td align="center" class="calendar_miniday">{#i18n_monday_short#}</td>
		<td align="center" class="calendar_miniday">{#i18n_tuesday_short#}</td>
		<td align="center" class="calendar_miniday">{#i18n_wednesday_short#}</td>
		<td align="center" class="calendar_miniday">{#i18n_thursday_short#}</td>
		<td align="center" class="calendar_miniday">{#i18n_friday_short#}</td>
		<td align="center" class="calendar_miniday">{#i18n_saturday_short#}</td>
	</tr>
{foreach from=$monthly item=week key=weekid}
	<tr class="{if $currentweek == $weekid}calendar_currentweek{/if}">
		{foreach from=$week key=day item=dayinfo}
			<td align="center">
			{if $dayinfo.number > -1}
				{if $dayinfo.number == 0}
					{$day}
				{else}
					<a class="mngmntlink calendar_mngmntlink" href="{link action=viewday time=$dayinfo.ts}" title="{$dayinfo.ts|format_date:"%A, %B %e, %Y"}" alt="{$dayinfo.ts|format_date:"%A, %B %e, %Y"}"><b>{$day}</b></a>
				{/if}
			{else}
				&nbsp;
			{/if}
			</td>
		{/foreach}
	</tr>
{/foreach}
</table>
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewmonth}" title="{#i18n_viewmonthof#} {$now|format_date:"%B"}" alt="{#i18n_viewmonthof#} {$now|format_date:"%B"}">{#i18n_viewmonth#}</a>
<br />
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.post == 1}
<a class="mngmntlink calendar_mngmntlink" href="{link action=edit}" title="{#i18n_create_desc#}" alt="{#i18n_create_desc#}">{#i18n_create#}</a><br />
{/if}
{if $in_approval != 0 && $canview_approval_link == 1}
<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=summary}" title="{#i18n_viewapprovals_desc#}" alt="{#i18n_viewapprovals_desc#}">{#i18n_viewapprovals#}</a><br />
{/if}
{/permissions}
<br />

{if $modconfig->enable_categories == 1}
<a href="{link module=categories m=calendarmodule action=manage}" class="mngmntlink calendar_mngmntlink">{#i18n_managecategories#}</a>
{/if}