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
	*/ if(!is_array($object)) { @http_response_code(503); echo "Startup Error - Please delete your settings.php file and re-install this instance..."; exit(); }	
	#################################################################################################################################################
	// Define Defaults
	#################################################################################################################################################
		define("_HIVE_CREATOR_", 'Powered by <a href="https://github.com/bugfishtm/bugfish-cms" rel="noopener" target="_blank">Bugfish CMS</a>!');
		
	#################################################################################################################################################
	// Includes and Requirements
	#################################################################################################################################################
		require_once($object["path"]."/_framework/classes/x_class_2fa.php");
		require_once($object["path"]."/_framework/classes/x_class_api.php");
		require_once($object["path"]."/_framework/classes/x_class_benchmark.php");
		require_once($object["path"]."/_framework/classes/x_class_block.php");
		require_once($object["path"]."/_framework/classes/x_class_comment.php");
		require_once($object["path"]."/_framework/classes/x_class_crypt.php");
		require_once($object["path"]."/_framework/classes/x_class_csrf.php");
		require_once($object["path"]."/_framework/classes/x_class_curl.php");
		require_once($object["path"]."/_framework/classes/x_class_debug.php");
		require_once($object["path"]."/_framework/classes/x_class_eventbox.php");
		require_once($object["path"]."/_framework/classes/x_class_hitcounter.php");
		require_once($object["path"]."/_framework/classes/x_class_ipbl.php");
		require_once($object["path"]."/_framework/classes/x_class_lang.php");
		require_once($object["path"]."/_framework/classes/x_class_log.php");
		require_once($object["path"]."/_framework/classes/x_class_mail.php");
		require_once($object["path"]."/_framework/classes/x_class_mail_item.php");
		require_once($object["path"]."/_framework/classes/x_class_mail_phpmailer.php");
		require_once($object["path"]."/_framework/classes/x_class_mail_template.php");
		require_once($object["path"]."/_framework/classes/x_class_mysql.php");
		require_once($object["path"]."/_framework/classes/x_class_mysql_item.php");
		require_once($object["path"]."/_framework/classes/x_class_perm.php");
		require_once($object["path"]."/_framework/classes/x_class_perm_item.php");
		require_once($object["path"]."/_framework/classes/x_class_redis.php");
		require_once($object["path"]."/_framework/classes/x_class_referer.php");
		require_once($object["path"]."/_framework/classes/x_class_table.php");
		require_once($object["path"]."/_framework/classes/x_class_user.php");
		require_once($object["path"]."/_framework/classes/x_class_var.php");
		require_once($object["path"]."/_framework/classes/x_class_version.php");
		require_once($object["path"]."/_framework/classes/x_class_zip.php");
		
	#################################################################################################################################################
	// Requirements of Framework Functionalities
	#################################################################################################################################################
		require_once($object["path"]."/_framework/functions/x_button.php");
		require_once($object["path"]."/_framework/functions/x_captcha.php");
		require_once($object["path"]."/_framework/functions/x_cookiebanner.php");
		require_once($object["path"]."/_framework/functions/x_curl.php");
		require_once($object["path"]."/_framework/functions/x_eventbox.php");
		require_once($object["path"]."/_framework/functions/x_library.php");
		require_once($object["path"]."/_framework/functions/x_rss.php");
		require_once($object["path"]."/_framework/functions/x_search.php");
		require_once($object["path"]."/_framework/functions/x_table.php");
		
	#################################################################################################################################################
	// Requirements of _core/_lib/*
	#################################################################################################################################################
		require_once($object["path"]."/_core/_lib/lib.__hive.php");
		require_once($object["path"]."/_core/_lib/lib._adminbsb.php");
		require_once($object["path"]."/_core/_lib/lib._simple.php");
		require_once($object["path"]."/_core/_lib/lib._volt.php");
		require_once($object["path"]."/_core/_lib/lib._windmill.php");
		
	#################################################################################################################################################
	// Create Maybe lost Folders
	#################################################################################################################################################
		hive__folder_create($object["path"]."/_domain", true, false);
		hive__folder_create($object["path"]."/_ext", true, false);
		hive__folder_create($object["path"]."/_image", true, false);
		hive__folder_create($object["path"]."/_internal", true, true);
		hive__folder_create($object["path"]."/_internal/_cache", true, true);
		hive__folder_create($object["path"]."/_internal/_docker-tpl", true, true);
		hive__folder_create($object["path"]."/_internal/_ext-dn", true, true);
		hive__folder_create($object["path"]."/_internal/_ext-tpl", true, true);
		hive__folder_create($object["path"]."/_internal/_image-tpl", true, true);
		hive__folder_create($object["path"]."/_internal/_image-dn", true, true);
		hive__folder_create($object["path"]."/_internal/_site-dn", true, true);
		hive__folder_create($object["path"]."/_internal/_site-tpl", true, true);
		hive__folder_create($object["path"]."/_internal/_script-tpl", true, true);
		hive__folder_create($object["path"]."/_public", true, false);
		hive__folder_create($object["path"]."/_restricted", true, true);
		hive__folder_create($object["path"]."/_script", true, false);
		hive__folder_create($object["path"]."/_site", true, false);		
		hive__folder_create($object["path"]."/_store", true, false);
		hive__folder_create($object["path"]."/_store/_core", true, false);
		hive__folder_create($object["path"]."/_store/_core-cl", true, false);
		hive__folder_create($object["path"]."/_store/_module-zip", true, false);
		hive__folder_create($object["path"]."/_store/_module-cache", true, false);
		hive__folder_create($object["path"]."/_store/_module-cl", true, false);
		hive__folder_create($object["path"]."/_store/_module-img", true, false);		
		hive__folder_create($object["path"]."/_store/_hub", true, false);		
		hive__folder_create($object["path"]."/_store/_hub/_releases", true, false);		
		hive__folder_create($object["path"]."/_store/_hub/_downloads", true, false);		
		hive__folder_create($object["path"]."/_store/_app", true, false);		
		hive__folder_create($object["path"]."/_store/_app/_releases", true, false);		
		
	#################################################################################################################################################
	// Instance Internal Settings
	#################################################################################################################################################
		if(file_exists(@$object["path"]."/cfg_ruleset.php")) { require_once($object["path"]."/cfg_ruleset.php"); } 	
		if(!defined("_HIVE_PHP_DISPLAY_ERROR_ON_START_")) { define('_HIVE_PHP_DISPLAY_ERROR_ON_START_', 0); }
		if(!defined("_HIVE_PHP_LOG_PATH_")) { define('_HIVE_PHP_LOG_PATH_', false); }
		if(!defined("_HIVE_PATH_PUBLIC_")) { define('_HIVE_PATH_PUBLIC_', @$object["path"]."/_public"); }
		if(!defined("_HIVE_PATH_PRIVATE_")) { define('_HIVE_PATH_PRIVATE_', @$object["path"]."/_restricted"); }	
		if(!defined("_HIVE_PATH_INTERNAL_")) { define('_HIVE_PATH_INTERNAL_', @$object["path"]."/_internal"); }
		if(!defined("_HIVE_MOD_CHANGES_")) { define('_HIVE_MOD_CHANGES_', false); }
		if(!defined("_HIVE_ALLOW_TOOLS_")) { define('_HIVE_ALLOW_TOOLS_', false); }
		if(!defined("_HIVE_MAINTENANCE_")) { define('_HIVE_MAINTENANCE_', false); }
		if(!defined("_HIVE_ALLOW_ADMIN_")) { define('_HIVE_ALLOW_ADMIN_', true);	 }
		if(!defined("_HIVE_ALLOW_TOKEN_")) { define('_HIVE_ALLOW_TOKEN_', true);	 }
		if(!defined("_HIVE_ADMIN_SITE_")) { define('_HIVE_ADMIN_SITE_', "_administrator");	 }
		if(!@$hive_mode_default) { $hive_mode_default = "_administrator"; }
		if(!defined("_HIVE_MOD_FETCH_")) { define('_HIVE_MOD_FETCH_',   false); }
		if(!defined("_HIVE_MAINTENANCE_")) { define('_HIVE_MAINTENANCE_',   false); }
		if(!@$hive_mode_override) { $hive_mode_override = false; }
		if(!is_array(@$hive_mode_array)) { $hive_mode_array = false; }	
		if(!defined("_HIVE_SERVER_")) { define("_HIVE_SERVER_", array("https://store.bugfish.eu")); }
		if(!defined("_HIVE_SERVER_CORE_")) { define("_HIVE_SERVER_CORE_", "https://store.bugfish.eu"); }
		if(defined("_HIVE_COOKIE_DOMAIN_")) { ini_set('session.cookie_domain', _HIVE_COOKIE_DOMAIN_); }	
		if(_HIVE_MAINTENANCE_) {
			hive_error_full("Maintenance", "Site is in maintenance mode!", "Please come back later.", true, 503);
		}
		
	#################################################################################################################################################
	// Error Reporting
	#################################################################################################################################################
		error_reporting(E_ALL); 
		ini_set('log_errors', TRUE);
		if(defined("_HIVE_PHP_LOG_PATH_")) { if(_HIVE_PHP_LOG_PATH_) { ini_set('error_log',_HIVE_PHP_LOG_PATH_);}}
		if(defined("_HIVE_PHP_DISPLAY_ERROR_ON_START_")) { ini_set('display_errors', _HIVE_PHP_DISPLAY_ERROR_ON_START_); } else { ini_set('display_errors', 0); }
		
	#################################################################################################################################################
	// Start Session
	#################################################################################################################################################
	session_start();

	#################################################################################################################################################
	// Constants for Tables
	#################################################################################################################################################
		$object["prefix"]						= @$mysql["prefix"];
		
		// Default Table Constants - Classes Auto-Creation
		define("_TABLE_LOG_", 				$object["prefix"]."log");
		define("_TABLE_LOG_IP_", 			$object["prefix"]."log_ip");
		define("_TABLE_LOG_BENCHMARK_", 	$object["prefix"]."log_benchmark");
		define("_TABLE_LOG_CURL_", 			$object["prefix"]."log_curl");
		define("_TABLE_LOG_MAIL_", 			$object["prefix"]."log_mail");
		define("_TABLE_LOG_MYSQL_", 		$object["prefix"]."log_mysql");
		define("_TABLE_LOG_REFERER_", 		$object["prefix"]."log_referer");
		define("_TABLE_LOG_CRON_", 			$object["prefix"]."log_cron");
		define("_TABLE_LOG_JS_", 			$object["prefix"]."log_js");
		define("_TABLE_LOG_VISIT_", 		$object["prefix"]."log_hitcounter");
		
		// Default Table Constants - Classes Auto-Creation
		define("_TABLE_USER_", 				$object["prefix"]."user");
		define("_TABLE_USER_EXTRAFIELDS_", 	$object["prefix"]."user_extrafields");
		define("_TABLE_USER_SESSION_",		$object["prefix"]."user_session");
		define("_TABLE_USER_PERM_",			$object["prefix"]."user_perm");
		define("_TABLE_USER_GROUP_",		$object["prefix"]."user_group");
		define("_TABLE_USER_GROUP_PERM_",	$object["prefix"]."user_group_perm");
		define("_TABLE_USER_GROUP_LINK_",	$object["prefix"]."user_group_link");
		
		// Default Table Constants - Classes Auto-Creation
		define("_TABLE_VAR_", 				$object["prefix"]."sys_var");
		define("_TABLE_LANG_",				$object["prefix"]."sys_lang");
		define("_TABLE_MAIL_TPL_",			$object["prefix"]."sys_template_mail");
		define("_TABLE_API_", 				$object["prefix"]."sys_api");
		define("_TABLE_COMMENT_", 			$object["prefix"]."sys_comment");
		
		// Tables for Store and Token Access to Modules - Installed out of _core/_mysql folder!
		define("_TABLE_STORE_", 			$object["prefix"]."store");
		define("_TABLE_HUB_", 				$object["prefix"]."hub");
		define("_TABLE_TOKEN_",				$object["prefix"]."token");
		
	#################################################################################################################################################
	// Constant Definitions
	#################################################################################################################################################
		define("_HIVE_PREFIX_", 				@$mysql["prefix"]);
		define("_HIVE_COOKIE_", 				@$object["cookie"]);
		define("_HIVE_PATH_", 					@$object["path"]);	

	#################################################################################################################################################
	// Internal.php Determine Hive Mode
	#################################################################################################################################################
		if($hive_mode_override) { define("_HIVE_MODE_DEFAULT_", $hive_mode_override); } else { define("_HIVE_MODE_DEFAULT_", $hive_mode_default); } unset($hive_mode_default);
		if($hive_mode_override) { if(_HIVE_ALLOW_ADMIN_) {define("_HIVE_MODE_ARRAY_", array($hive_mode_override, _HIVE_ADMIN_SITE_));} else {define("_HIVE_MODE_ARRAY_", array($hive_mode_override));} } 
			elseif(@is_array(@$hive_mode_array)) { if(_HIVE_ALLOW_ADMIN_) { array_push($hive_mode_array, _HIVE_ADMIN_SITE_); define("_HIVE_MODE_ARRAY_", $hive_mode_array);} else {define("_HIVE_MODE_ARRAY_", $hive_mode_array);} } 
		if(!$hive_mode_override) {	
			$directory = $object["path"]."/_site";
			$folders = array();
			if (is_dir($directory)) {
				$contents = scandir($directory);
				foreach ($contents as $item) {
					$itemPath = $directory . '/' . $item;
					if (is_dir($itemPath) && !in_array($item, array('.', '..'))) {
						$folders[] = $item;
					}
					unset($itemPath);
				} unset($item);
			} if(_HIVE_ALLOW_ADMIN_) {define("_HIVE_MODE_ARRAY_", $folders);} 
			else {
				if (($key = array_search(_HIVE_ADMIN_SITE_, $folders)) !== false) { 
					unset($folders[$key]);
				} define("_HIVE_MODE_ARRAY_", $folders);
			} 	 
		} unset($hive_mode_array); unset($directory);	unset($folders); unset($contents); unset($key);	
		
		// Switch _HIVE_MODE_
		if(!isset($_SESSION[_HIVE_COOKIE_."hive_mode"])) { @$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_MODE_DEFAULT_; }		
		if(@is_string(@$_SESSION[_HIVE_COOKIE_."hive_mode"]) AND  @in_array(@$_SESSION[_HIVE_COOKIE_."hive_mode"], @_HIVE_MODE_ARRAY_)) {
		} else {  
			$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_MODE_DEFAULT_;
		}			
		if(is_array(_HIVE_MOD_FETCH_) AND !$hive_mode_override) {
			$found_new = false;
			$found_url = false;
			if(is_array(_HIVE_MOD_FETCH_)) { 
				foreach(_HIVE_MOD_FETCH_ as $key => $value) {
					if( strpos($_SERVER['HTTP_HOST'], $value["url"]) > -1)  {
						$found_new = $value["mode"];		
						$found_url = $value["url"];		
					}					
				}
			}
			if(!$found_new) { hive_error_full("Dynamic URL Error", "Site Mode could not be determined by URL!", "Please check your dynamic site mode by domain settings in the administrator interface or at ruleset.php.", true, 503); }
			else {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = $found_new;
				define("_HIVE_URL_", $found_url."/");
			}
		}			
		// Override _HIVE_MODE_
		if($hive_mode_override AND $_SESSION[_HIVE_COOKIE_."hive_mode"] != $hive_mode_override) {
			if(_HIVE_ALLOW_ADMIN_ AND $_SESSION[_HIVE_COOKIE_."hive_mode"] == _HIVE_ADMIN_SITE_) {
			} elseif(!_HIVE_ALLOW_ADMIN_ AND $_SESSION[_HIVE_COOKIE_."hive_mode"] == _HIVE_ADMIN_SITE_) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = $hive_mode_override;
			} else {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = $hive_mode_override;
			}
		} unset($hive_mode_override);  
		
		// Check for Hive Mode per SetEnv Variable 
		$ovr_hive_mode_getenv = @getenv("FP2_HIVE_MODE_OVR_ENV_658"); 
		if(strlen($ovr_hive_mode_getenv) > 0 AND trim($ovr_hive_mode_getenv ?? '') != "") { 
			if(@in_array($ovr_hive_mode_getenv, _HIVE_MODE_ARRAY_)) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = $ovr_hive_mode_getenv;
			} else { 
				hive_error_full("Module Missing", "A Site Module is missing, which has been overrided by Apache2 Environment Variables!", "You have set the Apache2 Environment Variable: 'FP2_HIVE_MODE_OVR_ENV_658' to '".@$ovr_hive_mode_getenv."', but this site module does not exist. Please fix the Environment Variable Value to fit a valid site module!", true, 503);
				exit();
			}
		}
		
		// Set Hive Mode
		define("_HIVE_MODE_", $_SESSION[_HIVE_COOKIE_."hive_mode"]);	
	
	#################################################################################################################################################
	// Current Site Related Constants Determination
	#################################################################################################################################################
		define('_HIVE_SITE_PATH_', 			$object["path"]."/_site/"._HIVE_MODE_."/");	
		define('_HIVE_SITE_COOKIE_', 		_HIVE_COOKIE_."_"._HIVE_MODE_."_");	
		define('_HIVE_SITE_PREFIX_', 		_HIVE_PREFIX_."_"._HIVE_MODE_."_");	
		
	#################################################################################################################################################
	// Create Site Modules Folders
	#################################################################################################################################################
		hive__folder_create($object["path"]."/_public/"._HIVE_MODE_."", true, false);
		hive__folder_create($object["path"]."/_restricted/"._HIVE_MODE_."/", true, true);
		hive__folder_create($object["path"]."/_ext/"._HIVE_MODE_."/", true, false);
	
	#################################################################################################################################################
	// Get Current Extensions
	#################################################################################################################################################
		$object["extensions_path"] = array();
		if(is_dir($object["path"]."/_ext/"._HIVE_MODE_."")) { 
			foreach (glob($object["path"]."/_ext/"._HIVE_MODE_."/*") as $filename) {
				if(is_dir($filename)) { 
					array_push($object["extensions_path"], $filename);
				}
			}		
		}		
	
	#################################################################################################################################################
	// Get Current Core Data
	#################################################################################################################################################
		require_once($object["path"]."/_core/version.php");
		$object["core_mode"] = $x;
		unset($x);
	
	#################################################################################################################################################
	// Get Current Hive Mode Data
	#################################################################################################################################################
		if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/version.php")) { 
			require_once($object["path"]."/_site/"._HIVE_MODE_."/version.php");
			$object["hive_mode"] = $x;
			unset($x);
		} else {
			$object["hive_mode"] = false;
			unset($_SESSION[_HIVE_COOKIE_."hive_mode"]);
		}	
	
	#################################################################################################################################################
	// MySQL Initializations
	#################################################################################################################################################
		$object["mysql"] = new x_class_mysql(@$mysql["host"], @$mysql["user"], @$mysql["pass"], @$mysql["db"], @$mysql["port"]);	
		if ($object["mysql"]->lasterror != false) { $object["mysql"]->displayError(true, 503); }		
		$object["mysql"]->log_config(_TABLE_LOG_MYSQL_, _HIVE_MODE_);

	#################################################################################################################################################
	// Load Log Class
	#################################################################################################################################################
		$object["log"] 			= 	new x_class_log($object["mysql"], _TABLE_LOG_CRON_, "");
		$object["log"] 			= 	new x_class_log($object["mysql"], _TABLE_LOG_, _HIVE_MODE_);
		$object["log_tmp"] 		= 	new x_class_log($object["mysql"], _TABLE_LOG_, "");

	#################################################################################################################################################
	// Load Pre-Defined Core Tables if Needed
	#################################################################################################################################################
		if(!$object["mysql"]->table_exists($object["prefix"]."store")) {
			$object["log_tmp"]->warning("[CORE][SQL_INSTALL] [TABLE] ".@htmlspecialchars($object["prefix"]."store" ?? '' )."", "_core");
			require_once(_HIVE_PATH_."/_core/_mysql/mysql.store.php");
			$object["mysql"]->free_all();
		}	
		if(!$object["mysql"]->table_exists($object["prefix"]."token")) {
			$object["log_tmp"]->warning("[CORE][SQL_INSTALL] [TABLE] ".@htmlspecialchars($object["prefix"]."token" ?? '' )."", "_core");
			require_once(_HIVE_PATH_."/_core/_mysql/mysql.token.php");
			$object["mysql"]->free_all();
		}
		if(!$object["mysql"]->table_exists($object["prefix"]."hub")) {
			$object["log_tmp"]->warning("[CORE][SQL_INSTALL] [TABLE] ".@htmlspecialchars($object["prefix"]."hub" ?? '' )."", "_core");
			require_once(_HIVE_PATH_."/_core/_mysql/mysql.hub.php");
			$object["mysql"]->free_all();
		}
		$object["mysql"]->benchmark_config(true, $object["cookie"]);
		unset($mysql);

	#################################################################################################################################################
	// Classes Variables Initializations
	#################################################################################################################################################
		$object["var"] 			= 	new x_class_var($object["mysql"], _TABLE_VAR_, _HIVE_MODE_);
	
	#################################################################################################################################################
	// Init Current Site Build Number
	#################################################################################################################################################
		if(!defined("_HIVE_BUILD_") AND $object["hive_mode"] ) { 
			define('_HIVE_BUILD_', $object["hive_mode"]["build"]); } else { define("_HIVE_CRIT_ER_", 1); define('_HIVE_BUILD_', 0); 
		}
		if(!defined("_HIVE_VERSION_") AND $object["hive_mode"] ) { 
			define('_HIVE_VERSION_', $object["hive_mode"]["version"]); } else { if(!defined("_HIVE_CRIT_ER_")) { define("_HIVE_CRIT_ER_", 1); } define('_HIVE_VERSION_', 0); 
		}
		if(!defined("_HIVE_RNAME_") AND $object["hive_mode"] ) { 
			define('_HIVE_RNAME_', $object["hive_mode"]["rname"]); } else { if(!defined("_HIVE_CRIT_ER_")) {define("_HIVE_CRIT_ER_", 1); } define('_HIVE_RNAME_', 0); 
		}
		if(!defined("_HIVE_CRIT_ER_")) { 
			$object["var"]->setup("_HIVE_BUILD_ACTIVE_",@htmlspecialchars( _HIVE_BUILD_ ?? ''), "Current Installed Site Modules Build Number");	
			$object["var"]->setup("_HIVE_RNAME_ACTIVE_",@htmlspecialchars( _HIVE_RNAME_ ?? ''), "Current Installed Site Modules RNAME");	}	

		$tmp_version = $object["var"]->get("_HIVE_VERSION_ACTIVE_");
		$tmp_build = $object["var"]->get("_HIVE_BUILD_ACTIVE_");
		$tmp_rname = $object["var"]->get("_HIVE_RNAME_ACTIVE_");
		if(_HIVE_BUILD_ == 0 OR _HIVE_VERSION_ == 0 OR _HIVE_RNAME_ == 0 OR _HIVE_BUILD_ != $tmp_build OR _HIVE_RNAME_ != $tmp_rname) {
			if(!defined("_HIVE_CRIT_ER_")) { define("_HIVE_CRIT_ER_", 1); }
		} unset($tmp_build);unset($tmp_rname);
		if(!defined("_HIVE_CRIT_ER_"))  {
			if (file_exists(_HIVE_SITE_PATH_."/_config/config_global_pre.php")) {
				require_once(_HIVE_SITE_PATH_."/_config/config_global_pre.php");
			}
		}
		
	#################################################################################################################################################
	// Inject Site Pre Options if there are any
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_"))  { 
			if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/_config/config_pre.php")) { require_once($object["path"]."/_site/"._HIVE_MODE_."/_config/config_pre.php"); }	
			// Extension Libraries
			foreach ($object["extensions_path"] as $filename) {
				$object["extension"] = array(); $object["extension"]["name"] = basename($filename);
				$object["extension"]["prefix"] =  _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				$object["extension"]["cookie"] =  _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				if (file_exists($filename."/_config/config_pre.php")) {
					require_once $filename."/_config/config_pre.php";
				}
			}	
		}	
		
	#################################################################################################################################################
	// Get Site Mode Library Files
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) { 
			foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_lib/lib.*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}	 
			foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_wfc/wfc.*.php") as $filename) { if(@basename($filename) == "index.php") { continue; } require_once $filename;}	 
			// Extension Libraries
			foreach ($object["extensions_path"] as $filename) {
				$object["extension"] = array(); $object["extension"]["name"] = basename($filename);
				$object["extension"]["prefix"] =  _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				$object["extension"]["cookie"] =  _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				if (is_dir($filename."/_lib")) {
						foreach (glob($filename."/_lib/lib.*.php") as $filenamex){ require_once $filenamex; }
				}		
			}	
			// Extension Libraries
			foreach ($object["extensions_path"] as $filename) {
				$object["extension"] = array(); $object["extension"]["name"] = basename($filename);
				$object["extension"]["prefix"] =  _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				$object["extension"]["cookie"] =  _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				if (is_dir($filename."/_wfc")) {
						foreach (glob($filename."/_wfc/wfc.*.php") as $filenamex){ require_once $filenamex; }
				}
			}	
		}	
		
	#################################################################################################################################################
	/* Set Up The Rel URL as Configured in Settings.php */	
	#################################################################################################################################################
		if(!defined("_HIVE_URL_")) { define("_HIVE_URL_", $object["url"]); }
		$object["url"] = _HIVE_URL_;	 
		$tmprel = parse_url(_HIVE_URL_, PHP_URL_PATH);
		if(!$tmprel OR $tmprel == "") { $tmprel = "/"; }
		if (isset($_SERVER['HTTPS']) && @$_SERVER['HTTPS'] === 'on')
				{$link = "https://";}
				else
				{$link = "http://";}
		$tmprelx = $link.@$_SERVER["HTTP_HOST"].$tmprel;
		define('_HIVE_URL_REL_', $tmprelx);	
		$tmprelx = $tmprel;
		define('_HIVE_URLC_REL_', $tmprelx);	
		unset($tmprelx);
		unset($tmprel);
		unset($link);
		
	#################################################################################################################################################
	// Classes Initializations
	#################################################################################################################################################
		$object["debug"] 		= 	new x_class_debug();
		$object["debug"]->js_error_create_db($object["mysql"], _TABLE_LOG_JS_);
		$object["eventbox"] 	= 	new x_class_eventbox($object["cookie"]);
		$object["curl"] 		= 	new x_class_curl();	
		$object["benchmark"] 	= 	new x_class_benchmark($object["mysql"], _TABLE_LOG_BENCHMARK_, _HIVE_MODE_);	
		$object["crypt"] 		= 	new x_class_crypt();	
		$object["zip"] 			= 	new x_class_zip();
		$object["api"] 			= 	new x_class_api($object["mysql"], _TABLE_API_, _HIVE_MODE_);
		$object["hitcounter"] 	= 	new x_class_hitcounter($object["mysql"], _TABLE_LOG_VISIT_, $object["cookie"], _HIVE_MODE_);
		$object["hitcounter"]->clearget(false);
		
	#################################################################################################################################################
	// Instance Settings
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) { if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/_config/config.php")) { require_once($object["path"]."/_site/"._HIVE_MODE_."/_config/config.php"); } }	
		
	#################################################################################################################################################
	// Classes Initializations	
	#################################################################################################################################################
		$object["var"]->init_constant();	
	
	#################################################################################################################################################
	// Some Variables in Case they are not set
	#################################################################################################################################################
		if(!defined("_HIVE_URL_GET_")) { define('_HIVE_URL_GET_', array("fp2_l1", "fp2_l2", "fp2_l3", "fp2_l4", "fp2_l5")); }
		if(!defined("_HIVE_CURL_LOGGING_")) { define('_HIVE_CURL_LOGGING_', false); }
		if(!defined("_HIVE_URL_SEO_")) { define("_HIVE_URL_SEO_", false); }
		if(!defined("_HIVE_TITLE_SPACER_")) { define("_HIVE_TITLE_SPACER_", " - "); }
		if(!defined("_UPDATER_CODE_")) { define("_UPDATER_CODE_", false); }
		if(!defined("_CRON_ONLY_CLI_")) { define("_CRON_ONLY_CLI_", true); }
		if(!defined("_HIVE_CSRF_TIME_")) { define("_HIVE_CSRF_TIME_", 600); }
		if(!defined("_HIVE_HTACCESS_REFRESH_")) { define("_HIVE_HTACCESS_REFRESH_", false); }
		if(!defined("_HIVE_HTACCESS_HTTPS_FORWARD_")) { define("_HIVE_HTACCESS_HTTPS_FORWARD_", false); }
		if(!defined("_HIVE_HTACCESS_WRITE_")) { define("_HIVE_HTACCESS_WRITE_", false); }
		if(!defined("_HIVE_HTACCESS_WWW_FORWARD_")) { define("_HIVE_HTACCESS_WWW_FORWARD_", false); }
		if(!defined("_TINYMCE_PLUGINS_")) { define("_TINYMCE_PLUGINS_", "preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor advlist lists wordcount help charmap quickbars emoticons code"); }
		if(!defined("_TINYMCE_MENU_BAR_")) { define("_TINYMCE_MENU_BAR_", "file edit view insert format table help"); }
		if(!defined("_TINYMCE_TOOL_BAR_")) { define("_TINYMCE_TOOL_BAR_", "undo redo | bold italic underline strikethrough | blocks fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link"); }
	
	#################################################################################################################################################
	// Load Modules Current Selected MySQL Configuration
	#################################################################################################################################################
	if(!defined("_HIVE_CRIT_ER_")) { 
		foreach (glob($object["path"]."/_site/"._HIVE_MODE_."/_mysql/mysql.*.php") as $filename){ 
		if(@basename($filename) == "index.php") { continue; } 
		if(!$object["mysql"]->table_exists(_HIVE_SITE_PREFIX_.substr(basename($filename), 6, -4))) {
			$object["log"]->warning("[CORE][SQL_INSTALL] [SITE] ".@htmlspecialchars(_HIVE_MODE_ ?? '')." [TABLE] ".@htmlspecialchars(_HIVE_SITE_PREFIX_.substr(basename($filename), 6, -4) ?? '' )."", "_core");
			require_once($filename);
			$object["mysql"]->free_all();
		}}	
		
		// Extension Libraries
		foreach ($object["extensions_path"] as $filename) {
			$object["extension"] = array(); $object["extension"]["name"] = basename($filename);
			$object["extension"]["prefix"] =  _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
			$object["extension"]["cookie"] =  _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
			foreach (glob($filename."/_mysql/mysql.*.php") as $filenamemm){ 
				if(@basename($filenamemm) == "index.php") { continue; } 
				if(!$object["mysql"]->table_exists($object["extension"]["prefix"].substr(basename($filenamemm), 6, -4))) {
					$object["log"]->warning("[CORE] [EXT] ".htmlspecialchars($object["extension"]["name"] ?? '') ." [SQL_INSTALL] [SITE] ".@htmlspecialchars(_HIVE_MODE_ ?? '')." [TABLE] ".@htmlspecialchars($object["extension"]["prefix"].substr(basename($filenamemm), 6, -4) ?? '' )."", "_ext_".$object["extension"]["name"]);
					require_once($filenamemm);
					$object["mysql"]->free_all();
				}
			}	
		}	
			
	} unset($filename);	unset($object["log_tmp"]);
		
	#################################################################################################################################################
	// Define Default Headers for Mails
	#################################################################################################################################################
		if(!defined("_SMTP_MAILS_HEADER_")) {
			define("_SMTP_MAILS_HEADER_", '<!doctype html><html><head><meta name="viewport" content="width=device-width, initial-scale=1.0"/><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>body { background-color: #121212; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } .content { background: #FFFFFF; box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px; border-radius: 5px; margin-top: 15px;  }  .footer { clear: both; margin-top: 10px; text-align: center; width: 100%; color: #000000; font-size: 12px; text-align: center;  }  h1, h2, h3, h4 { color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 30px; }  h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; }  a { color: blue; text-decoration: none; } hr { border: 0; border-bottom: 1px solid #242424; margin: 20px 0; }  @media only screen and (max-width: 620px) { div.content { margin-top: 2vw !important; margin-left: 2vw !important; margin-right: 2vw !important;}}</style></head><body><div class="content">');
		}
		if(!defined("_SMTP_MAILS_FOOTER_")) {
			define("_SMTP_MAILS_FOOTER_", '</div></body></html>');
		}
		
	#################################################################################################################################################
	/* Get Current URL Data */
	#################################################################################################################################################
		if(!_HIVE_URL_SEO_) { define('_HIVE_URL_CUR_', array(@$_GET[_HIVE_URL_GET_[0]], @$_GET[_HIVE_URL_GET_[1]], @$_GET[_HIVE_URL_GET_[2]], @$_GET[_HIVE_URL_GET_[3]], @$_GET[_HIVE_URL_GET_[4]])); } else {  $tmp = explode("/", @$_GET[_HIVE_URL_SEO_]); define('_HIVE_URL_CUR_', array(@$tmp[0], @$tmp[1], @$tmp[2], @$tmp[3], @$tmp[4]));}	    

	#################################################################################################################################################
	/* MySQL Debug Mode? */
	#################################################################################################################################################
		if(defined("_HIVE_MYSQL_DEBUG_")) { if(_HIVE_MYSQL_DEBUG_) { $object["mysql"]->stop_on_error(); } }
		if(defined("_HIVE_MYSQL_DEBUG_")) { if(_HIVE_MYSQL_DEBUG_) { $object["mysql"]->display_on_error(); } } else { define("_HIVE_MYSQL_DEBUG_", false); }

	#################################################################################################################################################
	/* Apply PHP Debug */
	#################################################################################################################################################
		if(defined("_HIVE_PHP_DEBUG_")) { if(_HIVE_PHP_DEBUG_ == true) { @ini_set('display_errors', 1); @ini_set('display_startup_errors', 1); @error_reporting(E_ALL);	
		} else { @ini_set('display_errors', 0); @ini_set('display_startup_errors', 0); } } else { @ini_set('display_errors', 1); @ini_set('display_startup_errors', 1); define("_HIVE_PHP_DEBUG_", false); } 
		if(defined("_HIVE_PHP_MODS_")) { if(is_array(@_HIVE_PHP_MODS_)) { foreach(_HIVE_PHP_MODS_ as $key => $value) { $object["debug"]->required_php_module($value, true); } } } 
		else { define("_HIVE_PHP_MODS_", array()); }		
	
	#################################################################################################################################################
	// Classes Initializations	
	#################################################################################################################################################
		$object["var"]->init_constant();			

	#################################################################################################################################################
	// User Init	
	#################################################################################################################################################
		define("_USER_MAIL_PRIMARY_", true); # True - User Login is Mail | false - User Login is Username
		if(!defined("_USER_MULTI_LOGIN_")) { define("_USER_MULTI_LOGIN_", false); }
		if(!defined("_USER_REC_DROP_")) { define("_USER_REC_DROP_", true); }
		if(!defined("_USER_MAX_SESSION_")) { define("_USER_MAX_SESSION_", 7); }
		if(!defined("_USER_TOKEN_TIME_")) { define("_USER_TOKEN_TIME_", 300); }
		if(!defined("_USER_PF_SIGNS_")) { define("_USER_PF_SIGNS_", 7); }
		if(!defined("_USER_PF_CAPSIGNS_")) { define("_USER_PF_CAPSIGNS_", 1); }
		if(!defined("_USER_PF_SMSIGNS_")) { define("_USER_PF_SMSIGNS_", 1); }
		if(!defined("_USER_PF_SPSIGNS_")) { define("_USER_PF_SPSIGNS_", 0); }
		if(!defined("_USER_PF_NUMSIGNS_")) { define("_USER_PF_NUMSIGNS_", 1); }
		if(!defined("_USER_AUTOBLOCK_")) { define("_USER_AUTOBLOCK_", false); }
		if(!defined("_USER_WAIT_COUNTER_")) { define("_USER_WAIT_COUNTER_", 60); }
		if(!defined("_USER_LOG_SESSIONS_")) { define("_USER_LOG_SESSIONS_", true); }
		if(!defined("_USER_INITIAL_USERNAME_")) { define("_USER_INITIAL_USERNAME_", "admin@admin.local"); }
		if(!defined("_USER_INITIAL_USERPASS_")) { define("_USER_INITIAL_USERPASS_", "changeme"); }
		if(!defined("_USER_LOG_IP_")) { define("_USER_LOG_IP_", false); }	
		$object["user"] = new x_class_user($object["mysql"], _TABLE_USER_, _TABLE_USER_SESSION_, _HIVE_COOKIE_, _USER_INITIAL_USERNAME_, _USER_INITIAL_USERPASS_, 1); 
		$object["user"]->multi_login(_USER_MULTI_LOGIN_);	
		$object["user"]->login_recover_drop(_USER_REC_DROP_);	
		if(_USER_MAIL_PRIMARY_) { $object["user"]->login_field_mail(); } else { $object["user"]->login_field_user(); }
		if(_USER_MAIL_PRIMARY_) { $object["user"]->mail_unique(true); $object["user"]->user_unique(false); } else { $object["user"]->mail_unique(false); $object["user"]->user_unique(true); }	
		$object["user"]->log_ip(_USER_LOG_IP_);
		$object["user"]->log_activation(_USER_LOG_SESSIONS_);
		$object["user"]->log_session(_USER_LOG_SESSIONS_);
		$object["user"]->log_recover(_USER_LOG_SESSIONS_);
		$object["user"]->log_mail_edit(_USER_LOG_SESSIONS_);
		$object["user"]->wait_activation_min(_USER_WAIT_COUNTER_);
		$object["user"]->wait_recover_min(_USER_WAIT_COUNTER_);
		$object["user"]->wait_mail_edit_min(_USER_WAIT_COUNTER_);
		$object["user"]->autoblock(_USER_AUTOBLOCK_);
		$object["user"]->min_activation(_USER_TOKEN_TIME_);
		$object["user"]->min_recover(_USER_TOKEN_TIME_);
		$object["user"]->min_mail_edit(_USER_TOKEN_TIME_);
		$object["user"]->sessions_days(_USER_MAX_SESSION_);
		$object["user"]->cookies_use(true);
		$object["user"]->cookies_days(_USER_MAX_SESSION_);	
		$object["user"]->passfilter(_USER_PF_SIGNS_, _USER_PF_CAPSIGNS_, _USER_PF_SMSIGNS_, _USER_PF_SPSIGNS_, _USER_PF_NUMSIGNS_);	
		$object["user"]->groups(_TABLE_USER_GROUP_, _TABLE_USER_GROUP_LINK_);		
		$object["user"]->extrafields(_TABLE_USER_EXTRAFIELDS_);		
		$object["user"]->init();
	
	#################################################################################################################################################
	// User Permissions
	#################################################################################################################################################
		$object["perm_user"] 		= 	new x_class_perm($object["mysql"], _TABLE_USER_PERM_, _HIVE_MODE_);
		$object["perm_user_glob"] 	= 	new x_class_perm($object["mysql"], _TABLE_USER_PERM_, "");
		$object["perm_group"] 		= 	new x_class_perm($object["mysql"], _TABLE_USER_GROUP_PERM_, _HIVE_MODE_);	
		$object["perm_group_glob"] 	= 	new x_class_perm($object["mysql"], _TABLE_USER_GROUP_PERM_, "");	
	
	#################################################################################################################################################
	// Create Permission Item for Current User
	#################################################################################################################################################
		$object["user_perm"] = $object["perm_user"]->item($object["user"]->user_id);	
		$object["user_perm_glob"] = $object["perm_user_glob"]->item($object["user"]->user_id);	
	
	#################################################################################################################################################
	// Prepare Arrays for User Groups and Permissions
	#################################################################################################################################################
		$object["user_group"] = array();
		$tmp = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_user = '".@$object["user"]->user_id."'", true);
		if(is_array($tmp)) {
			foreach($tmp AS $key => $value) {
				$tmp2 = $object["perm_group"]->item($value["fk_group"]);
				$tmp3 = $object["perm_group_glob"]->item($value["fk_group"]);
				$tmp = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_GROUP_." WHERE id = '".$value["fk_group"]."'", false);
				$tmp["perm_obj"] = $tmp2;
				$tmp["perm_obj_glob"] = $tmp3;
				array_push($object["user_group"], $tmp);
				unset($tmp2);}
		} unset($tmp);	
	
	#################################################################################################################################################
	// Curl Class Logging Setup
	#################################################################################################################################################
		$object["curl"]->logging($object["mysql"], _HIVE_CURL_LOGGING_, true, _TABLE_LOG_CURL_, _HIVE_MODE_);		

	#################################################################################################################################################
	// Blacklisting Class
	#################################################################################################################################################
		if(!defined("_HIVE_IP_LIMIT_")) { define("_HIVE_IP_LIMIT_", false); }
		$object["ipbl"] = new x_class_ipbl($object["mysql"], _TABLE_LOG_IP_, _HIVE_IP_LIMIT_);		
	
	#################################################################################################################################################
	// Referer Class	
	#################################################################################################################################################
		$object["referer"] = new x_class_referer($object["mysql"], _TABLE_LOG_REFERER_, $object["url"]);	
	
	#################################################################################################################################################
	// Referer Setup
	#################################################################################################################################################
		if(!defined("_HIVE_REFERER_")) { define("_HIVE_REFERER_", false); }	
		if(_HIVE_REFERER_) 	{ $object["referer"]->execute(_HIVE_MODE_); }
	
	#################################################################################################################################################
	// Redis
	#################################################################################################################################################
		if(!defined("_REDIS_")) { define("_REDIS_", false); }
		if(_REDIS_) { $object["redis"] = new x_class_redis(_REDIS_HOST_, _REDIS_PORT_, _REDIS_PREFIX_); }		
		
	#################################################################################################################################################
	// SMTP Mail Settings
	#################################################################################################################################################
		if(!defined("_SMTP_HOST_")) { define("_SMTP_HOST_", 			@$smtp["_SMTP_HOST_"]); } # Mail Host Server
		if(!defined("_SMTP_PORT_")) { define("_SMTP_PORT_", 			@$smtp["_SMTP_PORT_"]); } # Mail Server Port
		if(!defined("_SMTP_AUTH_")) { define("_SMTP_AUTH_", 			@$smtp["_SMTP_AUTH_"]); } # can be ssl/tls/false
		if(!defined("_SMTP_USER_")) { define("_SMTP_USER_", 			@$smtp["_SMTP_USER_"]); } # Username to Login (can be false)
		if(!defined("_SMTP_PASS_")) { define("_SMTP_PASS_", 			@$smtp["_SMTP_PASS_"]); } # Password to Login (can be false)
		if(!defined("_SMTP_INSECURE_")) { define("_SMTP_INSECURE_", 			true); }
		if(!defined("_SMTP_DEBUG_")) { define("_SMTP_DEBUG_", 			0); }
		if(!defined("_SMTP_MAILS_IN_HTML_")) { define("_SMTP_MAILS_IN_HTML_", 			true); }
		if(!defined("_SMTP_SENDER_MAIL_")) { define("_SMTP_SENDER_MAIL_", 			@$smtp["_SMTP_USER_"]); }
		if(!defined("_SMTP_SENDER_NAME_")) { define("_SMTP_SENDER_NAME_", 			@$smtp["_SMTP_USER_"]); }
		unset($smtp);		
		$object["mail"] = new x_class_mail(_SMTP_HOST_, _SMTP_PORT_, _SMTP_AUTH_, _SMTP_USER_, _SMTP_PASS_, _SMTP_SENDER_MAIL_, _SMTP_SENDER_NAME_);
		$object["mail"]->initReplyTo(_SMTP_SENDER_MAIL_, _SMTP_SENDER_NAME_);
		$object["mail"]->change_default_template(_SMTP_MAILS_HEADER_, _SMTP_MAILS_FOOTER_);		
		$object["mail"]->all_default_html(_SMTP_MAILS_IN_HTML_);	
		$object["mail"]->smtpdebuglevel(_SMTP_DEBUG_);	
		$object["mail"]->allow_insecure_ssl_connections(_SMTP_INSECURE_);		
		$object["mail"]->logging($object["mysql"], _TABLE_LOG_MAIL_, false, _HIVE_MODE_);	
	
	#################################################################################################################################################
	// Mail Template Settings
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) {
			$object["mail_template"] = new x_class_mail_template($object["mysql"], _TABLE_MAIL_TPL_, _HIVE_MODE_);
			$object["mail_template"]->set_header(_SMTP_MAILS_HEADER_);
			$object["mail_template"]->set_footer(_SMTP_MAILS_FOOTER_);			
		}
	
	#################################################################################################################################################
	// Language Initializations	
	#################################################################################################################################################
		if(!defined("_HIVE_LANG_DB_")) { define("_HIVE_LANG_DB_", false); }
		if(!defined("_HIVE_LANG_ARRAY_")) { define("_HIVE_LANG_ARRAY_", array()); }
		if(!defined("_HIVE_LANG_DEFAULT_")) { define("_HIVE_LANG_DEFAULT_", false); }
		$object["lang"] = new x_class_lang($object["mysql"], _TABLE_LANG_, false, false, false);
		unset($object["lang"]);
		if(_HIVE_LANG_DB_ == false) { 
			if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_language"])) {
				if(in_array($_SESSION[_HIVE_SITE_COOKIE_."hive_language"], _HIVE_LANG_ARRAY_)) {
					
				} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_; }
			} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_; }
			if($object["user"]->user_loggedIn) {
				$tmp = $object["user"]->user["hive_extradata"];
				$tmp = @unserialize($tmp);
				if(is_array(@$tmp[_HIVE_MODE_])) {
					if(isset($tmp[_HIVE_MODE_]["lang"]) AND @$tmp[_HIVE_MODE_]["lang"] AND @trim(@$tmp[_HIVE_MODE_]["lang"] ?? '') != "") {
						if(@in_array(@$tmp[_HIVE_MODE_]["lang"], _HIVE_LANG_ARRAY_)) {
							$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = @$tmp[_HIVE_MODE_]["lang"];		
						}
					}
				}
			} $object["lang"] = new x_class_lang(false, false, false, false, _HIVE_SITE_PATH_."/_lang/".@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"]); define("_HIVE_LANG_", $_SESSION[_HIVE_SITE_COOKIE_."hive_language"]);		
		} else {
			if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_language"])) {
				if(in_array($_SESSION[_HIVE_SITE_COOKIE_."hive_language"], _HIVE_LANG_ARRAY_)) {
				} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_; }
			} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = _HIVE_LANG_DEFAULT_;}
			if($object["user"]->user_loggedIn) {
				$tmp = $object["user"]->user["hive_extradata"];
				$tmp = @unserialize($tmp);
				if(is_array(@$tmp[_HIVE_MODE_])) {
					if(isset($tmp[_HIVE_MODE_]["lang"]) AND @$tmp[_HIVE_MODE_]["lang"] AND @trim(@$tmp[_HIVE_MODE_]["lang"] ?? '') != "") {
						if(@in_array(@$tmp[_HIVE_MODE_]["lang"], _HIVE_LANG_ARRAY_)) {
							$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = @$tmp[_HIVE_MODE_]["lang"];		
						}
					}
				}
			} $object["lang"] = new x_class_lang(false, false, false, false, _HIVE_SITE_PATH_."/_lang/".@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"]); define("_HIVE_LANG_", $_SESSION[_HIVE_SITE_COOKIE_."hive_language"]);	 
			$object["lang_tmp"] = new x_class_lang($object["mysql"], _TABLE_LANG_, @$_SESSION[_HIVE_SITE_COOKIE_."hive_language"], _HIVE_MODE_, false); 
			foreach($object["lang_tmp"]->array as $key => $value) { 
				$object["lang"]->array[$key] = $value;
			}
			unset($object["lang_tmp"]);
		}	
	
	#################################################################################################################################################
	// Theme Initializations	
	#################################################################################################################################################
		if(!defined("_HIVE_THEME_ARRAY_")) { define("_HIVE_THEME_ARRAY_", array()); }
		if(!defined("_HIVE_THEME_DEFAULT_")) { define("_HIVE_THEME_DEFAULT_", false); }
		if(!defined("_HIVE_THEME_COLOR_DEFAULT_")) { define("_HIVE_THEME_COLOR_DEFAULT_", "#FFFF00"); }
		if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_theme"])) {
			if(@in_array(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"], _HIVE_THEME_ARRAY_)) {
				//define("_HIVE_THEME_", @$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]);
			} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = _HIVE_THEME_DEFAULT_; }
		} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = _HIVE_THEME_DEFAULT_; }
		if($object["user"]->user_loggedIn) {
			$tmp = $object["user"]->user["hive_extradata"];
			$tmp = @unserialize($tmp);
			if(is_array(@$tmp[_HIVE_MODE_])) {
				if(isset($tmp[_HIVE_MODE_]["theme"]) AND @$tmp[_HIVE_MODE_]["theme"] AND @trim(@$tmp[_HIVE_MODE_]["theme"] ?? '') != "") {
					if(@in_array(@$tmp[_HIVE_MODE_]["theme"], _HIVE_THEME_ARRAY_)) {
						$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = @$tmp[_HIVE_MODE_]["theme"];				
					}
				}
			}
		} define("_HIVE_THEME_", $_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]);	
	
	#################################################################################################################################################
	// Color Initializations	
	#################################################################################################################################################
		if(isset($_SESSION[_HIVE_SITE_COOKIE_."hive_color"])) {
			//define("_HIVE_COLOR_", @$_SESSION[_HIVE_SITE_COOKIE_."hive_color"]);
		} else { $_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = _HIVE_THEME_COLOR_DEFAULT_; }
		if($object["user"]->user_loggedIn) {
			$tmp = $object["user"]->user["hive_extradata"];
			$tmp = @unserialize($tmp);
			if(is_array(@$tmp[_HIVE_MODE_])) {
				if(isset($tmp[_HIVE_MODE_]["color"]) AND @$tmp[_HIVE_MODE_]["color"] AND @trim(@$tmp[_HIVE_MODE_]["color"] ?? '') != "") {
					$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = @$tmp[_HIVE_MODE_]["color"];				
				}
			}
		} define("_HIVE_COLOR_", $_SESSION[_HIVE_SITE_COOKIE_."hive_color"]);	
	
	#################################################################################################################################################
	// Robots.TXT for Website if Configured
	#################################################################################################################################################
