{*
 *
 * Copyright (c) 2005 Dryw Filtiarn, Maxim Mueller
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
 * $Id: Top Nav Dropdown.tpl,v 1.0  dryw_filtiarn Exp $
 * 2005/08/24 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<script type="text/javascript" src="{$smarty.const.PATH_RELATIVE}modules/{$__loc->mod}/js/{$__view}.js"/></script>
<style type="text/css">
	@import url("{$smarty.const.PATH_RELATIVE}modules/{$__loc->mod}/css/{$__view}.css");
	@import url("{$smarty.const.THEME_RELATIVE}modules/{$__loc->mod}/css/{$__view}.css");
</style>
<table class="dropdown_top"> 
	<tr> 
		<td class="dropdown_top_split">|</td> 
		{foreach from=$sections item=section} 
			{if $section->active == 1} 
				{if $section->depth == 0}
					<td class="dropdown_top" onmouseover="showMenu( this, 'menuNav{$section->id}' );" onmouseout="hideMenu( document.getElementById('menuNav{$section->id}') );"> 
						<a href="{$section->link}" class="navlink"{if $section->new_window} target="_blank"{/if}>{$section->name}</a>
					</td>
				{/if} 
			{else}
				<td>
					<span class="navlink">{$section->name}</span>
				</td>
			{/if} 
			
			{if $section->depth == 0} 
				<td class="dropdown_top_split">|</td> 
			{/if} 
		{/foreach}
		 
		{permissions level=$smarty.const.UILEVEL_NORMAL} 
			{if $canManage == 1} 
				<td> 
					[ <a class="navlink" href="{link action=manage}">{#i18n_manage#}</a> ] 
				</td> 
				<td class="dropdown_top_split">|</td> 
			{/if} 
		{/permissions} 
	</tr> 
</table>

{foreach from=$sections item=section} 
	{if $section->depth == 1} 
		{if $started != 1} 
			{assign var=started value=1} 
			<div class="dropdown_menu" id="menuNav{$section->parent}" onmouseover="keepMenu( this );" onmouseout="hideMenu( this );"> 
		{/if}
		<a href="{$section->link}" class="navlink"{if $section->new_window} target="_blank"{/if}>{$section->name}</a><br /> 
	{/if}
	 
	{if $section->depth == 0 && $started == 1} 
		</div> 
		{assign var=started value=0} 
	{/if} 
{/foreach}