#!/usr/bin/env php
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
	
	//////////////////////////////////////////////////////////////////////////////////
	// Prevent Initialization if Settings.php is included.
	//////////////////////////////////////////////////////////////////////////////////
		define("_HIVE_PREVENT_INIT_", true);

	//////////////////////////////////////////////////////////////////////////////////
	// Functions for Process Creation
	//////////////////////////////////////////////////////////////////////////////////
		/*
			<?php
				// Assuming the JSON is passed as the first argument after the script name
				$jsonParameters = $argv[1] ?? '{}';
				$parameters = json_decode($jsonParameters, true);

				// Now you can use $parameters as an associative array
				print_r($parameters);
			?>
		*/
		function suitefish_worker_execute_php($path, $parameters = false) {
			if(trim(@$parameters ?? '') != "" AND @$parameters) { 
				$parameters = json_decode($parameters, true);
				$command = sprintf(PHP_BINARY." %s %s", escapeshellarg($path), escapeshellarg(json_encode($parameters)));
			} else { $command = sprintf(PHP_BINARY." %s", escapeshellarg($path)); }
			$descriptorspec = array(0 => array("pipe", "r"),1 => array("pipe", "w"),2 => array("pipe", "w"));
			$process = proc_open($command, $descriptorspec, $pipes, null, null, array('bypass_shell' => true));
			if (is_resource($process)) { foreach ($pipes as $pipe) { fclose($pipe); } return $process; }
			return false;
		}
		/*
			#!/bin/bash
			# Assuming the JSON is passed as the first argument
			jsonParameters="$1"
			# Parse JSON using jq
			if command -v jq &> /dev/null; then
				echo "Parsed parameters:"
				echo "$jsonParameters" | jq '.'
			else
				echo "jq is not installed. Raw JSON:"
				echo "$jsonParameters"
			fi
		*/
		function suitefish_worker_execute_bash($path, $parameters = false) {
			if(trim(@$parameters ?? '') != "" AND @$parameters) { 
				$parameters = json_decode($parameters, true);
				$command = sprintf("/bin/bash %s %s", escapeshellarg($path), escapeshellarg(json_encode($parameters)));
			} else { 
				$command = sprintf("/bin/bash %s", escapeshellarg($path)); 
			}
			$descriptorspec = array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "w"));
			$process = proc_open($command, $descriptorspec, $pipes, null, null, array('bypass_shell' => true));
			if (is_resource($process)) { 
				foreach ($pipes as $pipe) { 
					fclose($pipe); 
				} 
				return $process; 
			}
			return false;
		}
		/*
			#!/bin/sh
			# Assuming the JSON is passed as the first argument
			jsonParameters="$1"

			echo "Received JSON parameters:"
			echo "$jsonParameters"

			# If you have access to Python, you could use it to pretty-print the JSON
			if command -v python &> /dev/null; then
				echo "Parsed parameters:"
				echo "$jsonParameters" | python -m json.tool
			fi
		*/
		function suitefish_worker_execute_sh($path, $parameters = false) {
			if(trim(@$parameters ?? '') != "" AND @$parameters) { 
				$parameters = json_decode($parameters, true);
				$command = sprintf("/bin/sh %s %s", escapeshellarg($path), escapeshellarg(json_encode($parameters)));
			} else { 
				$command = sprintf("/bin/sh %s", escapeshellarg($path)); 
			}
			$descriptorspec = array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "w"));
			$process = proc_open($command, $descriptorspec, $pipes, null, null, array('bypass_shell' => true));
			if (is_resource($process)) { 
				foreach ($pipes as $pipe) { 
					fclose($pipe); 
				} 
				return $process; 
			}
			return false;
		}
		
	//////////////////////////////////////////////////////////////////////////////////
	// Logging Functionality
	//////////////////////////////////////////////////////////////////////////////////							
		function suitefish_worker_log($text) {
			if(!getenv("SUITEFISH_SUPERVISOR_LOG_FILE")) { return false; }
			$supervisorLogFile = getenv('SUITEFISH_SUPERVISOR_LOG_FILE');
			file_put_contents($supervisorLogFile, $text, FILE_APPEND);
		}		
		
	//////////////////////////////////////////////////////////////////////////////////
	// Prepare Variables and Libraries
	//////////////////////////////////////////////////////////////////////////////////
		$object = array();
		$object["path"] = dirname(__FILE__)."/../";
		if(!getenv("SUITEFISH_SUPERVISOR_LOG_FILE")) { usleep(60000000); exit(); }
		suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - STARTUP".PHP_EOL);
		if(file_exists($object["path"]."/_core/_framework/classes/x_class_mysql.php")) { require_once($object["path"]."/_core/_framework/classes/x_class_mysql.php"); } 
			else { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Mandatory Files for Executions are missing!".PHP_EOL); usleep(60000000); exit(); }
		if(file_exists($object["path"]."/_core/_framework/classes/x_class_var.php")) { require_once($object["path"]."/_core/_framework/classes/x_class_var.php"); } 
			else { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Mandatory Files for Executions are missing!".PHP_EOL); usleep(60000000); exit(); }
		if(file_exists($object["path"]."/_core/_framework/functions/x_library.php")) { require_once($object["path"]."/_core/_framework/functions/x_library.php"); } 
			else { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Mandatory Files for Executions are missing!".PHP_EOL); usleep(60000000); exit(); }
		if(!x_inCLI()) { @http_response_code(403); echo "TERMINATED - Worker can only be executed via CLI!"; exit(); }
		$valid_object = array();
		$valid_object["host"] = false;
		$valid_object["port"] = false;
		$valid_object["user"] = false;
		$valid_object["pass"] = false;
		$valid_object["db"] = false;
		$valid_object["prefix"] = false;
		$valid_object["cookie"] = false;
		$valid_object["path"] = false;
		$object["mysql"] = false;
		$processes_array = array();
		$processes_array_run = array();

	//////////////////////////////////////////////////////////////////////////////////
	// Check if Websites Settings File Exists to Execute Database Operation if Necessary
	//////////////////////////////////////////////////////////////////////////////////
		if(file_exists(dirname(__FILE__)."/../settings.php")) {
			//////////////////////////////////////////////////////////////////////////////////
			// Include the Settings.php File
			//////////////////////////////////////////////////////////////////////////////////
			require(dirname(__FILE__)."/../settings.php");		
			if(!$valid_object["host"]) 		{ $valid_object["host"] 	= $mysql['host']; }
			if(!$valid_object["user"]) 		{ $valid_object["user"] 	= $mysql['user']; }
			if(!$valid_object["port"]) 		{ $valid_object["port"] 	= $mysql['port']; }
			if(!$valid_object["pass"]) 		{ $valid_object["pass"] 	= $mysql['pass']; }
			if(!$valid_object["db"])   		{ $valid_object["db"] 		= $mysql['db']; }
			if(!$valid_object["prefix"])	{ $valid_object["prefix"] 	= $mysql['prefix']; }
			if(!$valid_object["path"])		{ $valid_object["path"] 	= $object['path']; }
			if(!$valid_object["cookie"])	{ $valid_object["cookie"] 	= $object['cookie']; }	
		} else { 
			//////////////////////////////////////////////////////////////////////////////////
			// Sleep for 1min if Settings not Found / Not Installed
			//////////////////////////////////////////////////////////////////////////////////
			suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Settings.php File missing.".PHP_EOL); 
			usleep(60000000);
			exit(); 
		}		
		
	//////////////////////////////////////////////////////////////////////////////////
	// Runtime
	//////////////////////////////////////////////////////////////////////////////////
		while(true) {
			//////////////////////////////////////////////////////////////////////////////////
			// Check if current PHP Version is 8 or Higher
			//////////////////////////////////////////////////////////////////////////////////
			if (version_compare(PHP_VERSION, '8.0.0', '>=')) {
				// Current PHP Version 8 or Higher // All OK
			} else {
				// PHP Version to Low to use this Script
				suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Current PHP Version is below 8.X.".PHP_EOL); 
				usleep(60000000); 
				exit();
			}			
			
			//////////////////////////////////////////////////////////////////////////////////
			// Check if Websites Settings File Exists to Execute Database Operation if Necessary
			//////////////////////////////////////////////////////////////////////////////////
			if(file_exists(dirname(__FILE__)."/../settings.php")) {
				//////////////////////////////////////////////////////////////////////////////////
				// Include the Settings.php File
				//////////////////////////////////////////////////////////////////////////////////
				require(dirname(__FILE__)."/../settings.php");		
				if(!$valid_object["host"]) 		{ $valid_object["host"] 	= $mysql['host']; }
				if(!$valid_object["user"]) 		{ $valid_object["user"] 	= $mysql['user']; }
				if(!$valid_object["port"]) 		{ $valid_object["port"] 	= $mysql['port']; }
				if(!$valid_object["pass"]) 		{ $valid_object["pass"] 	= $mysql['pass']; }
				if(!$valid_object["db"])   		{ $valid_object["db"] 		= $mysql['db']; }
				if(!$valid_object["prefix"])	{ $valid_object["prefix"] 	= $mysql['prefix']; }
				if(!$valid_object["path"])		{ $valid_object["path"] 	= $object['path']; }
				if(!$valid_object["cookie"])	{ $valid_object["cookie"] 	= $object['cookie']; }	
			} else { 
				//////////////////////////////////////////////////////////////////////////////////
				// Sleep for 1min if Settings not Found / Not Installed
				//////////////////////////////////////////////////////////////////////////////////
				suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Settings.php File missing.".PHP_EOL); 
				usleep(60000000);
				exit(); 
			}		
			
			//////////////////////////////////////////////////////////////////////////////////
			// Check Integrity of Settings Variables
			//////////////////////////////////////////////////////////////////////////////////			
			if(!$mysql['host']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if(!$mysql['user']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if(!$mysql['port']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if(!$mysql['pass']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if(!$mysql['db']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if(!$mysql['prefix']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if(!$object['path']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if(!$object['cookie']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if($valid_object["host"] != $mysql['host']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if($valid_object["user"] != $mysql['user']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if($valid_object["port"] != $mysql['port']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if($valid_object["pass"] != $mysql['pass']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if($valid_object["db"] != $mysql['db']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if($valid_object["prefix"] != $mysql['prefix']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if($valid_object["path"] != $object['path']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			if($valid_object["cookie"] != $object['cookie']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(60000000); exit(); }
			
			//////////////////////////////////////////////////////////////////////////////////	
			// Close previous MySQL Connections
			//////////////////////////////////////////////////////////////////////////////////
			if(is_object(@$object["mysql"])) {
				$object["mysql"]->mysqlcon->close();
			}
				
			//////////////////////////////////////////////////////////////////////////////////	
			// Close previous MySQL Connections
			//////////////////////////////////////////////////////////////////////////////////
			if(is_object(@$object["mysql"])) {
				unset($object["mysql"]);
			} $object["mysql"] = false;
			
			//////////////////////////////////////////////////////////////////////////////////		
			// MySQL Connection and Execution
			//////////////////////////////////////////////////////////////////////////////////		
			$object["mysql"] = new x_class_mysql(@$mysql["host"], @$mysql["user"], @$mysql["pass"], @$mysql["db"], @$mysql["port"]);   
			
			//////////////////////////////////////////////////////////////////////////////////		
			// Check for MySQL Errors
			//////////////////////////////////////////////////////////////////////////////////		
			if ($object["mysql"]->lasterror != false) {
				//////////////////////////////////////////////////////////////////////////////////		
				// Stop on MySQL Connection Error
				//////////////////////////////////////////////////////////////////////////////////	
				suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - MySQL Connection Error.".PHP_EOL); 
				usleep(60000000); 
				exit(); 
			}
			
			//////////////////////////////////////////////////////////////////////////////////		
			// Get and Update Worker Runtime Variables
			//////////////////////////////////////////////////////////////////////////////////		
			$object["var_glob"] = new x_class_var($object["mysql"], $valid_object["prefix"]."cms_var", "");			
			$object["var_glob"]->set("_SF_WORKER_TIME_VAR_", date("Y-m-d H:i:s"), "Datetime Value of Last Worker Execution on System", true, true);
			
			//////////////////////////////////////////////////////////////////////////////////		
			// Execute Worker Processes
			//////////////////////////////////////////////////////////////////////////////////					
			$x = $object["mysql"]->select("SELECT * FROM ".$valid_object["prefix"]."cms_worker WHERE script_executed = 0 ORDER BY id ASC", true);
			if(is_array($x)) {
				foreach($x as $k => $v) {
					//////////////////////////////////////////////////////////////////////////////////		
					// Preperation
					//////////////////////////////////////////////////////////////////////////////////		
					$is_extension = !empty(trim(@$v["site_extension"] ?? ''));
					$path = $object["path"];
					//////////////////////////////////////////////////////////////////////////////////		
					// Determine extension
					//////////////////////////////////////////////////////////////////////////////////	
					if(@$v["script_type"] == "php") { $extension = "php"; }
					elseif(@$v["script_type"] == "sh") { $extension = "sh"; }
					elseif(@$v["script_type"] == "bash") { $extension = "bash"; }
					else { $extension = false; }
					//////////////////////////////////////////////////////////////////////////////////		
					// Determine the Path to the script
					//////////////////////////////////////////////////////////////////////////////////	
					if($extension) { 
						if(!$is_extension) { 
							$path .= "/_site/".basename($v["site_module"])."/_worker/worker.".basename($v["script_execution"]).".".$extension."";
						} else { 
							$path .= "/_data/".basename($v["site_module"])."/_extension/".basename($v["site_extension"])."/_worker/worker.".basename($v["script_execution"]).".".$extension."";
						}			
					} else {
						$path = false;
					}				
					//////////////////////////////////////////////////////////////////////////////////		
					// Check for Errors
					//////////////////////////////////////////////////////////////////////////////////		
					if($path) {
						if(file_exists($path) && !is_dir($path)) {
							if($extension == "php") 	{ $process = suitefish_worker_execute_php($path, $v["script_parameters"]); }
							if($extension == "sh") 		{ $process = suitefish_worker_execute_sh($path, $v["script_parameters"]); }
							if($extension == "bash") 	{ $process = suitefish_worker_execute_bash($path, $v["script_parameters"]); }
							if ($process !== false) { 
								$status = proc_get_status($process);
								if(@$status['pid']) { $pid = $status['pid']; }
								$processes_array[$v['id']] = $process;
								$object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 1, script_pid = '".$pid."' WHERE id = ".$v['id']."");
							} else {
								$object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 3, script_pid = '' WHERE id = ".$v['id']."");
							}
						} else { $object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 2, script_pid = '' WHERE id = ".$v['id'].""); }
					} else { $object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 2, script_pid = '' WHERE id = ".$v['id'].""); }
				}
			}					
					
			//////////////////////////////////////////////////////////////////////////////////
			// Runtime Scripts from Adminstrator Module Exensions
			//////////////////////////////////////////////////////////////////////////////////
			if(is_dir($object["path"]."/_data/_administrator/_extension/")) {
				//////////////////////////////////////////////////////////////////////////////////
				// Get the path to the directory
				//////////////////////////////////////////////////////////////////////////////////
				$directoryPath = $object["path"] . "/_data/_administrator/_extension/";
				//////////////////////////////////////////////////////////////////////////////////
				// Scan the directory for its contents
				//////////////////////////////////////////////////////////////////////////////////
				$folders = scandir($directoryPath);
				//////////////////////////////////////////////////////////////////////////////////
				// Loop through each item in the directory
				//////////////////////////////////////////////////////////////////////////////////
				foreach ($folders as $folder) {
					//////////////////////////////////////////////////////////////////////////////////
					// Skip current and parent directory entries
					//////////////////////////////////////////////////////////////////////////////////
					if ($folder === '.' || $folder === '..') { continue; }
					//////////////////////////////////////////////////////////////////////////////////
					// Construct the full path of the folder
					//////////////////////////////////////////////////////////////////////////////////
					$fullPath = $directoryPath . $folder;
					//////////////////////////////////////////////////////////////////////////////////
					// Check if it is a directory
					//////////////////////////////////////////////////////////////////////////////////
					if (is_dir($fullPath. '/_runtime')) {
						//////////////////////////////////////////////////////////////////////////////////
						// Runtime Path Prepare
						//////////////////////////////////////////////////////////////////////////////////
						$runtimePath = $fullPath. '/_runtime/';
						//////////////////////////////////////////////////////////////////////////////////
						// Runtime Scandir Prepare
						//////////////////////////////////////////////////////////////////////////////////
						$files = scandir($runtimePath);
						//////////////////////////////////////////////////////////////////////////////////
						// Loop through current runtime scripts
						//////////////////////////////////////////////////////////////////////////////////
						foreach ($files as $file) {
							//////////////////////////////////////////////////////////////////////////////////
							// Skip current and parent directory entries
							//////////////////////////////////////////////////////////////////////////////////
							if ($file === '.' || $file === '..') { continue; }
							//////////////////////////////////////////////////////////////////////////////////
							// Check if the file starts with 'run' and ends with valid extension
							//////////////////////////////////////////////////////////////////////////////////
							if (is_file($runtimePath . '/' . $file) && substr($file, 0, 4) === 'run.') {
								//////////////////////////////////////////////////////////////////////////////////
								// PHP Script Handling
								//////////////////////////////////////////////////////////////////////////////////
								if (substr($file, -4) === '.php') {
									//////////////////////////////////////////////////////////////////////////////////
									// Prepare Execution
									//////////////////////////////////////////////////////////////////////////////////
									$procnumnow = md5($runtimePath . '/' . $file);
									//////////////////////////////////////////////////////////////////////////////////
									// Start Process
									//////////////////////////////////////////////////////////////////////////////////
									if(!array_key_exists($procnumnow, $processes_array_run)) { 
										$process = false;
										$process = suitefish_worker_execute_php($runtimePath . '/' . $file);
										if ($process !== false) {
											$processes_array_run[$procnumnow] = $process;
										}	
									}
								}
								//////////////////////////////////////////////////////////////////////////////////
								// BASH Script Handling
								//////////////////////////////////////////////////////////////////////////////////
								if (substr($file, -5) === '.bash') {
									//////////////////////////////////////////////////////////////////////////////////
									// Prepare Execution
									//////////////////////////////////////////////////////////////////////////////////
									$procnumnow = md5($runtimePath . '/' . $file);
									//////////////////////////////////////////////////////////////////////////////////
									// Start Process
									//////////////////////////////////////////////////////////////////////////////////
									if(!array_key_exists($procnumnow, $processes_array_run)) { 
										$process = false;
										$process = suitefish_worker_execute_bash($runtimePath . '/' . $file);
										if ($process !== false) {
											$processes_array_run[$procnumnow] = $process;
										}	
									}
								}	
								//////////////////////////////////////////////////////////////////////////////////
								// SH Script Handling
								//////////////////////////////////////////////////////////////////////////////////									
								if (substr($file, -3) === '.sh') {
									//////////////////////////////////////////////////////////////////////////////////
									// Prepare Execution
									//////////////////////////////////////////////////////////////////////////////////
									$procnumnow = md5($runtimePath . '/' . $file);
									//////////////////////////////////////////////////////////////////////////////////
									// Start Process
									//////////////////////////////////////////////////////////////////////////////////
									if(!array_key_exists($procnumnow, $processes_array_run)) { 
										$process = false;
										$process = suitefish_worker_execute_sh($runtimePath . '/' . $file);
										if ($process !== false) {
											$processes_array_run[$procnumnow] = $process;
										}	
									}
								}
							}
						}
					}
				}
			}
				
			//////////////////////////////////////////////////////////////////////////////////
			// Clean up finished processes for Workers
			//////////////////////////////////////////////////////////////////////////////////
			foreach ($processes_array as $id => $process) {
				$status = proc_get_status($process);
				if (is_array($status)) {
					if (!$status['running']) {
						proc_close($process);
						unset($processes_array[$id]); 
						if(is_numeric($id)) {
							$object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 3, script_pid = '' WHERE id = ".$id.""); 
						}
					}
				} else {
					unset($processes_array[$id]); 
					$object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 3, script_pid = '' WHERE id = ".$id.""); 
				}
			}				

			//////////////////////////////////////////////////////////////////////////////////
			// Clean up finished processes for Runtime
			//////////////////////////////////////////////////////////////////////////////////
			foreach ($processes_array_run as $id => $process) {
				$status = proc_get_status($process);
				if (is_array($status)) {
					if (!$status['running']) {
						proc_close($process);
						unset($processes_array_run[$id]); 
					}
				} else {
					unset($processes_array_run[$id]); 
				}
			}				
			
			//////////////////////////////////////////////////////////////////////////////////
			// Sleep for 5s
			//////////////////////////////////////////////////////////////////////////////////
			usleep(5000000);
		}	
		
	//////////////////////////////////////////////////////////////////////////////////
	// Runtime End
	//////////////////////////////////////////////////////////////////////////////////