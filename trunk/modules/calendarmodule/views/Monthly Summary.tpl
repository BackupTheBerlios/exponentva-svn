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
 * $Id: Monthly\040Summary.tpl,v 1.1 2005/04/03 08:10:31 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}" alt="{#i18n_editconfig_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{/permissions}
<table cellspacing="0" cellpadding="0" width="100%" style="border: 1px solid #DDD; border-collapse: collapse" rules="all" class="calendar_monthly">
<tbody>
<tr><td align="left">
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewmonth time=$prevmonth}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}left.png" title="{#i18n_previous#}" alt="{#i18n_previous#}" /></a>
</td>
<td align="center" valign="top" colspan="5">{if $moduletitle != ""}{$moduletitle} {/if}{$now|format_date:"%B %Y"}</td>
<td align="right">
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewmonth time=$nextmonth}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}right.png" title="{#i18n_next#}" alt="{#i18n_next#}" /></a>
</td></tr>
<tr>
	<td align="center" style="font-weight:bold">{#i18n_sunday#}</td>
	<td align="center" style="font-weight:bold">{#i18n_monday#}</td>
	<td align="center" style="font-weight:bold">{#i18n_tuesday#}</td>
	<td align="center" style="font-weight:bold">{#i18n_wednesday#}</td>
	<td align="center" style="font-weight:bold">{#i18n_thursday#}</td>
	<td align="center" style="font-weight:bold">{#i18n_friday#}</td>
	<td align="center" style="font-weight:bold">{#i18n_saturday#}</td>
</tr>
{math equation="x-86400" x=$now assign=dayts}
{foreach from=$monthly item=week key=weeknum}
	<tr class="{if $currentweek == $weeknum}calendar_currentweek{/if}">
		{*foreach name=w from=$week key=day item=events*}
		{foreach from=$week key=day item=dayinfo}
			<td width="14%" align="left" valign="top" style="height: 100px; {if $dayinfo.number == -1}background-color: #EEE;{/if}">
				{if $number != -1}{math equation="x+86400" x=$dayts assign=dayts}{/if}
				{if $dayinfo.number > -1}
					<div style="border-bottom:1px solid lightgrey; padding: 2px; margin-bottom: .25em; background-color: #DDD">{$day}</div>
				{/if}
				{if $dayinfo.number > 0}
					<a class="mngmntlink calendar_mngmntlink" href="{link action=viewday time=$dayinfo.ts}" title="{$dayinfo.ts|format_date:"%A, %B %e, %Y"}" alt="{$dayinfo.ts|format_date:"%A, %B %e, %Y"}">
					{$dayinfo.number} {plural singular=Event plural=Events count=$dayinfo.number}
					</a>
				{/if}
			</td>
		{/foreach}
	</tr>
{/foreach}
</tbody>
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.post == 1}
<a class="mngmntlink calendar_mngmntlink" href="{link action=edit id=0}" title="{#i18n_create_desc#}" alt="{#i18n_create_desc#}">{#i18n_create#}</a>
{/if}
{if $in_approval != 0 && $canview_approval_link == 1}
<br />
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