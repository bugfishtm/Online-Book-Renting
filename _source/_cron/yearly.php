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
	if(file_exists(dirname(__FILE__)."/../settings.php")) { require_once(dirname(__FILE__)."/../settings.php"); } else { echo "Not yet installed!"; exit(); }
	if(_CRON_ONLY_CLI_) { if(!x_inCLI()) { hive_error_full("Not Allowed", "Cronjob hardlink not allowed!", "Cron execution in browser has been disabled in configuration by _CRON_ONLY_CLI_.", true, 401);  exit(); } }
	$php_space = "\r\n"; if(!x_inCLI()) { $php_space = "<br />"; }
	ob_start();
	echo "// Yearly bugfishCMS Cronjob".$php_space.$php_space;
	if(is_dir($object["path"]."/_site/")) {
		$scan = scandir($object["path"]."/_site/");
		foreach($scan as $file) {
		   if (is_dir($object["path"]."/_site/".$file."/_cron/_yearly") AND $file != "." AND $file != "..") {
			   foreach (glob($object["path"]."/_site/".$file."/_cron/_yearly/cron.*.php") as $filename){ 
			   
					$object["cron_var"] = new x_class_var($object["mysql"], _TABLE_VAR_, @trim($file ?? ''));
					$hive_mode_cron = @trim($file ?? '');
					
					$tmp = $object["cron_var"]->get("_SMTP_HOST_"); if(!$tmp) { $tmp  = false; } 
					$tmp1 = $object["cron_var"]->get("_SMTP_PORT_"); if(!$tmp1) { $tmp1  = false; } 
					$tmp2 = $object["cron_var"]->get("_SMTP_AUTH_"); if(!$tmp2) { $tmp2  = false; } 
					$tmp3 = $object["cron_var"]->get("_SMTP_USER_"); if(!$tmp3) { $tmp3  = false; } 
					$tmp4 = $object["cron_var"]->get("_SMTP_PASS_"); if(!$tmp4) { $tmp4  = false; } 
					$tmpx = $object["cron_var"]->get("_SMTP_SENDER_MAIL_"); if(!$tmpx) { $tmpx  = false; } 
					$tmp1x = $object["cron_var"]->get("_SMTP_SENDER_NAME_"); if(!$tmp1x) { $tmp1x  = false; } 
					$object["cron_mail"] = new x_class_mail($tmp, $tmp1, $tmp2, $tmp3, $tmp4, $tmpx, $tmp1x);
					$object["cron_mail"]->initReplyTo($tmpx, $tmp1x);
					
					$object["cron_mail"]->all_default_html(true);	
					$object["cron_mail"]->smtpdebuglevel(0);	
					$object["cron_mail"]->allow_insecure_ssl_connections(true);		
					$object["cron_mail"]->logging($object["mysql"], _TABLE_LOG_MAIL_, false, $hive_mode_cron);	
					
					$object["cron_mail_template"] = new x_class_mail_template($object["mysql"], _TABLE_MAIL_TPL_, $hive_mode_cron);
					$tmp = $object["cron_var"]->get("_SMTP_MAILS_HEADER_"); if(!$tmp) { $tmp  = false; } 
					$object["cron_mail_template"]->set_header($tmp);
					$tmp1 = $object["cron_var"]->get("_SMTP_MAILS_FOOTER_"); if(!$tmp1) { $tmp1  = false; } 
					$object["cron_mail_template"]->set_footer($tmp1);	
					$object["cron_mail"]->change_default_template($tmp, $tmp1);	
					
					// Execute Current Site Modules Cronjob in Loop
					echo "// Execution - Site: ".$file." Cronjob File: ".basename($filename)."".$php_space.$php_space;
					require_once($filename);
					
					// Extension Libraries 
					foreach ($object["extensions_path"] as $filename) {
						$object["extension"] = array(); $object["extension"]["name"] = basename($filename);
						$object["extension"]["prefix"] =  _HIVE_PREFIX_."_".$hive_mode_cron."__".$object["extension"]["name"]."_";
						$object["extension"]["cookie"] =  _HIVE_COOKIE_."_".$hive_mode_cron."__".$object["extension"]["name"]."_";
						if (is_dir($filename."/_cron/_yearly")) {
								foreach (glob($filename."/_cron/_yearly/cron.*.php") as $filenamex){ require_once $filenamex; }
						}
					}		
					
			   }
		   }
		}	
	}
	
	// Log and output Content
	$content = ob_get_contents();
	$cron_log = new x_class_log($object["mysql"], _TABLE_LOG_CRON_, "yearly");
	$cron_log->message($content);
	ob_end_clean();
	echo $content;
	