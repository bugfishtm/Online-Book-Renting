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
	// Prevent Initialization if Settings.php is included.
		define("_HIVE_PREVENT_INIT_", true);

	// Create Asynchronous Process for each file executed.
		function suitefish_worker_execute($path, $parameters) {
			if(trim($parameters ?? '') != "" AND $parameters) { 
				$command = sprintf("/usr/bin/php %s %s", escapeshellarg($path), escapeshellarg(json_encode($parameters)));
			} else {
				$command = sprintf("/usr/bin/php %s", escapeshellarg($path));
			}
			$descriptorspec = array(
				0 => array("pipe", "r"),
				1 => array("pipe", "w"),
				2 => array("pipe", "w")
			);
			$process = proc_open($command, $descriptorspec, $pipes, null, null, array('bypass_shell' => true));
			
			if (is_resource($process)) {
				foreach ($pipes as $pipe) {
					fclose($pipe);
				}
				return $process;
			}
			return false;
		}
		
		function suitefish_worker_execute_noparam($path) {
			$command = sprintf("/usr/bin/php %s", escapeshellarg($path));
			$descriptorspec = array(
				0 => array("pipe", "r"),
				1 => array("pipe", "w"),
				2 => array("pipe", "w")
			);
			$process = proc_open($command, $descriptorspec, $pipes, null, null, array('bypass_shell' => true));
			
			if (is_resource($process)) {
				foreach ($pipes as $pipe) {
					fclose($pipe);
				}
				return $process;
			}
			return false;
		}
		
		function suitefish_worker_log($text) {
			if(!getenv("SUITEFISH_SUPERVISOR_LOG_FILE")) { return false; }
			$supervisorLogFile = getenv('SUITEFISH_SUPERVISOR_LOG_FILE');
			file_put_contents($supervisorLogFile, $text, FILE_APPEND);
		}
	
	// Prepare Variables and Libraries
		$object = array();
		$object["path"] = dirname(__FILE__)."/../";
		if(file_exists($object["path"]."/_core/_framework/classes/x_class_mysql.php")) { require_once($object["path"]."/_core/_framework/classes/x_class_mysql.php"); } 
			else { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Mandatory Files for Executions are missing!".PHP_EOL); usleep(5000000); exit(); }
		if(file_exists($object["path"]."/_core/_framework/classes/x_class_var.php")) { require_once($object["path"]."/_core/_framework/classes/x_class_var.php"); } 
			else { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Mandatory Files for Executions are missing!".PHP_EOL); usleep(5000000); exit(); }
		if(file_exists($object["path"]."/_core/_framework/functions/x_library.php")) { require_once($object["path"]."/_core/_framework/functions/x_library.php"); } 
			else { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Mandatory Files for Executions are missing!".PHP_EOL); usleep(5000000); exit(); }
		if(!x_inCLI()) { @http_response_code(403); echo "TERMINATED - Worker can only be executed via CLI!"; exit(); }
		if(!getenv("SUITEFISH_SUPERVISOR_LOG_FILE")) { usleep(5000000); exit(); }
		suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - STARTUP - Script is starting up!".PHP_EOL);
		$valid_object = array();
		$valid_object["host"] = false;
		$valid_object["port"] = false;
		$valid_object["user"] = false;
		$valid_object["pass"] = false;
		$valid_object["db"] = false;
		$valid_object["prefix"] = false;
		$valid_object["cookie"] = false;
		$valid_object["path"] = false;
		$processes_array = array();
			
	// Runtime
	while(true) {
		// Check if Websites Settings File Exists to Execute Database Operation if Necessary
		if(file_exists(dirname(__FILE__)."/../settings.php")) {
			// Include the Settings File
			require(dirname(__FILE__)."/../settings.php");
			if(!$valid_object["host"]) { $valid_object["host"] = $mysql['host']; }
			if(!$valid_object["user"]) { $valid_object["user"] = $mysql['user']; }
			if(!$valid_object["port"]) { $valid_object["port"] = $mysql['port']; }
			if(!$valid_object["pass"]) { $valid_object["pass"] = $mysql['pass']; }
			if(!$valid_object["db"])   { $valid_object["db"] = $mysql['db']; }
			if(!$valid_object["prefix"]){ $valid_object["prefix"] = $mysql['prefix']; }
			if(!$valid_object["path"]){ $valid_object["path"] = $object['path']; }
			if(!$valid_object["cookie"]){ $valid_object["cookie"] = $object['cookie']; }
			if($valid_object["host"] != $mysql['host']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(5000000); exit(); }
			if($valid_object["user"] != $mysql['user']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(5000000); exit(); }
			if($valid_object["port"] != $mysql['port']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(5000000); exit(); }
			if($valid_object["pass"] != $mysql['pass']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(5000000); exit(); }
			if($valid_object["db"] != $mysql['db']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(5000000); exit(); }
			if($valid_object["prefix"] != $mysql['prefix']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(5000000); exit(); }
			if($valid_object["path"] != $object['path']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(5000000); exit(); }
			if($valid_object["cookie"] != $object['cookie']) { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Script Exited because Integrity of settings.php variables if no longer guaranteed.".PHP_EOL); usleep(5000000); exit(); }
			// MySQL Connection and Execution
			$object["mysql"] = new x_class_mysql(@$mysql["host"], @$mysql["user"], @$mysql["pass"], @$mysql["db"], @$mysql["port"]);   
			if ($object["mysql"]->lasterror == false) {
				$x = $object["mysql"]->select("SELECT * FROM ".$valid_object["prefix"]."cms_worker WHERE script_executed = 0 ORDER BY id ASC", true);
				$object["var_glob"] = new x_class_var($object["mysql"], $valid_object["prefix"]."cms_var", "");
				$object["var_glob"]->set("_SF_WORKER_TIME_VAR_", date("Y-m-d H:i:s"), "Datetime Value of Last Worker Execution on System", true, true);
				if(is_array($x)) {
					foreach($x as $k => $v) {
						$is_extension = !empty(trim($v["site_extension"] ?? ''));
						$path = $object["path"];
						if(!$is_extension) { 
							$path .= "/_site/".$v["site_module"]."/_worker/worker.".$v["script_execution"].".php";
						} else { 
							$path .= "/_data/".$v["site_module"]."/_extension/".$v["site_extension"]."/_worker/worker.".$v["script_execution"].".php";
						}
						if(file_exists($path) && !is_dir($path)) {
							$parameters = json_decode($v["script_parameters"], true);
							$process = suitefish_worker_execute($path, $parameters);
							if ($process !== false) {
								$processes_array[$v['id']] = $process;
								$object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 1 WHERE id = ".$v['id']."");
								suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - EXECUTION RUN - ID[".$v["id"]."] - SITE[".@$v["site_module"]."] - EXT[".@$v["site_extension"]."] - FILE[".basename($path)."]".PHP_EOL);
							} else {
								$object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 3 WHERE id = ".$v['id']."");
								suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - EXECUTION FINISH - ID[".$v["id"]."] - SITE[".@$v["site_module"]."] - EXT[".@$v["site_extension"]."] - FILE[".basename($path)."]".PHP_EOL);
							}
							
						}
					}
				}
				// Runtime Scripts from Adminstrator Module Exensions
				if(is_dir($object["path"]."/_data/_administrator/_extension/")) {
					// Get the path to the directory
					$directoryPath = $object["path"] . "/_data/_administrator/_extension/";
					// Scan the directory for its contents
					$folders = scandir($directoryPath);
					// Loop through each item in the directory
					foreach ($folders as $folder) {
						// Skip current and parent directory entries
						if ($folder === '.' || $folder === '..') {
							continue;
						}
						// Construct the full path of the folder
						$fullPath = $directoryPath . $folder;
						// Check if it is a directory
						if (is_dir($fullPath. '/_runtime')) {
							$runtimePath = $fullPath. '/_runtime/';
							$files = scandir($runtimePath);
							foreach ($files as $file) {
								// Skip current and parent directory entries
								if ($file === '.' || $file === '..') {
									continue;
								}
								// Check if the file starts with 'run' and ends with '.php'
								if (is_file($runtimePath . '/' . $file) && 
									substr($file, 0, 4) === 'run.' && 
									substr($file, -4) === '.php') {
									$procnumnow = md5($runtimePath . '/' . $file);
									if(!array_key_exists("run".$procnumnow, $processes_array)) { 
										$process = suitefish_worker_execute_noparam($runtimePath . '/' . $file);
										if ($process !== false) {
											$processes_array["run".$procnumnow] = $process;
										}	
									}
								}
							}
						}
					}					
				}
				// Clean up finished processes
				foreach ($processes_array as $id => $process) {
					$status = proc_get_status($process);
					if (!$status['running']) {
						proc_close($process);
						unset($processes_array[$id]); 
						if(is_numeric($id)) {
							$object["mysql"]->query("UPDATE ".$valid_object["prefix"]."cms_worker SET script_executed = 3 WHERE id = ".$id.""); 
							suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - EXECUTION RUN FINISH - ID[".$id."]".PHP_EOL);
						}
					}
				}
			} else { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - MySQL Connection Error.".PHP_EOL); usleep(5000000); exit(); }
			// Close the MySQL Connection
			$object["mysql"]->mysqlcon->close();
			// Wait 200ms before querying new tasks to prevent server performance issues
			usleep(1000000);
		} else { suitefish_worker_log(date("Y-m-d H:i:s")." - Suitefish - TERMINATED - Settings.php File missing.".PHP_EOL); usleep(5000000); exit(); }
		// Sleep for 500ms
		usleep(500000); 
	}	
	