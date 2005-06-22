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
 * $Id: _cat_manageCategories.tpl,v 1.5 2005/02/19 00:32:30 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">
{#i18n_header#}
</div>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr>
	<td class="header" width="40">&nbsp;</td>
	<td class="header">Name</td>
	<td class="header"></td>
</tr>
{foreach name=a from=$categories item=category}
{math equation="x-2" x=$smarty.foreach.a.iteration assign=prev}
{math equation="x-1" x=$smarty.foreach.a.iteration assign=this}
{assign var=next value=$smarty.foreach.a.iteration}
<tr class="row {cycle values=odd_row,even_row}">
	<td>
		<div style="width: 32px; height: 16px; background-color: {$category->color}">&nbsp;</div>
	</td>
	<td>
		<b>{$category->name}</b>		
	</td>
	<td align="right">
		<a href="{link module=categories action=edit id=$category->id orig_module=$origmodule}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" />
		</a>
		<a href="{link module=categories action=delete id=$category->id orig_module=$origmodule}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" />
		</a>	
		{if $smarty.foreach.a.first == 0}
		<a href="{link action=rank_switch a=$this b=$prev id=$category->id orig_module=$origmodule}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.png" border="0"/>
		</a>
		{else}
		<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.disabled.png" border="0"/>
		{/if}
		
		{if $smarty.foreach.a.last == 0}
		<a href="{link action=rank_switch a=$next b=$this id=$category->id orig_module=$origmodule}">
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.png" border="0"/>
		</a>
		{else}
			<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.disabled.png" border="0"/>
		{/if}
		
	</td>
<tr>
{foreachelse}
<tr>
	<td colspan="2" align="center"><i>{#i18n_noitemsfound#}</i></td>
</tr>
{/foreach}
</table>
<br /><br />
<a href="{link module=categories action=edit orig_module=$origmodule}" class="mngmntlink mngmntlink">{#i18n_create#}</a>