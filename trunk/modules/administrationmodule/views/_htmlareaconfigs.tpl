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
 * $Id: _htmlareaconfigs.tpl,v 1.4 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">{#i18n_header#}
<br /><br />
To create a new toolbar, use the <a class="mngmntlink administration_mngmntlink" href="{link action=htmlarea_editconfig id=0}">{#i18n_create#}</a> form.
</div>
<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header administration_header">{#i18n_name#}</td>
		<td class="header administration_header">{#i18n_active#}?</td>
		<td class="header administration_header"></td>
	</tr>
	{foreach from=$configs item=config}
		<tr>
			<td>{$config->name}</td>
			<td>
				{if $config->active == 1}<b>{#i18n_yes#}</b>{else}{#i18n_no#}{/if}
			</td>
			<td>
				<a class="mngmntlink administration_mngmntlink" href="{link action=htmlarea_editconfig id=$config->id}">
					<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" />
				</a>
				{if $config->active == 0}
				<a class="mngmntlink administration_mngmntlink" href="{link action=htmlarea_deleteconfig id=$config->id}">
					<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" />
				</a>
				{else}
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.disabled.png" border="0" />
				{/if}
			</td>
		</tr>
	{foreachelse}
		<tr>
			<td colspan="2" align="center">
				<i>{#i18n_noitemsfound#}</i>
			</td>
		</tr>
	{/foreach}
</table>