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
			This File Configuration will be executed in the middle of configuration. 
			See Documentation for more insights about initialization.
	*/ if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); }
	
	/////////////////////////////////////////////////////////////////////////////
	## TinyMCE Settings
	/////////////////////////////////////////////////////////////////////////////
		# TinyMCE Plugins
		//define("_TINYMCE_PLUGINS_", "preview importcss searchreplace autolink directionality visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor advlist lists wordcount help charmap quickbars emoticons code");
		# TinyMCE Menu Bar
		//define("_TINYMCE_MENU_BAR_", "file edit view insert format table help");
		# TinyMCE Tool Bar
		//define("_TINYMCE_TOOL_BAR_", "undo redo | bold italic underline strikethrough | blocks fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link");
	
	/////////////////////////////////////////////////////////////////////////////
	## User Settings (If using Users Class Module)
	/////////////////////////////////////////////////////////////////////////////	
		# Maximum Days Sessions/Cookies are Valid
		//define("_USER_MAX_SESSION_", 			7); 
		# Time in Minutes token out of Activation Mails are Valid
		//define("_USER_TOKEN_TIME_", 			600); 
		# Block Users after X Fail Logins (can be false)
		//define("_USER_AUTOBLOCK_", 				1200); 
		# Time in Minutes User has to wait between Requests (anti flood)
		//define("_USER_WAIT_COUNTER_", 			120); 
		# Log old sessions? (Logins, Recoverys, Activations, Mail Changes) (true/false)
		//define("_USER_LOG_SESSIONS_", 			true); 
		# Log User IPs in Database (true/false)
		//define("_USER_LOG_IP_", 				false); 
		# True - Remove Recovery Keys after user Succesfully Logged In | false - Preserve Keys
		//define("_USER_REC_DROP_", 				true); 
		# True - Allow Multi Login  | false - Disable Multi Login (old session logout)
		//define("_USER_MULTI_LOGIN_", 			false); 
		# Passwordfilter: Min Signs
		//define("_USER_PF_SIGNS_", 				7); 
		# Passwordfilter: Min Capital Signs
		//define("_USER_PF_CAPSIGNS_", 			1); 
		# Passwordfilter: Min Small Signs
		//define("_USER_PF_SMSIGNS_", 			1); 
		# Passwordfilter: Min Special Signs
		//define("_USER_PF_SPSIGNS_", 			0); 
		# Passwordfilter: Min Numeric Signs
		//define("_USER_PF_NUMSIGNS_", 			1); 
		# Initial Created Username
		//define("_USER_INITIAL_USERNAME_", 			"admin@admin.local"); 
		# Initial Created User Password
		//define("_USER_INITIAL_USERPASS_", 			"changeme"); 
		
	/////////////////////////////////////////////////////////////////////////////
	## Captcha Settings
	/////////////////////////////////////////////////////////////////////////////
		# Random Code for Captcha
		//define("_CAPTCHA_CODE_", 		mt_rand(1000, 9999)); 
		# Count of Lines in Captcha
		//define("_CAPTCHA_LINES_", 		mt_rand(5, 12)); 
		# Count of Squares in Captcha
		//define("_CAPTCHA_SQUARES_", 	mt_rand(5, 12)); 
		# Captcha Height Image
		//define("_CAPTCHA_HEIGHT_", 		"70"); 
		# Captcha Width Image
		//define("_CAPTCHA_WIDTH_", 		"200"); 
		# Colors for Captcha (Optional, can be false)
		//define("_CAPTCHA_COLORS_", 		false); 
		# If false Default Font will be used.
		//define("_CAPTCHA_FONT_PATH_", 	"../_font/font.captcha_fallback.ttf"); 
		
	/////////////////////////////////////////////////////////////////////////////
	## Mail Settings
	/////////////////////////////////////////////////////////////////////////////
		# Default Header for Mails
		//define("_SMTP_MAILS_HEADER_", 	'<!doctype html><html><head><meta name="viewport" content="width=device-width, initial-scale=1.0"/><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><style>body { background-color: #121212; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; } .content { background: #FFFFFF; box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px; border-radius: 5px; margin-top: 15px;  }  .footer { clear: both; margin-top: 10px; text-align: center; width: 100%; color: #000000; font-size: 12px; text-align: center;  }  h1, h2, h3, h4 { color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 30px; }  h1 { font-size: 35px; font-weight: 300; text-align: center; text-transform: capitalize; }  a { color: blue; text-decoration: none; } hr { border: 0; border-bottom: 1px solid #242424; margin: 20px 0; }  @media only screen and (max-width: 620px) { div.content { margin-top: 2vw !important; margin-left: 2vw !important; margin-right: 2vw !important;}} a:hover { color: black; } .alert { padding: 15px; margin: 5px; border-radius: 5px; } .alert-danger { background: #FFCDD2; } .alert-success { background: #A5D6A7; } .alert-warning { background: #FFF9C4; }</style></head><body><div class="content">'); 
		# Default Footer for Mails
		//define("_SMTP_MAILS_FOOTER_", 	'</div></body></html>'); 
		# Default Sender Mail Adr
		//define("_SMTP_SENDER_MAIL_", 	false);
		# Default Sender Mail Name
		//define("_SMTP_SENDER_NAME_", 	false);
		# All Mails sended as HTML? (false/true)
		//define("_SMTP_MAILS_IN_HTML_", 	true); 
		# Allow insecure SSL Connections? (true/false)
		//define("_SMTP_INSECURE_", 		true); 
		# Mail Debug Mode (0, 1, 2, 3) - Use 0 for Production as this will result Debug Output on site!
		//define("_SMTP_DEBUG_", 			0); 
		# SMTP Host 
		//define("_SMTP_HOST_", 			false); 
		# SMTP Port 
		//define("_SMTP_PORT_", 			false); 
		# SMTP Auth (ssl/tls/false) 
		//define("_SMTP_AUTH_", 			false); 
		# SMTP Username 
		//define("_SMTP_USER_", 			false); 
		# SMTP Password 
		//define("_SMTP_PASS_", 			false); 
		
	/////////////////////////////////////////////////////////////////////////////
	## Redis Settings
	/////////////////////////////////////////////////////////////////////////////
		# Redis Activated? False/True
		//define("_REDIS_", 				false); 
		# Redis Host
		//define("_REDIS_HOST_", 			"localhost"); 
		# Redis Port
		//define("_REDIS_PORT_", 			6379); 
		# Redis Prefix
		//define("_REDIS_PREFIX_", 		_HIVE_SITE_PREFIX_); 
		
	/////////////////////////////////////////////////////////////////////////////
	## Updater Script Settings (Optional)
	/////////////////////////////////////////////////////////////////////////////
		// Title for the Updater on this Site
		//define("_UPDATER_TITLE_", 		false); 
		// Code needed for Update? (can be false)	
		//define("_UPDATER_CODE_", 		false); 
		
	/////////////////////////////////////////////////////////////////////////////
	## Additional Functionalities Setup (Optional)
	/////////////////////////////////////////////////////////////////////////////
		# Log CURL Class Requests? (true/false)
		//define("_HIVE_CURL_LOGGING_", 	false); 
		# Block IPs after X Failures
		//define("_HIVE_IP_LIMIT_", 		100000); 
		# Log Referers? (true/false)
		//define("_HIVE_REFERER_", 		false); 
		# Default CSRF Code Valid Time in Seconds	
		//define('_HIVE_CSRF_TIME_',  	1200); 
		# True - Only Cronjob Execution from Command Line | False - Allow Cronjob Execution in Browser
		//define('_CRON_ONLY_CLI_',  		true);  
		# Activate Javascript Debugging Script
		// define('_HIVE_JS_ACTION_ACTIVE_',  true);  

	/////////////////////////////////////////////////////////////////////////////
	## Website Settings
	/////////////////////////////////////////////////////////////////////////////
		# Website Title for Tabs and More
		//define('_HIVE_TITLE_',  				"CMS"); 
		# Title Spacer for Tabs in Browser
		//define('_HIVE_TITLE_SPACER_',  			" - "); 
		# Show PHP Errors on website? (true/false)
		//define('_HIVE_PHP_DEBUG_',  			false); 
		# Array with needed PHP Modules, if not existant error is shown (example: array("mysqli", "mbstring", "gd")) 
		//define('_HIVE_PHP_MODS_',  				array()); 
		# Stop and Show MySQL Errors on Page if Happening? (Will always be logged in x_log_mysql table!) (true/false)
		//define('_HIVE_MYSQL_DEBUG_',  			false); 

	/////////////////////////////////////////////////////////////////////////////
	## URL Navigation Settings
	/////////////////////////////////////////////////////////////////////////////
		// STRING - GET VARIABLE SEO IN HTACCESS  | 0 - No SEO URLs Using
		//define('_HIVE_URL_SEO_',  				false);  
		# Only neeed if _HIVE_URL_SEO_ == false [Name for Get Location Variables]
		//define('_HIVE_URL_GET_', 				array("hl1", "hl2", "hl3", "hl4", "hl5")); 