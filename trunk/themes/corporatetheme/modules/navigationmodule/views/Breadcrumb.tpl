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
 * $Id: Breadcrumb.tpl,v 1.3 2005/02/19 00:37:08 filetreefrog Exp $
 *}
 
<tr>
	<td style="background-image: url({$smarty.const.THEME_RELATIVE}images/title_bg.gif); padding: 10px;" height="25">
	<img src="{$smarty.const.THEME_RELATIVE}images/doublearrow.gif" align="middle" hspace="5"/>
{assign var=i value=0}
{foreach from=$sections item=section}
{if $current->parents[$i] == $section->id || $current->id == $section->id}
{math equation="x+1" x=$i assign=i}
{if $section->active == 1}
<a class="mngmntlink navigation_mngmntlink" href="{$section->link}" class="navlink">{$section->name}</a>&nbsp;
{else}
<span class="navlink">{$section->name}</span>&nbsp;
{/if}
{if $section->id != $current->id}
	<img src="{$smarty.const.THEME_RELATIVE}images/slash.gif" align="middle" hspace="5" />
{/if}
{/if}
{/foreach}
	</td>
</tr>