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
	*/ # No Installation Needed
	if(file_exists("./settings.php")) { require_once("./settings.php"); hive_error_full("No Installation Required", "Click <a href='./'>here</a> to go back...", "We found a valid settings.php file, which means that this software is already installed!<br /> Tp re-install this software delete the settings.php file in the document root directory.", true, 401);  exit(); } 
	$object = array(); require_once("./_core/_lib/lib.hive.php");  
	$object = array(); require_once("./_core/_lib/lib.__installer.php");  
	$object = array(); require_once("./_core/_lib/lib._simple.php");  
	define("_HIVE_COLOR_", "#ff5707");
	// Start Session
	session_start();
	// Blcok User if Needed
	if(@$_SESSION["hive_installer_block"] > 100  AND _INSTALLER_CODE_ != false AND _INSTALLER_CODE_ != "") { 
		hive_error_full("Temporary Banned", "Too many wrong installation passwords!", "You have been temporarly blocked from this page!<br />Try again later and check to provide the real installation code.", true, 401);}
	// Installation Start and Fetch
	$erroremptyr = false;
	$erroremptyu = false;
	$erroremptyd = false;
	$erroremptyrcced = false;
	$do = false;
	$con = false; 
	$coner = false;
	if(!@is_numeric(@$_SESSION["hive_installer_block"])) { $_SESSION["hive_installer_block"] = 0; }
	if(isset($_POST["mysql_host"])) { 
		if(@$_SESSION["csrf_hive_installer"] == @$_POST["csrf"]) { 
				if(@_INSTALLER_CODE_ == @$_POST["installer_code"] OR @_INSTALLER_CODE_ == false OR @_INSTALLER_CODE_ == "") { 
					$do = true;
					if(@trim(@$_POST["website_url"] ?? '') == "") {  $erroremptyu = true; $do = false;}
					if(@trim(@$_POST["website_cookie"] ?? '') == "") {  $erroremptyux = true; $do = false;}
					if(@trim(@$_POST["website_prefix"] ?? '') == "") {  $erroremptyuy = true; $do = false;}
					if(!file_exists(@$_POST["doc_root"]."_core/_misc/ynvnzmlzaa.php")) { $erroremptyr = true; $do = false;}
					if(@trim(@$_POST["mysql_db"] ?? '') == "") {  $erroremptyd = true; $do = false;}
					if(!is_numeric(@$_POST["mysql_port"])) { $_POST["mysql_port"] = 3306; }
					if(@trim(@$_POST["mysql_host"] ?? '') == "") { $_POST["mysql_host"] = "localhost"; }
					try { $mysqli = @new mysqli(@$_POST["mysql_host"], $_POST["mysql_user"], $_POST["mysql_pass"], $_POST["mysql_db"], $_POST["mysql_port"]);  
						if ($mysqli->connect_errno) {
							$coner = "Connection Error: ".$mysqli->connect_error;
						}		
						/* check if server is alive */
						if ($mysqli->ping()) {
							$con = true;
						} else {
							$coner .= " | Ping Error: ".$mysqli->error;
						}			
					} catch (\Throwable $e) {
						$coner = $e->getMessage();
					}	
				} else { $erroremptyrcced = true; $_SESSION["hive_installer_block"] = $_SESSION["hive_installer_block"] + 1; }	
		} else { $csrf = "<div class='containererror'><b>CSRF Form Protection Error</b><br /> Please Try Again, the form you have executed is expired.</div><br />"; }	
	}	
	$_SESSION["csrf_hive_installer"] = mt_rand(1000000, 9999999);
	hive__simple_start($object, "Installation - FP²", '<link rel="icon" type="image/x-icon" href="./_core/_image/favicon.ico">');
	if(!$do OR $erroremptyr OR $erroremptyu OR $erroremptyd OR !$con OR $coner OR @$erroremptyrcced) {?>
	<div class="containerbox">
		<img src='./_core/_image/logo_alpha.png' width='40' style="margin-right: 10px;" > <b style='font-size:36px; padding-bottom: 10px;'>Installation</b>
		<small><br />Welcome to the website installer script! This script aims to simplify the setup process by generating a 'settings.php' file for your website's root folder. Should the 'settings.php' file be absent, this installer will assist in configuring MySQL data and prefixes necessary for your website's functionality.<br><br>

Enter your MySQL database credentials and desired database prefix in the provided form. For additional email functionalities, manual setup within 'settings.php' or through the administration interface can be undertaken post-installation.</small>
		<br /><br />	
		<form method="post">
		<input type="hidden" name="csrf" value="<?php echo $_SESSION["csrf_hive_installer"]; ?>">
		<?php if(_INSTALLER_CODE_ != false AND _INSTALLER_CODE_ != "") { ?>
		<b>Installation Code</b>:<br /><small>Provide Installation Code to install this software!<br /> You can find the installer code in /_core/_lib/lib.__installer.php!</small><br />
		<?php if(@$erroremptyrcced) { echo "<b><div class='containererror'>Please provide a valid installer code!</div></b>"; } ?>
		<input type="text" name="installer_code"  placeholder="Installer Code" value="<?php if(!is_string(@$_POST["installer_code"])) { echo ""; } else { echo htmlentities(@$_POST["installer_code"] ?? '');} ?>"> <br />
		<br />
		<?php }?>
		<?php echo @$csrf; if($coner) { echo "<b><div class='containererror'>MySQL Error</b>: ".$coner."</div><br />"; } ?>
		<b>MySQL Hostname</b>:<br /><small>The hostname of the MySQL Server you want to connect to.</small><br />
		<input type="text" name="mysql_host"  placeholder="MySQL Host" value="<?php if(!is_string(@$_POST["mysql_host"])) { echo "localhost"; } else { echo htmlentities(@$_POST["mysql_host"] ?? '');} ?>"> <br />
		<br />
		<b>MySQL Port</b>:<br /><small>The port of the MySQL Server you want to connect to.</small><br />
		<input type="number" name="mysql_port" placeholder="MySQL Port" value="<?php if(!is_numeric(@$_POST["mysql_port"])) { echo "3306"; } else { echo htmlentities(@$_POST["mysql_port"] ?? '');} ?>"> <br />
		<br />
		<b>MySQL Username</b>:<br /><small>The username to connect to the MySQL Instance</small><br />
		<input type="text" name="mysql_user" placeholder="MySQL Username" value="<?php if(!is_string(@$_POST["mysql_user"])) { echo "root"; } else { echo htmlentities(@$_POST["mysql_user"] ?? '');} ?>"> <br />
		<br />
		<b>MySQL Password</b>:<br /> <small>The password to connect to the MySQL Instance</small><br />
		<input type="password" name="mysql_pass" placeholder="*****" > <br />
		<br />
		<b>MySQL Database</b>:<br /><small>The name of the MySQL Database you want to connect to.</small><br />
			<?php if($erroremptyd) { echo "<b><div class='containererror'>Invalid database name!</div></b>"; } ?>
		<input type="text" name="mysql_db" placeholder="Database Name" value="<?php if(!is_string(@$_POST["mysql_db"])) { echo ""; } else { echo htmlentities(@$_POST["mysql_db"] ?? '');} ?>"> <br />
		<br />
		<b>Document Root</b>:<br /><small>Document Root Folder where this website is located on your webspace. This will be auto-determined, you do not need to change this, as the default setting should be correct! Please add a trailing slash if not existant!</small><br />
		<?php if($erroremptyr) { echo "<b><div class='containererror'>Please provide a valid document root!</div></b>"; } ?>
		<input type="text" name="doc_root" value="<?php if(!is_string(@$_POST["doc_root"])) { echo substr(dirname(__FILE__), 0)."/"; } else { echo htmlentities(@$_POST["doc_root"] ?? '');} ?>"> <br />
		<br />						
		<b>Website URL</b>:<br /><small> Enter the Website URL it will be reachable online. Enter the URL Name with http/https at the start. System will determine protocol automatically. If this website is installed in a subfolder, do add this subfolder into this domain as well. Please add a trailing slash if not existant!</small><br />
		<?php if($erroremptyu) { echo "<b><div class='containererror'>Please enter the public URL, where this page will run on!</div></b>"; } 
		
		if (isset($_SERVER['HTTPS']) &&
			($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
			isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
			$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
		  $protocol = 'https://';
		}
		else {
		  $protocol = 'http://';
		}
		?>
		<input type="text" name="website_url" value="<?php if(!is_string(@$_POST["website_url"])) { 
			if(@strlen(@dirname(@trim(@$_SERVER["REQUEST_URI"] ?? ''))) > 2) { 
				echo $protocol.$_SERVER["HTTP_HOST"]."".@dirname(@$_SERVER["REQUEST_URI"])."/"; 
			} else {
				echo $protocol. $_SERVER["HTTP_HOST"]."/"; 
			}
		} else { echo htmlentities(@$_POST["website_url"] ?? '');} ?>"> <br />
		<br />
		<b>Cookie Prefix</b>:<br /><small> Cookie Prefix, does not need to be changed.</small><br />
		<?php if(@$erroremptyux) { echo "<b><div class='containererror'>Please enter a valid Cookie Prefix!</div></b>"; } ?>
		<input type="text" name="website_cookie" value="<?php if(!is_string(@$_POST["website_cookie"])) {  echo _INSTALLER_COOKIE_;} else { echo htmlentities(@$_POST["website_cookie"] ?? '');} ?>"> <br />
		<br />
		<b>Table Prefix</b>:<br /><small> MySQL Tables Prefix, does not need to be changed.</small><br />
		<?php if(@$erroremptyuy) { echo "<b><div class='containererror'>Please enter a valid Table Prefix!</div></b>"; } ?>				
		<input type="text" name="website_prefix" value="<?php if(!is_string(@$_POST["website_prefix"])) { echo _INSTALLER_PREFIX_; } else { echo htmlentities(@$_POST["website_prefix"] ?? '');} ?>"> <br />			
		<button type="submit" class="containerbox-btn">Start Installation</button>			 
	</div>
	<?php hive__simple_end($object, 'Powered by <a href="https://github.com/bugfishtm" rel="noopener" target="_blank" style="color: yellow!important;">Bugfish</a> Fast-PHP Framework!'); ?>
	<?php } else { ?>
	<div class="containerbox">
		<img src='./_core/_image/logo_alpha.png' width='40' style="margin-right: 10px;" > <b style='font-size:36px; padding-bottom: 10px;'>Installation</b><br />
		<small>Congratulations! The installation is complete. You can now explore your website. In case of any errors, simply delete the 'settings.php' file to initiate a fresh software installation. Enjoy using your new website!</small>
		<br ><br >
		<?php
if(!file_exists("./settings.php")) {
	$_POST["website_url"] = rtrim($_POST["website_url"], '/');
	if(file_put_contents( "./settings.php", "<?php
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
	/* Generated Settings.php File by Installer at ".date("Y-m-d H:i")." */
	
	/* Generated MySQL Settings */
	\$mysql['host'] = '".str_replace("'", "\\'",str_replace("\\", "\\\\", $_POST["mysql_host"]))."'; # MySQL Hostname
	\$mysql['port'] = '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["mysql_port"]))."'; # Mysql Port
	\$mysql['user'] = '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["mysql_user"]))."'; # MySQL User
	\$mysql['pass'] = '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["mysql_pass"]))."'; # MySQL Pass
	\$mysql['db'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["mysql_db"]))."'; # MySQL Database
	\$mysql['prefix'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["website_prefix"]))."'; # MySQL Prefix
	
	/* Generated Site Settings */
	\$object['cookie'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["website_cookie"]))."'; # Cookie Prefix
	\$object['path'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["doc_root"]))."'; # Full Path
	\$object['url'] 	= '".str_replace("'", "\\'",str_replace("\\", "\\\\",$_POST["website_url"]))."'; # Full URL
	
	/* Mail Settings - Can also be defined in Sites Module (Setting will be overwritten by Site Module Setting) */
	\$smtp['_SMTP_HOST_'] 			= 'localhost';  # Mail Host Server
	\$smtp['_SMTP_PORT_'] 			= '465';  # Mail Server Port
	\$smtp['_SMTP_AUTH_'] 			= 'ssl';  # can be ssl/tls/false
	\$smtp['_SMTP_USER_'] 			= '_______ENTER___MAIL___USERNAME____'; # Username to Login (can be false)
	\$smtp['_SMTP_PASS_'] 			= '_______ENTER___MAIL___PASSWORD____'; # Password to Login (can be false)
	
	/* Do not change below! */
	require_once(\$object['path'].\"/_core/init.php\");
	")) {
		echo "<p><font color='lime'>OK: </font>Validating Configuration Variables<br />";
		echo "<font color='lime'>OK: </font>Creating Settings.php File<br />";
		echo "<font color='lime'>OK: </font>Installation complete!</p>";
	} else {  echo "<p><font color='red'>Error: </font> File settings.php could not be created, this may be a permission error.</p>"; }
} else { echo "<p><font color='red'>Error: </font> File settings.php already exists!</p>"; }
	?>
							
		<br /><a type="submit" class="containerbox-btn" href="./">Finish Installation</a>	<br />	<br />					
	</div>
	<?php hive__simple_end($object, 'Powered by <a href="https://github.com/bugfishtm" rel="noopener" target="_blank" style="color: yellow!important;">Bugfish</a> Fast-PHP Framework!'); ?>
<?php } ?>