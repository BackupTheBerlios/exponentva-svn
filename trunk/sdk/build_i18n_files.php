<?PHP
#
#this file is part of Exponent
#
#copyright 2005 Maxim Mueller
#
#this file is licenced underr GPL
#
#v 1.0 2005/06/17 MaxxCorp PHP5 version
###########################

#PHP5+ only version

#Note: the unique strings counter does not work yet


#first things first: do not tell me that the codes sucks - i know it sucks - big time
#please bear with me, i will function-ify and generalize it as soon as i find some time, which will shrink it to less than one third of it's current size
#until then, feel free to optimize it to your hearts content, PHP4 it, add the missing "deprecate-unused-i18n_vars" capability or add this functionality to the translation module
# or - the second best solution - wait till i get around to do it



#please set these values to wherever you want this script to work
#or wait until the translation module is in a workable state
#
$language = 'en';
#this file resides in <root of exponent>/sdk/ 
#replace "exponent" with whatever drawer name you use for your exponent installation
$dir_new = '../../exponent';












if (isset($_REQUEST['lang']))
{
	$language = $_REQUEST['lang'];
}

if (isset($_REQUEST['dir']))
{
	$new_dir = $_REQUEST['dir'];
}

$lang_files_path = $dir_new . "/subsystems/lang/". $language . "/modules/";


function recur_dir($dir)
{
	#global $permodule_vars;
	global $statistics_array;
	
	$dirlist = opendir($dir);
	while ($file = readdir ($dirlist))
	{
		if ($file != '.' && $file != '..')
		{
			$newpath = $dir.'/'.$file;
			$level = explode('/',$newpath);
			if (is_dir($newpath))
			{
				recur_dir($newpath);
			}
			else
			{
				#is it a template file ? is it in a 'views' directory - i.e. is it a translatable file?
				if((strpos($newpath, ".tpl") != FALSE) && ($level[count($level) - 2] == 'views'))
				{
					$stringtosearch = file_get_contents($newpath);
					preg_match_all("/i18n_\w*/" , $stringtosearch, $results);
					#do we have i18n strings in this template ?
					if(count($results[0]) > 0)
					{
						# get name of module
						$depth_of_tree = count($level);
						$name_of_module = $level[$depth_of_tree - 3];
						$name_of_view = substr(end($level), 0, -4);
												
						foreach($results[0] as $result)
						{
							
							$statistics_array[] = array($name_of_module,$name_of_view,$result,$newpath);
							#$temp_array1[] = $result;
							
						}
					}
				}
			}
		}
	}
	closedir($dirlist);
	/*
	if(isset($temp_array1))
	{
		$permodule_vars[$name_of_module][] = $temp_array1;
	}
	*/
	   
}


function compute_entryvalue($compare_array,$item)
{
	foreach($compare_array as $compare_item)
	{
		if($compare_item == $item)
		{
			$itemfound = TRUE;
			break;
		}
		else
		{
			$itemfound = FALSE;
		}
	}
	if($itemfound == TRUE)
	{
		return "# " . $item . " = ''\n";
	}
	else
	{
		return $item . " = 'TRANSLATE ME'\n";
	}
}



echo '<pre>';
 
#----------get all i18n_ variables---------------------------------------------------------------------------------------------------  
recur_dir($dir_new);
#group all modules and views together
sort($statistics_array);

#----------sort them by view & module, and find vars that are shared arcoss at least two views---------------------------------------------------------------------------------------------------

$prev_i18n_item = $statistics_array[0];
for($counter = 0;$counter <= count($statistics_array);$counter++)
{
	$curr_i18n_item = $statistics_array[$counter];
	
	//curr_18n_item[2] contains the viewname, has it changed ? => view finished
	if ($prev_i18n_item[1] != $curr_i18n_item[1])
	{
		//previous module & view => save unique i18n_ vars to view
		$i18n_files[$prev_i18n_item[0]][$prev_i18n_item[1]] = array_unique($i18n_files[$prev_i18n_item[0]][$prev_i18n_item[1]]);

		//curr_18n_item[2] contains the modulename, has it changed ? => module finished
		if ($prev_i18n_item[0] != $curr_i18n_item[0])
		{
			//array_merge works on non-empty arrays only => init
			$module_vars = array('dummy');
			
			//get i18n_ vars that are shared in this module
			foreach(array_keys($i18n_files[$prev_i18n_item[0]]) as $curr_view)
			{
				foreach(array_keys($i18n_files[$prev_i18n_item[0]]) as $check_view)
				{
					//no sense in comparing the same views
					if($curr_view != $check_view)
					{
						//compare the i18n strings of two views at a time => it make sense to save the common strings one translation level higher
						$module_vars = array_unique(array_merge($module_vars,array_intersect($i18n_files[$prev_i18n_item[0]][$curr_view], $i18n_files[$prev_i18n_item[0]][$check_view])));
						
					}
				}
			}
			//remove the dummy
			unset($module_vars[0]);
			sort($module_vars);
			//save the module's shared variables
			foreach($module_vars as $module_var)
			{
				$i18n_files[$prev_i18n_item[0]][] = $module_var;
				$sharedvars_module[$prev_i18n_item[0]][] = $module_var;
			}
			
		}
	}
	
	//current i18n_variable is written to view
	if(isset($curr_i18n_item[2]))
	{
		$i18n_files[$curr_i18n_item[0]][$curr_i18n_item[1]][] =  $curr_i18n_item[2];
	}
	$prev_i18n_item = $curr_i18n_item;
}
#print_r($sharedvars_module);

