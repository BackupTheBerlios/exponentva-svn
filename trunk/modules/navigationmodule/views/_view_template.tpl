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
 * $Id: _view_template.tpl,v 1.5 2005/02/19 00:32:35 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="moduletitle">{$template->name}</div>
<hr size="1" />
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td><b>{#i18n_nameofsection#}</b></td>
<td>
[ <a class="mngmntlink sitetemplate_mngmntlink" href="{link action=edit_template parent=$template->id}">{#i18n_create#}</a> ]
[ <a class="mngmntlink sitetemplate_mngmntlink" href="{link action=edit_template id=$template->id}">{#i18n_properties#}</a> ]
[ <a class="mngmntlink sitetemplate_mngmntlink" href="#" onClick="window.open('{$smarty.const.PATH_RELATIVE}modules/navigationmodule/actions/edit_page.php?sitetemplate_id={$template->id}'); return false">{#i18n_pagecontent#}</a> ]
</td>
{foreach from=$subs item=sub}
{math equation="x+1" x=$sub->rank assign=nextrank}
{math equation="x-1" x=$sub->rank assign=prevrank}
<tr>
<td style="padding-left: {math equation="x*20" x=$sub->depth}">
<b>{$sub->name}</b>
</td>
<td>
[ <a class="mngmntlink sitetemplate_mngmntlink" href="{link action=edit_template parent=$sub->id}">{#i18n_create#}</a> ]
[ <a class="mngmntlink sitetemplate_mngmntlink" href="{link action=edit_template id=$sub->id}">{#i18n_properties#}</a> ]
[ <a class="mngmntlink sitetemplate_mngmntlink" href="#" onClick="window.open('{$smarty.const.PATH_RELATIVE}modules/navigationmodule/actions/edit_page.php?sitetemplate_id={$sub->id}'); return false">{#i18n_pagecontent#}</a> ]
[ <a class="mngmntlink sitetemplate_mngmntlink" href="{link action=delete_template id=$sub->id}">{#i18n_delete#}</a> ]
{if $sub->last == 0}
	<a href="{link action=order_templates parent=$sub->parent a=$sub->rank b=$nextrank}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.png" border="0" /></a>
{else}
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}down.disabled.png" border="0" />
{/if}
{if $sub->first == 0}
	<a href="{link action=order_templates parent=$sub->parent a=$sub->rank b=$prevrank}"><img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.png" border="0" /></a>
{else}
	<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}up.disabled.png" border="0" />
{/if}
</td>
</tr>
{/foreach}
</table>
<br />
<br />
<a class="mngmntlink navigation_mngmntlink" href="{link action=manage}">{#i18n_back#}</a>