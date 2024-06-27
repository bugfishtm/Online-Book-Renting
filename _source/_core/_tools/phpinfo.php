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
	*/ if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { @http_response_code(404); Header("Location: ./"); exit(); }	
	if(!_HIVE_ALLOW_TOOLS_) { hive_error_full("Access Error", "Script is deactivated in ruleset.php!", "Enable _HIVE_ALLOW_TOOLS_ in ruleset.php or in the _administration interface to enable this files execution!", true, 401); }
	echo '<link rel="icon" type="image/x-icon" href="../_image/favicon.ico">';
	echo '<title>PHP Informations - CMS</title>';
	echo "<center><a href='../../developer.php'>Click here to go back to developer tools!</a></center>";
	phpinfo();