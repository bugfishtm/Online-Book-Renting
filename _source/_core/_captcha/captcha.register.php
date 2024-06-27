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
	if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { exit(); }
	if(_CAPTCHA_FONT_PATH_ != false) {$font_path = _CAPTCHA_FONT_PATH_;} else {$font_path = "../_font/_captcha-fallback.ttf";}
	x_captcha(_HIVE_SITE_COOKIE_."captcha.register", _CAPTCHA_WIDTH_, _CAPTCHA_HEIGHT_, _CAPTCHA_LINES_, _CAPTCHA_SQUARES_, _CAPTCHA_COLORS_, $font_path, _CAPTCHA_CODE_);
