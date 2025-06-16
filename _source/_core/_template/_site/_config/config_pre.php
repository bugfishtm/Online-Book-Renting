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
			This File Configuration will be executed BEFORE the Initialization. 
			See Documentation for more insights about initialization.
	*/ if(!is_array(@$object)) { http_response_code(404); Header("Location: ../"); exit(); }

	/////////////////////////////////////////////////////////////////////////////
	## Default Authentication and Account Functionalitites
	/////////////////////////////////////////////////////////////////////////////
		# General Login Form Active?
		// define("_HIVE_ACTION_MAILCHANGE_", false);
		# General Activation Form Active?
		// define("_HIVE_ACTION_RECOVER_", false);
		# General Recover Form Active?
		// define("_HIVE_ACTION_LOGIN_", false);
		# General Register Form Active?
		// define("_HIVE_ACTION_REGISTER_", false);

	/////////////////////////////////////////////////////////////////////////////
	## URL Settings
	/////////////////////////////////////////////////////////////////////////////
		# URL of this Page // Setting can be Overwritten as from settings.php
		# This is only needed for multi site purposes and if automatically fetching per browser url
		# is deactivated
		//define('_HIVE_URL_',  					$object["url"]); 
		
	/////////////////////////////////////////////////////////////////////////////
	## Language Settings
	/////////////////////////////////////////////////////////////////////////////
		// define("_HIVE_LANG_DEFAULT_", 			"en"); # Array with Default Language
		// define("_HIVE_LANG_ARRAY_", 			array("en", "de", "ja", "es", "zh", "it", "fr", "ru", "kr", "pt", "in", "tr")); # Array with valid Languages
		#_HIVE_LANG_ Contains current choosen Language
		
	/////////////////////////////////////////////////////////////////////////////
	## Theme Settings
	/////////////////////////////////////////////////////////////////////////////
		//define("_HIVE_THEME_DEFAULT_", 			"orange"); # Default Used Theme
		//define("_HIVE_THEME_ARRAY_", 			array("green", "purple", "orange", "dynamic")); # Array with valid Themes
		#_HIVE_THEME_ Contains current choosen theme

	/////////////////////////////////////////////////////////////////////////////
	## Color Settings
	/////////////////////////////////////////////////////////////////////////////
		//define("_HIVE_THEME_COLOR_DEFAULT_", 	"#FFFF00"); # Default Color for Dynamic Theme Colors
		#_HIVE_COLOR_ Contains current choosen theme







