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
			This File Configuration will be executed in the after the initialization but is stil part of that.. 
			See Documentation for more insights about initialization.
	*/ if(!is_array(@$object)) { http_response_code(404); Header("Location: ../"); exit(); }

	///////////////////////////////////////////////////////////////////
	// Navigation Language Menue Settings
	///////////////////////////////////////////////////////////////////
		define("__OBR_TABLE_TAG_", _HIVE_SITE_PREFIX_."book_tag");
		define("__OBR_TABLE_BOOK_", _HIVE_SITE_PREFIX_."book");
		define("__OBR_TABLE_BOOKI_", _HIVE_SITE_PREFIX_."book_item");
		define("__OBR_TABLE_BOOKR_", _HIVE_SITE_PREFIX_."book_rent");
		
	////////////////////////////////////////////////////////////////
	// You can set up current site module configuration here.
	// The configuration here is loaded after initial configuration, 
	// on the current web viewed site module.
	////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
	// Navigation Main Menue Settings
	///////////////////////////////////////////////////////////////////
		$object["nav"] = array();

		array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_books"),"nav_img" => "bx bx-book","nav_sub" => false, "nav_act" => "list", "nav_loc" => hive__url(array("list", false, false, false, false))));
	
		if($object["user"]->loggedIn AND (hive__access($object, "page_deadlines", false))) {		
			array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_deadlines"),"nav_img" => "bx bx-time-five","nav_sub" => false, "nav_act" => "deadlines", "nav_loc" => hive__url(array("deadlines", false, false, false, false))));
		}
	
		if($object["user"]->loggedIn AND (hive__access($object, "page_tag", false))) {
			array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_tag"),"nav_img" => "bx bx-tag","nav_sub" => false, "nav_act" => "tag", "nav_loc" => hive__url(array("tag", false, false, false, false))));
		}
	
		if($object["user"]->loggedIn AND (hive__access($object, "page_user", false))) {
			array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_user"),"nav_img" => "bx bx-user","nav_sub" => false, "nav_act" => "user", "nav_loc" => hive__url(array("user", false, false, false, false))));
		}
	
		if($object["user"]->loggedIn AND (hive__access($object, "page_blacklist", false))) {
			array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_blacklist"),"nav_img" => "bx bx-shield-alt-2","nav_sub" => false, "nav_act" => "blacklist", "nav_loc" => hive__url(array("blacklist", false, false, false, false))));
		}
	
		if($object["user"]->loggedIn AND (hive__access($object, "page_logging", false))) {
			array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_logging"),"nav_img" => "bx bx-notepad","nav_sub" => false, "nav_act" => "logging", "nav_loc" => hive__url(array("logging", false, false, false, false))));
		}

		if($object["user"]->loggedIn) {
			$act_temp = false; 
			if(@$_GET["id"] == $object["user"]->user_id OR !is_numeric(@$_GET["id"])) { $act_temp = "profile"; }
			array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_myprofile"),"nav_img" => "bx bxs-user-account","nav_sub" => false, "nav_act" => $act_temp, "nav_loc" => hive__url(array("profile", false, false, false, false))));
		}
		
		if($object["user"]->loggedIn AND (hive__access($object, "page_settings", false))) {
			array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_settings"),"nav_img" => "bx bx-cog","nav_sub" => false, "nav_act" => "settings", "nav_loc" => hive__url(array("settings", false, false, false, false))));
		}

		array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_privacy"),"nav_img" => "bx bxs-graduation","nav_sub" => false, "nav_act" => "privacy", "nav_loc" => hive__url(array("privacy", false, false, false, false))));
		
		array_push($object["nav"], array("nav_title" => $object["lang"]->translate("be_impressum"),"nav_img" => "bx bx-buildings","nav_sub" => false, "nav_act" => "impressum", "nav_loc" => hive__url(array("impressum", false, false, false, false))));	
	
	///////////////////////////////////////////////////////////////////
	// Navigation Language Menue Settings
	///////////////////////////////////////////////////////////////////
		$lang_ar = array();
		$lang_ar[0]["current_ident"] = _HIVE_LANG_;
		$lang_ar[0]["current_img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/"._HIVE_LANG_.".png";
		$lang_ar[0]["ident"] = "en";
		$lang_ar[0]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/en.png";
		$lang_ar[0]["name"] = "English";
		$lang_ar[1]["ident"] = "de";
		$lang_ar[1]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/de.png";
		$lang_ar[1]["name"] = "Deutsch";
		$lang_ar[2]["ident"] = "es";
		$lang_ar[2]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/es.png";
		$lang_ar[2]["name"] = "Espanol";
		$lang_ar[3]["ident"] = "ja";
		$lang_ar[3]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/ja.png";
		$lang_ar[3]["name"] = "日本語";	
		$lang_ar[4]["ident"] = "zh";
		$lang_ar[4]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/zh.png";
		$lang_ar[4]["name"] = "中国人";	
		$lang_ar[5]["ident"] = "it";
		$lang_ar[5]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/it.png";
		$lang_ar[5]["name"] = "Italiano ";	
		$lang_ar[6]["ident"] = "fr";
		$lang_ar[6]["img"] = _HIVE_URL_REL_."/_core/_vendor/country-flags-icons/png/fr.png";
		$lang_ar[6]["name"] = "Français";	
	
	#####################################################################################
	## Permission Settings
	#####################################################################################	
	# Here you can add permissions which can than be setup in the administrator panel!
	$object["set"]["permission"] = array(
		array("page_books", $object["lang"]->translate("be_tperm_page_books"), $object["lang"]->translate("be_dperm_page_books")),
		array("page_deadlines", $object["lang"]->translate("be_tperm_page_deadlines"), $object["lang"]->translate("be_dperm_page_deadlines")),
		array("page_tag", $object["lang"]->translate("be_tperm_page_tag"), $object["lang"]->translate("be_dperm_page_tag")),
		array("page_user", $object["lang"]->translate("be_tperm_page_user"), $object["lang"]->translate("be_dperm_page_user")),
		array("page_blacklist", $object["lang"]->translate("be_tperm_page_blacklist"), $object["lang"]->translate("be_dperm_page_blacklist")),
		array("page_logging", $object["lang"]->translate("be_tperm_page_logging"), $object["lang"]->translate("be_dperm_page_logging")),
		array("page_settings", $object["lang"]->translate("be_tperm_page_settings"), $object["lang"]->translate("be_dperm_page_settings")));	
