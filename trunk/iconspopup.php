<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
#
# This file is part of Exponent
#
# Exponent is free software; you can redistribute
# it and/or modify it under the terms of the GNU
# General Public License as published by the Free
# Software Foundation; either version 2 of the
# License, or (at your option) any later version.
#
# Exponent is distributed in the hope that it
# will be useful, but WITHOUT ANY WARRANTY;
# without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR
# PURPOSE.  See the GNU General Public License
# for more details.
#
# You should have received a copy of the GNU
# General Public License along with Exponent; if
# not, write to:
#
# Free Software Foundation, Inc.,
# 59 Temple Place,
# Suite 330,
# Boston, MA 02111-1307  USA
#
# $Id: iconspopup.php,v 1.4 2005/02/19 00:40:17 filetreefrog Exp $
##################################################
 
if (!defined('BASE')) {
	define('BASE',dirname(__FILE__).'/');
}
// Define PATH_RELATIVE
define('PATH_RELATIVE',dirname($_SERVER['SCRIPT_NAME']) . '/');
// Define ICONDIR, more for convenience than anything else.
define('ICONDIR',BASE.str_replace(PATH_RELATIVE,"",$_GET['icodir']));

$perrow = 8;
$iconfiles = array(0=>array());
$thisrow = 0;
$good = true;
if (is_readable(ICONDIR)) {
	$dh = opendir(ICONDIR);
	$counter = 0;
	while (($file = readdir($dh)) !== false) {
		if (is_readable(ICONDIR.$file) && is_file(ICONDIR.$file)) {
			$iconfiles[$thisrow][] = $file;
			$counter++;
			if ($counter >= $perrow) {
				$counter = 0;
				$thisrow++;
				$iconfiles[$thisrow] = array();
			}
		}
	}
} else $good = false;

?>
<html>
<head><title>Icon Picker</title></head>
<script type="text/javascript">
function setIcon(src) {
	opener.setIcon(src);
	window.close();
}
</script>
<body>
<table width="100%" height="100%" cellpadding="4" cellspacing="0">
<?php
for ($i = 0; $i < count($iconfiles); $i++) {
	echo '<tr>';
	for ($j = 0; $j < count($iconfiles[$i]); $j++) {
		echo '<td>';
		$imgsrc = $_GET['icodir'] . $iconfiles[$i][$j];
		echo "<a href='' onClick='setIcon(\"$imgsrc\"); return false'><img src='$imgsrc' border='0' /></a>";
		echo '</td>';
	}
	echo '</tr>';
}


?>
</table>
</body>
</html>