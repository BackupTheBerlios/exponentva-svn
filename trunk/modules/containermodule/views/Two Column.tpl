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
 * $Id: Two\040Column.tpl,v 1.4 2005/02/19 00:32:31 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_STRUCTURE}
{if ($permissions.administrate == 1 || $permissions.edit_module == 1 || $permissions.delete_module == 1 || $permissions.add_module == 1 || $container->permissions.administrate == 1 || $container->permissions.edit_module == 1 || $container->permissions.delete_module == 1)}
<b>Container Module</b>
<br />
{/if}
{if $hasParent == 0 &&  $permissions.edit_module == 1}{** top level container module **}
<div class="container_editheader">
	{* I.E. requires a 'dummy' div inside of the above div, so that it
	   doesn't just 'lose' the margins and padding. jh 8/23/04 *}
	<div width="100%" style="width: 100%">
	<table width="100%" cellpadding="0" cellspacing="3" border="0" class="container_editheader">
		<tr>
			<td valign="top" class="info">
				Container Module
				<br />{#i18n_shownin#} {$__view} {#i18n_view#}
			</td>
			<td align="right" valign="top">
				{if $permissions.administrate == 1}
					<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
					<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
				{/if}
			
				{if $permissions.edit_module == 1}
					<a href="{link action=edit id=$top->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configuremodule.png" title="{#i18n_editlayout_desc#}" alt="{#i18n_editlayout_desc#}" />
					</a>
				{/if}
			</td>
		</tr>
	</table>
	</div>
</div>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
{viewfile module=$singlemodule view=$singleview var=viewfile}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top" style="padding: 3px;">
	{assign var=container value=$containers.0}
	{assign var=rank value=0}
	{include file=$viewfile}
</td>
<td valign="top" style="padding: 3px;">
	{assign var=container value=$containers.1}
	{assign var=rank value=1}
	{include file=$viewfile}
</td>
</tr>
</table>
