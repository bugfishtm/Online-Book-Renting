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
	*/	if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); } ?>
	
	
/******************************************************* x_cookiebanner  *********/
	.x_cookieBanner { -webkit-transform: translate3d(0, 0, 0); transform: translate3d(0, 0, 0); -webkit-box-sizing: border-box; -moz-box-sizing: border-box; 
		box-sizing: border-box; background-color: rgba(255, 20, 20, 0.95); color: #ccc; line-height: 26px; 
		font-family: Arial; display: block; position: fixed;font-size: 16px; bottom: 10vh; right: 0; color: #ffffff; 
		width: 200px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; padding: 20px;
		z-index: 600; }
	.x_cookieBanner a { color: #000000; text-decoration: none; font-weight: bold; }
	.x_cookieBanner a:hover { color: #ffffff; }	
	.x_cookieBanner input.x_cookieBanner_close { background-color: #1b1b1b; color: #fff; display: inline-block; border: none !important; width: 100% !important; border-color: #fff !important; 
		border-radius: 10px !important; cursor: pointer; height: 40px !important; font-size: 13px !important; font-family: Arial !important; font-weight: 700 !important; padding-top: 5px; padding-bottom: 5px; }
	.x_cookieBanner input.x_cookieBanner_close:hover { background-color: #121212; }