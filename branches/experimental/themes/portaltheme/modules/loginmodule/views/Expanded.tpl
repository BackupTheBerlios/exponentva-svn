{*
 * Copyright (c) 2004-2005 OIC Group, Inc.
 * Written and Designed by James Hunt
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * GPL: http://www.gnu.org/licenses/gpl.txt
 *
 *}
{if $smarty.const.PREVIEW_READONLY == 1}
<i>{$logged_in_users}:</i><br />
{/if}
{if $loggedin == true || $smarty.const.PREVIEW_READONLY == 1}
{$_TR.welcome|sprintf:$displayname}<br />
<a href="{link action=editprofile}">{$_TR.edit_profile}</a>&nbsp;|&nbsp;
{if $is_group_admin}
<a href="{link action=mygroups}">{$_TR.my_groups}</a>&nbsp;|&nbsp;
{/if}
<a href="{link action=changepass}">{$_TR.change_password}</a>&nbsp;|&nbsp;
<a href="{link action=logout}">{$_TR.logout}</a><br />
{/if}
{if $smarty.const.PREVIEW_READONLY == 1}
<hr size="1" />
<i>{$_TR.anon_users}:</i><br />
{/if}
{if $loggedin == false || $smarty.const.PREVIEW_READONLY == 1}
<form method="post" action="">
<input type="hidden" name="action" value="login" />
<input type="hidden" name="module" value="loginmodule" />
<table border="0" cellspacing="5px" cellpadding="0">
  <tr>
    <td><input type="text" name="username" id="login_username" size="15" /></td>
    <td><input type="password" name="password" id="login_password" size="15" /></td>
    <td><input type="image" name="imageField" class="loginbutton" src="{$smarty.const.THEME_RELATIVE}/images/buttons/button-login.jpg" width="41px" height="23px"/></td>
	   </tr><tr>
    <td style="text-align:right;" colspan="3">{if $smarty.const.SITE_ALLOW_REGISTRATION == 1}
<a href="{link action=createuser}">{$_TR.create_account}</a>&nbsp;|&nbsp;
<a href="{link action=resetpass}">{$_TR.forgot_password}</a>
{/if}</td>
  </tr>
</table>
</form>
{/if}