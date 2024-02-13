<?php
	/* 	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
	    Bugfish Fast PHP Page Framework
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
	*/
	if(@$object["path"]) { if(file_exists(@$object["path"]."/ruleset.php")) { require_once($object["path"]."/ruleset.php"); } } else { Header("Location: ../"); }	
	##########################################################################################
	// Allow the use of /developer.php?
	##########################################################################################	
	if(!defined("_HIVE_MOD_CHANGES_")) { define('_HIVE_MOD_CHANGES_', true); }
	
	##########################################################################################
	// Allow the use of files in _core/_tools folder for development?
	##########################################################################################	
	if(!defined("_HIVE_ALLOW_TOOLS_")) { define('_HIVE_ALLOW_TOOLS_', true); }
	
	##########################################################################################
	// Enable the Internal Administration Frontend?
	##########################################################################################	
	if(!defined("_HIVE_ALLOW_ADMIN_")) { define('_HIVE_ALLOW_ADMIN_', true);	 }
	# You can change the Administrator Site // Not Recommended
	if(!defined("_HIVE_ADMIN_SITE_")) { define('_HIVE_ADMIN_SITE_', "_administrator");	 }
	
	##########################################################################################
	// Setting Types to fetch Site Mode
	##########################################################################################
	// Default Site mode to use:
	if(!@$hive_mode_default) { $hive_mode_default = "_administrator"; }
	
		#####################################################################################
		// Type 1 - Fetch from URL (for Multi Site Purposes only!)
		#####################################################################################
		# False following constant to Disable by URL Site Mode Determination
		# ARRAY to enable URL Site Mode Determination
		# Example Array:
		# array(
		# 	array("url" => "sub.bugfish.de", "mode" => "sbtm"), 
		# 	array("url" => "bugfish.de", "mode" => "btm"),
		# 	array("url" => "bugfish-github.de", "mode" => "bg")
		# )
		if(!defined("_HIVE_MOD_FETCH_")) { define('_HIVE_MOD_FETCH_',   false); }
		
		#####################################################################################
		// Type 2 - Override Site Mode to use only one Module + optional Admin Area
		// If _HIVE_ALLOW_ADMIN_ is activated!
		// False - No Override
		// String - Site Module to Overwritte 
		#####################################################################################
		if(!@$hive_mode_override) { $hive_mode_override = false; }

		#####################################################################################
		// Type 3 - Fetch From Available Site Modules Folders in _site which
		// Site Modules can be used
		// If following Variable is false and Overwritte is not activated in the upper section
		// Than folder names in _site will be put into _hive_mode_array
		// You can also insert array here, this will deactivate auto-determination of folders.
		// And use this pre-given array.
		// Array Example: 
		// array("mod1", "mod1", "mod1");
		#####################################################################################
		if(!is_array(@$hive_mode_array)) { $hive_mode_array = false; }	
		
	##########################################################################################
	// You can use your own update and store server by using the _site/_internal/_store folder!
	// Only change if you know what you are doing!
	// Otherwhise Core Updates and Store in the Administrator Site Module wont work...
	##########################################################################################	
	//define("_HIVE_SERVER_", "https://www.bugfish.eu");
	if(!defined("_HIVE_SERVER_")) { define("_HIVE_SERVER_", false); }