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
 * $Id: Default.tpl,v 1.9 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
{foreach from=$banners item=banner}
<a href="{$smarty.const.URL_FULL}modules/bannermodule/banner_click.php?id={$banner->id}">
<img class="mngmnt_icon" src="{$smarty.const.PATH_RELATIVE}{$banner->file->directory}/{$banner->file->filename}" border="0" />
</a>
<br />
{/foreach}
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.manage && $noupload != 1}
<a class="mngmntlink banner_mngmntlink" href="{link action=ad_edit}">{#i18n_create#}</a>
{/if}
{/permissions}

{if $noupload == 1}
<div class="error">
{#i18n_operation_error#}<br/>
{if $uploadError == $smarty.const.SYS_FILES_FOUNDFILE}{#i18n_operation_error1#}
{elseif $uploadError == $smarty.const.SYS_FILES_NOTWRITABLE}{#i18n_operation_error2#}
{else}{#i18n_operation_errordefault#}
{/if}
</div>
{/if}
