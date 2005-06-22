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
 * $Id: _view.tpl,v 1.7 2005/04/08 15:45:49 filetreefrog Exp $
 *}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	{capture assign=int}b{$board->id}{/capture}
	<a href="{link action=userperms _common=1 int=$int}" title="Assign permissions on this Forum"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1 int=$int}" title="Assign group permissions on this Forum"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{/permissions}
<div class="moduletitle bb_moduletitle">{$board->name}</div>
<br /><br />
{$board->description}
<br /><br />
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td class="header bb_header">Topic</td>
	<td class="header bb_header">Author</td>
	<td class="header bb_header">Posted</td>
	<td class="header bb_header">Last Updated</td>
	<td class="header bb_header">Replies</td>
</tr>
{foreach from=$threads item=thread}
<tr class="row {cycle values=odd_,even_}row">
	<td>
		<a href="{link action=view_thread id=$thread->id}" class="mngmntlink bb_mngmntlink">
			{$thread->subject}
		</a>
	</td>
	<td>{attribution user=$thread->user}</td>
	<td>{$thread->posted|format_date:"%D %T"}</td>
	<td>{$thread->updated|format_date:"%D %T"}</td>
	<td>{$thread->num_replies}</td>
</tr>
{foreachelse}
<tr>
	<td colspan="2"><i>No posts found on this board</i></td>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.create_thread == 1}
<a class="mngmntlink bb_mngmntlink" href="{link module="bbmodule" action="edit_post" bb=$board->id}">Start Thread</a>
{/if}
{/permissions}
<br /><br />
{if $loggedin == 1}
{if $monitoring == 1}
You are monitoring this board for new threads.
<br /><a class="mngmntlink bb_mngmntlink" href="{link action=monitor_board id=$board->id monitor=0}">Click here</a> to stop monitoring it.
{else}
You are not monitoring this board.
<br /><a class="mngmntlink bb_mngmntlink" href="{link action=monitor_board id=$board->id monitor=1}">Click here</a> to start monitoring it for new threads.
{/if}
{/if}