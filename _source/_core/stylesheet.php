<?php
	/* 	 _           ___ _     _   _____ _____ _____ 
		| |_ _ _ ___|  _|_|___| |_|     |     |   __|
		| . | | | . |  _| |_ -|   |   --| | | |__   |
		|___|___|_  |_| |_|___|_|_|_____|_|_|_|_____|
				|___|                                
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
			the website.
	*/
	// Include Settings.php
	require_once("../settings.php");
	  
	// Cache Setup
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	  
	// Content is Text/CSS
	header('Content-Type: text/css'); 
  
    // Include Necessary CSS Files into this File
	if($object["user"]->loggedIn) {
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.global.*") as $filename){ require_once $filename; }
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.restricted.*") as $filename){ require_once $filename; }
	} else {
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.global.*") as $filename){ require_once $filename; }
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_css/css.public.*") as $filename){ require_once $filename; }
	}
	
	// Include Extension Scripts
	foreach ($object["extensions_path"] as $filename) {
		$object["extension"] = array(); $object["extension"]["name"] = basename($filename);
		$object["extension"]["prefix"] =  _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
		$object["extension"]["cookie"] =  _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
		if (is_dir($filename."/_css")) {
			if($object["user"]->loggedIn) {
				foreach (glob($filename."/_css/css.global.*") as $filenamex){ require_once $filenamex; }
				foreach (glob($filename."/_css/css.restricted.*") as $filenamex){ require_once $filenamex; }
			} else {
				foreach (glob($filename."/_css/css.global.*") as $filenamex){ require_once $filenamex; }
				foreach (glob($filename."/_css/css.public.*") as $filenamex){ require_once $filenamex; }
			}
		}	
	}	
	  
	// Include Framework CSS File
	require_once("../_framework/css/xcss_xfpe.css");	  