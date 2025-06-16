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
	*/	 if(!is_array(@$object)) { @http_response_code(404); Header("Location ../"); exit(); }
	//////////////////////////////////////////////////////////////////////////////
	// Cookie Banner Pre-Settings
	//////////////////////////////////////////////////////////////////////////////
	x_cookieBanner_Pre(_HIVE_SITE_COOKIE_);
	
	//////////////////////////////////////////////////////////////////////////////
	// Reset Language
	//////////////////////////////////////////////////////////////////////////////
	if(_HIVE_LANG_DEFAULT_ != _HIVE_LANG_) {
		unset($_SESSION[_HIVE_SITE_COOKIE_."hive_language"]);
		Header("Location: ./");
		exit();
	}
	
	//////////////////////////////////////////////////////////////////////////////
	// Start Page if no Page Selected
	//////////////////////////////////////////////////////////////////////////////
	if(@trim(_HIVE_URL_CUR_[0]) == "") { Header("Location: ".hive__url(array("list", false, false, false, false))); exit();}
	
	//////////////////////////////////////////////////////////////////////////////
	// Start Elements
	//////////////////////////////////////////////////////////////////////////////
	$object["add_head_title"] = $object["lang"]->translate("be_operr");
	$object["add_head_theme"] = "dark"; # Dark/ Light
	if(file_exists($object["path"]."/_data/"._HIVE_MODE_."/favicon.ico")) {
		$object["add_head_ext"] = '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_data/'._HIVE_MODE_.'/favicon.ico">';
	} else {
		$object["add_head_ext"] = '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_site/'._HIVE_MODE_.'/_theme/favicon.ico">';
	}
	$object["add_nav_title"] = _HIVE_TITLE_;
	$object["add_top_title"] = 404;
	
	// Login/Logout Button on Navigation
	if(!$object["user"]->loggedIn) {
		$object["add_nav_button_title"] 	= $object["lang"]->translate("be_login");
		$object["add_nav_button_url"] 		= array("./_core/_action/user_login.php", $object["add_nav_button_title"]);
	} else {
		$object["add_nav_button_title"] 	= $object["lang"]->translate("be_logout");
		$object["add_nav_button_url"] 		= array("./_core/_action/user_logout.php", $object["add_nav_button_title"]);
	}

	// Secured User Areas - Require
	switch(_HIVE_URL_CUR_[0]) {
		case false: case "":  
			Header("Location: ./?hl1=list");
			exit();
			break;
		case "list": 
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_list");
			require_once(_HIVE_SITE_PATH_."/html/list.php");
			break;	
		case "view": 
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_view");
			require_once(_HIVE_SITE_PATH_."/html/view.php");
			break;	
		case "profile": 
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_profile");
			require_once(_HIVE_SITE_PATH_."/html/profile.php");
			break;		
		case "deadlines": 
			if($object["user"]->loggedIn AND (hive__access($object, "page_deadlines", false))) {
				$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_deadlines");
				require_once(_HIVE_SITE_PATH_."/html/deadlines.php");
			} else { define("_INT_SHOW_ACCESS_", true); } 
			break;	
		case "tag": 
			if($object["user"]->loggedIn AND (hive__access($object, "page_tag", false))) {
				$object["add_top_title"] = $object["lang"]->translate("be_tag"); 
				$object["add_head_title"] = $object["add_top_title"];
				$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_tag");
				require_once(_HIVE_SITE_PATH_."/html/tag.php");
			} else { define("_INT_SHOW_ACCESS_", true); } 
			break;	
		case "user": 
			if($object["user"]->loggedIn AND (hive__access($object, "page_user", false))) {
				$object["add_top_title"] = $object["lang"]->translate("be_user"); 
				$object["add_head_title"] = $object["add_top_title"];
				$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_user");
				require_once(_HIVE_SITE_PATH_."/html/user.php");
			} else { define("_INT_SHOW_ACCESS_", true); } 
			break;	
		case "blacklist": 
			if($object["user"]->loggedIn AND (hive__access($object, "page_blacklist", false))) {
				$object["add_top_title"] = $object["lang"]->translate("be_blacklist"); 
				$object["add_head_title"] = $object["add_top_title"];
				$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_blacklist");
				require_once(_HIVE_SITE_PATH_."/html/blacklist.php");
			} else { define("_INT_SHOW_ACCESS_", true); } 
			break;	
		case "logging": 
			if($object["user"]->loggedIn AND (hive__access($object, "page_logging", false))) {
				$object["add_top_title"] = $object["lang"]->translate("be_logging"); 
				$object["add_head_title"] = $object["add_top_title"];
				$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_logging");
				require_once(_HIVE_SITE_PATH_."/html/logging.php");
			} else { define("_INT_SHOW_ACCESS_", true); } 
			break;				
		case "settings": 
			if($object["user"]->loggedIn AND (hive__access($object, "page_settings", false))) {
				$object["add_top_title"] = $object["lang"]->translate("be_settings"); 
				$object["add_head_title"] = $object["add_top_title"];
				$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."_site_settings");
				require_once(_HIVE_SITE_PATH_."/html/settings.php");
			} else { define("_INT_SHOW_ACCESS_", true); } 
			break;
		case "privacy": 
			$object["add_top_title"] = $object["lang"]->translate("be_privacy"); 
			$object["add_head_title"] = $object["add_top_title"];
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."global_csrf");
			hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
			hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);
			require_once(_HIVE_SITE_PATH_."/html/privacy.php");
			break;
		case "impressum": 
			$object["add_top_title"] = $object["lang"]->translate("be_impressum"); 
			$object["add_head_title"] = $object["add_top_title"];
			$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."global_csrf");
			hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
			hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);
			require_once(_HIVE_SITE_PATH_."/html/impressum.php");
			break;
		default:
			define("_INT_SHOW_NOTFOUND_", true);
	};		
	
	// Special Areas
	if(defined("_INT_SHOW_NOTFOUND_")) {
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."global_csrf");
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);
		echo "<div class='xfpe_margintop15px'></div>";	
		hive__volt_404($object, $object["lang"]->translate("be_404_1"), $object["lang"]->translate("be_404_2"));
	} elseif(defined("_INT_SHOW_ACCESS_")) {
		$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."global_csrf");
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);
		echo "<div class='xfpe_margintop15px'></div>";	
		hive__volt_401($object, $object["lang"]->translate("be_401_1"), $object["lang"]->translate("be_401_2"));	
	}		

	// Show EventBox Classes Objects if required
	$object["eventbox"]->show($object["lang"]->translate("be_close"));
	
	// Show Cookiebanner if required
	x_cookieBanner(_HIVE_SITE_COOKIE_, false, $object["lang"]->translate("be_cbanner_1"), "", false, $object["lang"]->translate("be_cbanner_2"));
	
	// Display Footer and End Website
	echo "<div class='xfpe_margintop15px'></div>";	 
	hive__volt_footer($object, false);		