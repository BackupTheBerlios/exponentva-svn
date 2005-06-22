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
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
 <div>
{math equation="x-1" x=$current->rank assign="prevrank"}
{if $prevrank < 0}
	{#i18n_previous#}
{else}
	{foreach from=$sections item=section}
	{if $section->parent ==$current->parent && $section->rank==$prevrank}
	<a href="{$section->link}"{if $section->new_window} target="_blank"{/if}>{#i18n_previous#}</a>
	{/if}
	{/foreach}
{/if}

&nbsp;|&nbsp;

{if $current->parent == 0}
	{#i18n_up}
{else}
	<a href="?section={$current->parent}">{#i18n_up#}</a>
	&nbsp;|&nbsp;
	<a href="?section={$current->parents[0]}">{#i18n_top#}</a>
{/if}

&nbsp;|&nbsp;

{math equation="x+1" x=$current->rank assign="nextrank"}
{assign var=gotlink value=0}
{foreach from=$sections item=section }
{if $section->parent == $current->parent && $section->rank == $nextrank}
<a href="{$section->link}"{if $section->new_window} target="_blank"{/if}>{#i18n_next#}</a>
{assign var=gotlink value=1}
{/if}
{/foreach}
{if $gotlink == 0}
{#i18n_next#}
{/if}
</div>