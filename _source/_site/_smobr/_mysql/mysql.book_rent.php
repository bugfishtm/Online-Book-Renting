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
			File in this folder with mysql.**table_name**.php will be installed automatically if you use syntax below.
			Use CREATE TABLE IF NOT EXISTS - to prevent performance lowagen through handler errors.
			File name shall not create the Prefix which has been set at the installation, prefix of tables will
			automatically be included!
	*/ if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); }
	$object["mysql"]->multi_query("CREATE TABLE IF NOT EXISTS `"._HIVE_SITE_PREFIX_."book_rent` (
	  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Item ID',
	  `fk_user` int(11) NULL COMMENT 'Related User',      
	  `fk_book` int(11) NULL COMMENT 'Related Book',      
	  `fk_book_item` int(11) NULL COMMENT 'Related Book Item',      
	  `tmp_barcode` text NULL COMMENT 'Related Book Barcode',      
	  `is_returned` int(1) NULL COMMENT '1 if returned',      
	  `due_date` datetime DEFAULT NULL COMMENT 'Time when the book should be returned',
	  `return_date` datetime DEFAULT NULL COMMENT 'Time when the book should be returned',
	  `rent_descr` text DEFAULT NULL COMMENT 'Custom Description',
	  `creation` datetime DEFAULT current_timestamp() COMMENT 'Creation Date which is automatically set',
	  `modification` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Modification Date which is automatically set',
	  PRIMARY KEY (`id`) USING BTREE );");
