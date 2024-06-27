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
		
	*/ if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { @http_response_code(404); Header("Location: ../"); exit(); } 
	
	if(!_HIVE_ALLOW_ADMIN_) { hive_error_full("Access Error", "Shadow Backend is deactivated in ruleset.php!", "Enable _HIVE_ALLOW_ADMIN_ in ruleset.php or in any module with this functionality to enable this files execution!", true, 401); } 
	?>
	<html>
		<head>
		  <link rel="icon" type="image/x-icon" href="../_image/favicon.ico">
		  <title>Switch Session - CMS</title>
		  <meta charset="UTF-8">
		  <style>
			body {
			  background-color: #111;
			  color: #fff;
			  font-family: Arial, sans-serif;
			  height: 100vh;
			  margin: 0;
			}
			
			#countdown-box_out {
			  padding: 20px;
			  display: flex;
			  align-items: center;
			  justify-content: center;
				
			}
			
			#countdown-box {
			  background-color: #222;
			  color: #fff;
			  padding: 15px;
			  border-radius: 8px;
			  text-align: center;
			  max-width: 600px;
			}
			p {
			  font-size: 14px;
			  margin: 0;
			}
			a {
				color: yellow;
				text-decoration: none;
			}
			
			input[type=submit]:hover {
				background: white !important;
				color: black !important;
			}
		  </style>
		</head>
		<body>
		  <div id="countdown-box_out">
			  <div id="countdown-box">
				<img src="../_image/logo_alpha_color.png" width="100">
				<?php if(@$_SESSION[_HIVE_COOKIE_."hive_mode"] == _HIVE_ADMIN_SITE_) { $is_admin = true; } else { $is_admin = false; } ?>
				<p>You are currently <?php if(@$_SESSION[_HIVE_COOKIE_."hive_mode"] != _HIVE_ADMIN_SITE_) { echo "<b>NOT</b>"; } ?> in Administrator Mode!<br />If you came here by mistake you can leave <a href="../../">here</a>.</p>
				<?php if($is_admin) { 
					if(@$_GET["adm_change_access"]) {
						@$_SESSION[_HIVE_COOKIE_."hive_mode"] = @$_SESSION[_HIVE_COOKIE_."hive_mode_last"];
						@http_response_code(404); Header("Location: ../../"); exit();
					} ?>
					<br />
					<small>You can go back to: 
					<?php 
						if(@trim(@$_SESSION[_HIVE_COOKIE_."hive_mode_last"] ?? '') == "") { $newmode = _HIVE_MODE_DEFAULT_; } else { $newmode = @$_SESSION[_HIVE_COOKIE_."hive_mode_last"]; }
						echo "<b>".@htmlspecialchars($newmode ?? '')."</b>"; ?></small><br />
					<form method="get">
						<input type="submit" value="Frontend Mode" name="adm_change_access" style="font-weight: bold;border: none; background:#3b3b3b; color: white; padding: 15px; cursor: pointer; border-radius: 5px;">
					</form>
				<?php } else { 
					if(@$_GET["adm_change_access"]) {
						@$_SESSION[_HIVE_COOKIE_."hive_mode_last"] = @$_SESSION[_HIVE_COOKIE_."hive_mode"];
						@$_SESSION[_HIVE_COOKIE_."hive_mode"] = _HIVE_ADMIN_SITE_;
						@http_response_code(404); Header("Location: ../../"); exit();					
					}
					?>
					<br />
					<form method="get">
						<small>Click here for:</small><br /><input type="submit" value="Administrator Mode" name="adm_change_access"  style=" font-weight: bold;border: none; background:#3b3b3b; color: white; padding: 15px; cursor: pointer; border-radius: 5px;"><br /><small>[<?php echo @htmlspecialchars(_HIVE_ADMIN_SITE_ ?? ''); ?>]</small>
					</form>
				<?php } ?>
			  </div>
		  </div>
		</body>
	</html>	
	<?php exit();