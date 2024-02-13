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
	*/  if(file_exists("./settings.php")) { require_once("./settings.php"); } else { @http_response_code(404); Header("Location: ./"); exit(); } 
	if(!_HIVE_MOD_CHANGES_) { hive_error_full("Access Error", "Script is deactivated in ruleset.php!", "Enable _HIVE_MOD_CHANGES_ in ruleset.php or in the _administration interface to enable this files execution!", true, 401); }
	hive__simple_start($object, "Developer Tools - FP²", '<link rel="icon" type="image/x-icon" href="'._HIVE_URL_REL_.'/_core/_image/favicon.ico">'); ?>

	<div class="containerbox">
			<img src='./_core/_image/logo_alpha.png' width='40' style="margin-right: 10px;" > <b style='font-size:36px; padding-bottom: 10px;'>Backend Tools</b><br />
			Empower your browsing experience with personalized control through our user-centric settings customization feature. Modify website settings exclusively for your sessions, ensuring that changes remain confined to your individual preferences without any impact on global configurations. These developer tools provide a comprehensive suite for inspecting various backend functionalities, facilitating a more streamlined understanding and navigation during the development process. For optimal usage, consider disabling this functionality by turning off HIVE_MOD_CHANGES in ruleset.php or utilizing an associated admin interface designed for this purpose. Your seamless browsing experience starts with tailored settings and efficient developer tools.<br />	
	</div>
	<div class="containerbox">
		<b>Operational URLs:</b><br />Explore a suite of invaluable backend tools through the following links, designed to enhance your development and optimization processes!<br /><br />
		<a href="./_core/_tools/session_destroy.php" class="containerbox-btn">Session Destroy</a> 
		<a href="./_core/_tools/cookie_destroy.php" class="containerbox-btn">Cookie Destroy</a> <br /><br /><br />
		<a href="./_core/_tools/phpinfo.php" class="containerbox-btn">PHPInfo</a> 
		<a href="./_core/_tools/admin_switch.php" class="containerbox-btn">Admin Switch</a>
		<br /><br />
	</div>
	<div class="containerbox">
        <b>Change website mode:</b><br />Tailor your browsing experience effortlessly with our website's rewriting feature. Easily redefine the landing page based on conditions such as the current browser URL or active user session. Switch seamlessly between different sites (Site Modules) using the administration backend or by configuring ruleset.php through straightforward rewriting and setup. This rewriting capability allows you to personalize your online environment according to your preferences, ensuring a customized and efficient browsing experience!<br /><br />
		<b>Current Site-Module</b>: <?php echo _HIVE_MODE_; ?><br />
		<b>Session Site-Module</b>: <?php echo @$_SESSION[_HIVE_COOKIE_."hive_mode"]; ?><br />
		<b>Default Site-Module</b>: <?php echo _HIVE_MODE_DEFAULT_; ?><br />
		<b>Available Site-Modules</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_MODE_ARRAY_)) { foreach(_HIVE_MODE_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span><br /><br />
		<?php 
			if(@is_string(@$_POST["mod_change"]) AND @in_array(@$_POST["mod_change"], @_HIVE_MODE_ARRAY_)) {
				$_SESSION[_HIVE_COOKIE_."hive_mode"] = @$_POST["mod_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="mod_change" class="containerbox-btn">
				<option value="<?php echo htmlentities($_SESSION[_HIVE_COOKIE_."hive_mode"]  ?? ''); ?>">Active: <?php echo htmlentities($_SESSION[_HIVE_COOKIE_."hive_mode"] ?? '' ); ?></option>
				<?php
					foreach(_HIVE_MODE_ARRAY_ as $key => $value) {
						echo "<option value='".@htmlspecialchars($value ?? '')."'>".@htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="containerbox-btn">Change Site</button> 		
		</form>		
		
		<br /><b>Current Site Informations</b>:<br />
		Version: <?php echo @htmlspecialchars(@$object["hive_mode"]["version"] ?? ''); ?><br />
		Build: <?php echo @htmlspecialchars(@$object["hive_mode"]["build"] ?? ''); ?><br />
		Rname: <?php echo @htmlspecialchars(@$object["hive_mode"]["rname"] ?? ''); ?><br />
		Name: <?php echo @htmlspecialchars(@$object["hive_mode"]["name"] ?? ''); ?><br />
		Short Description: <?php echo @htmlspecialchars(@$object["hive_mode"]["short"] ?? ''); ?><br />
	</div>
	<div class="containerbox">
		<b>Change website language:</b><br />Customize your language preferences effortlessly on our website. Explore available languages configured within the current activated site modules configuration files. Take control of your linguistic experience, ensuring seamless navigation in a language that suits your preferences. Switch between languages with ease, making your interaction with the website a personalized and user-friendly journey. This functionality is available, if the current loaded site module has different languages enabled.<br /><br />
		<b>Current Language</b>: <?php echo htmlspecialchars(_HIVE_LANG_ ?? ''); ?><br />
		<b>Session Language</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?><br />
		<b>Default Language</b>: <?php echo htmlspecialchars(_HIVE_LANG_DEFAULT_ ?? ''); ?><br />
		<b>Available Languages</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_LANG_ARRAY_)) { foreach(_HIVE_LANG_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span>
		<br />
		<?php 
			if(@is_string(@$_POST["lang_change"]) AND @in_array(@$_POST["lang_change"], @_HIVE_LANG_ARRAY_)) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = @$_POST["lang_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="lang_change" class="containerbox-btn">
				<option value="<?php echo htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?>">Active: <?php echo htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] ?? ''); ?></option>
				<?php
					foreach(_HIVE_LANG_ARRAY_ as $key => $value) {
						echo "<option value='".htmlspecialchars($value ?? '')."'>".htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="containerbox-btn">Change Language</button>
		</form>		
	</div>
	<div class="containerbox">
		<b>Change website theme:</b><br />Elevate your visual experience by selecting a theme that resonates with your style on our website. Explore the array of available themes configured within the current activated site modules configuration files. Tailor the website's appearance to match your preferences, with the flexibility to seamlessly switch between different themes. Immerse yourself in a personalized and visually appealing online environment, where your chosen theme enhances the overall aesthetic and usability of the site! This functionality is available, if the current loaded site module has different themes enabled.<br /><br />
		<b>Current Theme</b>: <?php echo htmlspecialchars(_HIVE_THEME_ ?? ''); ?><br />
		<b>Session Theme</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] ?? ''); ?><br />
		<b>Default Theme</b>: <?php echo htmlspecialchars(_HIVE_THEME_DEFAULT_ ?? ''); ?><br />
		<b>Available Themes</b>: <span style='word-break: break-all;'><?php if(is_array(@_HIVE_THEME_ARRAY_)) { foreach(_HIVE_THEME_ARRAY_ as $key => $value) { if($key != 0) {echo ", ";} echo htmlspecialchars($value ?? '');  } }?></span>	
		<br />
		<?php 
			if(@is_string(@$_POST["thm_change"]) AND @in_array(@$_POST["thm_change"], @_HIVE_THEME_ARRAY_)) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = @$_POST["thm_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<select name="thm_change" class="containerbox-btn">
			<option value="<?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"]); ?>">Active: <?php echo @htmlentities(@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] ?? ''); ?></option>
				<?php
					foreach(_HIVE_THEME_ARRAY_ as $key => $value) {
						echo "<option value='".htmlspecialchars($value ?? '')."'>".htmlspecialchars($value ?? '')."</option>";
					}
				?>
			</select>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="containerbox-btn">Change Theme</button> 
		</form>
	</div>		
	<div class="containerbox">
		<b>Change website color:</b><br />Immerse yourself in a vibrant online experience by customizing the website's color palette dynamically. Explore a spectrum of colors available within the current activated site modules configuration files, extending beyond predefined options. Your color choices are not restricted, allowing for limitless personalization. Transform the visual aesthetics of the website effortlessly, adapting to your mood and preferences. Embrace the freedom to infuse your online journey with a burst of color that resonates with your unique style and enhances the dynamic themes at your fingertips! This functionality is available, if the current loaded site module has dynamic theme colors enabled.<br /><br />
		<b>Current Color</b>: <?php echo htmlspecialchars(_HIVE_COLOR_ ?? ''); ?><br />
		<b>Session Color</b>: <?php echo htmlspecialchars(@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] ?? ''); ?><br />	
		<b>Default Color</b>: <?php echo htmlspecialchars(_HIVE_THEME_COLOR_DEFAULT_ ?? ''); ?><br />		
		<br />
		<?php 
			if(@is_string(@$_POST["ctsd_change"])) {
				@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = @$_POST["ctsd_change"];
				echo "<script>window.location.href = window.location.href;</script>";
			}
		?>
		<form method="post">
			<input type="color" name="ctsd_change" value='<?php echo htmlspecialchars(_HIVE_COLOR_ ?? ''); ?>'>
			<input type="hidden" name="update_start" value="set">
			<button type="submit" class="containerbox-btn">Change Theme Color</button> 
		</form>
	</div>
			

<?php
hive__simple_end($object, _HIVE_CREATOR_); ?>
	