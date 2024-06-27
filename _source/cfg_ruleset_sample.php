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
		
		File Description:
			Rulset for specific CMS Settings. With this file you can change 
			some primary CMS Functionalities in Site Module determination
			and more. Take a look at the configuration below and change it if you
			need to. After you made changes, rename the file to cfg_ruleset.php
	*/
	##############################################################################################	
	// Informations about this file
	##############################################################################################	

		##########################################################################################
		// intial Rules for this CMS.
		// All this rules can also be setup in the _administrator interface.
		// This file is only meant to be used by active module or cms developers.
		// You can do all required stuff in the website itself if you are a regular user..
		##########################################################################################	
		// Change File name to cfg_ruleset.php if you want to edit something here!
		// This file is optional and only executed if it exists.
		##########################################################################################	
	
	##############################################################################################	
	// Initial Loadup and Site Module Setup
	##############################################################################################	
	
		##########################################################################################
		// Allow Parallel Site Module to be switched to by admin switch action? 
		// Default value is: true
		// Its recommended to set this to false for standalone cms site module instances.
		// This are instances which are not using the _administrator or another parallel
		// Administrator site module.
		##########################################################################################
		// define('_HIVE_ALLOW_ADMIN_', true);
	
		##########################################################################################
		// Name of the administrative Site Module with possibilities to switch to by 
		// file in _core/_action/admin_switch.php
		// Default value is: "_administrator"
		##########################################################################################
		// define('_HIVE_ADMIN_SITE_', "_administrator");
	
		##########################################################################################
		// Default Site mode to be loaded, if no other has been switched to
		// and if no other one has been determined by url with: _HIVE_MOD_FETCH_
		// Default value is: "_administrator"
		// This will be the frontend site module. As default _administrator is set 
		// because no other site module is installed to be displayed at the frontend.
		##########################################################################################
		// $hive_mode_default = "_administrator";

	##############################################################################################	
	// Installer Options
	##############################################################################################	
	
		##########################################################################################
		// Title for Installation Window at initial CMS Startup 
		// Default value is: "Installation"
		##########################################################################################
		// define("_INSTALLER_TITLE_", 		"Installation");
		
		##########################################################################################
		// Default Prefix for Cookies and Sessions
		// CAUTION: Users are able to change these values at installation procedure.
		// Default value is: "bcms_"
		// MAX 10 SIGNS! DO NOT START WITH NUMBER OR SPECIAL CHAR!
		##########################################################################################
		// define("_INSTALLER_COOKIE_", 	"bcms_");
		
		##########################################################################################
		// Default Prefix for Database Tables
		// CAUTION: Users are able to change these values at installation procedure.
		// Default value is: "hive_"
		// MAX 10 SIGNS! DO NOT START WITH NUMBER OR SPECIAL CHAR!
		##########################################################################################
		// define("_INSTALLER_PREFIX_", 	"bcms_");
	
		##########################################################################################
		// Password requirement for installation procedure.
		// Default value is: false
		// False = Do not use installation password.
		// "PASSWORD" = Do use String "PASSWORD" as installation password.
		##########################################################################################
		// define("_INSTALLER_CODE_", 		false);

	##############################################################################################	
	// Site Mode determination per URL
	// You can also set environment variable in apache vhost to force override site mode
	// So you can deploy different websites with same symbolic linked folder
	// SetEnv FP2_HIVE_MODE_OVR_ENV_658 MODULENAMETOOVERRIDE
	##############################################################################################	
	
		##########################################################################################
		// You can automatically choose a site mode by the value of 
		// PHP Variable: _SERVER[HTTP_HOST]
		// Default value is: false (This will disable this functionality)
			# ARRAY to enable URL Site Mode Determination
			# Example Array:
			# array(
			# 	array("url" => "x.domain", "mode" => "xdomainmod"), 
			# 	array("url" => "x1.domain", "mode" => "xdomainmod1"), 
			# 	array("url" => "x2.domain", "mode" => "xdomainmod2")
			# )	
		##########################################################################################
		// define("_HIVE_MOD_FETCH_", 		false);

	##############################################################################################	
	// PHP Error Functionalities
	##############################################################################################	
	
		##########################################################################################
		// PHP Logfile Location to Write (false to leave webserver default)
		// Default value is: false
		// This will leave the default PHP logfile location.
		##########################################################################################
		// define('_HIVE_PHP_LOG_PATH_', false);
	
		##########################################################################################
		// Activate CMS PHP Errors for Debugging on Initialization?
		// Recommended for PHP Error 500 Malfunction debugging.
		// Default value is: false
		// It is advised to set this on false productive, to net let visitors see any php errors.
		// Uncomment this to allow PHP Errors on initialization!
		##########################################################################################
		// define('_HIVE_PHP_DISPLAY_ERROR_ON_START_', 1);
	
	##############################################################################################	
	// Store Functionality
	##############################################################################################		
	
		##########################################################################################
		// You can use your own update and store server!
		// Use different store server instances at the same time and switch between them 
		// In the administrator module!
		// Only change if you know what you are doing, otherwhise store wont work anymore!
		// Default Value: array("https://www.bugfish.eu")
		// Store domain may change if we change our own store domain.
		// But newest domains will always be implented in core updates as default option.
		// If nothing is changed in this ruleset file regarding this setting.
		// Uncomment to add own store url (you can add ours beside yours to still use our store)
		##########################################################################################	
		// define("_HIVE_SERVER_", array("https://STOREURL"));	
		
		
		##########################################################################################
		// This URL is for Automatic Core Updates.
		// You can connect your own server instance. To control which core updates will be avail.
		// Default Value is: "https://www.bugfish.eu"
		// Be sure you know what you do!
		// Otherwhise Core Updates wont work...
		// It is recommended to leave the default update server.
		// But you can provide the url to your own store to provide core updates.
		// Uncomment to add own core update url.
		##########################################################################################	
		// define("_HIVE_SERVER_CORE_", "https://COREUPDATEURL");	

	##############################################################################################	
	// Developer Functions Activation Settings
	##############################################################################################	
	
		##########################################################################################
		// Allow the use of /developer.php?
		// Default Value is: false
		// Uncomment to Allow use of developer.php!
		##########################################################################################		
		// define('_HIVE_MOD_CHANGES_', true); 
		
		##########################################################################################
		// Allow the use of files in _core/_tools folder for development?
		// Default Value is: false
		// Uncomment to Allow use of files in /_core/_tool which are linked in developer.php!
		##########################################################################################		
		// define('_HIVE_ALLOW_TOOLS_', true);
		
		##########################################################################################
		// Allow the use of _core/_action/token_switch.php folder for Token Based Switches?
		// Default Value is: true
		##########################################################################################		
		// define('_HIVE_ALLOW_TOKEN_', true);

	##############################################################################################	
	// Session Cookie Domain Settings
	##############################################################################################			

		##########################################################################################
		// Change the general PHP Session Cookie Domains
		// Leave undefined to not change session domain php value.
		##########################################################################################		
		// define("_HIVE_COOKIE_DOMAIN_", ".example.domain");


	##############################################################################################	
	// Maintenance Mode
	##############################################################################################		
	
		##########################################################################################
		// Set Page to Maintenance Mode? Page will NOT be accessible for anyone!
		// Default Value is: false
		##########################################################################################		
		// define("_HIVE_MAINTENANCE_", false);