#-----------find variables shared across at least two modules------------------------------------------------------------------------------------------------------------------------


//array_merge works on non-empty arrays only => init
$sharedvars_allmodules = array('dummy');

//get i18n_ vars that are shared across at least two modules
foreach(array_keys($i18n_files) as $curr_module)
{
	//create a list with i18n_ vars in this module
	$curr_view_vars = array('dummy');
	foreach($i18n_files[$curr_module] as $curr_view)
	{
		if(is_array($curr_view))
		{
			$curr_view_vars = array_unique(array_merge($curr_view_vars,$curr_view));
		}
	}
	unset($curr_view_vars[0]);

	
	foreach(array_keys($i18n_files) as $check_module)
	{
		//no sense in comparing the same modules
		if($curr_module != $check_module)
		{
			//create a list with i18n_ vars in this module
			$check_view_vars = array('dummy');
			foreach($i18n_files[$check_module] as $check_view)
			{
				if(is_array($check_view))
				{
					$check_view_vars = array_unique(array_merge($check_view_vars,$check_view));
				}
			}
			unset($check_view_vars[0]);

		
			//compare the i18n strings of two modules at a time => it makes sense to save the common strings one translation level higher
			$sharedvars_allmodules = array_unique(array_merge($sharedvars_allmodules,array_intersect($curr_view_vars, $check_view_vars)));
		}
	}
}
//remove the dummy
unset($sharedvars_allmodules[0]);
sort($sharedvars_allmodules);
//save the module's shared variables
foreach($sharedvars_allmodules as $modules_var)
{
	$i18n_files[] = $modules_var;
}

#-----------write the stuff into the appropriate *.i18n files------------------------------------------------------------------------------------------------------
foreach(array_keys($i18n_files) as $curr_module)
{
	if(is_array($i18n_files[$curr_module]))
	{
		foreach(array_keys($i18n_files[$curr_module]) as $curr_view)
		{
			if(is_array($i18n_files[$curr_module][$curr_view]))
			{
				$view_to_write = $i18n_files[$curr_module][$curr_view];
				#sort($view_to_write);
				$ourfile = $lang_files_path . $curr_module . '.' . $curr_view . '.i18n';
				#echo "[ $curr_module $curr_view]\n";
				
				#print_r($view_to_write);
				unset($ourfile_contents);
				unset($duplicates);
				//do not overwrite preexisting entries in files
				if(file_exists($ourfile))
				{
					$ourfile_contents = file($ourfile);
					#print_r($ourfile_contents);
					foreach($view_to_write as $view_var)
					{
						foreach($ourfile_contents as $ourfile_item)
						{
							//eliminate preexisting entries from $view_to_write
							//BUG: strpos finds "i18n_edit" in "i18n_edit_desc" too ->some new i18n_ strings are not recognized to be new !
							//CIRCUMVENT: rely on the fact that entries in the file have a "space" after the string
							if(strpos($ourfile_item,$view_var . " " ) !== FALSE)
							{
								$duplicates[] = $view_var;
								unset($i18n_files[$curr_module][$curr_view][array_search($view_var,$i18n_files[$curr_module][$curr_view])]);
								#echo "duplicate found: $view_var in $ourfile_item\n";
							}
							
							//TODO: do we have vars in the file that are no longer needed ?
							#either it's just not in this entry or it's no longer in use at all
							#make it a "was removed" candidate here
							#unmake it's candidacy if 
						}
						
					}
					
					//do we have additional i18n variables since the last run
					if(isset($duplicates))
					{
						$view_to_write = array_diff($view_to_write,$duplicates);
						//substract the duplicates from the old file here
					}
					
					
				}
				
				foreach($view_to_write as &$i18n_item)
				{
					if(array_key_exists($curr_module,$sharedvars_module))
					{
						$i18n_item = compute_entryvalue(array_unique(array_merge($sharedvars_allmodules,$sharedvars_module[$curr_module])),$i18n_item);
					}
					else
					{
						$i18n_item = compute_entryvalue($sharedvars_allmodules,$i18n_item);
					}
				}
				
				
				//if there was a preexisting file append our new stuff to it
				if(isset($ourfile_contents))
				{
					$view_to_write = array_merge($ourfile_contents,$view_to_write);
				}
				
				file_put_contents($ourfile,$view_to_write);
				#print_r($view_to_write);				
			}
			else
			{
			
				$ourfile = $lang_files_path . $curr_module . '.i18n';
				
				$module_to_write = $sharedvars_module[$curr_module];
				
				unset($duplicates);
				unset($ourfile_contents);
				
				
				
				//do not overwrite preexisting entries in files
				if(file_exists($ourfile))
				{
					$ourfile_contents = file($ourfile);
					#print_r($ourfile_contents);
					foreach($module_to_write as $module_var)
					{
						foreach($ourfile_contents as $ourfile_item)
						{
							//eliminate preexisting entries from $view_to_write
							//BUG: strpos finds "i18n_edit" in "i18n_edit_desc" too ->some new i18n_ strings are not recognized to be new !
							//CIRCUMVENT: rely on the fact that entries in the file have a "space" after the string
							if(strpos($ourfile_item,$module_var . " " ) !== FALSE)
							{
								$duplicates[] = $module_var;
								unset($i18n_files[$curr_module][array_search($module_var,$i18n_files[$curr_module])]);
								#echo "duplicate found: $view_var in $ourfile_item\n";
							}
							
							//TODO: do we have vars in the file that are no longer needed ?
							#either it's just not in this entry or it's no longer in use at all
							#make it a "was removed" candidate here
							#unmake it's candidacy if 
						}
						
					}
					
					//do we have additional i18n variables since the last run
					if(isset($duplicates))
					{
						$module_to_write = array_diff($module_to_write,$duplicates);
						//substract the duplicates from the old file here
					}
					
					
				}
				
				
				
				#unset($module_to_write);
				foreach($module_to_write as &$i18n_item)
				{
					$i18n_item = compute_entryvalue($sharedvars_allmodules,$i18n_item);
				}
				
				//if there was a preexisting file append our new stuff to it
				if(isset($ourfile_contents))
				{
					$module_to_write = array_merge($ourfile_contents,$module_to_write);
				}
				
				file_put_contents($ourfile,$module_to_write);
				break;
			}
		}
	}
}


