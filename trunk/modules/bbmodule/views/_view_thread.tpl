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
 * $Id: _view_thread.tpl,v 1.7 2005/04/08 15:45:49 filetreefrog Exp $
 *}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	{capture assign=int}p{$thread->id}{/capture}
	<a href="{link action=userperms _common=1 int=$int}" title="Assign permissions on this Thread"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1 int=$int}" title="Assign group permissions on this Thread"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{/permissions}
<table cellspacing="0" cellpadding="0" border="0"width="100%" style="border-bottom: 2px solid black;">
	<tr class="bb_threadrow">
		<td class="bb_posttitle"><a name="bb{$thread->id}"></a>{$thread->subject}</td>
		<td align="right">&nbsp;
			{permissions level=$smarty.const.UILEVEL_NORMAL}
			{if $permissions.delete_thread == 1}
				<a class="mngmntlink bb_mngmntlink" href="{link action=delete_post id=$thread->id}">
					<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
				</a>
			{/if}
			{if $permissions.edit_post == 1}
				<a class="mngmntlink bb_mngmntlink" href="{link action=edit_post id=$thread->id}">
					<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
				</a>
			{/if}
			{if $permissions.reply == 1}
				<a class="mngmntlink bb_mngmntlink" href="{link action=edit_post parent=$thread->id}">
					Post Reply
				</a>
			{/if}
			{/permissions}
		</td>
	</tr>
	<tr class="bb_threadcreditrow">
		<td class="bb_postcredit" colspan="2">
		Posted on {$thread->posted|format_date:"%D %T"} by {attribution user=$thread->poster}
		{if $thread->editted != 0}
		<br />Editted on {$thread->editted|format_date:"%D %T"} by {attribution user=$thread->editor}
		{/if}
		</td>
	</tr>
	<tr class="bb_threadbodyrow">
		<td class="bb_postbody" colspan="2">
			{$thread->body}
		</td>
	</tr>
	{foreach from=$replies item=reply}
		<tr class="bb_threadrow">
			<td class="bb_replytitle"><a name="bb{$reply->id}"></a>{$reply->subject}&nbsp;</td>
			<td align="right">&nbsp;
				{permissions level=$smarty.const.UILEVEL_NORMAL}
				{if $permissions.delete_thread == 1}
					<a class="mngmntlink bb_mngmntlink" href="{link action=delete_post id=$reply->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
					</a>
				{/if}
				{if $permissions.edit_post == 1}
					<a class="mngmntlink bb_mngmntlink" href="{link action=edit_post id=$reply->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
					</a>
				{/if}
				{if $permissions.reply == 1}
					<a class="mngmntlink bb_mngmntlink" href="{link action=edit_post parent=$reply->id}">
						Post Reply
					</a>
				{/if}
				{/permissions}
			</td>
		</tr>
		<tr class="bb_threadcreditrow">
			<td class="bb_replycredit" colspan="2">
			Posted on {$reply->posted|format_date:"%D %T"} by {attribution user=$reply->poster}
			{if $reply->editted != 0}
			<br />Editted on {$reply->editted|format_date:"%D %T"} by {attribution user=$reply->editor}
			{/if}
			</td>
		</tr>
		<tr class="bb_threadbodyrow">
			<td class="bb_replybody" colspan="2">
				{$reply->body}
			</td>
		</tr>
	{/foreach}
</table>
<a class="mngmntlink bb_mngmntlink" href="{link action=view_board id=$thread->board_id}">Back to Board</a>
<br /><br />
{if $loggedin == 1}
{if $monitoring == 1}
You are monitoring this thread for new replies.
<br /><a class="mngmntlink bb_mngmntlink" href="{link action=monitor_thread id=$thread->id monitor=0}">Click here</a> to stop monitoring it.
{else}
You are not monitoring this thread.
<br /><a class="mngmntlink bb_mngmntlink" href="{link action=monitor_thread id=$thread->id monitor=1}">Click here</a> to start monitoring it for new replies.
{/if}
{/if}