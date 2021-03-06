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
 * $Id: _sourcePicker.tpl,v 1.4 2005/02/19 00:32:31 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<div class="container_editbox">
 
	<div class="container_editheader">
		{* I.E. requires a 'dummy' div inside of the above div, so that it
		   doesn't just 'lose' the margins and padding. jh 8/23/04 *}
		<div width="100%" style="width: 100%">
		<table width="100%" cellpadding="0" cellspacing="3" border="0" class="container_editheader">
			<tr>
				{if $container->info.clickable}
					<td width="18">
						<a href="#" onClick="window.open('{$smarty.const.PATH_RELATIVE}modules/containermodule/infopopup.php?{if $container->id != 0}id={$container->id}{else}mod={$container->info.class}&src={$container->info.src}{/if}','info','scrollbars=yes,title=no,titlebar=no,width=300,height=200');"><img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}info.png" title="Click for module information" alt="Click for module information" /></a>
					</td>
				{/if}
					<td valign="top" class="info">
					{$container->info.module}
					{if $container->view != ""}<br />{#i18n_shownin#} {$container->view} {#i18n_view#}{/if}
				</td>
				<td align="right" valign="top">
					
					{* {if $container->info.clickable} *}
					<a class="mngmntlink container_mngmnltink" href="{$dest}&ss={$container->info.source}&sm={$container->info.class}">
					{#i18n_usethis#}
					</a>
					{* {/if} *}
				</td>
			</tr>
		</table>
		</div>
	</div>
	<div class="container_box">
		<div width="100%" style="width: 100%">
		{$container->output}
		</div>
	</div>	
</div>
<br /><br />