{*
 *
 *}
{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
{if $permissions.administrate == 1}
	<a href="{link action=userperms _common=1}" title="{#i18n_assignuserpermissionstoitem_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>&nbsp;
	<a href="{link action=groupperms _common=1}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
{/if}
{if $permissions.configure == 1}
	<a href="{link action=configure _common=1}" title="{#i18n_editconfig_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}configure.png" /></a>
{/if}
{if $permissions.configure == 1 or $permissions.administrate == 1}
	<br />
{/if}
{/permissions}
{if $moduletitle != ''}<div class="moduletitle translator_moduletitle">{$moduletitle}</div>{/if}
<table cellpadding="0" cellspacing="0" border="0" width="100%">
{foreach from=$languages item=lang}
	<tr>
		<td class="header translator_header">
			{$lang->name} ({$lang->lang}:{$lang->charset}) by {$lang->author}
		</td>
		<td class="header translator_header" align="right">
			{permissions level=$smarty.const.UILEVEL_PERMISSIONS}
			{if $lang->permissions.administrate == 1}
			<a href="{link action=userperms _common=1 int=$lang->id}" title="{#i18n_assignuserpermissionstoitem_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}userperms.png" /></a>
			<a href="{link action=groupperms _common=1 int=$lang->id}" title="{#i18n_assigngrouppermissionstomodule_desc#}"><img border="0" src="{$smarty.const.ICON_RELATIVE}groupperms.png" /></a>
			{/if}
			{/permissions}
			{permissions level=$smarty.const.UILEVEL_NORMAL}
			{if $lang->permissions.configure == 1}
			<a class="mngmntlink translator_mngmntlink" href="{link action=edit_lang id=$lang->id}">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" />
			</a>
			<a class="mngmntlink translator_mngmntlink" href="{link action=delete_lang id=$lang->id}" onClick="return confirm('{#i18n_delete_confirm#}');">
				<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" />
			</a>
			&nbsp;
			<a href="{link action=export id=$lang->id}">Export</a>
			{/if}
			{/permissions}
		</td>
	</tr>
	{foreach from=$dictionaries key=type item=dicts}
		{foreach from=$dicts item=name}
	<tr>
		<td colspan="2">&nbsp;&nbsp;&nbsp;
			<a href="{link action=view_dictionary lang_id=$lang->id type=$type name=$name}">
				{$type} :: {$name}
			</a>
		</td>
	</tr>
		{/foreach}
	{/foreach}
{foreachelse}
	<tr><td align="center"><i>{#i18n_noitemsfound#}</i></td></tr>
{/foreach}
</table>
<br /><br />
{permissions level=$smarty.const.UILEVEL_NORMAL}
{if $permissions.configure == 1}
<a class="mngmntlink translator_mngmntlink" href="{link action=edit_lang}">{#i18n_create#}</a>
<br />
<a class="mngmntlink translator_mngmntlink" href="{link action=import_form}">Import Language Pack</a>
{/if}
{/permissions}