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
			External Action to Log Javascript Errors if Constant Setting _HIVE_JS_ACTION_ACTIVE_ is enabled for Site Module.
	*/
	if(file_exists("../../settings.php")) { require_once("../../settings.php"); }
		else { echo "/* This CMS is not yet installed. Please install this CMS by visiting the websites root folder! */"; }

	if(defined("_HIVE_JS_ACTION_ACTIVE_") AND !defined("_HIVE_CRIT_ER_")) { 
		if(_HIVE_JS_ACTION_ACTIVE_) { 
			if(!$object["user"]->loggedIn) { $userid = 0; } else { $userid = $object["user"]->user_id; } 
			if(!is_array($object["hive_mode"])) { $tmp = ""; } else { $tmp = _HIVE_MODE_; } 
			$object["debug"]->js_error_action($object["mysql"], _TABLE_LOG_JS_, $userid, $tmp);
		}
	}