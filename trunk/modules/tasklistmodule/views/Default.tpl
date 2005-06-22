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
 * $Id: _form_editTask.tpl,v 1.1 2005/02/22 16:43:35 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstoitem_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
<div class="moduletitle tasklist_moduletitle">{$moduletitle}</div>
<table cellpadding="3" cellspacing="0" border="0" width="100%">
{foreach from=$tasks item=task}
<tr class="{cycle values=odd_row,even_row}">
	<td width="16"><input type="checkbox" onClick="return false;" {if $task->completion == 100}checked {/if}/></td>
	<td>{$task->name}</td>
	<td width="40">
		{permissions level=$smarty.const.UILEVEL_NORMAL}
		{if $permissions.edit == 1}
		<a href="{link action=edit_task id=$task->id}">
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
		</a>
		{/if}
		{if $permissions.delete == 1}
		<a href="{link action=delete_task id=$task->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
		</a>
		{/if}
		{/permissions}
	</td>
	<td>
		{if $task->priority > 5}
			<span style="color: red; font-weight: bold;">
			{if $task->priority == 9}!!!!
			{elseif $task->priority == 8}!!!
			{elseif $task->priority == 7}!!
			{elseif $task->priority == 6}!
			{/if}
			</span>
		{/if}
	</td>
	<td>{$task->completion}%</td>
	<td width="50%">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
			<tr>
				{if $task->completion != 0}
				<td width="{$task->completion}%" bgcolor="#00FF00" style="border: 1px solid black;">&nbsp;</td>
				{/if}
				{if $task->left != 0}
				<td width="{$task->left}%" bgcolor="#FF0000" style="border: 1px solid black">&nbsp;</td>
				{/if}
			</tr>
		</table>
	</td>
</tr>
{foreachelse}
<tr><td align="center"><i>{#i18n_noitemsfound#}</i></td></tr>
{/foreach}
</table>
{$num_completed} {plural count=$num_completed singular="task has" plural="tasks have"} been completed.<br />
{$num_uncompleted} {plural count=$num_uncompleted singular="task is" plural="tasks are"} not completed.<br />
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.create == 1}
<a href="{link action=edit_task}">{#i18n_create#}</a>
{/if}
{/permissions}