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
 * $Id: Default.tpl,v 1.3 2005/02/19 16:53:35 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}userperms.gif" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.gif" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}configure.gif" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
<div class="moduletitle listing_moduletitle">{$moduletitle}</div>
<br>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
{foreach name=a from=$listings item=listing}
{math equation="x-1" x=$listing->rank assign=prev}
{math equation="x+1" x=$listing->rank assign=next}
	<td align="center" valign="bottom">
		{if $listing->picpath == ""}
		<i>{#i18n_noitemsfound#}</i>
		{else}
		<a href="{link action=view_listing id=$listing->id}">
			<img border="0" src="{$listing->picpath}"/>
		</a>
		{/if}
		<br>
		{$listing->name}
		<br>
		
		{if $permissions.configure == 1 or $permissions.administrate == 1}
		
		{if $smarty.foreach.a.first == 0}
		<a href="{link action=rank_switch a=$listing->rank b=$prev id=$listing->id}">			
			<img src="{$smarty.const.ICON_RELATIVE}left.gif" border="0"/>
		</a>
		{/if}
			
		<a href="{link action=edit_listing id=$listing->id}" title="{#i18n_edit_desc#}">
			<img border="0" src="{$smarty.const.ICON_RELATIVE}edit.gif" />
		</a>
		<a href="{link action=delete_listing id=$listing->id}" title="{#i18n_delete_desc#}">
			<img border="0" src="{$smarty.const.ICON_RELATIVE}delete.gif" />
		</a>
		
				
		{if $smarty.foreach.a.last == 0}
		<a href="{link action=rank_switch a=$next b=$listing->rank id=$listing->id}">
			<img src="{$smarty.const.ICON_RELATIVE}right.gif" border="0"/>
		</a>
		{/if}
		
		
	</td>
	{/if}
	{if $smarty.foreach.a.iteration mod $__viewconfig.perrow == 0}</tr><tr><td>&nbsp;</td></tr><tr>{/if}
{foreachelse}
	<td align="center"><i>{#i18n_noitemsfound#}</i></td>
{/foreach}
</tr>
</table>

{if $permissions.administrate == 1}
<br>
<a href="{link action=edit_listing}">{#i18n_create#}</a>
<br>
{/if}
