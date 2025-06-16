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
		CREATE TABLE IF NOT EXISTS `"._HIVE_PREFIX_."cms_token` (
		  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
		  `fk_user` int(11) DEFAULT NULL COMMENT 'Access granted by User',
		  `site_mode` varchar(20) NOT NULL COMMENT 'Access granted to Site Module Name',
		  `token_key` varchar(128) NOT NULL COMMENT 'Token Key in plain Text',
		  `creation` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Creation Date',
		  `modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Modification Date',
		  PRIMARY KEY (`id`) USING BTREE );");