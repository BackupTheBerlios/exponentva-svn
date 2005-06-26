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
 * $Id: _viewmessages.tpl,v 1.6 2005/02/19 00:32:34 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<b>{#i18n_itemsfor#} {$user->firstname} {$user->lastname}</b>
<br />
{$totalMessages} {#i18n_items#}, {$unreadMessages} {#i18n_unread#}.
<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<tr>
		<td class="header inbox_header">{#i18n_subject#}</td>
		<td class="header inbox_header">{#i18n_source#}</td>
		<td class="header inbox_header">{#i18n_senton#}</td>
		<td class="header inbox_header">&nbsp;</td>
	</tr>
{foreach from=$messages item=message}
	<tr>
		<td>
			{if $message->unread == 1}*{/if}
			<a class="mngmntlink inbox_mngmntlink" href="{link action=message id=$message->id}">
				{$message->subject}
			</a>
		</td>
		<td>{$message->from_name}</td>
		<td>{$message->date_sent|format_date:$smarty.const.DISPLAY_DATE_FORMAT}</td>
		<td>
			<a class="mngmntlink inbox_mngmntlink" href="{link action=delete id=$message->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
				<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" title="{#i18n_delete_desc#}" alt="{#i18n_delete_desc#}" />
			</a>
		</td>
	</tr>
{foreachelse}
	<tr>
		<td colspan="4" align="center"><i>{#i18n_noitemsfound#}</i></td>
	</tr>
{/foreach}
</table>
<hr size="1" />
<a class="mngmntlink inbox_mngmntlink" href="{link action=compose}">{#i18n_create#}</a>
<br />
<a class="mngmntlink inbox_mngmntlink" href="{link action=view_contacts}">{#i18n_personalcontacts#}</a>