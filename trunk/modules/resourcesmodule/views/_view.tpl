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
 * $Id: _view.tpl,v 1.5 2005/02/19 00:32:36 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<table>
<tr><td width="22" valign="top">
	{if $mimetype->icon != ""}
	<img src="{$smarty.const.MIMEICON_RELATIVE}{$mimetype->icon}"/>
	{/if}
</td>
<td>
	<b>{$resource->name}</b><br />
	{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
	{if $permissions.administrate == 1 || $resource->permissions.administrate == 1}
	<a class="mngmntlink resources_mngmntlink" href="{link action=userperms int=$resource->id _common=1}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}userperms.png" border="0" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>
	<a class="mngmntlink resources_mngmntlink" href="{link action=groupperms int=$resource->id _common=1}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}groupperms.png" border="0" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
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
	<br />
	{if $resource->locked != 0 && $resource->flock_owner != $user->id && ($permissions.edit == 1 || $resource->permissions.edit == 1)}
	<i>
	{#i18n_lockedby#} {$resource->lock_owner->firstname} {$resource->lock_owner->lastname}
	{if $user->is_acting_admin != 1}
	<i>{#i18n_lock_info#}</i>
	{/if}
	</i>
	<br />
	{elseif $resource->locked != 0 && $resource->flock_owner == $user->id}
	<i>{#i18n_locked_info#}</i>
	<br />
	{/if}
	<a class="mngmntlink resources_mngmntlink" href="{$smarty.const.PATH_RELATIVE}{$file->directory}/{$file->filename}">{#i18n_download#}</a>
	{if $permissions.edit == 1 || $resource->permissions.edit == 1}
	{if $resource->locked == 0}
	&nbsp;|&nbsp;
	<a class="mngmntlink resources_mngmntlink" href="{link action=updatefile id=$resource->id}">{#i18n_update#}</a>
	&nbsp;|&nbsp;
	<a class="mngmntlink resources_mngmntlink" href="{link action=changelock id=$resource->id}">{#i18n_lock#}</a>
	{elseif $resource->flock_owner == $user->id || $user->is_acting_admin == 1}
	&nbsp;|&nbsp;
	<a class="mngmntlink resources_mngmntlink" href="{link action=updatefile id=$resource->id}">{#i18n_update#}</a>
	&nbsp;|&nbsp;
	<a class="mngmntlink resources_mngmntlink" href="{link action=changelock id=$resource->id}">{#i18n_unlock#}</a>
	{/if}
	{/if}
	{if $permissions.manage_approval == 1 || $resource->permissions.manage_approval == 1}
		&nbsp;|&nbsp;
		<a class="mngmntlink news_mngmntlink" href="{link module=workflow datatype=resourceitem m=resourcesmodule s=$__loc->src action=revisions_view id=$resource->id}">
			{#i18n_revisions#}
		</a>
	{/if}
	{/permissions}
</td></tr>
</table>
<div style="padding-left: 20px;">
{$resource->description}
</div>