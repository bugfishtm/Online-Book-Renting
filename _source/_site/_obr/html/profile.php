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
	*/	
	if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); } 
	
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);
	if(!hive__access($object, "admin_user", false) AND $object["user"]->user["user_initial"] != 1) {
		if($object["user"]->user_id != @$_GET["id"] AND isset($_GET["id"])) {
			define("_INT_SHOW_ACCESS_", "true");
		} 
	} 
	
	if(!defined("_INT_SHOW_ACCESS_")) {
		$found = false;
		if(is_numeric(@$_GET["id"])) {
			$x = $object["user"]->get(@$_GET["id"]);
			if(is_array($x)) { $found = true; }
		} else {
			$x = $object["user"]->get($object["user"]->user_id);
			if(is_array($x)) { $found = true; }
		}
		if($found) {
			
			if((hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) AND $x["user_initial"] == 0) { 
				// Delete Operation
				if(is_numeric(@$_POST["form_id_dgroup"])) {
					if($object["csrf"]->check($_POST["form_csrf"])) {				
					if(@$_GET["confirm"] != "confirmed") { 
				?>
				<script>
					Swal.fire({
					  title: "<?php echo $object["lang"]->translate("be_puser_chdele"); ?>",
					  html: "<form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$_GET["id"]."&confirm=confirmed"; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><input type='hidden' name='form_id_dgroup' value='<?php echo @$_POST["form_id_dgroup"]; ?>'><input type='submit' class=\"flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-primary-bugfish border border-transparent xfpe_floatleft  xfpe_cursorpointer xfpe_marginbottom5px xfpe_marginright10px rounded-lg active:bg-primary-bugfish hover:bg-primary-bugfish focus:outline-none focus:shadow-primary-bugfish force-white-focus \" style=\"background: red;color: white;\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>",
					  showCancelButton: false,
					  showCloseButton: true,
					  showConfirmButton: false
					});
				</script>
				<?php 
			} else { 		
						$object["mysql"]->query("DELETE FROM "._TABLE_USER_." WHERE id = '".@$_POST["form_id_dgroup"]."'");
						$object["mysql"]->query("DELETE FROM "._TABLE_USER_GROUP_LINK_." WHERE fk_user = '".@$_POST["form_id_dgroup"]."'");
						$object["mysql"]->query("DELETE FROM "._TABLE_USER_PERM_." WHERE ref = '".@$_POST["form_id_dgroup"]."'");
						$object["log"]->info("[DELETION] [TABLE] "._TABLE_USER_." [ID] ".@$_POST["form_id_dgroup"]." [UID] ".$object["user"]->user_id."", "user_user");
						$object["eventbox"]->ok($object["lang"]->translate("be_op_usr_12")); 
						echo "<script>window.location.href=window.location.href;</script>";
			}
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); }
				} @$x = $object["user"]->get($x["id"]);
			}
			
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				// Block / Activate User
				if(@$_GET["user_block"] == "true") {
					if(@$object["csrf"]->check(@$_GET["token"])) {
						$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_blocked = 1 WHERE id = '".$x["id"]."'");
						$object["eventbox"]->info($object["lang"]->translate("be_op_usr_7"));
						$object["eventbox"]->skip();
						echo "<script>window.location.href= '".hive__url(array("user", "profile", false))."&id=".$x["id"]."';</script>";
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 
				} $x = $object["user"]->get($x["id"]);
				
				if(@$_GET["user_deblock"] == "true") {
					if(@$object["csrf"]->check(@$_GET["token"])) {
						$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_blocked = 0 WHERE id = '".$x["id"]."'");
						$object["eventbox"]->info($object["lang"]->translate("be_op_usr_8"));
						$object["eventbox"]->skip();
						echo "<script>window.location.href= '".hive__url(array("user", "profile", false))."&id=".$x["id"]."';</script>";
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 
				} $x = $object["user"]->get($x["id"]);
				
				// Disable / Activate User
				if(@$_GET["user_disable"] == "true") {
					if(@$object["csrf"]->check(@$_GET["token"])) {
						$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_disabled = 1 WHERE id = '".$x["id"]."'");
						$object["eventbox"]->info($object["lang"]->translate("be_op_usr_9"));
						$object["eventbox"]->skip();
						echo "<script>window.location.href= '".hive__url(array("user", "profile", false))."&id=".$x["id"]."';</script>";
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 
				} $x = $object["user"]->get($x["id"]);
				
				if(@$_GET["user_enable"] == "true") {
					if(@$object["csrf"]->check(@$_GET["token"])) {
						$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_disabled = 0 WHERE id = '".$x["id"]."'");
						$object["eventbox"]->info($object["lang"]->translate("be_op_usr_10"));
						$object["eventbox"]->skip();
						echo "<script>window.location.href= '".hive__url(array("user", "profile", false))."&id=".$x["id"]."';</script>";
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 
				} $x = $object["user"]->get($x["id"]);				
				
				if(@$_GET["user_confirmed"] == "true") {
					if(@$object["csrf"]->check(@$_GET["token"])) {
						$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_confirmed = 1 WHERE id = '".$x["id"]."'");
						$object["eventbox"]->info($object["lang"]->translate("be_op_usr_11"));
						$object["eventbox"]->skip();
						echo "<script>window.location.href= '".hive__url(array("user", "profile", false))."&id=".$x["id"]."';</script>";
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 
				} $x = $object["user"]->get($x["id"]);
			}			
			
			// Permission Change
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				if(@$_POST["perm_change"] == "1") {
					if(@$object["csrf"]->check(@$_POST["form_token"])) {
						// Add Rights
						$object["perm_user"]->clear_perms($x["id"]);
						if(is_array(@$_POST["multiselectsortable_value_right"])) {
							foreach($_POST["multiselectsortable_value_right"] AS $key => $value) {
								$isin = false;
								if(is_array($object["set"]["permission"])){
									foreach($object["set"]["permission"] AS $keyx => $valuex) {
										if($valuex[0] == $value) { $isin = true; }
									}
								}								
								if($isin) {
									$object["perm_user"]->add_perm($x["id"], $value);
								}
							}
						}						
						$object["eventbox"]->info($object["lang"]->translate("be_op_usr_6")); 
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 
				} @$x = $object["user"]->get($x["id"]); 
			}
					
			// Password Set
			if(@$_POST["pw_change"] == "1") {
				if(@$object["csrf"]->check(@$_POST["form_token"])) {
					if(@$_POST["pass1"] == @$_POST["pass2"]) {
						if(@trim(@$_POST["pass1"]) != "") {
							if($object["user"]->passfilter_check(@$_POST["pass1"])) {
								$object["user"]->change_pass($x["id"], @$_POST["pass1"]);
								$object["eventbox"]->ok($object["lang"]->translate("be_op_usr_4")); 
							} else { $object["eventbox"]->error($object["lang"]->translate("be_op_usr_1")); } 
						} else { $object["eventbox"]->error($object["lang"]->translate("be_op_usr_2")); } 
					} else { $object["eventbox"]->error($object["lang"]->translate("be_op_usr_3")); } 
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 
			} $x = $object["user"]->get($x["id"]);									
			
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";

			// Mail Change Request Information
			if(is_string($x["user_shadow"]) AND trim($x["user_shadow"] !=  "")) { 
				echo hive__volt_alert_warning($object["lang"]->translate("be_puser_chdele12")." '".htmlspecialchars($x["user_shadow"] ?? '')."'!<br /><a href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&abort_shadow=true&token=".$object["csrf"]->get()."'>".$object["lang"]->translate("be_puser_chdele13")."</a>");}			
			
			
			
			// User Superuser Message
			if($x["id"] != $object["user"]->user_id) { echo hive__volt_alert_warning($object["lang"]->translate("be_puser_chdele11")); }				

			// User Superuser Message
			if($x["user_initial"] == 1) { echo hive__volt_alert_info($object["lang"]->translate("be_puser_chdele10")); }			
			
			// User Blocked Message
			if($x["user_disabled"] == 1) { echo hive__volt_alert_danger($object["lang"]->translate("be_puser_chdele9")); }	
			
			// User Blocked Message
			if($x["user_blocked"] == 1) { echo hive__volt_alert_danger($object["lang"]->translate("be_puser_chdele8")); }			

			// User Unconfirmed Message
			if($x["user_confirmed"] != 1) { echo hive__volt_alert_danger($object["lang"]->translate("be_puser_chdele7")); }			
			
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				hive__volt_box_start(false, "");
				echo "<h4>Operationen</h4>";
				
				
				
				if($x["user_blocked"] == 1) { 
					echo " <a class=\"btn btn-warning \" href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&user_deblock=true&token=".$object["csrf"]->get()."' >".$object["lang"]->translate("be_puser_chdele3")."</a> ";
				} else {
					echo " <a class=\"btn btn-warning \" href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&user_block=true&token=".$object["csrf"]->get()."'>".$object["lang"]->translate("be_puser_chdele2")."</a> ";
				}
				

				if($x["user_initial"] == 0) { 
				?> 
				<form method="post" style="float: left;" action="<?php echo _HIVE_URL_REL_."/?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>">
				<?php
				echo ' <button type="submit" class="btn btn-danger">Benutzer löschen</button>';
				//echo hive__volt_button_icright($object["lang"]->translate("be_puser_chdele"), "", "red", "white", "submit"); 
				echo "<input type='hidden' name='form_csrf' value='".$object["csrf"]->get()."'>";
				echo "<input type='hidden' name='form_id_dgroup' value='".$x["id"]."'>";			
				echo "</form>"; }
				hive__volt_box_end();
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
			}
		
		
		
			// Permissions
			if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
				hive__volt_box_start(false, "");
				echo "<h4>Berechtigungen</h4>";
					?><form method="post" action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>"><div><select class="multiselectsortable_value_right" id="multiselectsortable_value_right" name="multiselectsortable_value_right" multiple><?php
						if(is_array($x)) {
							if(is_array($object["set"]["permission"])) {
								$curperms = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_PERM_." WHERE ref = ".$x["id"]."", false);  
								if(is_array($curperms)) { $curperms = unserialize($curperms["content"]); }
								if(is_array($curperms)) {  
									foreach($curperms as $key => $value) {
										$descr = "";
										$isin = false;
										if(is_array($object["set"]["permission"])) {
											foreach($object["set"]["permission"] as $keyx => $valuex) {
												if($valuex[0] == $value) { $isin = true; $descr = $valuex[2]; $tt = $valuex[1]; }
											}		
										}												
										if($isin) { echo '<option value="'.htmlentities($value ?? '').'" selected><b>'.htmlspecialchars($tt ?? '').'</b> - '.htmlspecialchars($descr ?? '').'</option>'; }
									}	
									foreach($object["set"]["permission"] as $key => $value) {
										$used = false;
										if(is_array($curperms)) {
											foreach($curperms as $keyx => $valuex) {
												if($valuex == $value[0]) { $used = true; }
											}		
										}
										if(!$used) { echo '<option value="'.htmlentities($value[0] ?? '').'"><b>'.htmlspecialchars($value[1] ?? '').'</b> - '.htmlspecialchars($value[2] ?? '').'</option>'; }
									}									
								} else {
									if(is_array($object["set"]["permission"])) {
										foreach($object["set"]["permission"] as $key => $value) {
											echo '<option value="'.htmlentities($value[0] ?? '').'"><b>'.htmlspecialchars($value[1] ?? '').'</b> - '.htmlspecialchars($value[2] ?? '').'</option>';
										}
									}
								}								
							}	else { 
								if(is_array($object["set"]["permission"])) {
									foreach($object["set"]["permission"] as $key => $value) {
										echo '<option value="'.htmlentities($value[0] ?? '').'"><b>'.htmlspecialchars($value[1] ?? '').'</b> - '.htmlspecialchars($value[2] ?? '').'</option>';
									}
								}
							}								
						} else { 
							if(is_array($object["set"]["permission"])) {
								foreach($object["set"]["permission"] as $key => $value) {
									echo '<option value="'.htmlentities($value[0] ?? '').'"><b>'.htmlspecialchars($value[1] ?? '').'</b> - '.htmlspecialchars($value[2] ?? '').'</option>';
								}
							}
						}								
					?></select>	</div>
					<?php //echo hive__volt_button_icright($object["lang"]->translate("be_puser_cper"), "bx bx-edit", "yellow", "black", "submit"); 
					
				echo '<button type="submit" class="btn btn-primary">Berechtigungen ändern</button>';?>
					<input type="hidden" name="perm_change" value="1">
					<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>"></form>
					<script>				  
						jQuery(function($){$('.multiselectsortable_value_right').bugfish_sortselect({rid:56,selectable:{
                title   :'<b><?php echo $object["lang"]->translate("b_inactive"); ?></b>' },
            selection :{
                title   :'<b><?php echo $object["lang"]->translate("b_active"); ?></b>'
            },});})							  
					</script>	<?php		
				hive__volt_box_end();	
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
			}			
			
			
			// Favorite Set 
			//hive__volt_box_start(false, "");
			//	echo "<h4>Lager-Favorit</h4>In diesem Abschnitt können Sie Ihren Lager-Favoriten festlegen. Damit haben Sie die Möglichkeit automatisch ein bestimmtes Lager zu öffnen, sobald Sie sich anmelden oder auf den Navigationslink 'Artikel' klicken.";
			?><!--<form method='post' action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>">
			
			
			<label class="block text-sm xfpe_marginbottom15px">
				<input class="form-control placeholder="<?php echo $object["lang"]->translate("be_puser_cpass2"); ?>" type="password" name="pass1">
			  </label>
			  <br >
				<?php //echo hive__volt_button_icright($object["lang"]->translate("be_puser_cpass"), "bx bx-edit", "yellow", "black", "submit"); 
				//echo '<button type="submit" class="btn btn-primary">Lager-Favorit Ändern</button>';?>
				<input type="hidden" name="fav_change" value="1">
				<input type="hidden" name="form_token" value="<?php //echo $object["csrf"]->get(); ?>">
				</form>-->
			<?php //hive__volt_box_end();	 	
			
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";

			// Password Set 
			hive__volt_box_start(false, "");
				echo "<h4>Passwort</h4>Hier können Sie Ihr Passwort für die Anmeldung ändern. Achten Sie darauf Ihr Passwort nicht zu verlieren, da es sonst keine Möglichkeit gibt den Zugang ohne Administrativen Zugriff wiederherzustellen.";
			?><form method='post' action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>">
			
			
				<label class="block text-sm xfpe_marginbottom15px">
				<small><?php echo $object["lang"]->translate("be_puser_cpass2"); ?></small>
				<input class="form-control placeholder="<?php echo $object["lang"]->translate("be_puser_cpass2"); ?>" type="password" name="pass1">
			  </label>
				<br />
				<label class="block text-sm xfpe_marginbottom15px">
				<small><?php echo $object["lang"]->translate("be_puser_cpass1"); ?></small>
				<input class="form-control" type="password" name="pass2">
			  </label>		<br />		
				<?php //echo hive__volt_button_icright($object["lang"]->translate("be_puser_cpass"), "bx bx-edit", "yellow", "black", "submit"); 
				echo '<button type="submit" class="btn btn-primary">Passwort ändern</button>';?>
				<input type="hidden" name="pw_change" value="1">
				<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>">
				</form>
			<?php hive__volt_box_end();	 		


		
		} else {
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
			echo hive__volt_alert_warning($object["lang"]->translate("be_puser_noview")); 
		}		
	}
