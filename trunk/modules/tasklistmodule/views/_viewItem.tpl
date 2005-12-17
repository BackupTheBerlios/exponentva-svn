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
 * $Id: _viewarticle.tpl,v 1.3 2005/03/13 18:57:28 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="item_title">{$item->title}</div>
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.manage == 1}
	<a href="{link action=edit_task id=$item->id}"><img border="0" class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" /></a>
	<a href="{link action=delete_task id=$item->id}" onClick="return confirm('{#i18n_delete_confirm#}');"><img border="0" class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" /></a>
{/if}
{/permissions}
<br><br>
<div class="item_description">
{$item->body}
</div>