if(!defined("_HIVE_CRIT_ER_")) {
	if(!defined("_HIVE_ROBOT_SPAWN_")) { define("_HIVE_ROBOT_SPAWN_", false); }
	if(!defined("_HIVE_SITEMAP_URL_")) { define("_HIVE_SITEMAP_URL_", false); }
	if(_HIVE_ROBOT_SPAWN_ == 1) {
		if(_HIVE_SITEMAP_URL_) { $url = "Sitemap: "._HIVE_SITEMAP_URL_."\r\n"; } else { $url = "";}
		if(!file_exists($object["path"]."/robots.txt")) {
			file_put_contents($object["path"]."/robots.txt", "".$url."User-Agent: *
Disallow: "._HIVE_URLC_REL_."/_core/*
Disallow: "._HIVE_URLC_REL_."/_cron/*
Disallow: "._HIVE_URLC_REL_."/_domain/*
Disallow: "._HIVE_URLC_REL_."/_framework/*
Disallow: "._HIVE_URLC_REL_."/_image/*
Disallow: "._HIVE_URLC_REL_."/_internal/*
Disallow: "._HIVE_URLC_REL_."/_ext/*
Disallow: "._HIVE_URLC_REL_."/_restricted/*
Disallow: "._HIVE_URLC_REL_."/_script/*
Disallow: "._HIVE_URLC_REL_."/_store/*
Disallow: "._HIVE_URLC_REL_."/cfg_ruleset.php
Disallow: "._HIVE_URLC_REL_."/README.md
Disallow: "._HIVE_URLC_REL_."/LICENSE.md
Disallow: "._HIVE_URLC_REL_."/cfg_ruleset_sample.php
Disallow: "._HIVE_URLC_REL_."/updater.php
Disallow: "._HIVE_URLC_REL_."/installer.php
Disallow: "._HIVE_URLC_REL_."/developer.php");
		}		
	}
if(_HIVE_ROBOT_SPAWN_ == 2) {
	if(_HIVE_SITEMAP_URL_) { $url = "Sitemap: "._HIVE_SITEMAP_URL_."\r\n"; } else { $url = "";}
	if(!file_exists($object["path"]."/robots.txt")) {
		file_put_contents($object["path"]."/robots.txt", "".$url."User-Agent: *\r\nDisallow: /\r\n");
	} unset($url);
}		

// Start to build HTAccess File if needed!
if(!file_exists($object["path"]."/.htaccess") AND _HIVE_HTACCESS_WRITE_) {
	
// Forward non-secure to secure?
if(_HIVE_HTACCESS_HTTPS_FORWARD_) { $https = "## HTTP -> HTTPS Rewrite
RewriteCond %{HTTPS} !=on
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]"; } else { $https = ""; }

// Use Mod Refresh?
if(_HIVE_HTACCESS_REFRESH_) { $refresh = "## Caching Tags mod_expires
<IfModule mod_expires.c>
  ExpiresActive On
   ExpiresByType image/jpeg \"access plus 1 year\"
   ExpiresByType image/gif \"access plus 1 year\"
   ExpiresByType image/png \"access plus 1 year\"
   ExpiresByType image/webp \"access plus 1 year\"
   ExpiresByType image/svg+xml \"access plus 1 year\"
   ExpiresByType image/x-icon \"access plus 1 year\" 
 
   ExpiresByType video/webm \"access plus 1 year\"
   ExpiresByType video/mp4 \"access plus 1 year\"
   ExpiresByType video/mpeg \"access plus 1 year\"

   ExpiresByType font/ttf \"access plus 1 year\"
   ExpiresByType font/otf \"access plus 1 year\"
   ExpiresByType font/woff \"access plus 1 year\"
   ExpiresByType font/woff2 \"access plus 1 year\"
   ExpiresByType application/font-woff \"access plus 1 year\"

   ExpiresByType text/css \"access plus 1 month\"
   ExpiresByType text/javascript \"access plus 1 month\"
   ExpiresByType application/javascript \"access plus 1 month\"

   ExpiresByType application/pdf \"access plus 1 month\"
   ExpiresByType image/vnd.microsoft.icon \"access plus 1 year\"
</IfModule>"; } else { $refresh = ""; }	

// Move non www to WWW URL?
if(_HIVE_HTACCESS_WWW_FORWARD_) { $www = "## WWW -> Non WWW Rewrite
RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
RewriteRule ^(.*)$ https://%1/$1 [R=301,L]"; } else { $www = ""; }	

// SEO String Rewriting?
if(_HIVE_URL_SEO_) { $seo = "## SEO Url Rewrite
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?hive__seo_tag_loc=$1 [L,QSA]"; 
} else { $seo = ""; }		

// Write Pre-Builded Htaccess File
file_put_contents($object["path"]."/.htaccess", "# bugfishCMS Generated HTAccess File
## Changes will be persistent!

## Enable Rewriting
RewriteEngine On

".$https."

".$www."

".$refresh."

".$seo."

## Disable Directory Browsing
Options -Indexes

## Lock Files
<Files \"settings.php\">  
  Order Allow,Deny
  Deny from all
</Files>
<Files \"cfg_ruleset.php\">  
  Order Allow,Deny
  Deny from all
</Files>
<Files \"cfg_ruleset_sample.php\">  
  Order Allow,Deny
  Deny from all
</Files>
<Files \".htaccess\">  
  Order Allow,Deny
  Deny from all
</Files>

## Error Pages
ErrorDocument 400 "._HIVE_URLC_REL_."/_core/_error/error.400.php
ErrorDocument 401 "._HIVE_URLC_REL_."/_core/_error/error.401.php
ErrorDocument 403 "._HIVE_URLC_REL_."/_core/_error/error.403.php
ErrorDocument 404 "._HIVE_URLC_REL_."/_core/_error/error.404.php
ErrorDocument 500 "._HIVE_URLC_REL_."/_core/_error/error.500.php
ErrorDocument 503 "._HIVE_URLC_REL_."/_core/_error/error.503.php

## Lock Folders (multiple seperator is |)
RewriteRule ^(_restricted|_internal) - [F,L]");}	 
unset($seo);
unset($www);
unset($refresh);
unset($https);
}
	
	#################################################################################################################################################
	// Global Sites Configuration
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) {
		   if (file_exists(_HIVE_SITE_PATH_."/_config/config_global_post.php")) {
				require_once(_HIVE_SITE_PATH_."/_config/config_global_post.php");
		   }
		}

	#################################################################################################################################################
	// Site Post Configuration
	#################################################################################################################################################
		if(!defined("_HIVE_CRIT_ER_")) { 
			if(file_exists(_HIVE_SITE_PATH_."/_config/config_post.php")) { require_once(_HIVE_SITE_PATH_."/_config/config_post.php"); }	
			// Extension Libraries
			foreach ($object["extensions_path"] as $filename) {
				$object["extension"] = array(); $object["extension"]["name"] = basename($filename);
				$object["extension"]["prefix"] =  _HIVE_PREFIX_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				$object["extension"]["cookie"] =  _HIVE_COOKIE_."_"._HIVE_MODE_."__".$object["extension"]["name"]."_";
				if (file_exists($filename."/_config/config_post.php")) {
					require_once $filename."/_config/config_post.php";
				}
			}		
		}
		if(!defined("_HIVE_CRIT_ER_")) { if(file_exists($object["path"]."/_site/"._HIVE_MODE_."/_config/permission.php")) { require_once($object["path"]."/_site/"._HIVE_MODE_."/_config/permission.php"); } }	
	
	#################################################################################################################################################
	// Unset Constant Fixes
	#################################################################################################################################################
		if(!defined("_HIVE_SITE_URL_")) { define('_HIVE_SITE_URL_', _HIVE_URL_); }
		if(!defined("_HIVE_TITLE_")) { define('_HIVE_TITLE_', "CMS"); }
		if(!defined("_UPDATER_TITLE_")) { define("_UPDATER_TITLE_", _HIVE_TITLE_); }
		if(!defined("_CAPTCHA_FONT_PATH_")) { define("_CAPTCHA_FONT_PATH_", false); }
		if(!defined("_CAPTCHA_WIDTH_")) { define("_CAPTCHA_WIDTH_", "200"); }
		if(!defined("_CAPTCHA_HEIGHT_")) { define("_CAPTCHA_HEIGHT_", "70"); }
		if(!defined("_CAPTCHA_LINES_")) { define("_CAPTCHA_LINES_", mt_rand(5, 12)); }
		if(!defined("_CAPTCHA_CODE_")) { define("_CAPTCHA_CODE_", mt_rand(1000, 9999)); }
		if(!defined("_CAPTCHA_SQUARES_")) { define("_CAPTCHA_SQUARES_", mt_rand(5, 12)); }
		if(!defined("_CAPTCHA_COLORS_")) { define("_CAPTCHA_COLORS_", false); }
		if(!defined("_HIVE_JS_ACTION_ACTIVE_")) { define("_HIVE_JS_ACTION_ACTIVE_", false); }
	
	#################################################################################################################################################
	// Create Initial HTAccess Files
	#################################################################################################################################################
		x_htaccess_secure(_HIVE_PATH_PRIVATE_);
		x_htaccess_secure(_HIVE_PATH_INTERNAL_);	
	
	#################################################################################################################################################
	// Rewrite Initial HTAccess File if non Existant
	#################################################################################################################################################
	if(!file_exists($object["path"]."/.htaccess")) {	
	
	#################################################################################################################################################
	// Write Pre-Builded Htaccess File
	#################################################################################################################################################
file_put_contents($object["path"]."/.htaccess", "###############################################################
# bugfishCMS Generated Initial HTAccess File
###############################################################

###############################################################
## Changes will be persistent!
###############################################################

###############################################################
## Enable Rewriting - Do not comment this out!
###############################################################
	RewriteEngine On

###############################################################
## HTTP -> HTTPS Rewrite
## Remove comment below to activate automatic HTTPS Rewriting if non HTTPS
###############################################################
	#	RewriteCond %{HTTPS} !=on
	#	RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

###############################################################
## Non-WWW -> WWW Rewritew
## Remove comment below to activate automatic non www to www forward
###############################################################
	#	RewriteCond %{HTTP_HOST} ^[^.]+\.[^.]+$
	#	RewriteRule ^(.*)$ http://www.%{HTTP_HOST}/$1 [L,R=301]	
	
###############################################################
## SEO Url Rewrite
###############################################################
	RewriteBase /
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule ^(.*)$ index.php?hive__seo_tag_loc=$1 [L,QSA]

###############################################################
## Use mod_expires ?
## Comment out to use mod_expires
###############################################################
	#	<IfModule mod_expires.c>
	#	  ExpiresActive On
	#	   ExpiresByType image/jpeg \"access plus 1 year\"
	#	   ExpiresByType image/gif \"access plus 1 year\"
	#	   ExpiresByType image/png \"access plus 1 year\"
	#	   ExpiresByType image/webp \"access plus 1 year\"
	#	   ExpiresByType image/svg+xml \"access plus 1 year\"
	#	   ExpiresByType image/x-icon \"access plus 1 year\" 
	#	 
	#	   ExpiresByType video/webm \"access plus 1 year\"
	#	   ExpiresByType video/mp4 \"access plus 1 year\"
	#	   ExpiresByType video/mpeg \"access plus 1 year\"
	#
	#	   ExpiresByType font/ttf \"access plus 1 year\"
	#	   ExpiresByType font/otf \"access plus 1 year\"
	#	   ExpiresByType font/woff \"access plus 1 year\"
	#	   ExpiresByType font/woff2 \"access plus 1 year\"
	#	   ExpiresByType application/font-woff \"access plus 1 year\"
	#
	#	   ExpiresByType text/css \"access plus 1 month\"
	#	   ExpiresByType text/javascript \"access plus 1 month\"
	#	   ExpiresByType application/javascript \"access plus 1 month\"
	#
	#	   ExpiresByType application/pdf \"access plus 1 month\"
	#	   ExpiresByType image/vnd.microsoft.icon \"access plus 1 year\"
	#	</IfModule>	

###############################################################
## Disable Directory Browsing for Security Purposes
###############################################################
	Options -Indexes

###############################################################
## Lock Configuration Files
###############################################################
	<Files \"settings.php\">  
	  Order Allow,Deny
	  Deny from all
	</Files>
	<Files \"cfg_ruleset.php\">  
	  Order Allow,Deny
	  Deny from all
	</Files>
	<Files \".htaccess\">  
	  Order Allow,Deny
	  Deny from all
	</Files>
	<Files \"cfg_ruleset_sample.php\">  
	  Order Allow,Deny
	  Deny from all
	</Files>

###############################################################
## Error Pages
## Change this if you want own error pages
## Comment this out if you dont want custom error pages to be used
###############################################################
	ErrorDocument 400 "._HIVE_URLC_REL_."/_core/_error/error.400.php
	ErrorDocument 401 "._HIVE_URLC_REL_."/_core/_error/error.401.php
	ErrorDocument 403 "._HIVE_URLC_REL_."/_core/_error/error.403.php
	ErrorDocument 404 "._HIVE_URLC_REL_."/_core/_error/error.404.php
	ErrorDocument 500 "._HIVE_URLC_REL_."/_core/_error/error.500.php
	ErrorDocument 503 "._HIVE_URLC_REL_."/_core/_error/error.503.php

###############################################################
## Lock Folders which should not be public accessible
## Do not comment this out
## Even if you do these folders are protected by an own htaccess file
## multiple seperator is |
###############################################################
	RewriteRule ^(_restricted|_internal) - [F,L]"); }	
	
	#################################################################################################################################################
	// Define Relative Site Mode
	#################################################################################################################################################
	define("_HIVE_SITE_REL_", _HIVE_URL_REL_."/_site/"._HIVE_MODE_."/");
	define("_HIVE_SITEC_REL_", _HIVE_URLC_REL_."/_site/"._HIVE_MODE_."/");
	define("_HIVE_SITE_PRIVATE_", _HIVE_PATH_PRIVATE_."/"._HIVE_MODE_."/");
	define("_HIVE_SITE_PUBLIC_", _HIVE_PATH_PUBLIC_."/"._HIVE_MODE_."/");
	define("_HIVE_SITE_EXT_", _HIVE_PATH_."/_ext/"._HIVE_MODE_."/");
	
	// Unset some Variables
	unset($ovr_hive_mode_getenv);
	unset($tmp_version);