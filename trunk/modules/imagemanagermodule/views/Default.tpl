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
 * $Id: Default.tpl,v 1.8 2005/03/21 17:15:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{if $show == 1}
{if $permissions.configure == 1 or $permissions.administrate == 1 or $permissions.post == 1 or $permissions.edit == 1 or $permissions.delete == 1 || $smarty.const.PREVIEW_READONLY}
{if $moduletitle != ""}<div class="moduletitle imagemanager_moduletitle">{$moduletitle}</div>{/if}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" title="{#i18n_editconfig_desc#}" alt="{#i18n_editconfig_desc#}" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header imagemanager_header">{#i18n_preview#}</td>
		<td class="header imagemanager_header">{#i18n_name#}</td>
		<td class="header imagemanager_header">&nbsp;</td>
	</tr>
{foreach from=$items item=item}
{assign var=fid value=$item->file_id}
	<tr>
		<td>
			{if $smarty.const.SELECTOR == 1}
			<a class="mngmntlink imagemanager_mngmntlink" href="{$smarty.const.PATH_RELATIVE}modules/imagemanagermodule/picked.php?url={$files[$fid]->directory}/{$files[$fid]->filename}">
				{if $item->scale == 100}
				<img src="{$smarty.const.PATH_RELATIVE}{$files[$fid]->directory}/{$files[$fid]->filename}" border="0" title="{#i18n_usethis#}" alt="{#i18n_usethis#}"/>
				{else}
				<img src="{$smarty.const.PATH_RELATIVE}thumb.php?base={$smarty.const.BASE}&file={$files[$fid]->directory}/{$files[$fid]->filename}&scale={$item->scale}" border="0" title="{#i18n_usethis#}" alt="{#i18n_usethis#}"/>
				{/if}
			</a>
			{else}
			<a class="mngmntlink imagemanager_mngmntlink" href="{link action=view id=$item->id}">
				{if $item->scale == 100}
				<img src="{$smarty.const.PATH_RELATIVE}{$files[$fid]->directory}/{$files[$fid]->filename}" border="0" title="{#i18n_view_desc#}" alt="{#i18n_view_desc#}"/>
				{else}
				<img src="{$smarty.const.PATH_RELATIVE}thumb.php?base={$smarty.const.BASE}&file={$files[$fid]->directory}/{$files[$fid]->filename}&scale={$item->scale}" border="0" title="{#i18n_view_desc#}" alt="{#i18n_view_desc#}"/>
				{/if}
			</a>
			{/if}
		</td>
		<td>
			{if $smarty.const.SELECTOR == 1}
			<a class="mngmntlink imagemanager_mngmntlink" href="{$smarty.const.PATH_RELATIVE}modules/imagemanagermodule/picked.php?url={$files[$fid]->directory}/{$files[$fid]->filename}" title="{#i18n_usethis#}" alt="{#i18n_usethis#}">
				{$item->name}
			</a>
			{else}
			<a class="mngmntlink imagemanager_mngmntlink" href="{link action=view id=$item->id}">
				{$item->name}
			</a>
			{/if}
		</td>
		<td>
			{permissions level=$smarty.const.UILEVEL_NORMAL}
			{if $permissions.edit == 1}
			<a class="mngmntlink imagemanager_mngmntlink" href="{link action=edit id=$item->id}" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" />
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" />
			</a>
			{/if}
			{if $permissions.delete == 1}
			<a class="mngmntlink imagemanager_mngmntlink" href="{link action=delete id=$item->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
			</a>
			{/if}
			{/permissions}
		</td>
	</tr>
{foreachelse}
	<tr><td align="center" colspan="3"><i>{#i18n_noitemsfound#}</i></td></tr>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.post == 1 && $noupload != 1}
<a class="mngmntlink imagemanager_mngmntlink" href="{link action=edit}">{#i18n_create#}</a>
{/if}
{/permissions}

{if $noupload == 1}
<div class="error">
{#i18n_operation_error#}<br />
{if $uploadError == $smarty.const.SYS_FILES_FOUNDFILE}{#i18n_operation_error1#}
{elseif $uploadError == $smarty.const.SYS_FILES_NOTWRITABLE}{#i18n_operation_error2#}
{else}{#i18n_operation_errordefault#}
{/if}
</div>
{/if}

{else}
{/if}{* If check - show or not *}
{/if}