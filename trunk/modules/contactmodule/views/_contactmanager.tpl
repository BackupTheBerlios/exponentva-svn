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
 * $Id: _contactmanager.tpl,v 1.2 2005/02/19 00:32:31 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header contact_header">{#i18n_name#}</td>
		<td class="header contact_header">{#i18n_email#}</td>
		<td class="header contact_header">{#i18n_contacttype#}</td>
		<td class="header contact_header">&nbsp;</td>
	</tr>
{foreach from=$contacts item=c}
	<tr>
		<td>{$c->name}</td>
		<td>{$c->email}</td>
		<td>
			{if $c->user_id != 0}
				{#i18n_useraccount#}
			{else}
				{#i18n_manualaddress#}
			{/if}
		</td>
		<td>
			<a class="mngmntlink contact_mngmntlink" href="{link action=edit_contact id=$c->id}">
				<img border="0" src="{$smarty.const.ICON_RELATIVE}edit.gif" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" />
			</a>
			<a class="mngmntlink contact_mngmntlink" href="{link action=delete_contact id=$c->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
				<img border="0" src="{$smarty.const.ICON_RELATIVE}delete.gif" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
			</a>
		</td>
	</tr>
{foreachelse}
	<tr>
		<td><i>{#i18n_noitemsfound#}</i></td>
	</tr>
{/foreach}
</table>
<a class="mngmntlink contact_mngmntlink" href="{link action=edit_contact}">{#i18n_create#}</a>