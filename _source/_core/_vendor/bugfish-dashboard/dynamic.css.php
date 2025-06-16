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
	*/
	// Include Settings.php
	require_once("../../../settings.php");
	  
	// Cache Setup
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	  
	// Content is Text/CSS
	header('Content-Type: text/css'); 
?>
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
	*/

.background-success {
	background: lime;
	color: black;}

.force-white-focus:hover  {
	background: white !important;
	color: black !important;}
	
.bg-primary-bugfish {
    background: black;
}
.bg-primary-bugfish:hover {
    background: white;
    color: black;
}
.shadow-primary-bugfish:focus {
    border-color: red;
}
.transition-colors {
    border-color: #242424;
}
button {
    color: #cccccc;
}
.text-bugfish-primary {
    color: #cccccc;
}
.button {
    color: grey;
}
.button svg {
    color: grey;
}
a {
    color: <?php echo _HIVE_COLOR_; ?>;
}
.text-bugfish-primary-600 {
    color: <?php echo _HIVE_COLOR_; ?>;
}
.background-danger {
    background: red;
}
.background-warning {
    background: yellow;
    color: black;
}
.background-info {
    background: blue;
}
.background-primary {
    background: <?php echo _HIVE_COLOR_; ?>;
    color: white;
}
.bugfish-primary-color {
    color: <?php echo _HIVE_COLOR_; ?> !important;
}

@media (min-width: 768px) {
    .fix-turnout-navigation {
        display: none;
    }
}

footer#web_footer {
    position: fixed;
    bottom: 0px;
    z-index: 28;
    width: 100%;
    padding: 15px;
    padding-top: 5px;
    padding-bottom: 5px;
    text-align: center;
    font-size: 12px;
}

main {
    padding-bottom: 50px;
}

.navi-sub-item-inactive {
	color: <?php echo _HIVE_COLOR_; ?> !important;
}


.navi-sub-item-inactive {
	color: #999999 !important;
}