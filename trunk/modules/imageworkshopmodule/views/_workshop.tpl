{if $noupload == 1}{#i18n_operation_error#} ({$uploadError}){/if}
<table cellspacing="0" cellpadding="4" border="0" width="100%" />
<tr>
	<td valign="top" width="120" align="center">
		<b>{#i18n_workspace#}</b><br />
	{foreach name=i from=$images item=image}
		{math equation="x-1" assign=this x=$smarty.foreach.i.iteration}
		<a href="{link action=workshop id=$image->id}" />
		<img src="{$smarty.const.PATH_RELATIVE}thumb.php?id={$image->file_id}&constraint=1&width=100&height=100" border="0" style="border: 1px solid black;"/>
		<br />
		{$image->name}
		</a>
		<br />
		{* Up *}
		{if $smarty.foreach.i.first == 0}
		{math equation="x-2" assign="prev" x=$smarty.foreach.i.iteration}
		<a href="{link action=order a=$this b=$prev}">
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}up.png" />
		</a>
		{else}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}up.disabled.png" />
		{/if}
		<a href="{link action=delete id=$image->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}delete.png" />
		</a>
		{* Down *}
		{if $smarty.foreach.i.last == 0}
		<a href="{link action=order a=$this b=$smarty.foreach.i.iteration}">
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}down.png" />
		</a>
		{else}
			<img class="mngmnt_icon" border="0" src="{$smarty.const.ICON_RELATIVE}down.disabled.png" />
		{/if}
		<br />
		<hr size="1" />
	{foreachelse}
		<i>{#i18n_noitemsfound#}</i><br />
		<hr size="1" />
	{/foreach}
		{if $noupload != 1}<a href="{link action=new_image}">{#i18n_create#}</a>{/if}
	</td>
	<td valign="top" width="400">
		{if $current->id == null}
		{#i18n_selectitem#}
		{else}
		<div class="moduletitle">{$current->name}{if $nochange == 1} ({#i18n_nochange#}){else} ({#i18n_changed#}){/if}</div>
		<img src="{$smarty.const.PATH_RELATIVE}thumb.php?id={$working->file_id}&constraint=1&width=400&height=400" border="0" style="border: 1px solid black;" alt="Loading image..." />
		{if $working->_width > 400 || $working->_height > 400}
		<div align="right">
			<a href="{$smarty.const.PATH_RELATIVE}{$working->_file->directory}/{$working->_file->filename}" target="_blank">({#i18n_view#})</a>
		</div>
		{/if}
		<table cellspacing="2" cellpadding="0" border="0">
			<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_name#}:</td>
				<td>{$current->_realname}</td>
			</tr>
			{*<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_type#}:</td>
				<td>{$working->_imagetype}</td>
			</tr>
			*}<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_width#}:</td>
				<td>{$working->_width}</td>
			</tr>
			<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_height#}:</td>
				<td>{$working->_height}</td>
			</tr>
			<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_depth#}:</td>
				<td>{$working->_bitdepth}-bit</td>
			</tr>
			<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_size#}:</td>
				<td>{$working->_filesize} {if $nochange == 0}({$sizediff}% {#i18n_of#} {#i18n_original#}){/if}</td>
			</tr>
		</table>
		
		<div style="border-left: 1.5em solid #CCC;">
			{#i18n_operations#}<br />
			<ul>
				<li><a href="{link action=resize_form id=$current->id}">{#i18n_resize#}</a></li>
				<li><a href="{link action=rotate_form id=$current->id}">{#i18n_rotate#}</a></li>
				<li><a href="{link action=flip_form id=$current->id}">{#i8n_flip#}</a></li>
				{*<li>{#i18n_convert#}</li>
				*}
			</ul>
		</div>
		<div align="right">
		{if $nochange == 0}
			<a href="{link action=save_changes id=$current->id}">{#i18n_submit#}</a>
			&nbsp;|&nbsp;
			<a href="{link action=revert_changes id=$current->id}">{#i18n_cancel#}</a>
		{else}
			<a href="#" onClick="openSelector('imagemanagermodule','?module=imageworkshopmodule&action=imgmgr_move&file_id={$current->file_id}','containermodule','_sourcePicker'); return false;">{#i18n_copytoimagemanager#}</a>
		{/if}
		</div>
		<hr size="1" />
		<b>{#Original#}:</b><br />
		<img src="{$smarty.const.PATH_RELATIVE}thumb.php?id={$current->file_id}&constraint=1&width=400&height=400" border="0" style="border: 1px solid black;"/>
		{if $current->_width > 400 || $current->_height > 400}
		<div align="right">
			<a href="{$smarty.const.PATH_RELATIVE}{$current->_file->directory}/{$current->_file->filename}" target="_blank">({#i18n_view#})</a>
		</div>
		{/if}
		<table cellspacing="2" cellpadding="0" border="0">
			<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_name#}:</td>
				<td>{$current->_realname}</td>
			</tr>
			{*<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_type#}:</td>
				<td>{$current->_imagetype}</td>
			</tr>
			*}<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_width#}:</td>
				<td>{$current->_width}</td>
			</tr>
			<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_height#}:</td>
				<td>{$current->_height}</td>
			</tr>
			<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_depth#}:</td>
				<td>{$current->_bitdepth}-bit</td>
			</tr>
			<tr>
				<td style="font-weight: bold; background-color: #CCC;">{#i18n_size#}:</td>
				<td>{$current->_filesize}</td>
			</tr>
		</table>
		{/if}
	</td>
</tr>
</table>