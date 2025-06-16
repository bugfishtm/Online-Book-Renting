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
	if(!is_array(@$object)) { @http_response_code(404); Header("Location: ../"); exit(); } 
	if(!is_numeric(@$_GET["id"])) { $_GET["id"] = @$object["user"]->user_id; }
	
	// Permission Check
	if(!hive__access($object, "page_user", false)) {
		if($object["user"]->user_id != @$_GET["id"] AND is_numeric(@$_GET["id"])) {
			define("_INT_SHOW_ACCESS_", "true");
		} 
	} 

	// Exist Check
	if(!$object["user"]->exists(@$_GET["id"]) OR !is_numeric(@$_GET["id"])) {
		define("_INT_SHOW_NOTFOUND_", "true");
	} 
	
	// Show Profile Page if Permission Exists
	if(!defined("_INT_SHOW_ACCESS_") AND !defined("_INT_SHOW_NOTFOUND_") ) {
		
		//Prepare Data
		$x = $object["user"]->get(@$_GET["id"]);
		
		//Prepare Title
		if(!is_numeric(@$_GET["id"]) OR @$_GET["id"] == $object["user"]->user_id) {
			$ttmp = $object["lang"]->translate("be_myprofile");
		} else {
			$ttmp = $object["lang"]->translate("be_profile")."#".$_GET["id"];
		}
		$object["add_head_title"] = $ttmp;
		$object["add_top_title"] = $ttmp;
		
		//Show Navbar
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);
		
		// Delete User
		if((hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) AND $x["user_initial"] == 0) {
			if(is_numeric(@$_POST["form_id_dgroup"])) {
				if($object["csrf"]->check($_POST["form_csrf"])) {
					if(@$_GET["confirm"] != "confirmed") { 
						?>
						<script>
							Swal.fire({
							  title: "<?php echo $object["lang"]->translate("be_puser_chdele"); ?>",
							  html: "<form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$_GET["id"]."&confirm=confirmed"; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><input type='hidden' name='form_id_dgroup' value='<?php echo @$_POST["form_id_dgroup"]; ?>'><input type='submit' class=\"btn btn-danger \" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>",
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
						exit();
					}
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); }			
			} @$x = $object["user"]->get($x["id"]);
		}

		// Confirm User
		if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
			if(@$_GET["user_confirm"]) {
				if(@$object["csrf"]->check(@$_GET["token"])) {
					$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_confirmed = 1 WHERE id = ".$x["id"]."");
					$object["eventbox"]->ok($object["lang"]->translate("be_op_usr_11"));
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 			
			}	
		}

		// Change Mail as Admin
		if(hive__access($object, "admin_user", false) OR $object["user"]->user["user_initial"] == 1) { 
			if(@$_POST["adm_mail_change"]) {
				if(@$object["csrf"]->check(@$_POST["form_token"])) {
					if(!$object["user"]->mailExists(@$_POST["adm_new_mail"])) {
						$object["user"]->change_mail($x["id"], @$_POST["adm_new_mail"]);
						$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_iedit"));
					} else { $object["eventbox"]->error($object["lang"]->translate("be_usr_ad_hmailex")); }
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 			
			}	
		}
		
		// Change Data
		if(@$_POST["form_edit_data"]) {
			if(@$object["csrf"]->check(@$_POST["form_token"])) {
				$b = array();
				$b[0]["value"] = @$_POST["user_v_c_fname"];
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_firstname = ? WHERE id = ".$x["id"]."", $b);
				$b[0]["value"] = @$_POST["user_v_c_lname"];
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_lastname = ? WHERE id = ".$x["id"]."", $b);
				$b[0]["value"] = @$_POST["user_v_c_str"];
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_street = ? WHERE id = ".$x["id"]."", $b);
				$b[0]["value"] = @$_POST["user_v_c_plz"];
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_postcode = ? WHERE id = ".$x["id"]."", $b);
				$b[0]["value"] = @$_POST["user_v_c_countr"];
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_country = ? WHERE id = ".$x["id"]."", $b);
				$b[0]["value"] = @$_POST["user_v_c_tel"];
				$object["mysql"]->query("UPDATE "._TABLE_USER_." SET user_tel = ? WHERE id = ".$x["id"]."", $b);
				$object["eventbox"]->info($object["lang"]->translate("be_op_usr_622")); 
			} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); } 			
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

		// User Superuser Message
		if($x["id"] != $object["user"]->user_id) { echo hive__volt_alert_warning($object["lang"]->translate("be_puser_chdele11")); }				

		// User Superuser Message
		if($x["user_initial"] == 1) { echo hive__volt_alert_info($object["lang"]->translate("be_puser_chdele10")); }			
		
		// User Unconfirmed Message
		if($x["user_confirmed"] != 1) { echo hive__volt_alert_danger($object["lang"]->translate("be_puser_chdele7")); }		


		echo '<div class="row">';
		echo '<div class="col-12 col-sm-4 col-xl-4 mb-0 mt-2">';
				
			// Delete // Confirm the User
			if(hive__access($object, "page_user", false)) { 
				hive__volt_box_start(false, "");
				if($x["user_confirmed"] != 1) { 
					echo " <a class=\"btn btn-warning\" href='./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"]."&user_confirm=true&token=".$object["csrf"]->get()."' >".$object["lang"]->translate("be_puser_chdele3")."</a> ";
				}
				?> 
				<form method="post" style="float: left;" action="<?php echo _HIVE_URL_REL_."/?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>">
				<?php
				echo ' <button type="submit" class="btn btn-danger">'.$object["lang"]->translate("b_delete").'</button>';
				echo "<input type='hidden' name='form_csrf' value='".$object["csrf"]->get()."'>";
				echo "<input type='hidden' name='form_id_dgroup' value='".$x["id"]."'>";			
				echo "</form>"; 
				hive__volt_box_end();
				// Div with Top Margin for Elements!
				echo "<div class='xfpe_margintop15px'></div>";
			}		
			
			// Password Set 
			hive__volt_box_start($object["lang"]->translate("b_password"), "mb-0 pb-0");
				echo $object["lang"]->translate("b_prof_pwinfo")."";
			?><form method='post' action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>">
				<label class="block text-sm xfpe_marginbottom15px">
				<small><?php echo $object["lang"]->translate("be_puser_cpass2"); ?></small>
				<input class="form-control placeholder="<?php echo $object["lang"]->translate("be_puser_cpass2"); ?>" type="password" name="pass1" required>
			  </label>
				<br />
				<label class="block text-sm xfpe_marginbottom15px">
				<small><?php echo $object["lang"]->translate("be_puser_cpass1"); ?></small>
				<input class="form-control" type="password" name="pass2" required>
			  </label>		<br />		
				<?php
				echo '<button type="submit" class="btn btn-primary">'.$object["lang"]->translate("b_change_password").'</button>';?>
				<input type="hidden" name="pw_change" value="1">
				<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>">
				</form>
			<?php hive__volt_box_end();	 	
			
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";
			
			// Mail Changes by User and Admin
			hive__volt_box_start($object["lang"]->translate("b_email"), "mb-0 pb-0");
				// by User
				if($object["user"]->user_id == $x["id"]) { 
						echo $object["lang"]->translate("b_prof_mailinfo")."";
						echo '<br /><a href="./_core/_action/user_mail_change.php" class="btn btn-primary">'.$object["lang"]->translate("b_change_email").'</a><br />';
						
				}
				// by Admin			
				if(hive__access($object, "page_user", false)) { 
						echo "<br />".$object["lang"]->translate("b_prof_pwinfoadd")."";
					?><form method='post' action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>">
						<label class="block text-sm xfpe_marginbottom15px">
						<input class="form-control" value="<?php echo hive__hen($x["user_mail"]); ?>" type="text" name="adm_new_mail" required>
					  </label>
						<br />		
						<?php
						echo '<button type="submit" class="btn btn-primary">'.$object["lang"]->translate("b_change_email").'</button>';?>
						<input type="hidden" name="adm_mail_change" value="1">
						<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>">
						</form>
					<?php 
				}
				hive__volt_box_end();			

			echo '</div>';			
			echo '<div class="col-12 col-sm-8 col-xl-8 mb-0 mt-2">';
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// Show currently rented books
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$value_array = $object["mysql"]->select("SELECT fk_book, fk_book_item, due_date, rent_descr, is_returned, id FROM ".__OBR_TABLE_BOOKR_." WHERE is_returned <> 1 AND fk_user = ".$x["id"]."", true);

				// Display the Table!
				hive__volt_box_start($object["lang"]->translate("be_deadlines"), false);
				echo "<table class='obr_datatable_init_class'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_book"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_barcode"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_duedate"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("b_status"))."</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
				if(is_array($value_array)) {
					foreach($value_array as $k => $v) {
						$b = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOK_." WHERE id = ".$v["fk_book"]."");
						$bi = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKI_." WHERE id = ".$v["fk_book_item"]."");
						echo "<tr>";
							echo "<td><a href='./?hl1=view&id=".$b["id"]."'>".hive__hsc(@$b["book_title"])."</b></td>";
							echo "<td>".hive__hsc(@$bi["book_barcode"])."</td>";
							echo "<td>".adm_date_format($v["due_date"])."</td>";
							$status = "";
							$datetime = $v["due_date"];
							$today = new DateTime('today');
							$datetime_object = new DateTime($datetime);
							if($datetime_object >= $today && $datetime_object < $today->modify('+1 day')) { $status = "<span class='badge bg-warning'>".hive__hsc($object["lang"]->translate("b_in_time"))."</span>"; }
							elseif($datetime_object < $today) { $status = "<span class='badge bg-danger'>".hive__hsc($object["lang"]->translate("b_overdue"))."</span>"; }
							else { $status = "<span class='badge bg-success'>".hive__hsc($object["lang"]->translate("b_in_time"))."</span>"; }
							echo "<td>".$status."</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
				echo "</tbody>";
				hive__volt_box_end();				
						
				// Div with Top Margin for Elements!
				echo "<div class='xfpe_margintop15px'></div>";					
				
				hive__volt_box_start($object["lang"]->translate("be_vb_header_det"), "");
				?>
				<form action="<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&id=".$x["id"].""; ?>" method="post">
					<b><?php echo $object["lang"]->translate("b_email"); ?></b>
					<input type="text" name="user_v_c_mail" value="<?php echo $x["user_mail"]; ?>" class="form-control mb-2" disabled>
					<b><?php echo $object["lang"]->translate("b_firstname"); ?></b>
					<input type="text" name="user_v_c_fname" value="<?php echo $x["user_firstname"]; ?>" class="form-control mb-2">
					<b><?php echo $object["lang"]->translate("b_lastname"); ?></b>
					<input type="text" name="user_v_c_lname" value="<?php echo $x["user_lastname"]; ?>" class="form-control mb-2">
					<b><?php echo $object["lang"]->translate("b_street"); ?></b>
					<input type="text" name="user_v_c_str" value="<?php echo $x["user_street"]; ?>" class="form-control mb-2">
					<b><?php echo $object["lang"]->translate("b_postcode"); ?></b>
					<input type="text" name="user_v_c_plz" value="<?php echo $x["user_postcode"]; ?>" class="form-control mb-2">
					<b><?php echo $object["lang"]->translate("b_country"); ?></b>
					<input type="text" name="user_v_c_countr" value="<?php echo $x["user_country"]; ?>" class="form-control mb-2">
					<b><?php echo $object["lang"]->translate("b_tel"); ?></b>
					<input type="text" name="user_v_c_tel" value="<?php echo $x["user_tel"]; ?>" class="form-control mb-2">
					<input type="submit" class="btn btn-primary" value="<?php echo $object["lang"]->translate("b_edit"); ?>">
					<input type="hidden" name="form_token" value="<?php echo $object["csrf"]->get(); ?>">
					<input type="hidden" name="form_edit_data" value="true">
				</form>
				<?php
				hive__volt_box_end();
					
				// Div with Top Margin for Elements!
				echo "<div class='xfpe_margintop15px'></div>";		

				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// Change Rights if Permission to Administer Users or Super User
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////					
				if(hive__access($object, "page_user", false)) { 
					hive__volt_box_start($object["lang"]->translate("b_permissions"), "");
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
					?></select>	
					</div>
					<?php 
					echo '<button type="submit" class="btn btn-primary">'.$object["lang"]->translate("b_edit").'</button>';?>
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
	
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// Log Show Old Returnals
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				if(hive__access($object, array("page_deadlines", "page_books"), false)) {
				$value_array = $object["mysql"]->select("SELECT fk_book, fk_book_item, due_date, rent_descr, return_date, is_returned, id FROM ".__OBR_TABLE_BOOKR_." WHERE is_returned <> 0 AND fk_user = ".$x["id"]."", true);
				hive__volt_box_start($object["lang"]->translate("be_vb_header_log"), false);
				echo "<table class='obr_datatable_init_class'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_book"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_barcode"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_returndate"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_duedate"))."</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
				if(is_array($value_array)) {
					foreach($value_array as $k => $v) {
						$b = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOK_." WHERE id = ".$v["fk_book"]."");
						$bi = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKI_." WHERE id = ".$v["fk_book_item"]."");
						echo "<tr>";
							echo "<td><a href='./?hl1=view&id=".$b["id"]."'>".hive__hsc($b["book_title"])."</a></td>";
							echo "<td>".hive__hsc(@$bi["book_barcode"])."</td>";
							echo "<td>".adm_date_format($v["return_date"])."</td>";
							echo "<td>".adm_date_format($v["due_date"])."</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
				echo "</tbody>";
				hive__volt_box_end();				

				// Div with Top Margin for Elements!
				echo "<div class='xfpe_margintop15px'></div>";
				}
			echo '</div>';
		echo '</div>';		
	}
