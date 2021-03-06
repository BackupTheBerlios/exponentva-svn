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
 * $Id: _linker.tpl,v 1.4 2005/02/19 00:32:35 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<html>
	<head>
		<meta type="Generator" value="Exponent Content Management System" />
		<link rel="stylesheet" href="{$smarty.const.THEME_RELATIVE}style.css" />
		<style type="text/css">
		{literal}
			body {
				padding: 5px;
			}
		{/literal}
		</style>
	</head>
	<body>
	<b>{#i18n_sitehierarchy#}</b><hr size="1" />
		<table cellpadding="1" cellspacing="0" border="0" width="100%">
		{foreach from=$sections item=section}
		<tr><td style="padding-left: {math equation="x*20" x=$section->depth}px">
		{if $section->active}<a href="{$smarty.get.linkbase}&section={$section->id}&section_name={$section->name|escape:url}" class="navlink">{$section->name|escape:"htmlall"}</a>&nbsp;
		{else}{$section->name}
		{/if}
		</td></tr>
		{/foreach}
		</table>
	{if $haveStandalones}
	<br /><br /><br />
	<b>{#i18n_standalonepages#}</b><hr size="1" />
		<table cellpadding="1" cellspacing="0" border="0" width="100%">
		{foreach from=$standalones item=section}
		<tr><td style="padding-left: 20px">
		<a href="{$smarty.get.linkbase}&section={$section->id}&section_name={$section->name|escape:url}" class="navlink">{$section->name|escape:"htmlall"}</a>&nbsp;
		</td></tr>
		{/foreach}
		</table>
	{/if}
	</body>
</html>