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
 * $Id: Default.tpl,v 1.6 2005/02/26 05:21:23 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstoitem_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
	<br />
{/if}
{/permissions}
{if $moduletitle != ""}<div class="moduletitle sharedcore_moduletitle">{$moduletitle}</div>{/if}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
{assign var=nocores value=0}
{foreach from=$cores item=core}
	<tr style="background-color: lightgrey;">
		<td>{$core->name} (version {$core->version})</td>
		<td>{$core->path}</td>
		<td>
			{permissions level=$smarty.const.UILEVEL_NORMAL}
			{if $permissions.manage == 1}
			<a class="mngmntlink sharedcore_mngmntlink" href="{link action=edit_core id=$core->id}">
				<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
			</a>
			<a class="mngmntlink sharedcore_mngmntlink" href="{link action=delete_core id=$core->id}">
				<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" onClick="return confirm('{#i18n_delete_confirm#}');" />
			</a>
			{/if}
			{/permissions}
		</td>
	</tr>
	{foreach from=$core->linked item=site}
		<tr>
			<td style="padding-left: 50px">
				{if $site->inactive == 1}
					<i><a target="_blank" class="mngmntlink sharedsite_mngmntlink" href="{$site->host}{$site->relpath}">{$site->name}</a></i>
				{else}
					<a target="_blank" class="mngmntlink sharedsite_mngmntlink" href="{$site->host}{$site->relpath}">{$site->name}</a>
				{/if}
			</td>
			<td>
				{$site->path}
			</td>
			<td>
				{permissions level=$smarty.const.UILEVEL_NORMAL}
				{if $permissions.manage == 1}
				<a class="mngmntlink sharedsite_mngmntlink" href="{link action=edit_site id=$site->id}">
					<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
				</a>
				<a class="mngmntlink sharedsite_mngmntlink" href="{link action=delete_site id=$site->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
					<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
				</a>
				{if $site->inactive == 1}
					<a class="mngmntlink sharedsite_mngmntlink" href="{link action=activate_site id=$site->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}unlock.png" />
					</a>
				{else}
					<a class="mngmntlink sharedsite_mngmntlink" href="{link action=deactivate_form id=$site->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}lock.png" />
					</a>
					<a class="mngmntlink sharedsite_mngmntlink" href="{link action=refresh_site id=$site->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}reload.png" />
					</a>
				{/if}
				{/if}
				{/permissions}
			</td>
		</tr>
	{foreachelse}
		<tr>
			<td colspan="3" style="padding-left: 50px">
				<i>{#i18n_noitemsfound#}</i>
			</td>
		</tr>
	{/foreach}
{foreachelse}
	{assign var=nocores value=1}
	<tr><td align="center"><i>{#i18n_nocoresfound#}</i></td></tr>
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.manage == 1}
<a class="mngmntlink sharedcore_mngmntlink" href="{link action=edit_core}">{#i18n_createcore#}</a>
{if $nocores == 0}
<br />
<a class="mngmntlink sharedcore_mngmntlink" href="{link action=edit_site core_id=$core->id}">{#i18n_create#}</a>
{/if}
{/if}
{/permissions}
