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
 * $Id: _view.tpl,v 1.9 2005/02/19 00:32:30 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{if $permissions.administrate == 1 || $item->permissions.administrate == 1}
	<a href="{link action=userperms int=$item->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
	<a href="{link action=groupperms int=$item->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
{/if}
{if $permissions.edit == 1 || $item->permissions.edit == 1}
	{if $item->approved == 1}
	<a href="{link action=edit id=$item->id date_id=$item->eventdate->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" /></a>&nbsp;
	{else}
	<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.disabled.png" title="{#i18n_editdisabledinapproval_desc#}" alt="{#i18n_editdisabledinapproval_desc#}" />
	{/if}
{/if}
{if $permissions.delete == 1 || $item->permissions.delete == 1}
	{if $item->approved == 1}
		{if $item->is_recurring == 0}
		<a href="{link action=delete id=$item->id}" onClick="return confirm('{#i18n_delete_confirm#}');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" /></a>
		{else}
		<a href="{link action=delete_form date_id=$item->eventdate->id id=$item->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" /></a>
		{/if}
	{else}
	<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.disabled.png" title="{#i18n_deletedisabledinapproval_desc#}" alt="{#i18n_deletedisabledinapproval_desc#}" />
	{/if}
{/if}
{if $permissions.manage_approval == 1}
	<a class="mngmntlink calendar_mngmntlink" href="{link module=workflow datatype=calendar m=calendarmodule s=$__loc->src action=revisions_view id=$item->id}" title="{#i18n_viewrevisionhistory_desc#}" alt="{#i18n_viewrevisionhistory_desc#}">{#i18n_revisions#}</a>
{/if}
{if $permissions.administrate == 1 || $item->permissions.administrate == 1 || $permissions.delete == 1 || $item->permissions.delete == 1 || $permissions.edit == 1 || $item->permissions.edit == 1}
<br />
{/if}
<h3>{$item->title}</h3>
{if $item->is_allday == 1}
{$item->eventstart|format_date:$smarty.const.DISPLAY_DATE_FORMAT}, {#i18n_allday#}
{else}
{$item->eventstart|format_date:"%B %e, %Y, %l:%M %P"} - {$item->eventend|format_date:"%l:%M %P"}
{/if}
<hr size="1" />
{$item->body}
{if $item->body}
<br />
<hr size="1" />
{/if}
{$form}
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewweek time=$item->eventstart}" title="{#i18n_viewweek_desc#}" alt="{#i18n_viewweek_desc#}">{#i18n_viewweek#}</a>&nbsp;|&nbsp;
<a class="mngmntlink calendar_mngmntlink" href="{link action=viewmonth time=$item->eventstart}" title="{#i18n_viewmonth_desc#}" alt="{#i18n_viewmonth_desc#}">{#i18n_viewmonth#}</a><br />