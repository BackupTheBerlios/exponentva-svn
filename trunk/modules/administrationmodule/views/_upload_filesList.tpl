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
 * $Id: _upload_filesList.tpl,v 1.2 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{assign var=haveFiles value=1}
{assign var=failed value=0}
{assign var=warn value=0}
<table cellpadding="0" cellspacing="0" width="100%" border="0">
<tr>
	<td class="header administration_header">File</td>
	<td class="header administration_header">Status</td>
	<td class="header administration_header"></td>
</tr>
{foreach from=$files item=file}
<tr>
	<td>{$file.absolute}</td>
	<td>
	{if $file.canCreate == $smarty.const.SYS_FILES_SUCCESS}
	<span style="color: green;">passed</span>
	{elseif $file.canCreate == $smarty.const.SYS_FILES_FOUNDFILE || $file.canCreate == $smarty.const.SYS_FILES_FOUNDDIR}
	{assign var=warn value=1}
	<span style="color: orange;">file exists</span>
	{else}
	{assign var=failed value=1}
	<span style="color: red;">failed</span>
	{/if}
	</td>
	<td>
	{if $file.ext == "tpl" || $file.ext == "php"}
	{capture assign="filearg"}{$smarty.const.PATH_RELATVE}{$relative}{$file.absolute}{/capture}
		<a class="mngmntlink administration_mngmntlink" href="{link module=filemanager action=viewcode file=$filearg}">
			{if $file.ext == "tpl"}View Template{else}View PHP Code{/if}
		</a>
	{/if}
	</td>
</tr>
{foreachelse}
{assign var=haveFiles value=0}
<tr><td colspan="3">
<i>No files were found in the archive</i>
</td></tr>
{/foreach}
</table>
{if $haveFiles == 1}
<br />
<hr size="1" />
{if $failed == 0}
{if $warn == 1}<b>Note:</b> Continuing with the installation will overwrite existing files.  It is <b>highly recommended</b> that you ensure that you want to do this.<br /><br />{/if}
To install these files on the website, click <a class="mngmntlink administration_mngmntlink" href="{link action=finish_install_extension}">continue</a>.
{else}
Permissions on the webserver are preventing the installation of this extension.  Please make the necessary directories writable, and then reload this page to continue.
{/if}
{/if}