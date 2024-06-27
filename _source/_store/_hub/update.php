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
	// Require Settings File,  otherwhise stop execution
	if(file_exists("../../settings.php")) { require_once("../../settings.php"); }
		else { echo "Store is currently not available! [Error x1]"; exit(); }
			
	// Output current deployed modules for external instances as serialized array!
	$x_array = $object["mysql"]->select("SELECT * FROM "._TABLE_HUB_." ORDER BY mod_rname, mod_version DESC", true);
	if(is_array($x_array)) { 
		echo serialize($x_array);
	} else {
		echo serialize(array());
	}