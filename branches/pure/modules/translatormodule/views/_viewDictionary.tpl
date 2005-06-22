{*
 *
 *}
<div class="moduletitle">{$d_type}/{$d_name}</div>

<table cellpadding="3" cellspacing="0" border="0" width="100%">
{foreach from=$all_constants item=c}
	<tr><td colspan="2">
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td class="header translator_header"valign="top">
					{if $these_constants[$c]->id > 0}{$c}{else}<span style="color: #FF0000;">{$c}</span>{/if}{if $removed_constants.$c != null} (removed){elseif $added_constants.$c != null} (added){/if}
				</td>
					
				<td class="header translator_header"valign="top" align="right">
					{permissions level=$smarty.const.UILEVEL_NORMAL}
					{if $permissions.configure == 1}
					{if $these_constants[$c]->id > 0}
					<a href="{link action=edit_entry id=$these_constants[$c]->id}">
						<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" />
					</a>
					{else}
					<a href="{link action=edit_entry type=$d_type name=$d_name lang_id=$lang->id key=$c}">
						<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}edit.png" border="0" />
					</a>
					{/if}
					{if $removed_constants.$c != null && $these_constants.c != null}
					<a href="{link action=delete_entry id=$these_constants[$c]->id}">
						<img class="mngmnt_icon" src="{$smarty.const.ICON_RELATIVE}delete.png" border="0" />
					</a>
					{/if}
					{/if}
					{/permissions}
				</td>
			</tr>
		</table>
	<tr>
		<td valign="top">
			<b>English Version</b><br />
			{$ref_constants.$c}
		</td>
		<td valign="top">
			<b>Translated Version</b><br />
			{$these_constants.$c->value}
		</td>
	</tr>
{/foreach}
</table>