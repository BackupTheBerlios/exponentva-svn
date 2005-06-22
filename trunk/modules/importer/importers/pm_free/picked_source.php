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
# $Id: picked_source.php,v 1.2 2005/02/19 16:53:35 filetreefrog Exp $
##################################################

include_once("../../../../pathos.php");
define("SCRIPT_RELATIVE",PATH_RELATIVE."modules/importer/importers/pm_free/");
define("SCRIPT_ABSOLUTE",BASE."modules/importer/importers/pm_free/");
define("SCRIPT_FILENAME","picked_source.php");

$post = array_merge($_POST,pathos_sessions_get("post"),$_GET);
$src = $post['ss'];
$mod = $post['sm'];

$locref = $db->selectObject("locationref","module='".$mod."' AND source='".$src."'");
if (!isset($locref->description)) $locref->description = "... no description ...";

?>
<html>
<head>
<script type="text/javascript">
function saveSource() {
	window.opener.sourceSelected("hidden",false,"<?php echo $post['ss']; ?>","<?php echo str_replace(array("\"","\r\n"),array("\\\"","\\r\\n"),$locref->description); ?>");
	window.close();
	
}
</script>
</head>
<body onload="saveSource()">
</body>
</html>
