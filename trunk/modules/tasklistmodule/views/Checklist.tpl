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
<form method="post" action="{$smarty.const.SCRIPT_RELATIVE}{$smarty.const.SCRIPT_FILENAME}">
<input type="hidden" name="module" value="tasklistmodule" />
<input type="hidden" name="action" value="update_checklist" />
<input type="hidden" name="src" value="{$__loc->src}" />
<table cellpadding="3" cellspacing="0" border="0" width="100%">
{foreach from=$tasks item=task}
<tr class="row {cycle values=odd_row,even_row}">
	<td width="16"><input name="item[{$task->id}]" type="checkbox" {if $task->completion == 100}checked {/if}/></td>
	<td>{$task->name}</td>
	<td align="right">
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
</tr>
{/foreach}
</table>
<input type="submit" value="{#i18n_submit#}" />
</form>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.create == 1}
<a href="{link action=edit_task}">{#i18n_create#}</a>
{/if}
{/permissions}