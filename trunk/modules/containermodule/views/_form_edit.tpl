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
 * $Id: _form_edit.tpl,v 1.7 2005/04/25 16:19:37 filetreefrog Exp $
 * 2005/06/14 MaxxCorp
 *}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/modules.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.i18n" scope="local"}
{config_load file="`$smarty.const.BASE`subsystems/lang/`$smarty.const.LANG`/modules/`$__loc->mod`.`$__view`.i18n" scope="local"}
<script type="text/javascript" />
{literal}
if (!document.body.appendChild) {
	alert("Your browser does not support the necessary javascript for this operation");
	history.go(-1);
}
{/literal}
</script>
{$js_init}

{if $nomodules == 1}
	<b>{#i18n_allmodulesdisabled_info#}</b>
{else}
<form name="form" method="post" action="{$smarty.const.SCRIPT_RELATIVE}{$smarty.const.SCRIPT_FILENAME}?" enctype="">
	{if $is_edit}<input type="hidden" name="id" value="{$container->id}" />
	{/if}<input type="hidden" name="rank" value="{$container->rank}" />
	<input type="hidden" name="module" value="containermodule" />
	<input type="hidden" name="src" value="{$loc->src}" />
	<input type="hidden" name="int" value="{$loc->int}" />
	{if $rerank == 1}<input type="hidden" name="rerank" value="1" />{/if}
	<input type="hidden" name="action" value="save" />
	{if $is_edit == 1}
	<input type="hidden" id="existing_source" name="existing_source" value="{$container->internal->src}" />
	{/if}
	<input type="hidden" name="current_section" value="{$current_section}" />
	
	<table cellspacing="0" cellpadding="0" width="100%">
		<tr><td valign="top">
		<table cellspacing="0" cellpadding="0" width="100%">
			{if $can_activate_modules == 1 && $is_edit == 0}
			<tr>
				<td></td>
				<td><i>{#i18n_enableadditionalmodules_info#}</i></td>
			</tr>
			{/if}
			<tr>
				<td valign="top">{#i18n_module#}</td>
				<td style='padding-left: 5px;' valign="top">
					<select id="i_mod" name="i_mod" size="1" onChange="writeViews()" {if $is_edit == 1}disabled {/if}>
						{html_options options=$modules selected=$container->internal->mod}
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top">{#i18n_view#}</td>
				<td style='padding-left: 5px;' valign="top">
					<select id="view" name="view" size="1" onChange="showPreviewCall()"></select>
				</td>
			</tr>
			<tr>
				<td valign="top">{#i18n_title#}</td>
				<td style='padding-left: 5px;' valign="top">
					<input type="text" name="title" id="title" value="{$container->title}" onChange="showPreviewCall()" />
				</td>
			</tr>
			{if $is_edit == 0}
			<tr>
				<td valign="top">{#i18n_source#}</td>
				<td style='padding-left: 5px;' valign="top">
					<table cellpadding='0' cellspacing='0' border='0'>
						<tr>
							<td>
								<input type='radio' name='i_src' value='new_source' id='r_new_source' onClick='activate("New");' />
							</td>
							<td>{#i18n_create#}&nbsp;</td>
						</tr>
						<tr>
							<td>
								<input type='radio' name='i_src' value='existing_source' id='r_existing_source' onClick='activate("Existing");' />
							</td>
							<td>
								<a id="existing_source_link" class='mngmntlink container_mngmntlink' href='' onClick="pickSource(); return false;">{#i18n_usethis#}</a>
								&nbsp;
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
								<input type="hidden" id="existing_source" name="existing_source" value="" />
							</td>
						</tr>
						<tr>
							<td colspan='2' id='noSourceMessageTD'></td>
						</tr>
					</table>
	
				</td>
			</tr>
			{/if}
			<tr><td valign="top">{#i18n_restrictviewing#}&nbsp;</td><td>
				<input type="checkbox" name="is_private"{if $container->is_private == 1} {#i18n_checked#}{/if} />
			</td></tr>
			<tr><td valign="top">{#i18n_description#}:&nbsp;</td><td>
				{#i18n_description_info#}
				<textarea rows="5" cols="30" id="ta_description" {if $container->is_existing}{#i18n_disabled#}{/if} name="description">{$locref->description}</textarea>
			</td></tr>
			<tr><td></td><td>
				<input type="submit" value="{#i18n_submit#}" onClick="return validateNew()" />
				<input type="button" value="{#i18n_cancel#}"onClick="document.location.href = '{$back}'" />
			</td></tr>
		</table>	
		</td><td width="50%">
			<b>{#i18n_preview#}:</b><br />
			<iframe id="iframePreview" src="{$smarty.const.PATH_RELATIVE}modules/containermodule/nosourceselected.php" width="100%" height="250" style="border: 1px dashed #DDD;"></iframe>
		</td></tr>
	</table>
</form>

<script type='text/javascript' src='{$smarty.const.PATH_RELATIVE}js/ContainerSourceControl.js'></script>
<script type="text/javascript" defer='1'>
var sourceInit = false;
writeViews();
activate("New");
sourcePicked("{$container->internal->src}","{$locref->description|escape:"javascript"}");
</script>
<script type="text/javascript">
{literal}
if (!document.body.appendChild) {
	alert("Your browser is not supported");
	history.go(-1);
}
{/literal}
</script>

{/if}