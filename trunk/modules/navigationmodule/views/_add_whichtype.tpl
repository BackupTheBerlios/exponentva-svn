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
 * $Id: _add_whichtype.tpl,v 1.4 2005/04/03 07:57:14 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="moduletitle navigation_modultitle">{#i18n_create_desc#}</div>
<div class="form_header">
{if $parent->id == 0}
{#i18n_header1#}
{else}
{#i18n_header1#} "{$parent->name}".
{/if}
{#i18n_header#}
</div>

<div style="background-color: #CCC; padding: 5px;">
<a class="mngmntlink navigation_mngmntlink" href="{link action=edit_contentpage parent=$parent->id}">
{#i18n_contentpage#}
</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#i18n_contentpage_info#}
</div>

<div style="background-color: #CCC; padding: 5px;">
<a class="mngmntlink navigation_mngmntlink" href="{link action=edit_externalalias parent=$parent->id}">
{#i18n_externalpage#}
</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#i18n_externalpage_info#}
</div>

<div style="background-color: #CCC; padding: 5px;">
<a class="mngmntlink navigation_mngmntlink" href="{link action=edit_internalalias parent=$parent->id}">
{#i18n_internalpage#}
</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#i18n_internalpage_info#}
</div>

{if $havePagesets != 0}
<div style="background-color: #CCC; padding: 5px;"><a class="mngmntlink navigation_mngmntlink" href="{link action=add_pagesetpage parent=$parent->id}">
{#i18n_pageset#}
</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#i18n_pageset_info#}
</div>
{/if}

{if $haveStandalone != 0 && $isAdministrator == 1}
<div style="background-color: #CCC; padding: 5px;"><a class="mngmntlink navigation_mngmntlink" href="{link action=move_standalone parent=$parent->id}">
{#i18n_movestandalonepage#}
</a>
</div>
<div style="padding: .5em; padding-bottom: 1.5em;">
{#i18n_movestandalonepage_info#}
</div>
{/if}
