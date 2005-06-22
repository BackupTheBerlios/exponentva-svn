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
 * $Id: _popup_info.tpl,v 1.3 2005/02/19 00:32:31 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<html>
	<title>Module Information</title>
	<link rel="stylesheet" href="{$smarty.const.THEME_RELATIVE}style.css" />
</head>
<body>
<br /><br />
<div align="center" style="font-weight: bold">{if $name == ''}{#i18n_unknownmodules#}{else}{$name}{/if}</div>
<br />

<div style="border-top: 3px dashed lightgrey; padding: 3px;">
<table cellpadding="0" cellspacing="0" border="0">
{if $is_orphan}
<tr>
	<td>{#i18n_archivedmodules#}</td>
</tr>
{else}
<tr>
	<td>{#i18n_view#}:&nbsp;</td>
	<td>{$container->view}</td>
</tr>
<tr>
	<td>{#i18n_title#}:&nbsp;</td>
	<td>{if $container->title == ""}<i>&lt;{#i18n_none#}&gt;</i>{else}{$container->title}{/if}</td>
</tr>
{/if}
</table>
</div>

<div style="border-top: 3px dashed lightgrey; padding: 3px;">{if $name == ''}<i>{#i18n_modulenotfound#}</i>{elseif $info == ''}<i>{#i18n_noitemsfound#}</i>{else}{$info|nl2br}{/if}</div>
</body>
</html>