<?php

##################################################
#
# Copyright (c) 2004-2005 James Hunt and the OIC Group, Inc.
# All Changes as of 6/1/05 Copyright 2005 James Hunt
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
# $Id: sanity.php,v 1.2 2005/11/22 01:16:03 filetreefrog Exp $
##################################################

$i18n = pathos_lang_loadFile('install/popups/sanity.php');

?>
<b><?php echo $i18n['title']; ?></b>
<div class="bodytext"><?php echo $i18n['header']; ?></div>
<br /><br />


<table cellspacing="0" cellpadding="3" rules="all" border="0" style="border:1px solid grey;" width="100%">
<tr><td colspan="2" style="background-color: lightgrey;"><b><?php echo $i18n['filedir_tests']; ?></b></td></tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_conf-configphp" />conf/config.php</td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['rw_server']; ?></div>
		<br />
		<?php echo $i18n['config.php']; ?>
		<br />
		<br />
		<b><?php echo $i18n['unix_solution']; ?>:</b>
		<div class="sanity_shell">
			chown <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/conf/<br />
			chown <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/conf/config.php
		</div>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_conf-profiles" />conf/profiles</td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['rw_server']; ?></div>
		<br />
		<?php echo $i18n['profiles']; ?>
		<br />
		<br />
		<b><?php echo $i18n['unix_solution']; ?>:</b>
		<div class="sanity_shell">
			chown -R <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/conf/profiles/
		</div>
	</td>
</tr>

<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_overridesphp" />overrides.php</td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['rw_server']; ?></div>
		<br />
		<?php echo $i18n['overrides.php']; ?>
		<br />
		<br />
		<b><?php echo $i18n['unix_solution']; ?>:</b>
		<div class="sanity_shell">
			chown <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/overrides.php
		</div>
	</td>
</tr>
	
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_install" />install/</td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['rw_server']; ?></div>
		<br />
		<?php echo $i18n['install']; ?>
		<br />
		<br />
		<b><?php echo $i18n['unix_solution']; ?>:</b>
		<div class="sanity_shell">
			chown <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/install
		</div>
	</td>
</tr>

<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_modules" />modules/</td>
	<td class="bodytext" valign="top">
		<?php echo $i18n['modules']; ?>
	</td>
</tr>

<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_views_c" />views_c/</td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['rw_server']; ?></div>
		<br />
		<?php echo $i18n['views_c']; ?>
		<br />
		<br />
		<b><?php echo $i18n['unix_solution']; ?>:</b>
		<div class="sanity_shell">
			chown <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/views_c
		</div>
	</td>
</tr>

<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_extensionuploads" />extensionuploads/</td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['rw_server']; ?></div>
		<br />
		<?php echo $i18n['extensionuploads']; ?>
		<br />
		<br />
		<b><?php echo $i18n['unix_solution']; ?>:</b>
		<div class="sanity_shell">
			chown <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/extensionuploads
		</div>
	</td>
</tr>

<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_files" />files/</td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['rw_server']; ?></div>
		<br />
		<?php echo $i18n['files']; ?>
		<br />
		<br />
		<b><?php echo $i18n['unix_solution']; ?>:</b>
		<div class="sanity_shell">
			chown <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/files
		</div>
	</td>
</tr>

<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="fdp_tmp" />tmp/</td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['rw_server']; ?></div>
		<br />
		<?php echo $i18n['tmp']; ?>
		<br />
		<br />
		<b><?php echo $i18n['unix_solution']; ?>:</b>
		<div class="sanity_shell">
			chown <span class="var">WEBUSER</span> <span class="var">EXPONENT</span>/tmp
		</div>
	</td>
</tr>
</table>

<br /><br />

<table cellspacing="0" cellpadding="3" rules="all" border="0" style="border:1px solid grey;" width="100%">
<tr><td colspan="2" style="background-color: lightgrey;"><b><?php echo $i18n['other_tests']; ?></b></td></tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_db" /><?php echo $i18n['db_backend']; ?></td>
	<td class="bodytext" valign="top">
		<?php echo $i18n['db_backend_desc']; ?>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_gd" /><?php echo $i18n['gd']; ?></td>
	<td class="bodytext" valign="top">
		<?php echo $i18n['gd_desc']; ?>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_php" />PHP 4.0.6+</td>
	<td class="bodytext" valign="top">
		<?php echo $i18n['php_desc']; ?>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_zlib" /><?php echo $i18n['zlib']; ?></td>
	<td class="bodytext" valign="top">
		<?php echo $i18n['zlib_desc']; ?>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_xml" /><?php echo $i18n['xml']; ?></td>
	<td class="bodytext" valign="top">
		<?php echo $i18n['xml_desc']; ?>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_safemode" /><?php echo $i18n['safemode']; ?></td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['safemode_req']; ?></div>
		<br />
		<?php echo $i18n['safemode_desc']; ?>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_openbasedir" /><?php echo $i18n['basedir']; ?></td>
	<td class="bodytext" valign="top">
		<div class="sanity_req"><?php echo $i18n['basedir_req']; ?></div>
		<br />
		<?php echo $i18n['basedir_desc']; ?>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_upload" /><?php echo $i18n['upload']; ?></td>
	<td class="bodytext" valign="top">
		<?php echo $i18n['upload_desc']; ?>
	</td>
</tr>
<tr>
	<td class="bodytext" style="font-weight: bold;" valign="top"><a name="o_tmpfile" /><?php echo $i18n['tempfile']; ?></td>
	<td class="bodytext" valign="top">
		<?php echo $i18n['tempfile_desc']; ?>
	</td>
</tr>
</table>