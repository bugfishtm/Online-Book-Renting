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
	*/ if(file_exists("./settings.php")) { require_once("./settings.php"); } else { @http_response_code(404); Header("Location: ./"); exit(); }
	
	////////////////////////////////////////////////////////////////////////////////////
	// Updater Script to deploy site module updates if build number has been increased.
	// File may gets updated during core updates.
	////////////////////////////////////////////////////////////////////////////////////
	
	$version = explode('.', PHP_VERSION);
	if($version[0] <= 7) {  
		hive_error_full("Critical Error", "This software does need at least PHP8.X to run properly!", "Your system is running PHP ".$version[0].", which is NOT supported!", true, 503);		
	}		
	unset($version);
		
	if(defined("_HIVE_RNAME_") AND defined("_HIVE_BUILD_ACTIVE_") AND defined("_HIVE_RNAME_ACTIVE_")) {
		if(_HIVE_RNAME_ != _HIVE_RNAME_ACTIVE_ OR _HIVE_RNAME_ == 0) { 
			hive_error_full("Wrong Site Module", "The site module used seems to have been replaced with another site module on the same location! Please restore the old site module and execute your operations on the administrator module!", "This is a critical error which should been taken care of!", true, 401); }
		// Show Update Notification
		if(_HIVE_BUILD_ == _HIVE_BUILD_ACTIVE_ ) { 
			hive_error_full("No Update Required", "This software is already updated!", "Click <a href='./'>here</a> to go back!", true, 401); }	
		// Show Update Notification
		if(_HIVE_BUILD_ < _HIVE_BUILD_ACTIVE_ ) { 
			hive_error_full("Not supported", "You are trying to downgrade this module!", "This is not supported by this updater functionality...", true, 401); }	
	} else {
		hive_error_full("Updater Error", "Important information missing to execute site module update!", "This mostly happens if the site module has not been initialized by a one time visit of the modules page.", true, 401);
	}
	
	if(!@is_numeric(@$_SESSION["hive_installer_block"])) { $_SESSION["hive_installer_block"] = 0; }
	if(@$_SESSION["hive_installer_block"] > 100 AND _UPDATER_CODE_ != false AND _UPDATER_CODE_ != "") { 
		hive_error_full("Temporary Banned", "Too many wrong installation passwords!", "You have been temporarly blocked from this page!<br />Try again later and check to provide the real updater code.", true, 401);}
	hive__simple_start($object, "Updater - ".@htmlspecialchars(_HIVE_TITLE_ ?? ''), '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/favicon.ico">'); ?>
    <div class="containerbox">
		<img src='./_core/_image/logo_alpha_color.png' width='40' style="margin-right: 10px;" > <b style='font-size:36px; padding-bottom: 10px;'><?php echo @htmlspecialchars(_HIVE_TITLE_ ?? ''); ?> Updater</b>
        <p><b>You are going to update this website!</b><br />This updater is mandatory to install database updates and more via php scripts! More informations about this updater can be found in this CMS Documentation.</p>   
			<?php $checkx = false; if(@_UPDATER_CODE_ == @$_POST["installer_code"]) { $checkx = true; } if(@_UPDATER_CODE_ != @$_POST["installer_code"] AND isset($_POST["installer_code"])) {
			$_SESSION["hive_installer_block"] = $_SESSION["hive_installer_block"] + 1; }if(@$_POST["update_start"] != "set" OR !$checkx) { ?>
			<p><b>Site Module</b>: <?php echo htmlspecialchars(_HIVE_MODE_ ?? ''); ?><br />
			<b>Site RName</b>: <?php echo htmlspecialchars(_HIVE_RNAME_ ?? ''); ?><br />
			<b>Active Build</b>: <?php echo htmlspecialchars(_HIVE_BUILD_ACTIVE_ ?? ''); ?><br />
			<b>Target Build</b>: <?php echo htmlspecialchars(_HIVE_BUILD_ ?? ''); ?><br />
			<b>Current Module Version</b>: <?php echo htmlspecialchars(_HIVE_VERSION_ ?? ''); ?><br /><br />
			<?php
				$ar = array();
				foreach (glob("./_site/"._HIVE_MODE_."/_update/*.php") as $filename) {
					if(basename($filename) == "README.md") { continue; }
					if(basename($filename) == "readme.md") { continue; }
					if(basename($filename) == "index.php") { continue; }
					if(basename($filename) == ".htaccess") { continue; }
					if(!is_numeric(substr(basename($filename), 0, -4))) { continue; }
					array_push($ar, basename($filename));
				} natsort($ar); 
				$x = false;			$cas = 0;
				foreach ($ar as $key => $filename) {
					$cas = $cas  + 1;
					if(substr($filename, 0, -4) > _HIVE_BUILD_ACTIVE_ AND substr($filename, 0, -4) <= _HIVE_BUILD_) { 
						if($x == 0) { echo "<b>Available Update Files</b>:<br />".$cas.". Build ".htmlspecialchars(substr($filename, 0, -4) ?? '')." (<b>Next Update</b>)"; $x = true; }
						else { echo "<br />".$cas.". Build ".htmlspecialchars(substr($filename, 0, -4) ?? '')." (Waiting)";  }				
					}	
				} 
				?> </p><form method="post">			
				<?php if(_UPDATER_CODE_ != false AND _UPDATER_CODE_ != "") { ?>
					<b>Updater Code:</b><br />
					Please enter Security Code to start Update!<br />
					You can find the security Code in /_site/<?php echo _HIVE_MODE_; ?>/config.php						
				<?php if(@!$checkx) { echo "<p><font color='red'>Please provide a valid security code!</font></p>"; } ?>			
					<input type="text" placeholder="updater_code" name="installer_code"><br /><br />		
				<?php } ?>
				<input type="hidden" name="update_start" value="set">
				<button type="submit" class="containerbox-btn">Start Update</button>
			</form>
		<?php } else { 
			$ar = array();
				foreach (glob("./_site/"._HIVE_MODE_."/_update/*.php") as $filename) {
					if(basename($filename) == "README.md") { continue; }
					if(basename($filename) == "readme.md") { continue; }
					if(basename($filename) == "index.php") { continue; }
					if(basename($filename) == ".htaccess") { continue; }
					if(!is_numeric(substr(basename($filename), 0, -4))) { continue; }
					array_push($ar, basename($filename));
				} natsort($ar); 
				$x = false;
				$y = false;
				foreach ($ar as $key => $filename) {
					if(substr($filename, 0, -4) > _HIVE_BUILD_ACTIVE_ AND substr($filename, 0, -4) <= _HIVE_BUILD_) { 
						$x = true; $y = substr($filename, 0, -4); 
						break;
					}								
				}						
				echo "<p><b><font color='lime'>OK: </font>Installing Build: ".htmlspecialchars($y ?? '')."</b><br />";
				if(!$x) { $y = _HIVE_BUILD_; }			
				$object["var"]->set("_HIVE_BUILD_ACTIVE_", htmlspecialchars($y ?? ''));		
				if(file_exists("./_site/"._HIVE_MODE_."/_update/".htmlspecialchars($y ?? '').".php") AND $x) { require_once("./_site/"._HIVE_MODE_."/_update/".htmlspecialchars($y ?? '').".php"); }			
				echo "<font color='lime'>OK: </font>Build Number has been changed to ".htmlspecialchars($y ?? '')."!";
				echo "<br /><b><font color='lime'>OK: </font>Build Installed!</b></p>";
			?> <form method="post">							
				<button type="submit" class="containerbox-btn">Finish Update</button> 
			</form>
		<?php } ?>
    </div>
<?php hive__simple_end($object, _HIVE_CREATOR_); ?>