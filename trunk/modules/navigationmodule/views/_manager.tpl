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
 * $Id: _manager.tpl,v 1.8 2005/04/03 07:57:14 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td class="tab_btn tab_btn_current">
	<a href="{link action=manage}">{#i18n_sitehierarchy#}</a>
</td>
{if $isAdministrator == 1}
<td class="tab_btn tab_btn">
	<a href="{link action=manage_standalone}">{#i18n_standalonepages#}</a>
</td>
<td class="tab_btn">
	<a href="{link action=manage_pagesets}">{#i18n_pagesets#}</a>
</td>
{else}
<td></td>
<td></td>
{/if}
<td class="tab_spacer" width="50%">&nbsp;

</td></tr>
<tr><td colspan="4" class="tab_main">

<div class="moduletitle navigation_moduletitle">{#i18n_formtitle#}</div>
<div class="form_header">
{#i18n_header#}
<br />
<a class="mngmntlink navigation_mngmntlink" href="{link action=add_section parent=0}">{#i18n_createtoppage#}</a>
</div>
<table cellpadding="2" cellspacing="0" border="0" width="100%">
<tr>
	<td class="header navigation_header">{#i18n_name#}</td>
	<td class="header navigation_header"><!-- Add Links --></td>
	<td class="header navigation_header"><!-- Edit/Delete Links --></td>
	<td class="header navigation_header"><!-- Permission Links --></td>
	<td class="header navigation_header"><!-- Ranking Links --></td>
</tr>
{foreach from=$sections item=section}
{math equation="x+1" x=$section->rank assign=nextrank}
{math equation="x-1" x=$section->rank assign=prevrank}
<tr class="row {cycle values=odd_row,even_row}"><td style="padding-left: {math equation="x*20" x=$section->depth}px">
{if $section->active}
<a href="{link section=$section->id}" class="navlink">{$section->name}</a>&nbsp;
{else}
{$section->name}&nbsp;
{/if}
</td><td>
{if $section->alias_type == 0 && $section->canManage == 1}
<a class="mngmntlink navigation_mngmntlink" href="{link action=add_section parent=$section->id}">{#i18n_create#}</a>
{/if}
</td><td>
{if $section->canManage == 1}
{if $section->alias_type == 0}
<a class="mngmntlink navigation_mngmntlink" href="{link action=edit_contentpage id=$section->id}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0"></a>
<a class="mngmntlink navigation_mngmntlink" href="{link action=remove id=$section->id}" onClick="return confirm('{#i18n_deletecontentpage_confim#}');"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0"></a>
{elseif $section->alias_type == 1}
{* External Link *}
<a class="mngmntlink navigation_mngmntlink" href="{link action=edit_externalalias id=$section->id}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0"></a>
<a class="mngmntlink navigation_mngmntlink" href="{link action=delete id=$section->id}" onClick="return confirm('{#i18n_delete_confirm#}');"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0"></a>
{else}
{* Internal Alias *}
<a class="mngmntlink navigation_mngmntlink" href="{link action=edit_internalalias id=$section->id}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0"></a>
<a class="mngmntlink navigation_mngmntlink" href="{link action=delete id=$section->id}" onClick="return confirm('{#i18n_delete_confirm#}');"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0"></a>
{/if}
{/if}
</td><td>
{if $section->canAdmin == 1}
	<a href="{link int=$section->id action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="Assign user permissions for viewing this page" alt="Assign user permissions for this page" /></a>
	<a href="{link int=$section->id action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="Assign group permissions for viewing this page" alt="Assign group permissions for this page" /></a>
{/if}
</td><td>
{if $section->canManageRank == 1}
{if $section->last == 0}
	<a href="{link action=order parent=$section->parent a=$section->rank b=$nextrank}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.png" border="0" /></a>
{else}
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.disabled.png" border="0" />
{/if}
{if $section->first == 0}
	<a href="{link action=order parent=$section->parent a=$section->rank b=$prevrank}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.png" border="0" /></a>
{else}
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.disabled.png" border="0" />
{/if}
{/if}
</td></tr>
{/foreach}
</table>

</td></tr>
</table>