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
 * $Id: _mimetypes.tpl,v 1.4 2005/02/19 00:32:32 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">{#i18n_header#}<br /><br />
To add support for a MIME type, use the <a class="mngmntlink administration_mngmntlink" href="{link module=filemanager action=admin_editmimetype}">New MIME Type</a> form.
</div>
<table cellpadding="2" cellspacing="0" border="0" width="100%">
<tr>
	<td class="header administration_header">{#i18n_type#}</td>
	<td class="header administration_header">{#i18n_name#}</td>
	<td align="center" class="header administration_header">{#i18n_icon#}</td>
	<td class="header administration_header"></td>
</tr>
{foreach from=$types item=type}
<tr class="row {cycle values='odd,even'}_row">
<td><b>{$type->mimetype}</b></td>
<td>{$type->name}</td>
<td align ="center">
	{if $type->icon != ""}
	<img class="mngmnt_icon" src="{$smarty.const.MIMEICON_RELATIVE}{$type->icon}"/>
	{else}
	(no icon)
	{/if}
</td>
<td>
	<a class="mngmntlink administration_mngmntlink" href="{link module=filemanager action=admin_editmimetype type=$type->mimetype}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" /></a>
	<a class="mngmntlink administration_mngmntlink" href="{link module=filemanager action=admin_deletemimetype type=$type->mimetype}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" /></a>
</td>
</tr>
{/foreach}
</table>
<br />
<a class="mngmntlink administration_mngmntlink" href="{link module=filemanager action=admin_restoremimetypes}">{#i18n_restore#}</a>