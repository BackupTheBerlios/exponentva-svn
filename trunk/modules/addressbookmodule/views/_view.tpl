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
 * $Id: _view.tpl,v 1.5 2005/02/19 00:32:28 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<h3>Contact Information : {$contact->firstname} {$contact->lastname}</h3>
{permissions level=$smarty.const.UILEVEL_NORMAL}
	{if $permissions.edit == 1}
	<a class="mngmntlink addressbook_mngmntlink" href="{link action=edit id= $contact->id}">
		<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" title="{#i18n_edit_desc#}" alt="{#i18n_edit_desc#}" />
	</a>
	{/if}
	{if $permissions.delete == 1}
	<a class="mngmntlink addressbook_mngmntlink" href="{link action=delete id=$contact->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
		<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
	</a>
	{/if}
{/permissions}
<hr size='1'/>
<table cellpadding="3" cellspacing="0" border="0" width="100%" />
<tr>
	<td valign="top" width="5%"><b>{#i18n_fullname#}</b></td>
	<td valign="top" width="95%">{$contact->firstname} {$contact->lastname}</td>
</tr>
<tr>
	<td valign="top"><b>{#i18n_address#}</b></td>
	<td valign="top">{$contact->address1}<br />{if $contact->address2 != ''}{$contact->address2}<br />{/if}{$contact->city}, {$contact->state} {$contact->zip}</td>
</tr>
<tr><td colspan="2"><hr size='1'/></td></tr>
<tr>
	<td valign="top"><b>{#i18n_email#}</b></td>
	<td valign="top">{$contact->email|hide_email}</td>
</tr>
<tr>
	<td valign="top"><b>{#i18n_homepage#}</b></td>
	<td valign="top"><a href="{$contact->webpage}" target="_blank">{$contact->webpage}</a></td>
</tr>
<tr><td colspan="2"><hr size='1'/></td></tr>
<tr>
	<td valign="top"><b>{#i18n_phone#}</b></td>
	<td valign="top">{$contact->phone}</td>
</tr>
<tr>
	<td valign="top"><b>{#i18n_mobile#}</b></td>
	<td valign="top">{$contact->cell}</td>
</tr>
<tr>
	<td valign="top"><b>{#i18n_fax#}</b></td>
	<td valign="top">{$contact->fax}</td>
</tr>
<tr>
	<td valign="top"><b>{#i18n_pager#}</b></td>
	<td valign="top">{$contact->pager}</td>
</tr>
<tr><td colspan="2"><hr size='1'/></td></tr>
<tr>
	<td valign="top"><b>{#i18n_notes#}</b></td>
	<td valign="top">{$contact->notes|nl2br}</td>
</tr>
</table>