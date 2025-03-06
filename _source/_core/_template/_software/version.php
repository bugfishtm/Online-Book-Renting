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
			Versioning File to Contain Module Information!
	*/ if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); }
	$x = array();

	##############################
	// Critical Module Information
	##############################
	
		// Unique Module ID
		// Identifies the module (not tied to folder/path). For official store, request at requests@bugfish.eu. 
		// Use <=10 chars, no special chars. Modules starting with _ are official.
		$x["rname"] 		= "_software";
		
		// Available Languages 
		// Available Languages in this Module Array (Default Languages: array("en", "de", "fr", "it", "es", "zh", "ja"))
		$x["lang"] 			= array("en", "de", "fr", "it", "es", "zh", "ja", "in", "kr", "pt", "ru", "tr");
		
		// Build Number:
		// Used by updater script to check updates. Stored with rname in the database. Increment only if _update script requires DB changes.
		$x["build"] 		= "100";
		
		// Module Version
		// Recommended format, ending with the build number (e.g., 1.10.[build]).
		$x["version"] 		= "1.10.".$x["build"];
		
		// Module Name 
		// This name will be shown to users as Name of this module.
		$x["name"] 			= "Template: Software Module";
		
		// Module Description 
		// Description for the Module with informations for the store or internal sites.
		$x["description"] = "This example module demonstrates the functioning of Software Module extensions within this CMS. It includes readme files explaining the use of various folders and provides a skeleton template for creating your own software modules.";

		// Parent Module
		// If this Extension/Module is related to a Parent Extension/Module enter the Parent rname below!
		// This can be an array("mod", "mod") or string for a single module.
		$x["parent_rname"] 	= false;
		
		// Module Type
		// There are different Types of Modules inside Suitefish CMS.
		// See examples in our documentation for more information.
			// 1 - Site Module
			// 2 - Extension Module
			// 3 - Image Module
			// 4 - Windows Software
			// 5 - Docker Template
			// 6 - Theme Module
			$x["type"] 			= 4;
		
		// Single Instance Module?
		// If true, than this modules rname can only be deployed a single time on that cms instance.
		// Recommended for Server Software where duplications of the module activated may lead to issues.
		// Module will be forced to use RNAME as Site Module Name for the deployed folder.
		$x["single_instance"] 	= false;	
	
	##############################
	// Module Autor Informations
	##############################
	
		// Module License (gplv3, gplv2, mit, bsd, bsd2, ...)
		$x["license"] 		= "gplv3";
		
		// Module Autor Name
		$x["autor"] 		= "Bugfish";
		
		// Module Autor Mail
		$x["mail"] 			= false;
		
		// Module Autor Website
		$x["website"] 		= "www.bugfish.eu";
		
		// Module Documentation Website
		$x["documentation"] = "https://bugfishtm.github.io/suitefish-cms/";	
	
		// Module Github Website
		$x["github"] 		= "https://github.com/bugfishtm/suitefish-cms";	

	############################################################
	// Information Dedicated to Software Modules for Launcher
	############################################################
		
		// Starter File for Windows Software
		// Starter File to be Executed in the Module Folder
		$x["software_executable"] 		= "executable.bat";
	
