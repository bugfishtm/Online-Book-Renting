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
			Core MySQL Table Installation File to be auto-installed on CMS Initialization if
			stated in initialize.php.in _core.
	*/ if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); }	
	$object["mysql"]->multi_query("
		CREATE TABLE IF NOT EXISTS `"._HIVE_PREFIX_."cms_worker` (
			`id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
			`script_execution` varchar(64) DEFAULT NULL COMMENT 'Name of the Script to be executed run.*.php for example.', 
			`script_type` varchar(12) DEFAULT NULL COMMENT 'Type of the Script to be executed (sh, php for example, NULL for direct command).', 
			`script_parameters` LONGTEXT DEFAULT NULL COMMENT 'Parameters to be send to the PHP Script, if direct command than this is the command', 
			`script_executed` int(1) DEFAULT 0 COMMENT '0 - Waiting | 1 - executed | 2 - Error | 3 - Success', 
			`script_return` LONGTEXT DEFAULT 0 COMMENT 'Return of the Script or command which has been executed.', 
			`script_pid` TEXT DEFAULT NULL COMMENT 'Process ID of the Script running.',
			`site_extension` varchar(20) DEFAULT NULL COMMENT 'Filled with extension name if worker script is from included site extension.',
			`site_module` varchar(20) DEFAULT NULL COMMENT 'Filled with Site Module Name from which script is included.', 
			`script_data` LONGTEXT DEFAULT NULL COMMENT 'Custom Data Field for Extensions to be used.', 
			`creation` datetime DEFAULT current_timestamp() COMMENT 'Creation Date auto set',
		  PRIMARY KEY (`id`) USING BTREE);
	");