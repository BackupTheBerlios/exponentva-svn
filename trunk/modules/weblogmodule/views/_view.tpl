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
 * $Id: _view.tpl,v 1.3 2005/04/25 15:30:23 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{*
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" title="{#i18n_editconfig_desc#}" alt="{#i18n_editconfig_desc#}" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
*}

<div>
<div class="itemtitle weblog_itemtitle">{$this_post->title}{if $post->is_draft} <span class="draft">(Draft)</span>{/if}</div>
<br />
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1 || $this_post->permissions.administrate == 1}
<a href="{link action=userperms _common=1 int=$this_post->id}">
	<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstomodule_desc#}" alt="{#i18n_assignuserpermissionstomodule_desc#}" />
</a>
<a href="{link action=groupperms _common=1 int=$this_post->id}">
	<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" />
</a>
{/if}
{/permissions}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.edit == 1 || $this_post->permissions.edit == 1}
<a class="mngmntlink weblog_mngmntlink" href="{link action=edit_post id=$this_post->id}">
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" />
</a>
{/if}
{if $permissions.delete == 1 || $this_post->permissions.delete == 1}
<a class="mngmntlink weblog_mngmntlink" href="{link action=post_delete id=$this_post->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
</a>
{/if}
{/permissions}
</div>
<div class="subheader weblog_subheader">{#i18n_createdby#} {attribution user_id=$this_post->poster} {#i18n_on#} {$this_post->posted|format_date:$smarty.const.DISPLAY_DATE_FORMAT}</div>
<div>{$this_post->body}</div>
{if $config->allow_comments}
	<div class="comments" style="padding-left: 35px;">
	{if $post->is_draft}
		<i>{#i18n_operation_disabled#}</i>
	{else}
		{permissions level=$smarty.const.UILEVEL_NORMAL}
		{if $permissions.comment == 1 || $this_post->permissions.comment == 1}
		<a class="mngmntlink weblog_mngmntlink" href="{link action=comment_edit parent_id=$this_post->id}">Comment</a>
		{/if}
		{/permissions}
		{foreach from=$this_post->comments item=comment}
			<div class="weblog_comment">
				<div class="weblog_comment_title">{$comment->title}
				<br />
				{permissions level=$smarty.const.UILEVEL_NORMAL}
				{if $permissions.edit_comments == 1 || $this_post->permissions.edit_comments == 1}
				<a class="mngmntlink weblog_mngmntlink" href="{link action=comment_edit id=$comment->id parent_id=$this_post->id}">
					<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" />
				</a>
				{/if}
				{if $permissions.delete_comments == 1 || $this_post->permissions.delete_comments == 1}
				<a class="mngmntlink weblog_mngmntlink" href="{link action=comment_delete id=$comment->id parent_id=$this_post->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
					<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
				</a>
				{/if}
				{/permissions}
				</div>
				<div class="weblog_comment_attribution">Posted by {attribution user_id=$comment->poster} on {$comment->posted|format_date:$smarty.const.DISPLAY_DATE_FORMAT}</div>
				<div class="weblog_comment_body">{$comment->body}</div>
			</div>
		{/foreach}
	{/if}
	</div>
{/if}
</div>
{if $prev_post != 0}
	&lt;&lt;<a class="mngmntlink weblog_mngmntlink" href="{link action=view id=$prev_post->id}">{$prev_post->title}</a>&nbsp;&nbsp;
{/if}
{if $next_post != 0}
	<a class="mngmntlink weblog_mngmntlink" href="{link action=view id=$next_post->id}">{$next_post->title}</a>&gt;&gt;
{/if}
<br />

{if $prev_post != 0}
	{if $smarty.const.MEANINGFUL_URLS}
	&lt;&lt;<a class="mngmntlink weblog_mngmntlink" href="{$smarty.const.URL_FULL}content/blog/{$prev_post->internal_name}">{$prev_post->title} ((SEF))</a>&nbsp;&nbsp;
	{else}
	&lt;&lt;<a class="mngmntlink weblog_mngmntlink" href="{$smarty.const.URL_FULL}content/blog.php?id={$prev_post->id}">{$prev_post->title}</a>&nbsp;&nbsp;
	{/if}
{/if}
{if $next_post != 0}
	{if $smarty.const.MEANINGFUL_URLS}
	<a class="mngmntlink weblog_mngmntlink" href="{$smarty.const.URL_FULL}content/blog/{$next_post->internal_name}">{$next_post->title} ((SEF))</a>&gt;&gt;
	{else}
	<a class="mngmntlink weblog_mngmntlink" href="{$smarty.const.URL_FULL}content/blog.php?id={$next_post->id}">{$next_post->title}</a>&gt;&gt;
	{/if}
{/if}