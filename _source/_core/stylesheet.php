<?php
	/* 
		 ____  __  __  ___  ____  ____  ___  _   _ 
		(  _ \(  )(  )/ __)( ___)(_  _)/ __)( )_( )
		 ) _ < )(__)(( (_-. )__)  _)(_ \__ \ ) _ ( 
		(____/(______)\___/(__)  (____)(___/(_) (_) www.bugfish.eu
				 ___ _   _ ___ _____ ___ ___ ___ ___ _  _ 
				/ __| | | |_ _|_   _| __| __|_ _/ __| || |
				\__ \ |_| || |  | | | _|| _| | |\__ \ __ |
				|___/\___/|___| |_| |___|_| |___|___/_||_|
		Copyright (C) 2024 Jan Maurice Dahlmanns [Bugfish]

		This program is free software: you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation, either version 3 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program.  If not, see <https://www.gnu.org/licenses/>.	
		
		File Description:
			Stylesheet Loader file to load Files out of Site Module Directory 
			reltated to current active site mode into this file to be included in 
			the website. You can include this stylesheet in your site modules header
			and it will include all your _css/css.* files and extension css files
			automatically.
	*/
	// Include Settings.php
	define("_HIVE_SHORT_INIT_", true);
	if(file_exists("../settings.php")) { require_once("../settings.php"); }
		else { echo "/* This CMS is not yet installed. Please install this CMS by visiting the websites root folder! */"; }
	  
	// Cache Setup
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	  
	// Content is Text/CSS
	header('Content-Type: text/css'); 
 
	// Output Empty Array if Current Website Error
	if(defined("_HIVE_CRIT_ER_")) {
		exit();
	}
	
	// Site Mode Infos to be consistent
	$object["hive_mode_config"] = hive__init_site_header($object, _HIVE_MODE_);
	
    // Include Necessary CSS Files into this File
	foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.*") as $filename){ 
		hive__require_once($object, $filename); 
	}
	
	// Include Extension Scripts
	foreach ($object["extensions_path"] as $filename) {
		if (is_dir($filename."/_css")) {
			$object["extension"] = hive__init_extension_header($object, basename($filename)); 
			foreach (glob($filename."/_css/css.*") as $filenamex){ 
				hive__require_once($object, $filenamex);
			}
		}	
	} unset($object["extension"]);
	  
	// Include Framework CSS File
	hive__require_once($object, "./_framework/css/xcss_xfpe.css"); 