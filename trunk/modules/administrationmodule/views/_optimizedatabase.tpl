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
 * $Id: _optimizedatabase.tpl,v 1.2 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#}</div>
<div class="form_header">{#i18n_header#}</div>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
<tr><td class="header administration_header">{#i18n_name#}</td><td class="header administration_header" align="right">{#i18n_size#} (kb)</td></tr>
{foreach from=$before key=table item=info}
	<tr class="row {cycle values='odd,even'}_row">
	<td>{$table}</td>
	<td align="right">{math format="%.3f" equation="x / 1024" x=$info->data_total} kb</td>
	<!--
	<td align="right">{math format="%.3f" equation="x / 1024" x=$before[$table]->data_total} kb</td>
	<td align="right">{math format="%.3f" equation="a-b" a=$info->data_total b=$before[$table]->data_total} kb</td>
	-->
	</tr>
{/foreach}
</table>