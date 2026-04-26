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
			Core Library File to be auto-included on CMS Initialization if
			stated in initialize.php.in _core.
	*/ if(!is_array(@$object)) { @http_response_code(@404); @Header("Location: ../"); exit(); }
	#################################################################################################################################################
	// File Include Functionalities
	#################################################################################################################################################
		function hive__init_site_header($object, $site_name) {
			// Prepare Information
			$array = array();
			$array["info"]   				= @$object["hive_mode_config_pre"]["site"][$site_name];
			$array["path"]  	 			= $object["path"]."/_site/".$site_name."/";
			$array["name"]   				= $site_name;
			$array["prefix"] 				= _HIVE_PREFIX_."_".$site_name."_";
			$array["cookie"] 				= _HIVE_COOKIE_."_".$site_name."_";
			$array["prefix_variables"] 		= "___smd_".$site_name."_";
			$array["lang"]					= @$object["hive_mode_config_pre"]["site_lang"][$site_name];
			// Return
			return $array;
		}
		
		function hive__init_extension_header($object, $extension_name, $sitemod_name = false) {
			// Precheck Sitemod Name
				if(!$sitemod_name) { $sitemod_name = _HIVE_MODE_; }
			// Prepare Information
				$array = array();
				if(@$object["hive_mode_config_pre"]["extension"][$extension_name]) {
					$array["info"]   			= $object["hive_mode_config_pre"]["extension"][$extension_name];
				} else { $array["info"]   		= array(); }
				$array["path"]   				= $object["path"]."/_data/".$sitemod_name."/_extension/".$extension_name."/";
				$array["name"]   				= $extension_name;
				$array["prefix"] 				= _HIVE_PREFIX_."_".$sitemod_name."__".$extension_name."_";
				$array["cookie"] 				= _HIVE_COOKIE_."_".$sitemod_name."__".$extension_name."_";
				$array["prefix_variables"] 		= "___ext_".$extension_name."_";
				$array["lang"] 					= @$object["hive_mode_config_pre"]["extension_lang"][$extension_name];
			// Return
			return $array;
		}

	#################################################################################################################################################
	// Extension Functionalities
	#################################################################################################################################################		
		function hive__extension_path($hive_mode) {
			$array = array();
			if(is_dir(_HIVE_PATH_."/_data/".$hive_mode."/_extension")) { 
				foreach (glob(_HIVE_PATH_."/_data/".$hive_mode."/_extension/*") as $filename) {
					if(is_dir($filename)) { 
						array_push($array, $filename);
					}
				}		
			} return $array;	
		}
	#################################################################################################################################################
	// General Mail Functionality for Default Pages in _action
	#################################################################################################################################################		
		function hive__default_mail($object, $template, $mail, $user_id, $url_if_needed) { 
			// URL SUBST
			if(is_string($url_if_needed)) { 
				$object["mail_template"]->add_substitution("SF_ACTION_URL", $url_if_needed); 
			}		
			// Sender Array name_exists($name)
			$tpmuser = "";
			if($object["user"]->exists($user_id)) {
				$tmp = $object["user"]->get($user_id);
				$object["mail_template"]->add_substitution("SF_RECEIVER_FIRSTNAME", 	@htmlspecialchars($tmp["user_firstname"]));
				$object["mail_template"]->add_substitution("SF_RECEIVER_LASTNAME", 		@htmlspecialchars($tmp["user_lastname"]));
				$object["mail_template"]->add_substitution("SF_RECEIVER_ID", 			@htmlspecialchars($user_id));
				$tpmuser = @htmlspecialchars($tmp["user_firstname"])." ".@htmlspecialchars($tmp["user_lastname"]);
			}			
			// Prepare Mail Templates for Sending Operation
			if(!$object["mail_template"]->name_exists($template)) {
				if($template == "SF_DEFAULT_REGISTER") { 
					$title = $object["lang"]->translate("hive_login_mail_title_register");
					$content = $object["lang"]->translate("hive_login_mail_pre_register");
					$title = $object["mail_template"]->do_substitute($title);
					$content = $object["mail_template"]->do_substitute($content);
				} elseif($template == "SF_DEFAULT_RECOVER") { 
					$title = $object["lang"]->translate("hive_login_mail_title_rec");
					$content = $object["lang"]->translate("hive_login_mail_pre_rec");
					$title = $object["mail_template"]->do_substitute($title);
					$content = $object["mail_template"]->do_substitute($content);
				} elseif($template == "SF_DEFAULT_MAILC") { 
					$title = $object["lang"]->translate("hive_login_mail_title_change");
					$content = $object["lang"]->translate("hive_login_mail_pre_change");
					$title = $object["mail_template"]->do_substitute($title);
					$content = $object["mail_template"]->do_substitute($content);
				} else { return false; }
			} else {
				$object["mail_template"]->set_template($template);
				$title = $object["mail_template"]->get_subject(true);
				$content = $object["mail_template"]->get_content(true);
			}
			// Get User Name for Sending
				if(@trim($tpmuser) != "") { $tpmuser = $tpmuser; } else { $tpmuser = @htmlspecialchars($mail); }
			// Send the Mail and Log everything
			if($object["mail"]->send($mail, $tpmuser, $title, $content)) { 
				return true; 
			} else { 
				return false; 
			} 
		}		
		
	#################################################################################################################################################
	// File Include Functionalities
	#################################################################################################################################################	
		function hive__require_once($object, $filepath) { require_once($filepath); return true; }
		function hive__require($object, $filepath) { require($filepath); return true; }
		function hive__require_x($filepath) {
			if(file_exists($filepath."/version.php")) {
				require($filepath);
				return $x;
			} else { return false; }}

	#################################################################################################################################################
	// Check for another Active Main Instance
	#################################################################################################################################################	
		function hive__is_main($object) {
			// Check is Mode is Set
			if(!defined("_HIVE_MODE_")) { return false; }
			// Check for Apache Set Site Mod
			if(@getenv("_HIVE_MODE_ENV_OVR_")) {
				if(@getenv("_HIVE_MODE_ENV_OVR_") == _HIVE_MODE_) {
					return true;
				}
			} 
			// If Admin Page Site is Set than Check if current Site is Admin Site
			if(_HIVE_ADMIN_SITE_) {
				if(_HIVE_ADMIN_SITE_ == _HIVE_MODE_) {
					return true;
				} else {
					return false;
				}
			}
			// Return True if Nothing Found in out simple logic
			return true;
		}
	
	#################################################################################################################################################
	// Check for Local or Remote Global Permissions (OR PERMISSION CHECK)
	#################################################################################################################################################
		function hive__access($object, $rights_local, $global_search = false, $inital_override = true) {
			// Initial CMS User is always Superadmin
			if($inital_override) { if(@$object["user"]->user["user_initial"] == 1) { return true; } }
			// Permission Checks
			if($global_search) { 
				// Check for Global Permissions
				if(!is_array($rights_local)) { $rights_local = array($rights_local); }
				// Check for Permission and Return
				if(is_array($rights_local)) {
					foreach($rights_local AS $key => $value) {
						// Does user have perm himself?
						if($object["user_perm_glob"]->has_perm($value)) { return true; }
						// Obtain Group Permission
						foreach($object["user_group"] as $groupkey => $groupvalue) { 
							if($groupvalue["perm_group_glob"]->has_perm($value)) { return true; }
						}
					}
				} return false;
			} else {
				// Check for Local Permissions
				if(!is_array($rights_local)) { $rights_local = array($rights_local); }
				// Check for Permission and Return
				if(is_array($rights_local)) {
					foreach($rights_local AS $key => $value) {
						// Does user have perm himself?
						if($object["user_perm"]->has_perm($value)) { return true; }
						// Obtain Group Permission
						foreach($object["user_group"] as $groupkey => $groupvalue) { 
							if($groupvalue["perm_obj"]->has_perm($value)) { return true; }
						}
					}
				} return false;
			}
		}
		
	#################################################################################################################################################
	// Get User Logged In Related Values
	#################################################################################################################################################
		function hive__user_lang_get($object, $user_id, $mode) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { return false; }
				return @$tmp[$mode]["lang"];
				return true;
			} return false;
		}
		function hive__user_theme_get($object, $user_id, $mode) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { return false; }
				return @$tmp[$mode]["theme"];
				return true;
			} return false;
		}	
		function hive__user_theme_sub_get($object, $user_id, $mode) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { return false; }
				return @$tmp[$mode]["theme_sub"];
				return true;
			} return false;
		}	
		function hive__user_color_get($object, $user_id, $mode) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { return false; }
				return @$tmp[$mode]["color"];
			} return false;
		}	
		function hive__user_key_get($object, $user_id, $mode, $key) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { return false; }
				return @$tmp[$mode][$key];
			} return false;
		}			
		
	#################################################################################################################################################
	// Set User Logged In Related Values
	#################################################################################################################################################
		function hive__user_lang_set($object, $user_id, $mode, $theme_name) {
			if(is_numeric($user_id) AND @in_array(@$theme_name, _HIVE_LANG_ARRAY_)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { $tmp = array(); }
				$tmp[$mode]["lang"] = $theme_name;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}
		function hive__user_theme_set($object, $user_id, $mode, $theme_name) {
			if(is_numeric($user_id) AND @in_array(@$theme_name, _HIVE_THEME_ARRAY_)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { $tmp = array(); }
				$tmp[$mode]["theme"] = $theme_name;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}	
		function hive__user_theme_sub_set($object, $user_id, $mode, $theme_name) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { $tmp = array(); }
				$tmp[$mode]["theme_sub"] = $theme_name;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}	
		function hive__user_color_set($object, $user_id, $mode, $theme_name) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { $tmp = array(); }
				$tmp[$mode]["color"] = $theme_name;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}	
		function hive__user_key_set($object, $user_id, $mode, $key, $value) {
			if(is_numeric($user_id)) {
				$x = $object["user"]->get($user_id);
				$tmp = @unserialize($x["hive_extradata"]);
				if(!is_array($tmp)) { $tmp = array(); }
				$tmp[$mode][$key] = $value;
				$tmp = serialize($tmp);
				$bind[0]["value"] = $tmp;
				$bind[0]["type"] = "s";
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET hive_extradata = ? WHERE id = '".$user_id."'", $bind);
				return true;
			} return false;
		}		

	#################################################################################################################################################
	// Quick and Easy Functions
	#################################################################################################################################################	
		function hive__trim($string) {
			return trim($string ?? '');
		}
		function hive__hsc($string) {
			return htmlspecialchars($string ?? '');
		}
		function hive__hen($string) {
			return htmlentities($string ?? '');
		}

	#################################################################################################################################################
	// Folder Functions
	#################################################################################################################################################
		function hive__folder_create($folderpath, $forwardfile = false, $denie_access = false, $chmode = 0770) {
			if(!is_dir($folderpath)) {  @mkdir($folderpath, $chmode, true); }
			if(is_dir($folderpath)) {
				if($forwardfile) {
					if(!file_exists($folderpath."/index.php")) { 
						file_put_contents($folderpath."/index.php", "<?php
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
			Redirect to previous directory in Folder Structure.
	*/
	@http_response_code(404);
	Header(\"Location: ../\");");
					}
				}
				if($denie_access) { x_htaccess_secure($folderpath); }
			}
		}	

	#################################################################################################################################################
	// URL Functionalities
	#################################################################################################################################################
		function  hive__url($array) {
			$url_rel = _HIVE_URL_REL_."";
			if(_HIVE_URL_SEO_) {
				foreach($array as $key => $value) {
					if($value == false) { break;}
					if($key == 0) {  } else {$url_rel .= "/";  }
					if(@is_string(@_HIVE_URL_GET_[$key]) AND @is_string($value)) { $url_rel .= $value; }}
			} else {
				foreach($array as $key => $value) {
					if($value == false) { break;}
					if($key == 0) { $url_rel .= "?"; } else {$url_rel .= "&";  }
					if(@is_string(@_HIVE_URL_GET_[$key]) AND @is_string($value)) { $url_rel .= _HIVE_URL_GET_[$key]."=".$value; }
				}}
				if(substr($url_rel, 0, 1) == "?") { return "/".$url_rel;}
			return $url_rel;}

	#################################################################################################################################################
	// Full Error Page to Include per Function
	#################################################################################################################################################		
		function hive__error($title, $subtitle, $description, $exit, $code) { 
			if(is_numeric($code)) { @http_response_code($code); }
		?><!DOCTYPE html>
		<html>
		<head>
			<title><?php echo $title; ?><?php if(defined("_HIVE_TITLE_SPACER_")) { echo _HIVE_TITLE_SPACER_; } else { echo " - "; } ?><?php if(defined("_HIVE_TITLE_")) { echo _HIVE_TITLE_; } else { echo "CMS"; } ?></title>
			<meta charset="UTF-8">
			<meta name="robots" content="noindex, nofollow">
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="data:image/x-icon;base64,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O//DiDv/w4k7/8OJO//DiDv/w4g7/8OJO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTr/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g6/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8KIO//DiDv/w4k7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OJO//CiDv/0qdu//bt4v/27eL/0qdu/8OIO//DiDv/w4g7/8OJO//DiDv/w4k7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8KIO//27eL////////+///27eP/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g6/8OIO//DiDv/w4g7/8OIO//DiDv/w4g6/8OIO//DiTv/wok7/8OIO//DiDv/w4g7/8OIO//DiDv/w4k7/8OIOv/DiTr/w4g7//78+/////////7///79+//DiDv/w4g7/8OIO//DiTr/w4g6/8OIO//DiDr/w4g6/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g6/8OIO//DiDv/w4g7/8OIO//DiDv/w4g6/8OIO//CiDr/wog7/8OIO//DiDv//v37///+/////////v37/8OIO//DiDv/w4g6/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//CiDv/w4g7/8OIO//DiTv/w4g7/8OJO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//+/fv////////////+/fv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDr/w4g7/8OJO//DiDr/w4g7/8OJO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//CiDv/wog7//79+/////////7///79+//CiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiTv/w4g7/8OIO//DiDv/w4g7/8KIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv//v37/////v///////v37/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g6/8OIO//CiDv/w4k7/8OJO//DiDv/w4g7/8OIO//CiDv/w4g7/8OIO//+/fv///////7////+/fv/w4g7/8OIO//DiDv/w4g7/8OIO//CiDv/w4g7/8OJOv/DiDv/w4k7/8OIO//CiDv/wog6/8KIO//DiDv/w4g7/8KIO//DiDv/w4g7/8OJO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7//79+v////////////79+v/DiDv/w4g7/8OIO//DiTr/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//CiDv/w4g7/8OIO//CiDv/w4g7/8OJOv/DiDv/wog7/8OIO//DiDv/w4g7/8KIO//DiDv/w4g7/8OIO//DiDv//v37//7////+/////v37/8OIOv/DiTv/w4k7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/wok7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//CiDv/w4k7/8OIO////fv//v/////////+/Pv/w4g7/8OIOv/DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIOv/DiDv/w4g7/8KIO//DiDv/w4g7/8OIO//DiDv/wog7/8OJO//DiDv/wog7/8KJOv/DiDv/w4g7//79+/////////////79+//DiDv/w4g7/8OIO//DiTv/w4g6/8OIO//DiDv/w4k7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g6/8OIO//DiDv/w4g7/8OIO//DiDv//v37/////////////v37/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//CiDv/w4g7/8KIO//DiDv/w4g7/8KIO//DiDv/w4g7/8OIO//DiDv/w4g7/8KIO//DiDv/w4k7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//48ej////+///////48ej/w4g7/8OIO//CiDr/w4k7/8OJO//DiDv/w4g6/8OIO//DiDr/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g6/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/9ewfP/7+PX/+/n0/9ewff/DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4k7/8OIO//DiDv/w4g7/8KIO//DiDv/w4g6/8OIO//DiDv/wog7/8OIO//DiDv/wog7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8SKPv/Fij7/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiTv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g6/8OIO//FikH/2bSD/9m0hP/FjEL/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OJO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//CiDv/w4g7/8OIO//DiDv/w4g8/+/hzP////7///////Hj0f/DiTz/w4g7/8OIO//DiDv/w4g7/8OIOv/DiTv/w4g6/8KIO//DiDv/w4g7/8OIO//DiDr/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wok7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//NnV3////////////+/////////86eXv/DiDr/w4g7/8OIO//DiDv/wok7/8KIO//DiDv/wok7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g6/8OJO//DiDv/w4g7/8OIO//CiDv/w4g6/8mTTv/9/Pr////////////+/Pr/yZNO/8OI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O//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiTv/xIg7n8OIPOfDiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g858OIO/7DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/sOIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiTv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8aORf/dvJD/9erd//Tq3P/du5D/xo5F/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/9y6jv/9+/n////////////9+/j/3bqO/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiTv/wog7/8OIO//DiDv/w4g7//Xs3////v///v//////////////9ezf/8OIOv/DiDv/w4g7/8OIO//DiDv/wog7/8OIOv/DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7//36+P///////////////////////fv4/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7//38+f///////////////////v///fz5/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7//38+f///////////////////v///fz5/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7//38+f///////////////////////fz5/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7//38+f///////////////////v///fz5/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7//38+f///////////////////////fz5/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiTv/w4g7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7//38+f///////////////////////fz5/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7//38+f///////////////////v///fz5/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7//38+f///v///v///////v///////fz5/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7//38+f///////////////////////fz5/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/wog7/8OIO//DiDv/w4g7//38+f///////v///////////////fz5/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7//38+f///////////////////////fz5/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7//38+P///////////////////////fz5/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIOv/DiDv/w4g7//38+f///////////////////////fz5/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7//38+f///////////////v///////fz5/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/wog7/8OIO//DiTv/wog7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7//38+f///v///////////////////fz5/8OIOv/DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7//v48///////////////////////+/fz/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/wog7/8OIOv/DiTv/w4g7/8OIO//DiTv/w4g7/8OIOv/DiDv/w4g7/+/fy///////////////////////7+DM/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/9Kmbf/58+v//v7+//7+/v/58+v/0qZt/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8SKP//Spmz/4cSd/+HEnf/Spm3/xIo//8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiTv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4k9/8OJPf/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/wog7/8OIO//DiTv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIPP/Hj0f/y5hW/8uYVv/HkEj/w4g8/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiTv/wog7/8OIO//DiDv/w4g7/82cXP/q173/+vTt//r17v/s2cD/zp5g/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/xIk9//Ll1P///v7//////////////v7/9OjZ/8SLP//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/0qVs/////////////////////////////////9Knbv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/1q55/////////////////////////////////9auev/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/yJJM//v38v///////////////////v///Pj0/8iSTf/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiTv/wog7/8OIO//DiDv/w4g7/9evff/48ur//v38//79/P/58ur/2LF//8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8SKPv/Qomb/3r6U/96+lP/Qo2f/xIo+/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO/7DiDv/w4g7/8OIO//DiTv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIOv/DiTv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/wog7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/wog7/sOIPOfDiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g858SIO5/DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/xYg7n8GHOTHDiDrow4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiTv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDrowIc5MdSAVQbCiDplw4g66MOIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOv/DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIOujCiDplt21JBwAAAADUgFUGwIc5McSIO5/DiDznw4g7/sOIO//DiTv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIOv/DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/wog7/8OIO//DiDv/wog7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO//DiDv/w4g7/8OIO/7DiDznxIg7n8GHOTHUgFUGAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==">
			<style type="text/css">
				body { text-align: center; padding: 10%; font: 20px Helvetica, sans-serif; color: #333; }
				h1 { font-size: 50px; margin: 0; }
				article { display: block; text-align: left; max-width: 650px; margin: 0 auto; }
				a { color: #FF5707; text-decoration: none; }
				a:hover { color: #333; text-decoration: none; }
				@media only screen and (max-width : 480px) {
					h1 { font-size: 40px; }
				}
			</style>
		</head>
			<body>
				<article>
					<h1><?php echo $title; ?></h1>
					<p><?php echo $subtitle; ?> <?php echo $description; ?></p>
					<p><a href="/">Back to Home</a></p>
				</article>
		</body></html><?php if($exit) { exit(); } }		

	#################################################################################################################################################
	// Default Login and User Token Functionalities
	#################################################################################################################################################			
		function hive__template_mail_activate($object, $get_token = "ref_token", $get_user = "ref_user", $message = true, $redirect = false) {
			$code = false;
			if(is_numeric(@$_GET[$get_user]) AND is_numeric(@$_GET[$get_token])) {
				if(!$object["ipbl"]->banned()) { 
					$code = $object["user"]->mail_edit_confirm(@$_GET[$get_user], @$_GET[$get_token]);
					if($code == 1) { if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_m_ok"));  }}
					if($code == 2) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_er")); }}
					if($code == 3) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_exp")); }}
					if($code == 4) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_res")); }}
					if($code == 5) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_block")); }}
					if($code == 6) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_m_res")); }}
			} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_ipban")); } $code = "banned";} } 
			if($redirect) { Header("Location: ".$redirect.""); exit(); } return $code; }
			
		function hive__template_user_activate($object, $get_token = "ref_token", $get_user = "ref_user", $message = true, $redirect = false) {
			$code = false;
			if(is_numeric(@$_GET[$get_user]) AND is_numeric(@$_GET[$get_token])) {
				if(!$object["ipbl"]->banned()) { 
					$code = $object["user"]->activation_confirm(@$_GET[$get_user], @$_GET[$get_token]);
					if($code == 1) { if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_a_ok"));  } }
					if($code == 2) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_er")); } }
					if($code == 3) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_exp")); } }
					if($code == 4) { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_a_block")); } }
				} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_ipban")); } $code = "banned";}
				} if($redirect) { Header("Location: ".$redirect.""); exit(); } return $code; }
		
		function hive__template_login($object, $cookies_allow = false, $message = true) {
			// Return OK if user is Logged In
			if($object["user"]->user_loggedIn) { return true; }
			// Get the current protocol (http or https)
			$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
			$domain = $_SERVER['HTTP_HOST'];
			$uri = $_SERVER['REQUEST_URI'];
			$current_url = $protocol . $domain . $uri;
			if ($_SERVER['QUERY_STRING']) {
				$current_url .= '?' . $_SERVER['QUERY_STRING'];
			}
			// Login Operation
			if (isset($_POST["loginbutton"])) {
				// Check for IP Ban on Current Login Try
				if(!$object["ipbl"]->banned()) { 
					// Check for Empty Missing Inputs
					if (!empty($_POST["usermail"]) and !empty($_POST["password"])) {
						// Prepare Cookie Allowed Bool Variable
						if(isset($_POST["rememberme"]) AND $cookies_allow) { $stay = true; } else { $stay = false; }
						// Check for CSRF Class Validation of $_post Token is set or Object is not created (csrf)
						if (!is_object($object["csrf"])) { 
						} else {
							if ($object["csrf"]->check($_POST["token"])) {
							} else { if($message) {  $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } return "csrf"; }	
						}
						// Login Request
						$object["user"]->login_request($_POST["usermail"], $_POST["password"], $stay);	
						// Fetch and Result Operation
						if ($object["user"]->login_request_code == 1) {			
							if($message) { $object["eventbox"]->ok($object["lang"]->translate("hive_login_msg_l_ok")); }
							return $object["user"]->login_request_code;				
						} elseif ($object["user"]->login_request_code == 2) {	
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_wrong")); }
							$object["ipbl"]->increase();	
							return $object["user"]->login_request_code;				
						} elseif ($object["user"]->login_request_code == 3) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_wrong")); }		
							$object["ipbl"]->increase();			
							return $object["user"]->login_request_code;		
						} elseif ($object["user"]->login_request_code == 4) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_blocked")); }	
							return $object["user"]->login_request_code;				
						} elseif ($object["user"]->login_request_code == 5) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_inactive")); }	
							return $object["user"]->login_request_code;				
						} elseif ($object["user"]->login_request_code == 6) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_blockedpwf")); }
							return $object["user"]->login_request_code;						
						} elseif ($object["user"]->login_request_code == 7) {
							if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_l_disabled")); }
							return $object["user"]->login_request_code;								
						} return 8;
					} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_empty")); } return "empty"; }
				} else { if($message) { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_ipban")); } return "banned"; }
			} return false; }	

		function hive__template_recover_request($object, $rec_url = false, $get_token = "rec_token", $get_user = "rec_user") {
			if (isset($_POST["resetbutton"])) {
				if (@trim(@$_POST["mail"]) != "") {	
					// Check for CSRF Class Validation of $_post Token is set or Object is not created (csrf)
					if (!is_object($object["csrf"])) { 
					} else {
						if ($object["csrf"]->check($_POST["token"])) {
						} else { if($message) {  $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } return "csrf"; }	
					}													
					$object["user"]->recover_request($_POST["mail"]);
					if ($object["user"]->rec_request_code == 1) {
						$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
						$url_if_needed = $current_url."/_core/_action/user_recover.php?rec_token=".$object["user"]->mail_ref_token."&rec_user=".$object["user"]->mail_ref_user;
						if(hive__default_mail($object, "SF_DEFAULT_RECOVER", $_POST["mail"], $object["user"]->mail_ref_user, $url_if_needed)) { 
							return 1; 
						} else { return "errmail"; }
					}
					//if ($object["user"]->rec_request_code == 3) { 
					//	$vartmp = round($object["user"]->recover_request_time($object["user"]->mail_ref_user) / 60, 0);
					//	if($message) {$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_rr_recwait")); }
					//	if($redirect) { Header("Location: ".$redirect.""); exit(); }}
					return @$object["user"]->rec_request_code;
				} else { }
			} return false;  					
		}				
	
	#################################################################################################################################################
	// Default Login Templates
	#################################################################################################################################################
	function hive__default_volt_footer($object, $footer = "", $classes = "bg-white rounded shadow p-5 mb-3 mt-3", $end_div = true) { ?>
			<?php if($end_div) { ?></div><?php } ?>
			<!-- End of modal backdrop -->
			<?php if($footer != "" AND $footer != false) { ?><footer id="web_footer" class="<?php echo $classes; ?>">
				<?php echo $footer; ?>
				</footer>
				<?php } ?>
				 </main>
		  </body>
		</html>	
	<?php }	
	function hive__default_volt_header($object, $tabtitle = "", $metaextensions = "", $theme_default = "dark", $mainclass = "", $defaultclasses = true) { 
		if(!isset($_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"])) {
			$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] = $theme_default; 
			if($object["user"]->user_loggedIn) {
				if(isset($object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] )) {
					if($object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] == "dark" OR $object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] == "false") {
						$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] = $object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"];
					}
				}
			}
		}	?><!DOCTYPE html>
		<html lang="en">
		<head> 
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="robots" content="noindex, nofollow">
			<meta name="title" content="<?php echo htmlentities($tabtitle); ?><?php if(_HIVE_TITLE_SPACER_ != false) { echo _HIVE_TITLE_SPACER_; } ?><?php if(is_string(_HIVE_TITLE_)) { echo @htmlentities(_HIVE_TITLE_); } ?>">
			<title><?php echo $tabtitle; ?><?php if(_HIVE_TITLE_SPACER_ != false) { echo _HIVE_TITLE_SPACER_; } ?><?php if(is_string(_HIVE_TITLE_)) { echo _HIVE_TITLE_; } ?></title>
			
			<?php if($defaultclasses) { ?>
				<!-- Default CSS Includes -->
				<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/notyf/notyf.min.css">
				<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/boxicons/boxicons.css">
				<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/volt/volt.css">
				<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/bugfish-jquery-sortselect/jquery.multiselect.sortable.js.css">
				
				<!-- Default Javascript Includes -->
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/jquery/jq.3.6.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/@popperjs/core/dist/umd/popper.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/bootstrap5/dist/js/bootstrap.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/onscreen/dist/on-screen.umd.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/sweetalert2/sweetalert2.all.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/datatables/jq.datatables.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/tinymce/tinymce.min.js"></script>	
				<script src='<?php echo _HIVE_URL_REL_; ?>_core/_vendor/bugfish-jquery-sortselect/jquery.multiselect.sortable.js' defer></script>		
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/resumable/resumable.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/nouislider/dist/nouislider.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/simplebar/dist/simplebar.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/notyf/notyf.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/momentjs/moment.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/githubbuttons/buttons.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/chartist/dist/chartist.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>_core/_vendor/volt/volt.js"></script>	
			<?php } ?>
			
			<!-- Include Extensions from Function -->
			<?php echo $metaextensions; ?>			
			
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>_core/stylesheet.php">
			<script src="<?php echo _HIVE_URL_REL_; ?>_core/javascript.php"></script> 
		
		</head>		
		  <body class="<?php echo $mainclass; ?>">
	<?php }
	
	#################################################################################################################################################
	// Default Download Functionalitites
	#################################################################################################################################################
	function hive__download_mimeTypes() { 
		/* Just add any required MIME type if you are going to download something not listed here.*/ 
		$mime_types = array("323" => "text/h323", 
			"acx" => "application/internet-property-stream", 
			"ai" => "application/postscript", 
			"aif" => "audio/x-aiff", 
			"aifc" => "audio/x-aiff", 
			"aiff" => "audio/x-aiff", 
			"asf" => "video/x-ms-asf", 
			"asr" => "video/x-ms-asf", 
			"asx" => "video/x-ms-asf", 
			"au" => "audio/basic", 
			"avi" => "video/x-msvideo", 
			"axs" => "application/olescript", 
			"bas" => "text/plain", 
			"bcpio" => "application/x-bcpio", 
			"bin" => "application/octet-stream", 
			"bmp" => "image/bmp", 
			"c" => "text/plain", 
			"cat" => "application/vnd.ms-pkiseccat", 
			"cdf" => "application/x-cdf", 
			"cer" => "application/x-x509-ca-cert", 
			"class" => "application/octet-stream", 
			"clp" => "application/x-msclip", 
			"cmx" => "image/x-cmx", 
			"cod" => "image/cis-cod", 
			"cpio" => "application/x-cpio", 
			"crd" => "application/x-mscardfile", 
			"crl" => "application/pkix-crl", 
			"crt" => "application/x-x509-ca-cert", 
			"csh" => "application/x-csh", 
			"css" => "text/css", 
			"dcr" => "application/x-director", 
			"der" => "application/x-x509-ca-cert", 
			"dir" => "application/x-director", 
			"dll" => "application/x-msdownload", 
			"dms" => "application/octet-stream", 
			"doc" => "application/msword", 
			"dot" => "application/msword", 
			"dvi" => "application/x-dvi", 
			"dxr" => "application/x-director", 
			"eps" => "application/postscript", 
			"etx" => "text/x-setext", 
			"evy" => "application/envoy", 
			"exe" => "application/octet-stream", 
			"fif" => "application/fractals", 
			"flr" => "x-world/x-vrml", 
			"gif" => "image/gif", 
			"gtar" => "application/x-gtar", 
			"gz" => "application/x-gzip", 
			"h" => "text/plain", 
			"hdf" => "application/x-hdf", 
			"hlp" => "application/winhlp", 
			"hqx" => "application/mac-binhex40", 
			"hta" => "application/hta", 
			"htc" => "text/x-component", 
			"htm" => "text/html", 
			"html" => "text/html", 
			"htt" => "text/webviewhtml", 
			"ico" => "image/x-icon", 
			"ief" => "image/ief", 
			"iii" => "application/x-iphone", 
			"ins" => "application/x-internet-signup", 
			"isp" => "application/x-internet-signup", 
			"jfif" => "image/pipeg", 
			"jpe" => "image/jpeg", 
			"jpeg" => "image/jpeg", 
			"jpg" => "image/jpeg", 
			"js" => "application/x-javascript", 
			"latex" => "application/x-latex", 
			"lha" => "application/octet-stream", 
			"lsf" => "video/x-la-asf", 
			"lsx" => "video/x-la-asf", 
			"lzh" => "application/octet-stream", 
			"m13" => "application/x-msmediaview", 
			"m14" => "application/x-msmediaview", 
			"m3u" => "audio/x-mpegurl", 
			"man" => "application/x-troff-man", 
			"mdb" => "application/x-msaccess", 
			"me" => "application/x-troff-me", 
			"mht" => "message/rfc822", 
			"mhtml" => "message/rfc822", 
			"mid" => "audio/mid", 
			"mny" => "application/x-msmoney", 
			"mov" => "video/quicktime", 
			"movie" => "video/x-sgi-movie", 
			"mp2" => "video/mpeg", 
			"mp3" => "audio/mpeg", 
			"mpa" => "video/mpeg", 
			"mpe" => "video/mpeg", 
			"mpeg" => "video/mpeg", 
			"mpg" => "video/mpeg", 
			"mpp" => "application/vnd.ms-project", 
			"mpv2" => "video/mpeg", 
			"ms" => "application/x-troff-ms", 
			"mvb" => "application/x-msmediaview", 
			"nws" => "message/rfc822", 
			"oda" => "application/oda", 
			"p10" => "application/pkcs10", 
			"p12" => "application/x-pkcs12", 
			"p7b" => "application/x-pkcs7-certificates", 
			"p7c" => "application/x-pkcs7-mime", 
			"p7m" => "application/x-pkcs7-mime", 
			"p7r" => "application/x-pkcs7-certreqresp", 
			"p7s" => "application/x-pkcs7-signature", 
			"pbm" => "image/x-portable-bitmap", 
			"pdf" => "application/pdf", 
			"pfx" => "application/x-pkcs12", 
			"pgm" => "image/x-portable-graymap", 
			"pko" => "application/ynd.ms-pkipko", 
			"pma" => "application/x-perfmon", 
			"pmc" => "application/x-perfmon", 
			"pml" => "application/x-perfmon", 
			"pmr" => "application/x-perfmon", 
			"pmw" => "application/x-perfmon", 
			"pnm" => "image/x-portable-anymap", 
			"pot" => "application/vnd.ms-powerpoint", 
			"ppm" => "image/x-portable-pixmap", 
			"pps" => "application/vnd.ms-powerpoint", 
			"ppt" => "application/vnd.ms-powerpoint", 
			"prf" => "application/pics-rules", 
			"ps" => "application/postscript", 
			"pub" => "application/x-mspublisher", 
			"qt" => "video/quicktime", 
			"ra" => "audio/x-pn-realaudio", 
			"ram" => "audio/x-pn-realaudio", 
			"ras" => "image/x-cmu-raster", 
			"rgb" => "image/x-rgb", 
			"rmi" => "audio/mid", 
			"roff" => "application/x-troff", 
			"rtf" => "application/rtf", 
			"rtx" => "text/richtext", 
			"scd" => "application/x-msschedule", 
			"sct" => "text/scriptlet", 
			"setpay" => "application/set-payment-initiation", 
			"setreg" => "application/set-registration-initiation", 
			"sh" => "application/x-sh", 
			"shar" => "application/x-shar", 
			"sit" => "application/x-stuffit", 
			"snd" => "audio/basic", 
			"spc" => "application/x-pkcs7-certificates", 
			"spl" => "application/futuresplash", 
			"src" => "application/x-wais-source", 
			"sst" => "application/vnd.ms-pkicertstore", 
			"stl" => "application/vnd.ms-pkistl", 
			"stm" => "text/html", 
			"svg" => "image/svg+xml", 
			"sv4cpio" => "application/x-sv4cpio", 
			"sv4crc" => "application/x-sv4crc", 
			"t" => "application/x-troff", 
			"tar" => "application/x-tar", 
			"tcl" => "application/x-tcl", 
			"tex" => "application/x-tex", 
			"texi" => "application/x-texinfo", 
			"texinfo" => "application/x-texinfo", 
			"tgz" => "application/x-compressed", 
			"tif" => "image/tiff", 
			"tiff" => "image/tiff", 
			"tr" => "application/x-troff", 
			"trm" => "application/x-msterminal", 
			"tsv" => "text/tab-separated-values", 
			"txt" => "text/plain", 
			"uls" => "text/iuls", 
			"ustar" => "application/x-ustar", 
			"vcf" => "text/x-vcard", 
			"vrml" => "x-world/x-vrml", 
			"wav" => "audio/x-wav", 
			"wcm" => "application/vnd.ms-works", 
			"wdb" => "application/vnd.ms-works", 
			"wks" => "application/vnd.ms-works", 
			"wmf" => "application/x-msmetafile", 
			"wps" => "application/vnd.ms-works", 
			"wri" => "application/x-mswrite", 
			"wrl" => "x-world/x-vrml", 
			"wrz" => "x-world/x-vrml", 
			"xaf" => "x-world/x-vrml", 
			"xbm" => "image/x-xbitmap", 
			"xla" => "application/vnd.ms-excel", 
			"xlc" => "application/vnd.ms-excel", 
			"xlm" => "application/vnd.ms-excel", 
			"xls" => "application/vnd.ms-excel", 
			"xlt" => "application/vnd.ms-excel", 
			"xlw" => "application/vnd.ms-excel", 
			"xof" => "x-world/x-vrml", 
			"xpm" => "image/x-xpixmap", 
			"xwd" => "image/x-xwindowdump", 
			"z" => "application/x-compress", 
			"rar" => "application/x-rar-compressed", 
			"zip" => "application/zip"); 
		return $mime_types;                     
	} 	
	
	function hive__download($filePath) {     
		if (!empty($filePath) && file_exists($filePath)) 
		{ 
			$fileInfo = pathinfo($filePath); 
			$fileName = $fileInfo['basename']; 
			$fileExtension = strtolower($fileInfo['extension']); 
			$defaultContentType = "application/octet-stream"; 
			$contentTypesList = hive__download_mimeTypes(); 
			$contentType = $contentTypesList[$fileExtension] ?? $defaultContentType; 

			$size = filesize($filePath); 
			$offset = 0; 
			$length = $size; 

			if (isset($_SERVER['HTTP_RANGE'])) 
			{ 
				if (preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $matches)) 
				{ 
					$offset = intval($matches[1]); 
					$length = (isset($matches[2]) ? intval($matches[2]) : $size) - $offset; 
					$length = max($length, 0); 
					$size = $size; 
				} 
				else 
				{ 
					header('HTTP/1.1 400 Invalid Range'); 
					exit; 
				} 
			} 

			// Headers for download
			header('Content-Type: ' . $contentType); 
			header('Content-Disposition: attachment; filename="' . $fileName . '"'); 
			header('Accept-Ranges: bytes'); 
			header('Cache-Control: no-cache, must-revalidate'); 
			header('Pragma: no-cache'); 
			header('Expires: 0'); 

			if ($offset > 0 || $length < $size) 
			{ 
				header('HTTP/1.1 206 Partial Content'); 
				header('Content-Range: bytes ' . $offset . '-' . ($offset + $length - 1) . '/' . $size); 
				header('Content-Length: ' . $length); 
			} 
			else 
			{ 
				header('Content-Length: ' . $size); 
			} 

			// Output file content
			$chunkSize = 8 * 1024 * 1024; // 8MB
			$handle = fopen($filePath, 'rb'); 

			if ($handle === false) 
			{ 
				header('HTTP/1.1 500 Internal Server Error'); 
				exit; 
			} 

			if ($offset > 0) 
			{ 
				fseek($handle, $offset); 
			} 

			while (!feof($handle) && (connection_status() === CONNECTION_NORMAL)) 
			{ 
				echo fread($handle, $chunkSize); 
				ob_flush(); 
				flush(); 
			} 

			fclose($handle); 
		} 
		else 
		{ 
			header('HTTP/1.1 404 Not Found'); 
			echo 'File does not exist or path is empty!'; 
		} 
	}