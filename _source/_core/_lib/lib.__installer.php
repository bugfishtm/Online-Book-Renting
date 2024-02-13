<?php
	/* 	__________ ____ ___  ___________________.___  _________ ___ ___  
		\______   \    |   \/  _____/\_   _____/|   |/   _____//   |   \ 
		 |    |  _/    |   /   \  ___ |    __)  |   |\_____  \/    ~    \
		 |    |   \    |  /\    \_\  \|     \   |   |/        \    Y    /
		 |______  /______/  \______  /\___  /   |___/_______  /\___|_  / 
				\/                 \/     \/                \/       \/  	
							www.bugfish.eu
							
	    Bugfish Fast PHP Page Framework
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
	*/ if(!is_array($object)) { @http_response_code(@404); @Header("Location: ../"); exit(); }
	// INSTALLER OPTIONS
	define("_INSTALLER_TITLE_", 	"Installation");
	define("_INSTALLER_PRODUCT_", 	"Software");
	define("_INSTALLER_DESCR_", 	"Here you can execute required steps to install this software! Enter required data below and click on the submit button - the installer will then check your input and create a settings.php after that.");
	define("_INSTALLER_COOKIE_", 	"fp2_");
	define("_INSTALLER_PREFIX_", 	"fp2_");
	// Can be false // Code for Installation
	define("_INSTALLER_CODE_", 		false);