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
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="Assign permissions on this Calendar Module" alt="Assign permissions on this Calendar Module"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="Assign group permissions on this Calendar Module" alt="Assign group permissions on this Calendar Module"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="Configure this Calendar Module" alt="Configure this Calendar Module"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{/permissions}
<table cellspacing="0" cellpadding="0" width="100%" style="border: 1px solid #DDD; border-collapse: collapse" rules="all" class="calendar_monthly">
<tbody>
<tr><td align="left">
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewmonth time=$prevmonth}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}left.png" title="Previous Month" alt="Previous Month" /></a>
</td>
<td align="center" valign="top" colspan="5">{if $moduletitle != ""}{$moduletitle} {/if}{$now|format_date:"%B %Y"}</td>
<td align="right">
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewmonth time=$nextmonth}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}right.png" title="Next Month" alt="Next Month" /></a>
</td></tr>
<tr>
	<td align="center" style="font-weight:bold">Sunday</td>
	<td align="center" style="font-weight:bold">Monday</td>
	<td align="center" style="font-weight:bold">Tuesday</td>
	<td align="center" style="font-weight:bold">Wednesday</td>
	<td align="center" style="font-weight:bold">Thursday</td>
	<td align="center" style="font-weight:bold">Friday</td>
	<td align="center" style="font-weight:bold">Saturday</td>
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
<a class="mngmntlink calendar_mngmntlink" href="{link action=edit id=0}" title="Create a new Calendar Event" alt="Create a new Calendar Event">Create Event</a>
{/if}
{if $in_approval != 0 && $canview_approval_link == 1}
<br />
<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=CalendarModule s=$__loc->src action=summary}" title="View Calendar Events in Approval" alt="View Calendar Events in Approval">View Approval</a>
{/if}
{if $modconfig->enable_categories == 1}
{if $permissions.manage_categories == 1}
<br />
<a href="{link module=categories orig_module=CalendarModule action=manage}" class="mngmntlink calendar_mngmntlink">Manage Categories</a>
{else}
<br />
<a class="mngmntlink calendar_mngmntlink" href="#" onClick="window.open('{$smarty.const.PATH_RELATIVE}popup.php?module=categories&m={$__loc->mod}&action=view&src={$__loc->src}','legend','width=200,height=200,title=no,status=no'); return false" title="View Event Categories" alt="View Event Categories">View Categories</a>
{/if}
{/if}
{/permissions}