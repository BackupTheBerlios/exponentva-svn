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

if (!defined('EXPONENT')) exit('');

if (exponent_permissions_check('order_modules',$loc)) {
	$db->switchValues('container','rank',$_GET['a'],$_GET['b'],"external='".serialize($loc)."'");
    if (isset($_SESSION['containers_cache']))
        unset($_SESSION['containers_cache']);
    exponent_flow_redirect();
} else {
	echo SITE_403_HTML;
}

?>
