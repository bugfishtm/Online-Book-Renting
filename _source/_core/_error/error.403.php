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
	*/		function hive_error_full_out($title, $subtitle, $description, $exit, $code) { 
			if(is_numeric($code)) { @http_response_code($code); }?><!DOCTYPE html><html lang="en"><head><?php if(defined("_HIVE_URL_REL_")) { ?> <link rel="icon" type="image/x-icon" href="<?php echo _HIVE_URL_REL_; ?>/_core/_image/favicon.ico"> <?php } ?>
			<title><?php echo $title; ?><?php if(defined("_HIVE_TITLE_SPACER_")) { echo _HIVE_TITLE_SPACER_; } else { echo " - "; } ?><?php if(defined("_HIVE_TITLE_")) { echo _HIVE_TITLE_; } else { echo "CMS"; } ?></title><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="robots" content="noindex, nofollow"><style>
			body {
				background-color: #080808;
				padding: 0 0 0 0 0;
				margin: 0 0 0 0;
				color: #ffffff;
				font-family: 'Courier New', Courier, monospace;
				margin: 0;
				padding: 20px;
				box-sizing: border-box;
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				min-height: 100vh;
				overflow-x: hidden;
			}
			h1 {
				font-size: 2em;
				padding-top: 0px;
				margin-top: 0px;
				margin-bottom: 20px;
			}
			p {
				font-size: 1.2em;
				line-height: 1.6;
				margin-bottom: 30px;
			}
			button {
				padding: 10px 20px;
				font-size: 1em;
				background-color: #FF5707;
				color: #ffffff;
				border: none;
				border-radius: 5px;
				cursor: pointer;
				transition: background-color 0.3s;
			}
			button:hover { background-color: #ff814a; }
			.debugging_box {
				background: #121212;
				width: 100vw;
				padding: 25px;
				padding-bottom: 0px;
				box-sizing: border-box;
			}
			.debugging_box_inner {
				max-width: 100%;
				width: 500px;
				margin: auto;
			}
			a { color: #FF5707;	}
			@media screen and (max-width: 600px) {
				h1 { font-size: 1.5em; }
				p { font-size: 1em;	}
			}
		</style></head><body><div class="debugging_box"><div class="debugging_box_inner" ><h1><?php echo $title; ?></h1><p><?php echo $subtitle; ?> <?php echo $description; ?></p></div></div></body></html><?php if($exit) { exit(); } }
		hive_error_full_out("Error 403", "Forbidden", "", true, 403);