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
 *}
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewday time=$prevday}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}left.png" title="Previous Day" alt="Previous Day" /></a>
<span style="font-weight: bold; font-size: 16px">{$now|format_date:"%A, %B %e, %Y"}</span>
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewday time=$nextday}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}right.png" title="Next Day" alt="Next Day" /></a>
<br />
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewweek time=$now}" title="View Entire Week" alt="View Entire Week">View Week</a>
<br /><hr size="1" />
<table cellpadding="2" cellspacing="0" width="100%" border="0">
{assign var=count value=0}
{foreach from=$events item=event}
	{assign var=count value=1}
	<tr><td style="padding-left: 15px">
		<a class="mngmntlink calendar_mngmntlink" href="{link action=view id=$event->id date_id=$event->eventdate->id}">{$event->title}</a>
		{if $permissions.administrate == 1 || $event->permissions.administrate == 1}
			<a href="{link action=userperms int=$event->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="Assign user permissions on this Calendar Event" alt="Assign user permissions on this Calendar Event" /></a>&nbsp;
			<a href="{link action=groupperms int=$event->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="Assign group permissions on this Calendar Event" alt="Assign group permissions on this Calendar Event" /></a>
		{/if}
		{if $permissions.edit == 1 || $event->permissions.edit == 1}
			{if $event->approved == 1}
			<a href="{link action=edit id=$event->id date_id=$event->eventdate->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" title="Edit this Calendar Event" alt="Edit this Calendar Event" /></a>&nbsp;
			{else}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.disabled.png" title="Editting Disabled - Calendar Event In Approval" alt="Editting Disabled - Calendar Event In Approval" />
			{/if}
		{/if}
		{if $permissions.delete == 1 || $event->permissions.delete == 1}
			{if $event->approved == 1}
				{if $event->is_recurring == 0}
				<a href="{link action=delete id=$event->id}" onClick="return confirm('Are you sure you want to delete this Calendar Event?');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="Delete this Calendar Event" alt="Delete this Calendar Event" /></a>
				{else}
				<a href="{link action=delete_form date_id=$event->eventdate->id id=$event->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="Delete this Calendar Event" alt="Delete this Calendar Event" /></a>
				{/if}
			{else}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.disabled.png" title="Deleting Disabled - Calendar Event In Approval" alt="Deleting Disabled - Calendar Event In Approval" />
			{/if}
		{/if}
		{if $permissions.manage_approval == 1}
			<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=revisions_view id=$event->id}" title="View Revision History for this Calendar Event" alt="View Revision History for this Calendar Event">Revisions</a>
		{/if}
		<div style="padding-left: 10px">
			<b>{if $event->is_allday == 1}All Day{else}
			{$event->eventstart|format_date:"%l:%M %P"} - {$event->eventend|format_date:"%l:%M %P"}
			{/if}</b><br />
			{$event->body|summarize:"html":"para"}
		</div>
	</td></tr>
{/foreach}
{if $count == 0}
	<tr><td><i>No Events</i></td></tr>
{/if}
</table>