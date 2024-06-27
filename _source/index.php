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
	*/
	
	if(file_exists("./settings.php")) {
		// Require settings.php if existant
		require_once("./settings.php");
		
		if(@trim(@$_GET["hive__seo_tag_loc"] ?? '') != ""  AND @$_GET["hive__seo_tag_loc"] != false) {
			if(!defined("_HIVE_URL_SEO_")) {
				require_once($object["path"]."/_core/_error/error.404.php");
				exit();
			} else {
				if(!_HIVE_URL_SEO_) {
					require_once($object["path"]."/_core/_error/error.404.php");
					exit();
				}
			}
		}
		
		$version = explode('.', PHP_VERSION);
		if($version[0] <= 7) {  
			hive_error_full("Critical Error", "This software does need at least PHP8.X to run properly!", "Your system is running PHP ".$version[0].", which is NOT supported!", true, 503);		
		}		
		unset($version);
		
		// Check if Public/Internal/Restricted is writeable
		if (defined("_HIVE_PATH_PRIVATE_")) {
			if ( ! is_writable(dirname(_HIVE_PATH_PRIVATE_."/dummy.file"))) {
				hive_error_full("Critical Error", "File/Folder permission error!", "The folder: '"._HIVE_PATH_PRIVATE_."' is not writeable!", true, 503);	
			}
		}
		if (defined("_HIVE_PATH_INTERNAL_")) {
			if ( ! is_writable(dirname(_HIVE_PATH_INTERNAL_."/dummy.file"))) {
				hive_error_full("Critical Error", "File/Folder permission error!", "The folder: '"._HIVE_PATH_INTERNAL_."' is not writeable!", true, 503);	
			}
		}
		if (defined("_HIVE_PATH_PUBLIC_")) {
			if ( ! is_writable(dirname(_HIVE_PATH_PUBLIC_."/dummy.file"))) {
				hive_error_full("Critical Error", "File/Folder permission error!", "The folder: '"._HIVE_PATH_PUBLIC_."' is not writeable!", true, 503);	
			}
		}
		
		// If not Site Mode Found Display Error
		if(!defined("_HIVE_BUILD_")) { 
			hive_error_full("Critical Error", "_HIVE_BUILD_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		if(!defined("_HIVE_RNAME_")) { 
			hive_error_full("Critical Error", "_HIVE_RNAME_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		if(!defined("_HIVE_VERSION_")) { 
			hive_error_full("Critical Error", "_HIVE_VERSION_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		if(!defined("_HIVE_BUILD_ACTIVE_")) { 
			hive_error_full("Critical Error", "_HIVE_BUILD_ACTIVE_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		if(!defined("_HIVE_RNAME_ACTIVE_")) { 
			hive_error_full("Critical Error", "_HIVE_RNAME_ACTIVE_ not found while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);
		}
		
		if(_HIVE_BUILD_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_BUILD_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check if the module folder exists in _site!", true, 503);		
		}
		if(_HIVE_RNAME_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_RNAME_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);		
		}
		if(_HIVE_VERSION_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_VERSION_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);		
		}
		if(_HIVE_BUILD_ACTIVE_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_BUILD_ACTIVE_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);		
		}
		if(_HIVE_RNAME_ACTIVE_ == 0) { 
			hive_error_full("Critical Error", "_HIVE_RNAME_ACTIVE_ is NULL while initializing the Side Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Please check the version.php informations of the deployed module.", true, 503);		
		}
		
		// Check Update and Build Number/RNAME
		if(_HIVE_RNAME_ != _HIVE_RNAME_ACTIVE_) {
			// Update is needed
			hive_error_full("Module Error", "The installed _HIVE_RNAME_: '".@htmlspecialchars(_HIVE_RNAME_ ?? '')."' does not match the module folders _HIVE_RNAME_ACTIVE_: '".@htmlspecialchars(_HIVE_RNAME_ACTIVE_ ?? '')."'!", "You need to delete the old data manually or in the administrator interface to use this module!", true, 503);
		} 			
		
		// Check Update and Build Number/RNAME
		if(_HIVE_BUILD_ > _HIVE_BUILD_ACTIVE_) {
			// Update is needed
			hive_error_full("Update Required", "You need to visit <a href='./updater.php'>./updater.php</a> for: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Version/Build in Database does not fit the current running site module.<br /> You may need to update this website to proceed!", true, 503);
		} 	
		// Check Update and Build Number/RNAME
		if(_HIVE_BUILD_ < _HIVE_BUILD_ACTIVE_) {
			// Update is needed
			hive_error_full("Downgrade Error", "Module: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."' files have been downgraded, please install folder build: '".@htmlspecialchars(_HIVE_BUILD_ACTIVE_ ?? '')."'!", "It is not recommended to downgrade a deployed module!", true, 503);
		} 	
		
		// Check Update and Build Number/RNAME
		if(_HIVE_BUILD_ != _HIVE_BUILD_ACTIVE_) {
			// Update is needed
			hive_error_full("Critical Error", "Critical module versioning error for: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Version/Build error with current installed module! [Install and Deployed does not fit]", true, 503);
		} 	
		
		if(defined("_HIVE_CRIT_ER_")) {
			hive_error_full("Critical Error", "Critical Page Error on: '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "Unspecified Error!", true, 503);
		}
		
		// Check for Existant load.php
		if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/load.php")) {
			// Include Load.php
			require_once("./_site/"._HIVE_MODE_."/load.php"); 
			// Execute Scripts
			$object["benchmark"]->execute($object["mysql"]->benchmark_get());
			$object["hitcounter"]->execute();
		} else { 
			// Error load.php not found!
			hive_error_full("Critical Error", "Something went wrong initializing the Side Module '".@htmlspecialchars(_HIVE_MODE_ ?? '')."'!", "We found no load.php file for activated Site Module.<br />Please re-install Site Module or check availability of related load.php.", true, 503);
		}
	} else {
		// Error without Configuration
		function hive_error_full_out($title, $subtitle, $description, $exit, $code) { 
			if(is_numeric($code)) { @http_response_code($code); }?><!DOCTYPE html><html lang="en"><head><?php if(defined("_HIVE_URL_REL_")) { ?> <link rel="icon" type="image/x-icon" href="<?php echo _HIVE_URL_REL_; ?>/_core/_image/favicon.ico"> <?php } ?>
			<title><?php echo $title; ?><?php if(defined("_HIVE_TITLE_SPACER_")) { echo _HIVE_TITLE_SPACER_; } else { echo " - "; } ?><?php if(defined("_HIVE_TITLE_")) { echo _HIVE_TITLE_; } else { echo "CMS"; } ?></title><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="robots" content="noindex, nofollow"><style>
			body {
				background-color: #080808;
				padding: 0 0 0 0 0;
				margin: 0 0 0 0;
				color: #ffffff;
				font-family: 'Courier New', Courier, monospace;
				margin: 0;
				padding: 20px;
				box-sizing: border-box;
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				min-height: 100vh;
				overflow-x: hidden;
			}
			h1 {
				font-size: 2em;
				padding-top: 0px;
				margin-top: 0px;
				margin-bottom: 20px;
			}
			p {
				font-size: 1.2em;
				line-height: 1.6;
				margin-bottom: 30px;
			}
			button {
				padding: 10px 20px;
				font-size: 1em;
				background-color: #FF5707;
				color: #ffffff;
				border: none;
				border-radius: 5px;
				cursor: pointer;
				transition: background-color 0.3s;
			}
			button:hover { background-color: #ff814a; }
			.debugging_box {
				background: #121212;
				width: 100vw;
				padding: 25px;
				padding-bottom: 0px;
				box-sizing: border-box;
			}
			.debugging_box_inner {
				max-width: 100%;
				width: 500px;
				margin: auto;
			}
			a { color: #FF5707;	}
			@media screen and (max-width: 600px) {
				h1 { font-size: 1.5em; }
				p { font-size: 1em;	}
			}
		</style></head><body><div class="debugging_box"><div class="debugging_box_inner" ><h1><?php echo $title; ?></h1><p><?php echo $subtitle; ?> <?php echo $description; ?></p></div></div></body></html><?php if($exit) { exit(); } }
		
		// If Settings.php Missing show Installation Notice
		hive_error_full_out("Installation", "You need to install at: <a href='./installer.php'>./installer.php</a>.", "We found no settings.php file!<br > It seems that this is the first time you are visiting this instance.", true, 503);
	}