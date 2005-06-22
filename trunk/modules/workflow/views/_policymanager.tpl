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
 * $Id: _policymanager.tpl,v 1.4 2005/02/19 00:32:38 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">{#i18n_header#}</div>
<table cellpadding="2" cellspacing="0" width="100%" border="0">
	<tr>
		<td width="20%" class="header administration_header">{#i18n_policyname#}</td>
		<td class="header administration_header">{#i18n_description#}</td>
		<td width="40" class="header administration_header"></td>
	</tr>
	{foreach from=$policies item=policy}
	<tr class="row {cycle values='odd,even'}_row">
		<td valign="top">
			{$policy->name}
			<br />
			
		</td>
		<td valign="top">{$policy->description}</td>
		<td valign="top">
			<a class="mngmntlink administration_mngmntlink" href="{link action=admin_editpolicy id=$policy->id}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0"/></a>
			<a class="mngmntlink administration_mngmntlink" href="{link action=admin_confirmdeletepolicy id=$policy->id}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0"/></a>
			<a class="mngmntlink administration_mngmntlink" href="{link action=admin_viewactions id=$policy->id}">{#i18n_manage#}<
			<br />
		</td>
	</tr>
	{foreachelse}
		<tr><td colspan="3" align="center" style="font-style: italic">{#i18n_noitemsfound#}</td></tr>
	{/foreach}
	<tr><td colspan="3">
		<a class="mngmntlink administration_mngmntlink" href="{link action=admin_editpolicy}">{#i18n_create#}</a>
	</td></tr>
</table>