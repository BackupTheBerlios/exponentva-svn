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
# $Id: smtp.defaults.php,v 1.6 2005/03/11 15:18:34 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

if (!defined('SMTP_USE_PHP_MAIL')) define('SMTP_USE_PHP_MAIL',0);
if (!defined('SMTP_SERVER')) define('SMTP_SERVER','localhost');
if (!defined('SMTP_PORT')) define('SMTP_PORT',25);
if (!defined('SMTP_AUTHTYPE')) define('SMTP_AUTHTYPE','NONE');
if (!defined('SMTP_USERNAME')) define('SMTP_USERNAME','');
if (!defined('SMTP_PASSWORD')) define('SMTP_PASSWORD','');
if (!defined('SMTP_FROMADDRESS')) define('SMTP_FROMADDRESS','website@localhost');

?>