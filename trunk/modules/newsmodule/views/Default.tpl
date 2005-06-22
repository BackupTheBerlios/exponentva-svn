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
 * $Id: Default.tpl,v 1.9 2005/04/07 23:20:08 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/newsmodule.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/newsmodule.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}

{if $moduletitle != ""}<div class="moduletitle news_moduletitle">{$moduletitle}</div>{/if}
{foreach from=$news item=newsitem}
	<div>
		<div class="itemtitle news_itemtitle">{$newsitem->title}</div>
		{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
		{if $permissions.administrate == true || $newsitem->permissions.administrate == true}
			<a href="{link action=userperms int=$newsitem->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstoitem_desc#}" alt="{#i18n_assignuserpermissionstoitem_desc#}" /></a>&nbsp;
			<a href="{link action=groupperms int=$newsitem->id _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstoitem_desc#}" alt="{#i18n_assigngrouppermissionstoitem_desc#}" /></a>
		{/if}
		{/permissions}
		{permissions level=$smarty.const.UILEVEL_NORMAL}
		{if $permissions.edit_item == true || $newsitem->permissions.edit_item == true}
			{if $newsitem->approved == 2} {* in ap *}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.disabled.png" title="{#i18n_editdisabledinapproval_desc#}" alt="{#i18n_editdisabledinapproval_desc#}" />
			{else}
			<a class="mngmntlink news_mngmntlink" href="{link action=edit id=$newsitem->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" /></a>
			{/if}
		{/if}
		{if $permissions.delete_item == true || $newsitem->permissions.delete_item == true}
			{if $newsitem->approved == 2} {* in ap *}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.disabled.png" title="{#i18n_deletedisabledinapproval_desc#}" alt="{#i18n_deletedisabledinapproval_desc#}" />
			{else}
			<a onClick="return confirm('{#i18n_delete_confirm#}');" class="mngmntlink news_mngmntlink" href="{link action=delete id=$newsitem->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" /></a>
			{/if}
		{/if}
		{if $permissions.manage_approval == 1}
			<a class="mngmntlink news_mngmntlink" href="{link module=workflow datatype=newsitem m=newsmodule s=$__loc->src action=revisions_view id=$newsitem->id}" title="{#i18n_viewrevisionhistory_desc#}" alt="{#i18n_viewrevisionhistory_desc#}">{#i18n_revisions#}</a>
		{/if}
		{/permissions}
		<div style="padding-left: 15px;">
		{$newsitem->body|summarize:"html":"para"}
		</div>
	</div>
	{if $smarty.const.MEANINGFUL_URLS}
	<a class="mngmntlink news_mngmntlink" href="{$smarty.const.URL_FULL}content/news/{$newsitem->internal_name}">{#i18n_more#}</a>
	{else}
	<a class="mngmntlink news_mngmntlink" href="{$smarty.const.URL_FULL}content/news.php?id={$newsitem->id}">{#i18n_more#}</a>
	{/if}
	<br /><br />
{/foreach}
{if $morenews == 1}
<a href="{link action=view_all_news}">{#i18n_morenews#}</a>
{/if}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.add_item == true}
	<br /><a class="mngmntlink news_mngmntlink" href="{link action=edit}">{#i18n_create#}</a>
{/if}
{if $in_approval > 0 && $canview_approval_link == 1}
	<br /><a class="mngmntlink news_mngmntlink" href="{link module=workflow datatype=newsitem m=newsmodule s=$__loc->src action=summary}">{#i18n_viewapprovals#}</a>
{/if}
{if $permissions.view_unpublished == 1}
	<br /><a class="mngmntlink news_mngmntlink" href="{link action=view_expired}">{#i18n_unpublishedexpirednews#}</a>
{/if}
{if $permissions.manage_channel == 1}
	<br /><a class="mngmntlink news_mngmntlink" href="{link action=manage_channel}">{#i18n_sharedcontent#}</a>
	{if $hasNewChannelItems}(new items){/if}
{/if}
{/permissions}
