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
# $Id: mysql.info.php,v 1.3 2005/02/19 00:35:54 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

/**
 * MySQL Database Engine Info File
 *
 * Contains information about the MySQL Database Engine implementation
 *
 * @author James Hunt
 * @copyright 2004 James Hunt and the OIC Group, Inc.
 * @version 0.95
 *
 * @package Subsystems
 * @subpackage Database
 */

return array(
	"name"=>"MySQL Database Backend",
	"author"=>"James Hunt",
	"description"=>"MySQL Database Backend.",
	"version"=>pathos_core_version(true)
);

?>