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
 * $Id: _checksums.tpl,v 1.2 2005/02/19 00:32:34 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header info_header">{#i18n_file#}</td>
		<td class="header info_header">{#i18n_checksum#}</td>
	</tr>
{if $error == ""}
{foreach from=$files key=file item=oldmd5}
	{capture assign=relpath}{$relative[$file].dir}{$relative[$file].file}{/capture}
	{assign var=csum value=$checksums[$file]}
	{if $csum == ""}{assign var=csum value="&lt;no checksum - transient file&gt;"}{/if}
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