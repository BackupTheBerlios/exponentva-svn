{*
 *
 * Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
 * All Changes as of 6/1/05 Copyright 2005 James Hunt
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
 * $Id: _checksums.tpl,v 1.3 2005/11/22 01:16:09 filetreefrog Exp $
 *}
<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header info_header">{$_TR.file}</td>
		<td class="header info_header">{$_TR.checksum}</td>
	</tr>
{if $error == ""}
{foreach from=$files key=file item=oldmd5}
	{capture assign=relpath}{$relative[$file].dir}{$relative[$file].file}{/capture}
	{assign var=csum value=$checksums[$file]}
	{if $csum == ""}{assign var=csum value=$_TR.no_md5}{/if}
	<tr class="row {cycle values=even_row,odd_row}">
		<td>{$relative[$file].dir}<b><a href="{link module=filemanager action=viewcode file=$relpath}">{$relative[$file].file}</a></b></td>
		{if $checksums[$file] == $oldmd5}
		<td style="color: green;">{$csum}</td>
		{else}
		<td style="color: red;">{$csum}</td>
		{/if}
	</tr>
{/foreach}
{else}
	<tr>
		<td align="center" colspan="2"><i>{$error}</i></td>
	</tr>
{/if}
</table>