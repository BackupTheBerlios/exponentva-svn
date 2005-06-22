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
 * $Id: Breadcrumb.tpl,v 1.5 2005/05/05 19:11:26 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{assign var=i value=0}
{foreach from=$sections item=section}
{if $current->numParents <= $i && ($current->id == $section->id || $current->parents[$i] == $section->id)}
{math equation="x+1" x=$i assign=i}
{if $section->active == 1}
<a class="mngmntlink navigation_mngmntlink" href="{$section->link}" class="navlink"{if $section->new_window} target="_blank"{/if}>{$section->name}</a>&nbsp;
{else}
<span class="navlink">{$section->name}</span>&nbsp;
{/if}
{if $section->id != $current->id}<b> > </b>{/if}
{/if}
{/foreach}