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
 * $Id: _modulemanager.tpl,v 1.2 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">{#i18n_header#}
<br /><br />
To install a new module, use the <a class="mngmntlink administration_mngmntlink" href="{link action=upload_extension}">{#i18n_upload#}</a> form.</div>
<hr size="1" />
<a href="{link action=modmgr_activate all=1 activate=1}">{#i18n_unlockall#}</a>
&nbsp;&nbsp;|&nbsp;&nbsp;
<a href="{link action=modmgr_activate all=1 activate=0}">{#i18n_lockall#}</a>
<table cellpadding="4" cellspacing="0" border="0" width="100%">
	{foreach from=$modules item=module}
	<tr>
		<td class="administration_modmgrheader"><b>{$module->name}</b> by {$module->author}</td>
		<td class="administration_modmgrheader" align="right">{if $module->active == 1}<span class="active">{#i18n_unlocked#}</span>{else}<span class="inactive">{#i18n_locked#}</span>{/if}</td>
	</tr>
	<tr>
		<td colspan="3" class="administration_modmgrbody">
			{if $module->active == 1}
			<a class="mngmntlink administration_mngmntlink" href="{link action=modmgr_activate mod=$module->class activate=0}">{#i18n_lock#}</a> {#i18n_lock_info#}
			{else}
			<a class="mngmntlink administration_mngmntlink" href="{link action=modmgr_activate mod=$module->class activate=1}">{#i18n_unlock#}</a> {#i18n_unlock_info#}
			{/if}
			<br />
			<a class="mngmntlink administration_mngmntlink" href="{link module=info action=showfiles type=$smarty.const.CORE_EXT_MODULE name=$module->class}">{#i18n_view#}</a>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a class="mngmntlink administration_mngmntlink" href="{link action=examplecontent name=$module->class}">{#i18n_manage#}</a>
			<hr size="1"/>
			{$module->description}
		</td>
	</tr>
	<tr><td></td></tr>
	{/foreach}
</table>