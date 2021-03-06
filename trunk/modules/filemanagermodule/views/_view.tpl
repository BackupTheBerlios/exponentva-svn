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
 * $Id: _view.tpl,v 1.1 2005/05/04 19:11:32 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{$collection->name}</div>
<div class="form_header">
{$collection->description}
</div>
<script type="text/javascript">
{literal}
	function openWindow(filename,width,height) {
		if (width != 0) {
			width = width+20;
			if (width > 600) width = 600;
		} else {
			width = 400;
		}
		
		if (height != 0) {
			height = height+20;
			if (height > 400) height = 400;
		} else {
			height = 400;
		}
		
		window.open(filename,'image'+Math.random(),'status=no,status=no,width='+width+',height='+height);
		return false;
	}
{/literal}
</script>
<table>
<tr>
	{foreach name=i from=$files item=file}
	{if ($smarty.foreach.i.iteration - 1) mod 5 == 0}
</tr>
<tr>
	{/if}
	<td width="110" height="110" valign="top" align="center"{if $highlight_file == $file->id} id="highlight"{/if}>
		{if $file->is_image}
		<a href="{$smarty.const.PATH_RELATIVE}{$file->directory}/{$file->filename}" onclick="return openWindow('{$smarty.const.PATH_RELATIVE}{$file->directory}/{$file->filename}',{$file->image_width},{$file->image_height});" target="_blank">
			<img src="{$smarty.const.PATH_RELATIVE}thumb.php?id={$file->id}&constraint=1&width=100&height=100" border="0"/>
		</a>
		<br />
		<a href="{$smarty.const.PATH_RELATIVE}{$file->directory}/{$file->filename}" onClick="return openWindow('{$smarty.const.PATH_RELATIVE}{$file->directory}/{$file->filename}',{$file->image_width},{$file->image_height});" target="_blank">
			{$file->name}
		</a>
		{else}
			{getfileicon id=$file->id}
			<br />
			{if $file->name == ''}
				{$file->filename}
			{else}
				{$file->name}
			{/if}
		{/if}
		<a href="{link action=delete id=$file->id}" onclick="return confirm('{#i18n_delete_confirm#}');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" /></a>
	</td>
	{foreachelse}
	<td><i>{#i18n_noitemsfound#}</i></td>
	{/foreach}
</tr>
</table>
<br />
<a href="{link action=upload_file id=$collection->id}">{#i18n_create#}</a>