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
 * $Id: Default.tpl,v 1.7 2005/04/08 15:45:48 filetreefrog Exp $
 *}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="Assign permissions on this Module"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="Assign group permissions on this Module"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{/permissions}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="Configure this Module"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}

<div class="moduletitle bb_moduletitle">{$moduletitle}</div>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
{foreach from=$boards item=board}
<tr class="bb_boardrow">
	<td valign="top" class="bb_boardtitle">
		<b><a class="mngmntlink bb_mngmntlink" href="{link module="bbmodule" action="view_board" id=$board->id}">{$board->name}</a></b>
		&nbsp;( {$board->num_topics} thread{if $board->num_topics != 1}s{/if} )
	{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
	{if $permissions.administrate == 1}
		<a href="{link action=userperms _common=1}" title="Assign permissions on this Module"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
		<a href="{link action=groupperms _common=1}" title="Assign group permissions on this Module"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
	{/if}
	{/permissions}
	{permissions level=$smarty.const.UILEVEL_NORMAL}
	{if $permissions.edit_board == 1 || $board->permissions.edit_board == 1}
	<a href="{link action=edit_board id=$board->id}">
		<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0"/>
	</a>
	{/if}
	{if $permissions.delete_board == 1 || $board->permissions.delete_board == 1}
	<a href="{link action=delete_board id=$board->id}">
		<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0"/>
	</a>
	{/if}
	{/permissions}
	</td><td class="bb_boardlastpost">
	{if $board->last_post == null}
		<i>No Posts</i>
		{else}
		{$board->last_post->posted|format_date:"%D %T"} by {attribution user=$board->last_post->poster} :: <a class="mngmntlink bb_mngmntlink" href="{link action=view_thread id=$board->last_post->id}">View</a>
		{/if}
		</td></tr>
	<tr><td colspan="2" class="bb_boarddesc">
	{$board->description}</td>
</tr>
{foreachelse}
<tr>
	<td><i>No bulletin boards were found</i></td>
</tr>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.create_board == 1}
<a class="mngmntlink bb_mngmntlink" href="{link action=edit_board}">New Board</a>
{/if}
{/permissions}