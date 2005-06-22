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
 * $Id: _editQuestion.tpl,v 1.1 2005/04/10 23:24:02 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr><td class="header">{#i18n_question#}</td>
<td class="header">{#i18n_active#}</td>
<td class="header">{#i18n_openresults#}</td>
<td class="header">{#i18n_openvoting#}</td>
<td class="header"></td>
</tr>
{foreach from=$questions item=question}
<tr class="row {cycle values=odd_row,even_row}"><td>
<a href="{link action=manage_question id=$question->id}">{$question->question}</a>
({$question->answer_count} {plural plural=answers singular=answer count=$question->answer_count})
</td><td>
{if $question->is_active}{#i18n_yes#}{else}{#i18n_no#}{/if}
</td><td>
{if $question->open_results}{#i18n_yes#}{else}{#i18n_no#}{/if}
</td><td>
{if $question->open_voting}{#i18n_yes#}{else}{#i18n_no#}{/if}
</td><td>
<a href="{link action=activate_question id=$question->id}">Activate</a>
<a href="{link action=edit_question id=$question->id}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}edit.png" /></a>
<a href="{link action=delete_question id=$question->id}" onClick="return confirm('{#i18n_delete_confirm#}');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" /></a>
</td></tr>
{foreachelse}
<tr><td colspan="2" align="center"><i>{#i18n_noitemsfound#}</i></td></tr>
{/foreach}
</table>
<br />
<a href="{link action=edit_question}">{#i18n_create#}</a>
