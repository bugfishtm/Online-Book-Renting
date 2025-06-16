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
	// Starting Procedure
	define("_HIVE_SHORT_INIT_", true);
	if(file_exists(dirname(__FILE__)."/settings.php")) { require_once(dirname(__FILE__)."/settings.php"); } else { echo "Not yet installed!"; exit(); }
	if(!x_inCLI()) { hive__error("Not Allowed", "Cronjobs can only be executed via CLI!", "", true, 401);  exit(); } 
	
	// Cronjob Header
	ob_start();
	define("_CRON_SPACE_", "\r\n");
	
	// Starting Message
	echo ">>>>>> Cronjob executed at ". date('Y-m-d H:i:s').""._CRON_SPACE_;
	
	// Check Site Modules Folder
	if(is_dir($object["path"]."/_site/")) {
		
		// Scan Site Folder for Available Modules
		$scan = scandir($object["path"]."/_site/");
		
		// Loop through and remove files
		foreach ($scan as $key => $item) {
			if (!is_dir($object["path"]."/_site/".$item) || $item === '.' || $item === '..' || $item === '__disabled') {
				unset($scan[$key]); 
			}
		}		
		
		// Re-index the array (optional)
		$scan = array_values($scan);		
			
		// Run Through Available Site Module Folders
		foreach($scan as $file) {
			// Get Site Mode Info
			$object["hive_mode_config"] = hive__init_site_header($object, $file); 

			// Change Variables Data to fit current Site Module
			$object["var"] = new x_class_var($object["mysql"], _TABLE_VAR_, $file);
			$tmp = $object["var"]->get("_SMTP_HOST_"); if(!$tmp) { $tmp  = false; } 
			$tmp1 = $object["var"]->get("_SMTP_PORT_"); if(!$tmp1) { $tmp1  = false; } 
			$tmp2 = $object["var"]->get("_SMTP_AUTH_"); if(!$tmp2) { $tmp2  = false; } 
			$tmp3 = $object["var"]->get("_SMTP_USER_"); if(!$tmp3) { $tmp3  = false; } 
			$tmp4 = $object["var"]->get("_SMTP_PASS_"); if(!$tmp4) { $tmp4  = false; } 
			$tmpx = $object["var"]->get("_SMTP_SENDER_MAIL_"); if(!$tmpx) { $tmpx  = false; } 
			$tmp1x = $object["var"]->get("_SMTP_SENDER_NAME_"); if(!$tmp1x) { $tmp1x  = false; } 
			
			// FIt Mail Data for Current Site Module
			$object["mail"] = new x_class_mail($tmp, $tmp1, $tmp2, $tmp3, $tmp4, $tmpx, $tmp1x);
			$object["mail"]->initReplyTo($tmpx, $tmp1x);
			$object["mail"]->all_default_html(true);	
			$object["mail"]->smtpdebuglevel(0);	
			$object["mail"]->allow_insecure_ssl_connections(true);		
			$object["mail"]->logging($object["mysql"], _TABLE_LOG_MAIL_, false, $file);	
			$object["mail_template"] = new x_class_mail_template($object["mysql"], _TABLE_MAIL_TPL_, $file);
			$tmp = $object["var"]->get("_SMTP_MAILS_HEADER_"); if(!$tmp) { $tmp  = ""; } 
			$object["mail_template"]->set_header($tmp);
			$tmp1 = $object["var"]->get("_SMTP_MAILS_FOOTER_"); if(!$tmp1) { $tmp1  = ""; } 
			$object["mail_template"]->set_footer($tmp1);
			$object["mail"]->change_default_template($tmp, $tmp1);
			
			// Unset Worker Variables
			unset($tmp1); unset($tmp); unset($tmp2); unset($tmp3); unset($tmp4); unset($tmpx); unset($tmp1x);
			
			// Output Message for New Site Module Executions
			echo "--------->>> Executions for Site Module: '".$file."'"._CRON_SPACE_;
			
			// Check for Available Related Cron Directory in Site Module
		    if (is_dir($object["path"]."/_site/".$file."/_cron") AND $file != "." AND $file != "..") {
				// Loop Through Cronjobs in Modules Cronjob Folders	
			    foreach (glob($object["path"]."/_site/".$file."/_cron/cron.*.php") as $filename){
					// Message for Current File to be Executed
					echo "---> Cronjob File Execution: ".basename($filename).""._CRON_SPACE_;
					// Execute Current Site Modules Cronjob in Loop
					hive__require_once($object, $filename);	
			    }
		    }
			
			// Extension Libraries 
			$object["extensions_path"] = hive__extension_path($file);
			foreach ($object["extensions_path"] as $filename) {
				$object["extension"] = hive__init_extension_header($object, basename($filename), $file); 
				if (is_dir($filename."/_cron")) {
					foreach (glob($filename."/_cron/cron.*.php") as $filenamex){ 
						echo "---> Cronjob Extension File Execution: ".basename($filenamex).""._CRON_SPACE_;
						hive__require_once($object, $filenamex);
					}
				}
			}	
		}		
	}
	
	// Log and output Content
	$content = ob_get_contents();
	$cron_log = new x_class_log($object["mysql"], _TABLE_LOG_CRON_, "");
	$cron_log->message($content);
	ob_end_clean();
	echo $content;
	