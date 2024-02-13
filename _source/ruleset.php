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
	##########################################################################################
	// 1 / Yes - 0 / No // Display Errors before Startup procedure? (and warnings)
	##########################################################################################
	define('_HIVE_PHP_DISPLAY_ERROR_ON_START_', 1); 
	
	##########################################################################################
	// PHP Logfile Location to Write (false to leave default)
	##########################################################################################
	//define('_HIVE_PHP_LOG_PATH_', $object["path"]."/_internal/php_error.log");
	define('_HIVE_PHP_LOG_PATH_', false);
	
	##########################################################################################
	// Allow the use of /developer.php?
	##########################################################################################		
	define('_HIVE_MOD_CHANGES_', false); 
	
	##########################################################################################
	// Allow the use of files in _core/_tools folder for development?
	##########################################################################################		
	define('_HIVE_ALLOW_TOOLS_', false);

	##########################################################################################
	// Enable the Internal Administration Backend?
	##########################################################################################	
	define('_HIVE_ALLOW_ADMIN_', false);
	# You can change the Administrator Site Module for the Switch Functionality
	define('_HIVE_ADMIN_SITE_', "obr");
	
	##########################################################################################
	// Setting Types to fetch Site Mode
	##########################################################################################
	// Default Site mode to use:	
	$hive_mode_default = "obr";
	
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
		define('_HIVE_MOD_FETCH_',   false);
		
		#####################################################################################
		// Type 2 - Override Site Mode to use only one Module + optional Admin Area
		// If _HIVE_ALLOW_ADMIN_ is activated!
		// False - No Override
		// String - Site Module to Overwritte 
		#####################################################################################
		$hive_mode_override = false;

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
		$hive_mode_array = false;
		
	##########################################################################################
	// You can use your own update and store server by using the _site/_internal/_store folder!
	// Only change if you know what you are doing!
	// Otherwhise Core Updates and Store in the Administrator Site Module wont work...
	##########################################################################################	
	//define("_HIVE_SERVER_", "https://www.bugfish.eu");		
	define("_HIVE_SERVER_", "https://bugfish.eu");