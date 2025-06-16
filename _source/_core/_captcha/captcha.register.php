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
			You can include this Files in <img> tags on your website to easily display captchas. The Constants used below can 
			be adjusted by your site modules config.php setup. Code will be stored in $_SESSION[_HIVE_SITE_COOKIE_."captcha.register"].
	*/
	define("_HIVE_SHORT_INIT_", true);
	if(file_exists("../../settings.php")) { require_once("../../settings.php"); }
		else { echo "/* This CMS is not yet installed. Please install this CMS by visiting the websites root folder! */"; }
	if(_CAPTCHA_FONT_PATH_ != false) {$font_path = _CAPTCHA_FONT_PATH_;} else {$font_path = "../_font/_fallback/font.captcha_fallback.ttf";}
	x_captcha(_HIVE_SITE_COOKIE_."captcha.register", _CAPTCHA_WIDTH_, _CAPTCHA_HEIGHT_, _CAPTCHA_LINES_, _CAPTCHA_SQUARES_, _CAPTCHA_COLORS_, $font_path, _CAPTCHA_CODE_);