$ourfile = $lang_files_path . 'modules.i18n';
				
$modules_to_write = $sharedvars_allmodules;

unset($duplicates);
unset($ourfile_contents);



//do not overwrite preexisting entries in files
if(file_exists($ourfile))
{
	$ourfile_contents = file($ourfile);
	#print_r($ourfile_contents);
	foreach($modules_to_write as $modules_var)
	{
		foreach($ourfile_contents as $ourfile_item)
		{
			//eliminate preexisting entries from $view_to_write
			//BUG: strpos finds "i18n_edit" in "i18n_edit_desc" too ->some new i18n_ strings are not recognized to be new !
			//CIRCUMVENT: rely on the fact that entries in the file have a "space" after the string
			if(strpos($ourfile_item,$modules_var . " " ) !== FALSE)
			{
				$duplicates[] = $modules_var;
				unset($i18n_files[array_search($modules_var,$i18n_files)]);
				#echo "duplicate found: $view_var in $ourfile_item\n";
			}
			
			//TODO: do we have vars in the file that are no longer needed ?
			#either it's just not in this entry or it's no longer in use at all
			#make it a "was removed" candidate here
			#unmake it's candidacy if 
		}
		
	}
	
	//do we have additional i18n variables since the last run
	if(isset($duplicates))
	{
		$modules_to_write = array_diff($modules_to_write,$duplicates);
		//substract the duplicates from the old file here
	}
	
	
}



#unset($module_to_write);
foreach($modules_to_write as &$i18n_item)
{
	$i18n_item = compute_entryvalue(array('qwertzuiopü'),$i18n_item);
}

//if there was a preexisting file append our new stuff to it
if(isset($ourfile_contents))
{
	$modules_to_write = array_merge($ourfile_contents,$modules_to_write);
}

file_put_contents($ourfile,$modules_to_write);

/*
//TODO: check for preexisting
$ourfile = $lang_files_path . 'modules.i18n';
foreach($sharedvars_allmodules as $i18n_item)
{
	$modules_to_write[] = compute_entryvalue(array('dummy'),$i18n_item);
}
file_put_contents($ourfile,$modules_to_write);
*/

//TODO: remove only those items from i18n_files that are not deactivated
//TODO: remove empty subarrays to make the count precise
#echo count($i18n_files, COUNT_RECURSIVE) . " NEW unique I18n Strings yet left to translate\n";
#print_r($i18n_files);

echo '</pre>';
?>