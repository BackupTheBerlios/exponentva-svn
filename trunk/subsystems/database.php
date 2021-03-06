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
# $Id: database.php,v 1.4 2005/04/03 02:08:18 filetreefrog Exp $
##################################################

if (!defined('PATHOS')) exit('');

define("DATABASE_TABLE_EXISTED",		1);
define("DATABASE_TABLE_INSTALLED",		2);
define("DATABASE_TABLE_FAILED",			3);
define("DATABASE_TABLE_ALTERED",		4);

/**
 * Database Subsystem
 *
 * Handles all database abstraction in Exponent.
 *
 * @package		Subsystems
 * @subpackage	Database
 *
 * @author		James Hunt
 * @copyright		2004 James Hunt and the OIC Group, Inc.
 * @version		0.95
 */

/**
 * SYS flag for Database Subsystem
 *
 * The definition of this constant lets other parts of the subsystem know
 * that the Database Subsystem has been included for use.
 */
define("SYS_DATABASE",1);

/**
 * Database Field Type specifier
 *
 * An index for the Exponent Data Definition Language.
 * This index indicates what type of column should be created
 * in the table.
 */
define("DB_FIELD_TYPE",	0);

/**
 * Database Field Length specifier
 *
 * An index for the Exponent Data Definition Language.
 * This index indicates the length of the column.  Currently,
 * this is only applicable to textual field types.
 */
define("DB_FIELD_LEN",	1);

/**
 * Database Field Default specifier
 *
 * An index for the Exponent Data Definition Language.
 * This index indicates the default value of a field in the table.
 */
define("DB_DEFAULT",	2);

/**
 * Database Incremental Field specifier
 *
 * An index for the Exponent Data Definition Language.
 * This index specifies that the field should automatically
 * increment its value.  This is ONLY applicable to ID fields
 * that are marked as PRIMARY.
 *
 * @see DB_PRIMARY
 * @see DB_DEF_ID
 */
define("DB_INCREMENT",	3);

/**
 * Database Primary Key Field specifier
 *
 * An index for the Exponent Data Definition Language.
 * This index specifies that the field should be treated as the
 * primary key for the table.  There can only be one primary
 * key field per table.
 *
 * @see DB_DEF_ID
 * @see DB_INCREMENT
 */
define("DB_PRIMARY",	4);

/**
 * ????
 */
define("DB_UNIQUE",	5);

/**
 * ????
 */
define("DB_INDEX",		6);

/**
 * ??????
 */
define("DB_DEF_IGNORE",	100);

/**
 * Field Type specifier: Numeric ID
 *
 * A value for the Exponent Data Definition Language.
 * This value, specified for the DB_FIELD_TYPE index,
 * denotes that the field should be a numeric ID.
 */
define("DB_DEF_ID",	101);

/**
 * Field Type specifier: Text
 *
 * A value for the Exponent Data Definition Language.
 * This value, specified for the DB_FIELD_TYPE index,
 * denotes that the field should be a string of characters.
 * If used, the DB_FIELD_LEN index must also be specified.
 *
 * @see DB_FIELD_TYPE
 * @see DB_FIELD_LEN
 */
define("DB_DEF_STRING",	102);

/**
 * Field Type specifier: Integer
 *
 * A value for the Exponent Data Definition Language.
 * This value, specified for the DB_FIELD_TYPE index,
 * denotes that the field should be an integer.
 */
define("DB_DEF_INTEGER",	103);

/**
 * Field Type specifier: Boolean
 *
 * A value for the Exponent Data Definition Language.
 * This value, specified for the DB_FIELD_TYPE index,
 * denotes that the field should be a boolean (1 or 0, true or
 * false).
 */
define("DB_DEF_BOOLEAN",	104);

/**
 * Field Type specifier: Timestamp
 *
 * A value for the Exponent Data Definition Language.
 * This value, specified for the DB_FIELD_TYPE index,
 * denotes that the field should store a UNIX timestamp,
 * in order to portably manage dates and/or times.
 */
define("DB_DEF_TIMESTAMP",	105);

/**
 * Field Type specifier: Decimal
 *
 * A value for the Exponent Data Definition Language.
 * This value, specified for the DB_FIELD_TYPE index,
 * denotes that the field should store a decimal number.
 */
define("DB_DEF_DECIMAL",	106);

/**
 * Table Alteration Error Message - 200 : Alter Not Needed
 *
 * A message constant returned by parts of the Database Subsystem
 * indicating that a table alteration need not take place.
 */
define("TABLE_ALTER_NOT_NEEDED",	200);

/**
 * Table Alteration Error Message - 201 : Alter Succeeded
 *
 * A message constant returned by parts of the Database Subsystem
 * indicating that a table alteration succeeded.
 */
define("TABLE_ALTER_SUCCEEDED",	201);

/**
 * Table Meta Info : Workflow Table
 *
 * If specified as true in a table info array, the workflow tables will
 * be created to match.
 */
define("DB_TABLE_WORKFLOW",	300);

/**
 * Table Meta Info : Table Comment
 *
 * If specified in a table info array, a comment will be inserted
 * for the table (if the database engine in use supports table comments)
 */
define("DB_TABLE_COMMENT",	301);

if (!defined("DB_ENGINE")) define("DB_ENGINE","mysql");
include_once(BASE."subsystems/database/".DB_ENGINE.".php");

/**
 * List all available database backends
 *
 * This function looks for available database engines,
 * and then returns an array to the caller.
 *
 * @return Array An associative array of engine identifiers.
 *	The internal engine name is the key, and the external
 *	descriptive name is the value.
 */
function pathos_database_backends() {
	$options = array();
	$dh = opendir(BASE."subsystems/database");
	while (($file = readdir($dh)) !== false) {
		if (is_file(BASE."subsystems/database/$file") && is_readable(BASE."subsystems/database/$file") && substr($file,-9,9) == ".info.php") {
			$info = include(BASE."subsystems/database/$file");
			$options[substr($file,0,-9)] = $info['name'];
		}
	}
	return $options;
}

function pathos_database_connect($username,$password,$hostname,$database,$dbclass = "",$new=false) {
	if ($dbclass == "" || $dbclass == null) $dbclass = DB_ENGINE;
	include_once(BASE."subsystems/database/".$dbclass.".php");
	$dbclass .= "_database";
	$newdb = new $dbclass();
	$newdb->connect($username,$password,$hostname,$database,$new);
	return $newdb;
}

?>