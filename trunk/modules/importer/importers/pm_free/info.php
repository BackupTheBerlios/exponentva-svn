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
# $Id: info.php,v 1.2 2005/02/19 16:53:35 filetreefrog Exp $
##################################################

##################################################
#
#This importer module has been developed for pMachine Free ONLY.
#
#At this point, only users, blog posts, and post comments are imported.
#
#If you are importing blog posts, be sure to import users as well.
#Author IDs are matched up when importing the blog posts.
#If the pMachine user has not been imported into the Exponent
#user table, PHP errors will result and the import will be incomplete.
#
#Because it is a bit lengthy, I have not included a map of
#importing process. If you would like to see this, contact me.
#I will e-mail you a copy of the dataflow diagram in OpenOffice
#Draw format.
#
# -- jshinall_sf@users.sourceforge.net
#
##################################################

return array(
	"name"=>"pMachine Free Weblog Data Importer",
	"description"=>"Imports Data from pMachine Free weblog sites.",
	"author"=>"Jeremy Shinall"
);

?>
