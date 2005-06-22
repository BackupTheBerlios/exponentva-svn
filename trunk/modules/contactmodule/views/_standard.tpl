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
 * $Id: _standard.tpl,v 1.4 2005/02/19 00:32:31 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" title="{#i18n_assignuserpermissionstoitem_desc#}" alt="{#i18n_assignuserpermissionstoitem_desc#}" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" title="{#i18n_assigngrouppermissionstomodule_desc#}" alt="{#i18n_assigngrouppermissionstomodule_desc#}" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 || $permissions.administrate == 1}
<br />
{/if}
{/permissions}
