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
 * $Id: Expanding\040Hierarchy.tpl,v 1.6 2005/04/26 04:41:40 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<table cellpadding="1" cellspacing="0" border="0" width="100%">
{foreach from=$sections item=section}
{assign var=commonParent value=0}
{foreach from=$current->parents item=parentId}
	{if $parentId == $section->id || $parentId == $section->parent}
		{assign var=commonParent value=1}
	{/if}
{/foreach}
{if $section->numParents == 0 || $commonParent || $section->id == $current->id ||  $section->parent == $current->id}
<tr><td style="padding-left: {math equation="x*20" x=$section->depth}px">
{if $section->active == 1}
<a href="{$section->link}" class="navlink"{if $section->new_window} target="_blank"{/if}>{$section->name}</a>&nbsp;
{else}
<span class="navlink">{$section->name}</span>&nbsp;
{/if}
</td></tr>
{/if}
{/foreach}
</table>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $canManage == 1}
[ <a class="navlink" href="{link action=manage}">{#i18n_manage#}</a> ]
{/if}
{/permissions}