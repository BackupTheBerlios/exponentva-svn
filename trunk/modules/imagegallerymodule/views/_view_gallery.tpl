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
 * $Id: _view_gallery.tpl,v 1.10 2005/04/08 19:25:08 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UI_LEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstoitem_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
{assign var=boxw value=$gallery->box_size}
{assign var=boxh value=$gallery->box_size}
{math equation="x+10" x=$gallery->box_size assign=boxtop}
{$gallery->name}
{permissions level=$smarty.const.UI_LEVEL_NORMAL}
{if $permissions.edit == 1}
<a href="{link action=edit_gallery id=$gallery->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" /></a>
{/if}
{/permissions}
<br />
{$gallery->description}
<hr size="1" />
Page {$currentpage} of {$totalpages}<br />
{$totalimages} image{if $totalimages != 1}s{/if} in gallery.
<br />
{permissions level=$smarty.const.UI_LEVEL_NORMAL}
{if $permissions.manage == 1}
<form method="post" action="">
<input type="hidden" name="module" value="imagegallerymodule" />
<input type="hidden" name="action" value="sort_images" />
<input type="hidden" name="gid" value="{$gallery->id}" />
<select name="sorting">
	<option value="pathos_sorting_byNameAscending">{#i18n_sortbynameasc#}</option>
	<option value="pathos_sorting_byNameDescending">{#i18n_sortbynamedesc#}</option>
	<option value="pathos_sorting_byPostedAscending">{#i18n_sortbycreationdateasc#}</option>
	<option value="pathos_sorting_byPostedDescending">{#i18n_sortbycreationdatedesc#}</option>
</select>
<input type="submit" value="{#i18n_submit#}" />
</form>
{/if}
{/permissions}
<table cellspacing="0" cellpadding="0" border="0">
{foreach from=$table item=row}
	<tr>
		{foreach from=$row item=image}
			<td valign="bottom" align="center" style="padding: 1em">
				{if $image->newwindow == 0}
				<a href="{link action=view_image id=$image->id}">
					<img border="0" src="thumb.php?base={$smarty.const.BASE}&file={$image->file->directory}/{$image->file->filename}&height={$boxw}&width={$boxw}&constraint=1" alt="{$image->name}" title="{$image->name}" />
				</a>
				<br />
				<a href="{link action=view_image id=$image->id}">{$image->name}</a>
				{else}
				<a href="" onClick="window.open('{$image->file->directory}/{$image->file->filename}','image','title=no,status=no,scrollbars=yes'); return false;">
					<img border="0" src="thumb.php?base={$smarty.const.BASE}&file={$image->file->directory}/{$image->file->filename}&height={$boxw}&width={$boxw}&constraint=1" alt="{$image->name}" title="{$image->name}" />
				</a>
				<br />
				<a href="" onClick="window.open('{$image->file->directory}/{$image->file->filename}','image','title=no,status=no,scrollbars=yes');">{$image->name}</a>
				{/if}
				<br />
				{permissions level=$smarty.const.UI_LEVEL_NORMAL}
					{if $permissions.manage == 1}
					{if $smarty.foreach.i.first == false}
					{math equation="x-1" x=$image->rank assign=prevrank}
					<a class="mngmntlink imagegallery_mngmntlink" href="{link action=order_images gid=$gallery->id a=$image->rank b=$prevrank}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}left.png" />
					</a>
					{/if}
					<a class="mngmntlink imagegallery_mngmntlink" href="{link action=edit_image id=$image->id}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" />
					</a>
					<a class="mngmntlink imagegallery_mngmntlink" href="{link action=delete_image id=$image->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
					</a>
					{if $smarty.foreach.i.last == false}
					{math equation="x+1" x=$image->rank assign=nextrank}
					<a class="mngmntlink imagegallery_mngmntlink" href="{link action=order_images gid=$gallery->id a=$image->rank b=$nextrank}">
						<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}right.png" />
					</a>
					{/if}
					<br />
					{/if}
				{/permissions}
			</td>
		{/foreach}
	</tr>
{/foreach}
</table>
<div style="clear: both; border-top: 2px dashed lightgrey">
{if $currentpage != 1}<a href="{link action=view_gallery id=$gallery->id page=$prevpage view=$__view}">{#i18n_previous#}</a>{/if}
{if $currentpage != 1 && $currentpage != $totalpages}&nbsp;&nbsp;|&nbsp;&nbsp;{/if}
{if $currentpage != $totalpages}<a href="{link action=view_gallery id=$gallery->id page=$nextpage view=$__view}">{#i18n_next#}</a>{/if}
{permissions level=$smarty.const.UI_LEVEL_NORMAL}
{if $permissions.manage == 1}
<br />
<br />
<script type="text/javascript">
{literal}
function validate(frm) {
	var num = parseInt(frm.count.value);
	
	if (num <= 0 || isNaN(num)) {
		alert("{#i18n_positivenumbersonly_alert#}");
		return false;
	}
	
	if (num > 25) num = 25;
	
	frm.count.value = num;
	return true;
}
{/literal}
</script>
<form method="get" onSubmit="return validate(this)">
<input type="hidden" name="module" value="imagegallerymodule" />
<input type="hidden" name="src" value="{$__loc->src}" />
<input type="hidden" name="gid" value="{$gallery->id}" />
<input type="hidden" name="action" value="upload_multiple" />
{#i18n_uploadmultiplefiles#}: <input type="text" size="3" name="count" value="3" /><input name="Submit" type="submit" value="{#i18n_submit#}" />
</form>
{/if}
{/permissions}
</div>