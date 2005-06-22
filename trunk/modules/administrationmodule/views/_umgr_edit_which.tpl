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
 * $Id: _umgr_edit_which.tpl,v 1.2 2005/02/19 00:32:29 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="form_title">{#i18n_formtitle#} "{$user->firstname} {$user->lastname} ({$user->username})"</div>
<div class="form_caption">{#i18n_header#}</div>
{* Lock / Unlock Account *}
{if $user->is_locked}
<div style="background-color: #CCC; padding: 5px;">
<a class="mngmntlink administration_mngmntlink" href="{link action=umgr_lockuser id=$user->id value=0}">{#i18n_unlock#}</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#i18n_unlock_info#}
</div>
{else}
<div style="background-color: #CCC; padding: 5px;">
<a class="mngmntlink administration_mngmntlink" href="{link action=umgr_lockuser id=$user->id value=1}">{#i18n_lock#}</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#i18n_lock_info#}
</div>
{/if}

<div style="background-color: #CCC; padding: 5px;">
<a class="mngmntlink administration_mngmntlink" href="{link action=umgr_editprofile id=$user->id}">{#18n_edititem#}</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#18n_edititem_info#}
</div>

<div style="background-color: #CCC; padding: 5px;">
<a class="mngmntlink administration_mngmntlink" href="{link action=umgr_clearpass id=$user->id}">{#18n_clearpassword#}</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#18n_clearpassword_info#}
</div>

<div style="background-color: #CCC; padding: 5px;">
<a class="mngmntlink administration_mngmntlink" href="{link action=umgr_membership id=$user->id}">{#i18n_assigntogroup#}</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#i18n_assigntogroup_info#}
</div>

