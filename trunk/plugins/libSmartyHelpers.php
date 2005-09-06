<?php
/*
 * Created on 06.09.2005 by MaxxCorp (c) 2005 Maxim Mueller
 *
 * This file is part of Exponent
 *
 * Exponent is free software; you can redistribute
 * it and/or modify it under the terms of the GNU
 * General Public License as published by the Free
 * Software Foundation; either version 2 of the
 * License, or (at your option) any later version.
 *
 * Exponent is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR
 * PURPOSE.  See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU
 * General Public License along with Exponent; if
 * not, write to:
 *
 * Free Software Foundation, Inc.,
 * 59 Temple Place,
 * Suite 330,
 * Boston, MA 02111-1307  USA
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
*/ 
 
 	//convert into associative arrays
	function glob2keyedArray($workArray){
		$temp = array();
		foreach($workArray as $myWorkFile){
			$temp[basename($myWorkFile)] = $myWorkFile;
		} 
		return $temp;
	}
	
	//convert to relative paths for linking
	function absolute2relative($inPath) {
		//TODO: Investigate the chances of BASE occurring more than once
		$outPath = str_replace(BASE, PATH_RELATIVE, $inPath);
		return $outPath;
	}
?>
