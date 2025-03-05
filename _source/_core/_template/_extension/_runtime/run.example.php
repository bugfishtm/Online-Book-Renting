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
			Hourly cronjob to be executed by server.
	*/
	// Prevent Initialization if Settings.php is included. (Recommended)
	define("_HIVE_PREVENT_INIT_", true); 
	// Check for Valid Settings File
	if(file_exists(dirname(__FILE__)."/../../../../../settings.php")) {
		// Include the Settings File
		require(dirname(__FILE__)."/../../../../../settings.php");
		// MySQL Connection and Execution
		if(file_exists($object["path"]."/_core/_framework/classes/x_class_mysql.php")) { require_once($object["path"]."/_core/_framework/classes/x_class_mysql.php"); } 
		if(file_exists($object["path"]."/_core/_framework/classes/x_class_var.php")) { require_once($object["path"]."/_core/_framework/classes/x_class_var.php"); } 
		if(file_exists($object["path"]."/_core/_framework/functions/x_library.php")) { require_once($object["path"]."/_core/_framework/functions/x_library.php"); } 
		// Only Allow in Command Line Interface
		if(!x_inCLI()) { Header("Location: ../"); @http_response_code(404); exit(); }
		// Check Database Connection
		$object["mysql"] = new x_class_mysql(@$mysql["host"], @$mysql["user"], @$mysql["pass"], @$mysql["db"], @$mysql["port"]);   
		// Execute Code if Connection Successfull
		if ($object["mysql"]->lasterror == false) {
			// Example Variable to Update in Database on each run!
			$object["var_glob"] = new x_class_var($object["mysql"], $mysql['prefix']."cms_var", "");
			$object["var_glob"]->set("__EXTEXTENSION_EXAMPLE", date("Y-m-d H:i"), "Just an example Runtime Variable", true, true);
			
			// Execute Code only if Valid MySQL Connection for MySQL Operations
			// ...
		}
		
		// Execute Code without MySQL Connection 
		// ...
	} 