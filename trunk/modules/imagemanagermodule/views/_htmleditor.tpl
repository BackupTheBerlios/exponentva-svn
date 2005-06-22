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
 * $Id: _htmleditor.tpl,v 1.2 2005/02/19 00:32:33 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<script language="javascript" src="{$smarty.const.PATH_RELATIVE}js/ImageManagerHTMLArea.js"></script>
<table cellpadding="2" cellspacing="0" border="0" width="100%" rules="rows" style="bortder: 1px solid lightgrey">
{foreach from=$grid item=row}
	<tr>
	{foreach from=$row item=item}
	{assign var=fid value=$item->file_id}
		<td align="center">
			<a class="mngmntlink imagemanager_mngmntlink" href="" onclick="setContent('{$files[$fid]->directory}/{$files[$fid]->filename}','{$smarty.const.PATH_RELATIVE}'); return false">
				<img src="thumb.php?base={$smarty.const.BASE}&file={$files[$fid]->directory}/{$files[$fid]->filename}&scale={$item->scale}" border="0" />
			</a>
			<br />
			{$item->name}
		</td>
	{/foreach}
	</tr>
{foreachelse}
	<tr><td>{#i18n_noitemsfound#}</td></tr>
{/foreach}
</table>