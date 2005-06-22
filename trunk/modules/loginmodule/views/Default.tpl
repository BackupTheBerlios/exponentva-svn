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
 * $Id: Default.tpl,v 1.4 2005/04/26 04:41:03 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{if $smarty.const.PREVIEW_READONLY == 1}
<i>{#i18n_loggedin_info#}</i><br />
{/if}
{if $loggedin == true || $smarty.const.PREVIEW_READONLY == 1}
<div class="login_welcom">{#i18n_greeting#}, {$displayname}</div>
<a href="{link action=editprofile}">{#i18n_editprofile#}</a><br />
{if $is_group_admin}
<a href="{link action=mygroups}">{#i18n_mygroups#}</a><br />
{/if}
<a href="{link action=changepass}">{#i18n_editpassword#}</a><br />
<a href="{link action=logout}">{#i18n_logout#}</a><br />
{/if}
{if $smarty.const.PREVIEW_READONLY == 1}
<hr size="1" />
<i>{#i18n_loggedout_info#}</i><br />
{/if}
{if $loggedin == false || $smarty.const.PREVIEW_READONLY == 1}
<form method="post" action="">
<input type="hidden" name="action" value="login" />
<input type="hidden" name="module" value="loginmodule" />
<input type="text" name="username" id="login_username" size="15" /><br />
<input type="password" name="password" id="login_password" size="15" /><br />
<input type="submit" value="{#i18n_submit#}" /><br />
</form>
{if $smarty.const.SITE_ALLOW_REGISTRATION == 1}
<a href="{link action=createuser}">{#i18n_create#}</a><br />
<a href="{link action=resetpass}">{#i18n_retrievepassword#}</a><br />
{/if}
{/if}