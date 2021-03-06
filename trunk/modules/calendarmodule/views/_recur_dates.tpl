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
 * $Id: _recur_dates.tpl,v 1.5 2005/02/19 00:32:30 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{foreach from=$dates item=d}
<tr class="row {cycle values='even_row,odd_row'}">
	<td width="10">
		<input type="checkbox" name="dates[{$d->id}]" {if $d->id == $checked_date->id}checked {/if}/>
	</td>
	<td>
		{$d->date|format_date:$smarty.const.DISPLAY_DATE_FORMAT}
	</td>
</tr>
{/foreach}
<tr>
	<td colspan="2">
	{literal}
		<script type="text/javascript">
		function recur_selectUnselectAll(setChecked) {
			var elems = document.getElementsByTagName("input")
			for (key = 0; key < elems.length; key++) {
				if (elems[key].type == "checkbox" && elems[key].name.substr(0,6) == "dates[") {
					elems[key].checked = setChecked;
				}
			}
		}
		</script>
	{/literal}
		<a class="mngmntlink calendar_mngmntlink" href="#" onClick="recur_selectUnselectAll(true); return false;">{#i18n_selectall#}</a>
		&nbsp;/&nbsp;
		<a class="mngmntlink calendar_mngmntlink" href="#" onClick="recur_selectUnselectAll(false); return false;">{#i18n_unselectall#}</a>
	</td>
</tr>