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
 * $Id: Default.tpl,v 1.9 2005/04/18 01:36:36 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
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
{if $moduletitle != ""}<div class="moduletitle resource_moduletitle">{$moduletitle}</div>{/if}
<table cellspacing="0" cellpadding="4" border="0" width="100%" rules="rows" frame="hsides" style="border: 1px solid lightgrey">
{foreach name=loop from=$resources item=resource}
{assign var=id value=$resource->id}
{assign var=fid value=$resource->file_id}
<tr>
	<td valign="top" width="22">
		{if $__viewconfig.show_icons == 1 && $files[$fid]->mimetype->icon != ""}
		<img src="{$smarty.const.MIMEICON_RELATIVE}{$files[$fid]->mimetype->icon}"/>
		{/if}
	</td>
	<td valign="top">
		<a class="mngmntlink resources_mngmntlink" href="{link action=view id=$resource->id}">{$resource->name}</a>
		{if $__viewconfig.direct_download == 1}
		 - <a class="mngmntlink resources_mngmntlink" href="{$smarty.const.PATH_RELATIVE}{$files[$fid]->directory}/{$files[$fid]->filename}">{#i18n_download#}</a>
		{/if}
		<br />
		{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
		{if $permissions.administrate == 1 || $resource->permissions.administrate == 1}
		<a class="mngmntlink resources_mngmntlink" href="{link action=userperms int=$resource->id _common=1}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}userperms.png" border="0" title="{#i18n_assignuserpermissionstoitem_desc#}" alt="{#i18n_assignuserpermissionstoitem_desc#}" /></a>
		<a class="mngmntlink resources_mngmntlink" href="{link action=groupperms int=$resource->id _common=1}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}groupperms.png" border="0" title="{#i18n_assigngrouppermissionstoitem_desc#}" alt="{#i18n_assigngrouppermissionstoitem_desc#}" /></a>
		{/if}
		{/permissions}
		{permissions level=$smarty.const.UILEVEL_NORMAL}
		{if $permissions.edit == 1 || $resource->permissions.edit == 1}
		<a class="mngmntlink resources_mngmntlink" href="{link action=edit id=$resource->id}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" /></a>
		{/if}
		{if $permissions.delete == 1 || $resource->permissions.delete == 1}
		<a class="mngmntlink resources_mngmntlink" href="{link action=delete id=$resource->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
		</a>
		{/if}
		{if $permissions.edit == 1}
		{math assign=thisrank equation="x-1" x=$smarty.foreach.loop.iteration}
		{math assign=prevrank equation="x-2" x=$smarty.foreach.loop.iteration}
		{if $smarty.foreach.loop.first != true}{* move up *}
		<a class="mngmntlink resources_mngmntlink" href="{link action=order a=$thisrank b=$prevrank}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.png" border="0" title="{#i18n_up_desc#}" alt="{#i18n_up_desc#}" />
		</a>
		{else}
		<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.disabled.png" border="0" title="{#i18n_cantup_desc#}" alt="{#i18n_cantup_desc#}" />
		{/if}
		
		{if $smarty.foreach.loop.last != true}{* move down *}
		<a class="mngmntlink resources_mngmntlink" href="{link action=order a=$thisrank b=$smarty.foreach.loop.iteration}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.png" border="0" title="{#i18n_down_desc#}" alt="{#i18n_down_desc#}" />
		</a>
		{else}
		<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.disabled.png" border="0" title="{#i18n_cantdown_desc#}" alt="{#i18n_cantdown_desc#}" />
		{/if}
		{/if}
		{/permissions}
		{if $__viewconfig.show_descriptions == 1}
		<div style="padding-left: 20px;">
			{$resource->description}
		</div>
		{/if}
	</td>
</tr>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.post == 1 && $noupload != 1}
<a class="mngmntlink resources_mngmntlink" href="{link action=edit}">{#i18n_create#}</a>
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