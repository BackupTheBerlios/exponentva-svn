{*
 *
 * Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
 * All Changes as of 6/1/05 Copyright 2005 James Hunt
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
 * $Id: _view.tpl,v 1.6 2005/11/22 01:16:11 filetreefrog Exp $
 *}
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
	<a class="mngmntlink resources_mngmntlink" href="{link action=userperms int=$resource->id _common=1}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}userperms.png" border="0" title="{$_TR.alt_userperm}" alt="{$_TR.alt_userperm}" /></a>
	<a class="mngmntlink resources_mngmntlink" href="{link action=groupperms int=$resource->id _common=1}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}groupperms.png" border="0" title="{$_TR.alt_groupperm}" alt="{$_TR.alt_groupperm}" /></a>
	{/if}
	{/permissions}
	{permissions level=$smarty.const.UILEVEL_NORMAL}
	{if $permissions.edit == 1 || $resource->permissions.edit == 1}
	<a class="mngmntlink resources_mngmntlink" href="{link action=edit id=$resource->id}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="{$_TR.alt_edit}" alt="{$_TR.alt_edit}" /></a>
	{/if}
	{if $permissions.delete == 1 || $resource->permissions.delete == 1}
	<a class="mngmntlink resources_mngmntlink" href="{link action=delete id=$resource->id}" onClick="return confirm('{$_TR.delete_confirm}');">
		<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="{$_TR.alt_delete}" alt="{$_TR.alt_delete}" />
	</a>
	{/if}
	<br />
	{if $resource->locked != 0 && $resource->flock_owner != $user->id && ($permissions.edit == 1 || $resource->permissions.edit == 1)}
	<i>
	{capture assign=name}{$resource->lock_owner->firstname} {$resource->lock_owner->lastname}{/capture}
	{$_TR.locked_by|sprintf:$name}
	{if $user->is_acting_admin != 1}
	{$_TR.no_change}
	{/if}
	</i>
	<br />
	{elseif $resource->locked != 0 && $resource->flock_owner == $user->id}
	<i>{$_TR.you_locked}</i>
	<br />
	{/if}
	<a class="mngmntlink resources_mngmntlink" href="{$smarty.const.PATH_RELATIVE}{$file->directory}/{$file->filename}">{$_TR.download}</a>
	{if $permissions.edit == 1 || $resource->permissions.edit == 1}
	{if $resource->locked == 0}
	&nbsp;|&nbsp;
	<a class="mngmntlink resources_mngmntlink" href="{link action=updatefile id=$resource->id}">{$_TR.update}</a>
	&nbsp;|&nbsp;
	<a class="mngmntlink resources_mngmntlink" href="{link action=changelock id=$resource->id}">{$_TR.lock}</a>
	{elseif $resource->flock_owner == $user->id || $user->is_acting_admin == 1}
	&nbsp;|&nbsp;
	<a class="mngmntlink resources_mngmntlink" href="{link action=updatefile id=$resource->id}">{$_TR>update}</a>
	&nbsp;|&nbsp;
	<a class="mngmntlink resources_mngmntlink" href="{link action=changelock id=$resource->id}">{$_TR.unlock}</a>
	{/if}
	{/if}
	{if $permissions.manage_approval == 1 || $resource->permissions.manage_approval == 1}
		&nbsp;|&nbsp;
		<a class="mngmntlink news_mngmntlink" href="{link module=workflow datatype=resourceitem m=resourcesmodule s=$__loc->src action=revisions_view id=$resource->id}">
			{$_TR.revisions}
		</a>
	{/if}
	{/permissions}
</td></tr>
</table>
<div style="padding-left: 20px;">
{$resource->description}
</div>