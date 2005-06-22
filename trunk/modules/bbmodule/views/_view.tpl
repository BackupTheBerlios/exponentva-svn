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
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	{capture assign=int}b{$board->id}{/capture}
	<a href="{link action=userperms _common=1 int=$int}" title="{#i18n_assignuserpermissionstoitem_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1 int=$int}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{/permissions}
<div class="moduletitle bb_moduletitle">{$board->name}</div>
<br /><br />
{$board->description}
<br /><br />
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td class="header bb_header">{#i18n_topic#}</td>
	<td class="header bb_header">{#i18n_author#}</td>
	<td class="header bb_header">{#i18n_createdon#}</td>
	<td class="header bb_header">{#i18n_updatedon#}</td>
	<td class="header bb_header">{#i18n_items#}</td>
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
	<td colspan="2"><i>{#i18n_noitemsfound#}</i></td>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.create_thread == 1}
<a class="mngmntlink bb_mngmntlink" href="{link module="bbmodule" action="edit_post" bb=$board->id}">{#i18n_create#}</a>
{/if}
{/permissions}
<br /><br />
{if $loggedin == 1}
{if $monitoring == 1}
{#i18n_monitoring_info#}
<br /><a class="mngmntlink bb_mngmntlink" href="{link action=monitor_thread id=$thread->id monitor=0}">{#i18n_stopmonitoring#}
{else}
{#i18n_notmonitoring_info#}
<br /><a class="mngmntlink bb_mngmntlink" href="{link action=monitor_thread id=$thread->id monitor=1}">{#i18n_startmonitoring#}
{/if}
{/if}