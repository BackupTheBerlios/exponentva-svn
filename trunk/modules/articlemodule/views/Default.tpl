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
 * $Id: Default.tpl,v 1.4 2005/03/13 18:57:28 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
<div class="moduletitle article_moduletitle">{$moduletitle}</div>
<br/>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
{foreach name=c from=$data key=catid item=articles}

{if $hasCategories != 0}
<tr><td><hr size="1"></td></tr>
<tr>
	{if $catid != 0}
	<td colspan="2" class="category_title">{$categories[$catid]->name}</td>
	{else}
	<td colspan="2" class="category_title">{#i18n_notcategorized#}</td>
	{/if}
</tr>
<tr><td>&nbsp;</td></tr>
{/if}
{foreach name=a from=$articles item=article}
{assign var=article_found value=0}
	{math equation="x-1" x=$article->rank assign=prev}
	{math equation="x+1" x=$article->rank assign=next}

<!--tr>
	<td colspan="2"><hr size="1"></td></tr-->
<tr>
	<td style="padding-left:1.5em" class="question">
		<a href="{link action=view_article id=$article->id}" class="article_title_link">{$article->title}<br>
	</td>
	{if $permissions.manage == 1}
	<td align="right">
		<a href="{link action=edit_article id=$article->id}" title="{#i18n_edit_desc#}">
			<img border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
		</a>
		<a href="{link action=delete_article id=$article->id}" title="{#i18n_delete_desc#}" onClick="return confirm('{#i18n_delete_confirm#}');">
			<img border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
		</a>	
		{if $smarty.foreach.a.first == 0}
		<a href="{link action=rank_switch a=$article->rank b=$prev id=$article->id category_id=$catid}">			
			<img src="{$smarty.const.ICON_RELATIVE}up.png" border="0"/>
		</a>
		{else}
		<img src="{$smarty.const.ICON_RELATIVE}up.disabled.png" border="0"/>
		{/if}
		
		{if $smarty.foreach.a.last == 0}
		<a href="{link action=rank_switch a=$next b=$article->rank id=$article->id category_id=$catid}">
			<img src="{$smarty.const.ICON_RELATIVE}down.png" border="0"/>
		</a>
		{else}
		<img src="{$smarty.const.ICON_RELATIVE}down.disabled.png" border="0"/>
		{/if}
		
	</td>
	{/if}
<tr>
<tr>
	<td style="padding-left:1.5em" class="article_summary" colspan="2">
		{$article->body|summarize:'html':'para'}
	</td>
</tr>
<tr><td>&nbsp;</td></tr>
{assign var=article_found value=1}

{foreachelse}
{ if ($config->enable_categories == 1 && $catid != 0) || ($config->enable_categories==0)}
<tr>
	<td align="center"><i>{#i18n_noitemsfound#}</i></td>
</tr>
{/if}
{/foreach}
{foreachelse}
{/foreach}
</table>

{if $permissions.manage == 1}
<br>
<a href="{link action=edit_article}">{#i18n_create#}</a>
<br>
{if $config->enable_categories == 1}
<a href="{link module=categories action=manage orig_module=articlemodule}">{#i18n_managecategories#}</a>
{/if}
{/if}
