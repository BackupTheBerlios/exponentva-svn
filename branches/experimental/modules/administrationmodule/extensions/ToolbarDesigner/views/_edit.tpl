{*
 * Copyright (c) 2005-2006 Maxim Mueller
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
<div class="form_title">{$_TR.form_title}</div>
<div class="form_header">{$_TR.form_header}</div>

<div class="ToolbarDesigner">
{includeMiscFiles}

<script type="text/javascript" src="{$smarty.const.PATH_RELATIVE}external/editors/{$smarty.const.SITE_WYSIWYG_EDITOR}_toolbox.js"></script>
	
<table>
	<tbody>
		<tr id="ToolbarDesigner_toolbox" />
		<tr>
			<td class="ToolbarDesigner_messageline" id="msgTD"></td>
		</tr>
	</tbody>
</table>
<hr size="1" />
<a class="mngmntlink administration_mngmntlink" href="#" onclick="newRow(); return false">New Row</a>
<hr size="1" />
<table>
	<tbody id="ToolbarDesigner_workspace" />
</table>

<script type="text/javascript">
	var imagePrefix = "";
	// populate the button panel
	exponentJSbuildHTMLEditorButtonSelector(Exponent.WYSIWYG_toolboxbuttons);
		

{IF ($config == null)}

	// 3 initial rows.
	rows.push(new Array());
	rowlens.push(0);
	rows.push(new Array());
	rowlens.push(0);
	rows.push(new Array());
	rowlens.push(0);

{ELSE}	

	Exponent.WYSIWYG_toolbar = {$config->data};
	{LITERAL}
	for(currRow = 0; currRow < Exponent.WYSIWYG_toolbar.length; currRow++) {
		rows.push(new Array());
		rowlens.push(0);
		
		for(currButton = 0; currButton < Exponent.WYSIWYG_toolbar[currRow].length; currButton++) {
			//TODO: decide whether to disallow empty rows altoghether -> htmlareatoolbarbuilder.js->save()
			if (Exponent.WYSIWYG_toolbar[currRow][currButton] != "") {
				rows[currRow].push(Exponent.WYSIWYG_toolbar[currRow][currButton]);
				disableToolbox(Exponent.WYSIWYG_toolbar[currRow][currButton]);
			}
		}
	}
	{/LITERAL}
{/IF}

	regenerateTable();
</script>
<br />
<hr size="1" />
<form method="post">
	<input type="hidden" name="module" value="administrationmodule"/>
	<input type="hidden" name="action" value="edit"/>
	<input type="hidden" name="m" value="administrationmodule"/>
	<input type="hidden" name="a" value="htmlarea_saveconfig"/>
	{IF $config->id}
		<input type="hidden" name="id" value="{$config->id}"/>
	{/IF}
	<input type="hidden" name="config" value="" id="config_htmlarea" />
	{$_TR.config_name}:<br /><input type="text" name="config_name" value="{$config->name}" /><br />
	<input type="checkbox" name="config_activate" {IF $config->active == 1} 'checked="checked" {/IF}/> {$_TR.activate}<br />

	<input type="submit" value="Save" onclick="save(this.form); return false">
</form>
</div>
