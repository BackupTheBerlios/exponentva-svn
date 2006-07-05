{*
 * Copyright (c) 2006 Maxim Mueller
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
 
 {* include namespace, toolbar if any*}
 
 <div class="WYSIWIGToolbarControl">
 	<script type="text/javascript" src="{$smarty.const.PATH_RELATIVE}subsytems/forms/controls/WYSIWYGEditorControls/js/{$smarty.const.SITE_WYSIWYG_EDITOR}_toolbox.js"></script>
	
	<div id="WYSIWIGToolbox" />

	<div id="Messagebox" />
	
	<a class="mngmntlink administration_mngmntlink" onclick="eXp.WYSIWIG.createRow(); return false">{$_TR.new_row}</a>
	
	<hr/>

	<div id="ToolbarWorkspace" />

	<script type="text/javascript">
	/* <![CDATA[ */
		// populate the Toolbox panel
		eXp.WYSIWYG.initToolbox(eXp.WYSIWYG.toolbox);
	
		// populate the Toolbar panel
		eXp.WYSIWYG.initToolbar(eXp.WYSIWYG.toolbar);
	/* ]]> */									
	</script>
	
	<hr size="1" />
	
	<form method="post">
	{*TODO:
	* build an XML model, probably better here in the form than using
	* xml for datamodels all the time, because usage action "show" > "update"
	* and native php is quicker
	* why ? validation, compatiblity with xforms and keeping dataformats in order
	* should be done client side(checkbox checked="checked" -> active = 1)
	* supply a js for the last part and think about autogeneration
	*}
		<input type="hidden" name="module" value="AdministrationModule"/>
		<input type="hidden" name="action" value="run"/>
		<input type="hidden" name="m" value="AdministrationModule"/>
		<input type="hidden" name="a" value="htmlarea_saveconfig"/>
		
		<!-- this input holds the datamodel --> 
		<input type="hidden" name="datamodel" value="{$dm->serialize2XML()}"/>
	{IF $id != NULL}
		<input type="hidden" name="id" value="{$dm->id}"/>
	{/IF}
		<input type="hidden" name="data" value="" id="Toolbar" />
		{$_TR.configuration_name}:<br /><input type="text" name="name" value="($dm->name}" /><br />
		<input type="checkbox" name="active" {IF $dm->active == 1} checked="checked" {/IF}/>{$_TR.activate}?<br />
	
		<input type="submit" value="{$_TR.save}" onclick="save(this.form); return false">
		<input type="cancel" value="{$_TR.cancel}" onclick="document.location='{$smarty->__redirect}'; return false">
	</form>
</div>