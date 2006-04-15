<?php

##################################################
#
# Copyright (c) 2004-2006 OIC Group, Inc.
# Written and Designed by James Hunt
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# GPL: http://www.gnu.org/licenses/gpl.txt
#
##################################################
//GREP:HARDCODEDTEXT
//GREP:VIEWIFY
//GREP:REIMPLEMENT

// Part of the HTMLArea category

if (!defined("EXPONENT")) exit("");

if (exponent_permissions_check('htmlarea',exponent_core_makeLocation('administrationmodule'))) {

	$imagedir = BASE."external/htmlarea/toolbaricons";
	$imagebase = PATH_RELATIVE."external/htmlarea/toolbaricons";
	$confdir = BASE."external/htmlarea";

	$config = $db->selectObject("htmlareatoolbar","id=".intval($_GET['id']));

	?>
	<script type="text/javascript" src="<?php echo PATH_RELATIVE; ?>js/HTMLAreaToolbarBuilder.js"></script>
	<script type="text/javascript">
	var imagePrefix = "<?php echo $imagebase."/"; ?>";
	</script>
<?php
	$iconconfig = "";
	if (is_readable(THEME_ABSOLUTE."toolbaricons.conf.php")) {
		$iconconfig = include($confdir."/toolbaricons.conf.php");
	} else if (is_readable($confdir . "/toolbaricons.conf.php")) {
		$iconconfig = include($confdir."/toolbaricons.conf.php");
	}
	else {
		echo "Toolbar Icon Configuration file not found";
		return;
	}
	
?>
<table cellspacing="0" cellpadding="2" border="0">
<tr>
<?php

foreach ($iconconfig as $row) {
	foreach ($row as $icondata) {
		$icon = $icondata['icon'];
		$span = (isset($icondata['span']) ? ($icondata['span']) : 1);
		$tooltip = (isset($icondata['tooltip']) ? $icondata['tooltip'] : "");
		
		$file = $icon . ".gif";
		echo "<td colspan='$span' id='td_$icon' onmouseover='this.style.background=\"red\";' onmouseout='this.style.background=\"white\"'>";
		echo "<a id='a_$icon' href='#' onClick='register(\"$icon\")'>";
		echo "<img id='img_$icon' src='$imagebase/$file' border='0' alt='" . $tooltip . "' title='" . $tooltip . "' />";
		echo '</a>';
		echo "</td>";
	}
	echo "</tr><tr>";
}

?>
</tr>
<tr><td colspan="<?php echo $perrow; ?>" style="font-size: 12px; font-style: italic;" id="msgTD"></td></tr>
</table>
<hr size="1" />
<a class="mngmntlink administration_mngmntlink" href="#" onclick="newRow(); return false">New Row</a>
<hr size="1" />
<table cellpadding="2" cellspacing="2" rules="all" border="0">
<tbody id="toolbar_workspace">
<tbody>
</table>
<script type="text/javascript">
<?php
	
if ($config == null) {
?>
// 3 initial rows.
rows.push(new Array());
rowlens.push(0);
rows.push(new Array());
rowlens.push(0);
rows.push(new Array());
rowlens.push(0);
<?php

} else {
	$data = unserialize($config->data);
	$rowcount = 0;
	foreach ($data as $row) {
		?>
rows.push(new Array());
rowlens.push(0);
		<?php
		foreach ($row as $icon) {
			?>
rows[<?php echo $rowcount;?>].push("<?php echo $icon;?>");
rowlens[<?php echo $rowcount;?>] += toolbarIconSpan("<?php echo $icon;?>");
disableToolbox("<?php echo $icon;?>");
			<?php
			
		}
		$rowcount++;
	}
}
?>
regenerateTable();
</script>
<br />
<hr size="1" />
<form method="post">
<input type="hidden" name="module" value="administrationmodule"/>
<input type="hidden" name="action" value="run"/>
<input type="hidden" name="m" value="administrationmodule"/>
<input type="hidden" name="a" value="htmlarea_saveconfig"/>
<?php if ($config->id) { ?><input type="hidden" name="id" value="<?php echo $config->id; ?>"/><?php } ?>
<input type="hidden" name="config" value="" id="config_htmlarea" />
Configuration Name:<br /><input type="text" name="config_name" value="<?php echo $config->name ?>" /><br />
<input type="checkbox" name="config_activate" <?php echo ($config->active == 1 ? 'checked="checked" ' : '');?>/> Activate?<br />

<input type="submit" value="Save" onclick="save(this.form); return false">
</form>

	<?php

} else {
	echo SITE_403_HTML;
}

?>
