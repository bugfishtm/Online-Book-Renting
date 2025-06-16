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
		//define("_HIVE_ACTION_MAILCHANGE_", true);
		$object["var"]->setup("_HIVE_ACTION_MAILCHANGE_", 1, "");
		# General Activation Form Active?
		//define("_HIVE_ACTION_RECOVER_", true);
		$object["var"]->setup("_HIVE_ACTION_RECOVER_", 1, "");
		# General Recover Form Active?
		define("_HIVE_ACTION_LOGIN_", true);
		# General Register Form Active?
		//define("_HIVE_ACTION_REGISTER_", true);
		$object["var"]->setup("_HIVE_ACTION_REGISTER_", 1, "");

	/////////////////////////////////////////////////////////////////////////////
	## Language Settings
	/////////////////////////////////////////////////////////////////////////////
		$object["var"]->setup("_HIVE_LANG_DEFAULT_", "en", "");
		define("_HIVE_LANG_ARRAY_", 			array("en", "de", "ja", "es", "zh", "it", "fr", "ru", "kr", "pt", "in", "tr"));
		
	///////////////////////////////////////////////////////////////////
	// Site Related Variables
	///////////////////////////////////////////////////////////////////			
		$object["var"]->setup("_OBR_IMPRESSUM_", "Please add your impressum text here!", "");
		$object["var"]->setup("_OBR_PRIVACY_", "Please add your privacy text here!", "");
		
	/////////////////////////////////////////////////////////////////////////////
	## Mail Settings
	/////////////////////////////////////////////////////////////////////////////
		$object["var"]->setup("_SMTP_MAILS_HEADER_", '<!doctype html><html><head><meta name="viewport" content="width=device-width, initial-scale=1.0"/><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>body { background-color: #121212; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } .content { background: #FFFFFF; box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px; border-radius: 5px; margin-top: 15px;  }  .footer { clear: both; margin-top: 10px; text-align: center; width: 100%; color: #000000; font-size: 12px; text-align: center;  }  h1, h2, h3, h4 { color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 30px; }  h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; }  a { color: blue; text-decoration: none; } hr { border: 0; border-bottom: 1px solid #242424; margin: 20px 0; }  @media only screen and (max-width: 620px) { div.content { margin-top: 2vw !important; margin-left: 2vw !important; margin-right: 2vw !important;}} a:hover { color: black; } .alert { padding: 15px; margin: 5px; border-radius: 5px; } .alert-danger { background: #FFCDD2; } .alert-success { background: #A5D6A7; } .alert-warning { background: #FFF9C4; }</style></head><body><div class="content">', "");
		$object["var"]->setup("_SMTP_MAILS_FOOTER_", '</div></body></html>', "");
		$object["var"]->setup("_SMTP_SENDER_MAIL_", "email@local", "");
		$object["var"]->setup("_SMTP_SENDER_NAME_", "email@local", "");
		$object["var"]->setup("_SMTP_MAILS_IN_HTML_", 1, "");
		$object["var"]->setup("_SMTP_INSECURE_", 1, "");
		$object["var"]->setup("_SMTP_DEBUG_", 0, "");
		$object["var"]->setup("_SMTP_HOST_", "localhost", "");
		$object["var"]->setup("_SMTP_PORT_", 587, "");
		$object["var"]->setup("_SMTP_AUTH_", "ssl", "");
		$object["var"]->setup("_SMTP_USER_", "username", "");
		$object["var"]->setup("_SMTP_PASS_", "password", "");
		
	/////////////////////////////////////////////////////////////////////////////
	## Updater Script Settings (Optional)
	/////////////////////////////////////////////////////////////////////////////
		define("_UPDATER_TITLE_", 		"Online Book Renting"); 
		$object["var"]->setup("_UPDATER_CODE_", "", "");
		
	/////////////////////////////////////////////////////////////////////////////
	## Additional Functionalities Setup (Optional)
	/////////////////////////////////////////////////////////////////////////////
		define("_HIVE_CURL_LOGGING_", 	false); 
		$object["var"]->setup("_HIVE_IP_LIMIT_", 100000, "");
		define("_HIVE_REFERER_", 		false); 
		$object["var"]->setup("_HIVE_CSRF_TIME_", 1200, "");
		define('_CRON_ONLY_CLI_',  		true);  
		define('_HIVE_JS_ACTION_ACTIVE_',  false);  

	/////////////////////////////////////////////////////////////////////////////
	## Website Settings
	///////////////////////////////////////////////////////////////////////////// 
		# Website Title for Tabs and More
		$object["var"]->setup("_HIVE_TITLE_", "Online Book Renting", "");
		define('_HIVE_TITLE_SPACER_',  			" - "); 
		define('_HIVE_PHP_DEBUG_',  			false); 
		define('_HIVE_PHP_MODS_',  				array()); 
		define('_HIVE_MYSQL_DEBUG_',  			false); 

	/////////////////////////////////////////////////////////////////////////////
	## URL Navigation Settings
	/////////////////////////////////////////////////////////////////////////////
		define('_HIVE_URL_SEO_',  				false);  
		define('_HIVE_URL_GET_', 				array("hl1", "hl2", "hl3", "hl4", "hl5")); 
		
	/////////////////////////////////////////////////////////////////////////////
	## TinyMCE Settings
	/////////////////////////////////////////////////////////////////////////////
		# TinyMCE Plugins
		define("_TINYMCE_PLUGINS_", "preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor advlist lists wordcount help charmap quickbars emoticons code");
		# TinyMCE Menu Bar
		define("_TINYMCE_MENU_BAR_", "file edit view insert format table help");
		# TinyMCE Tool Bar
		define("_TINYMCE_TOOL_BAR_", "undo redo | bold italic underline strikethrough | blocks fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link");
	
	/////////////////////////////////////////////////////////////////////////////
	## User Settings (If using Users Class Module)
	/////////////////////////////////////////////////////////////////////////////	 
		# Maximum Days Sessions/Cookies are Valid
		define("_USER_MAX_SESSION_", 			7); 
		# Time in Minutes token out of Activation Mails are Valid
		//define("_USER_TOKEN_TIME_", 			600); 
		$object["var"]->setup("_USER_TOKEN_TIME_", 600, "");
		# Block Users after X Fail Logins (can be false)
		define("_USER_AUTOBLOCK_", 				false); 
		# Time in Minutes User has to wait between Requests (anti flood)
		//define("_USER_WAIT_COUNTER_", 			120); 
		$object["var"]->setup("_USER_WAIT_COUNTER_", 120, "");
		# Log old sessions? (Logins, Recoverys, Activations, Mail Changes) (true/false)
		define("_USER_LOG_SESSIONS_", 			false); 
		# Log User IPs in Database (true/false)
		define("_USER_LOG_IP_", 				false); 
		# True - Remove Recovery Keys after user Succesfully Logged In | false - Preserve Keys
		define("_USER_REC_DROP_", 				true); 
		# True - Allow Multi Login  | false - Disable Multi Login (old session logout)
		define("_USER_MULTI_LOGIN_", 			true); 
		# Passwordfilter: Min Signs
		define("_USER_PF_SIGNS_", 				9); 
		# Passwordfilter: Min Capital Signs
		define("_USER_PF_CAPSIGNS_", 			1); 
		# Passwordfilter: Min Small Signs
		define("_USER_PF_SMSIGNS_", 			1); 
		# Passwordfilter: Min Special Signs
		define("_USER_PF_SPSIGNS_", 			0); 
		# Passwordfilter: Min Numeric Signs
		define("_USER_PF_NUMSIGNS_", 			1); 
		# Initial Created Username
		define("_USER_INITIAL_USERNAME_", 			"admin@admin.local"); 
		# Initial Created User Password
		define("_USER_INITIAL_USERPASS_", 			"changeme"); 


