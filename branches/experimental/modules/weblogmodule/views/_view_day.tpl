{*
 * Copyright (c) 2004-2006 OIC Group, Inc.
 * Written and Designed by James Hunt
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * GPL: http://www.gnu.org/licenses/gpl.txt
 *
 *}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="Assign user permissions on this Weblog" alt="Assign user permissions on this Weblog" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="Assign group permissions on this Weblog" alt="Assign group permissions on this Weblog" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" title="Change the configuration of this Weblog" alt="Change the configuration of this Weblog" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
{foreach from=$posts item=post}
<div>
<div class="itemtitle weblog_itemtitle">{$post->title}{if $post->is_draft} <span class="draft">(Draft)</span>{/if}
<br />
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1 || $post->permissions.administrate == 1}
<a href="{link action=userperms _common=1 int=$post->id}">
	<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="Assign permissions on this Weblog Post" alt="Assign permissions on this Weblog Post" />
</a>
<a href="{link action=groupperms _common=1 int=$post->id}">
	<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="Assign group permissions on this Weblog Post" alt="Assign group permissions on this Weblog Post" />
</a>
{/if}
{/permissions}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.edit == 1 || $post->permissions.edit == 1}
<a class="mngmntlink weblog_mngmntlink" href="{link action=post_edit id=$post->id}">
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="Edit this Weblog Post" alt="Edit this Weblog Post" />
</a>
{/if}
{if $permissions.delete == 1 || $post->permissions.delete == 1}
<a class="mngmntlink weblog_mngmntlink" href="{link action=post_delete id=$post->id}" onClick="return confirm('Are you sure you want to delete this Weblog Post?');">
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="Delete this Weblog Post" alt="Delete this Weblog Post" />
</a>
{/if}
{/permissions}
</div>
<div class="subheader weblog_subheader">Posted by {attribution user_id=$post->poster} on {$post->posted|format_date:$smarty.const.DISPLAY_DATE_FORMAT}</div>
<div>{$post->body}</div>
{if $config->allow_comments}
	<div class="comments" style="padding-left: 35px;">
		{permissions level=$smarty.const.UILEVEL_NORMAL}
		{if $permissions.comment == 1 || $post->permissions.comment == 1}
		<a class="mngmntlink weblog_mngmntlink" href="{link action=comment_edit parent_id=$post->id}">Comment</a>
		{/if}
		{/permissions}
		{foreach from=$post->comments item=comment}
			<div class="weblog_comment">
				<div class="weblog_comment_title">{$comment->title}
				<br />
				{permissions level=$smarty.const.UILEVEL_NORMAL}
				{if $permissions.edit_comments == 1 || $post->permissions.edit_comments == 1}
				<a class="mngmntlink weblog_mngmntlink" href="{link action=comment_edit id=$comment->id parent_id=$post->id}">
					<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" title="Edit this Comment" alt="Edit this Comment" />
				</a>
				{/if}
				{if $permissions.delete_comments == 1 || $post->permissions.delete_comments == 1}
				<a class="mngmntlink weblog_mngmntlink" href="{link action=comment_delete id=$comment->id parent_id=$post->id}" onClick="return confirm('Are you sure you want to delete this Comment?');">
					<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" title="Delete this Comment" alt="Delete this Comment" />
				</a>
				{/if}
				{/permissions}
				</div>
				<div class="weblog_comment_attribution">Posted by {attribution user_id=$comment->poster} on {$comment->posted|format_date:$smarty.const.DISPLAY_DATE_FORMAT}</div>
				<div class="weblog_comment_body">{$comment->body}</div>
			</div>
		{/foreach}
	</div>
{/if}
<hr size="1" />
</div>
{/foreach}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.post == 1}
<a class="mngmntlink weblog_mngmntlink" href="{link action=post_edit}">New Post</a>
{/if}
{/permissions}