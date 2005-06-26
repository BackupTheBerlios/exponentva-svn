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
 * $Id: _viewmessage.tpl,v 1.3 2005/02/19 00:32:34 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<b>{$message->subject}</b>
<div style="padding: 5px; background-color: #CCC;">
{#i18n_senton#}{$message->date_sent|format_date:$smarty.const.DISPLAY_DATE_FORMAT} {#i18n_by#} {$message->from_name}
</div>
<div style="padding: 5px; background-color: #DDD;">
{$message->body}
</div>
<a class="mngmntlink inbox_mngmntlink" href="{link action=compose replyto=$message->id}">{#i18n_postreply#}</a>
<hr size="1" />
<a class="mngmntlink inbox_mngmntlink" href="{link action=inbox}">{#i18n_back#}</a>