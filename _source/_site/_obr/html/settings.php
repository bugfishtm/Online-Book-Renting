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
	*/ if(!is_array($object)) { @http_response_code(404); Header("Location: ../"); exit(); } 

	// International
	$title_general 	= $object["lang"]->translate("adm_nav_system_translation");
	$trts_general 	= "id as newid, identificator, lang, translation, section, id";
	$table_general 	= _TABLE_LANG_;
	$table_title   	= array(array("name" => $object["lang"]->translate("be_string_key")),
							array("name" => $object["lang"]->translate("be_string_language")),
							array("name" => $object["lang"]->translate("be_string_translation")),
							array("name" => $object["lang"]->translate("b_action")));

	// Create Table Object
	$tbl = new x_class_table($object["mysql"], $table_general, "table");
	
	if(is_numeric(@$_POST["edit_id"])) { 
		if($object["csrf"]->check(@$_POST["token"])) {
			$b = array();
			$b[0]["value"] = @$_POST["form_edit_trans"];
			$b[1]["value"] = _HIVE_MODE_;
			$object["mysql"]->query("UPDATE "._TABLE_LANG_." SET `translation` = ? WHERE section = ? AND id = ".@$_GET["edit_id"]."", $b);
			$b = array();
			$b[0]["value"] = _HIVE_MODE_;
			$xm = $object["mysql"]->select("SELECT * FROM "._TABLE_LANG_." WHERE section = ? AND id = ".@$_GET["edit_id"]."", false, $b);
			$object["log"]->info("[CHANGE] [TABLE] ".$table_general." [ID] ".@$_GET["edit_id"]." [NAME] ".htmlspecialchars($xm["identificator"] ?? '')."  [UID] ".$object["user"]->user_id."", "system_translation");
			$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_iedit"));
			Header("Location: ./?hl1="._HIVE_URL_CUR_[0]."&hl2="._HIVE_URL_CUR_[1]."");
			exit();
		} else {
			$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));
			Header("Location: ./?hl1="._HIVE_URL_CUR_[0]."&hl2="._HIVE_URL_CUR_[1]."");
			exit();
		}
	}

	if(is_numeric(@$_POST["add_form_exec"])) { 
		if($object["csrf"]->check(@$_POST["token"])) {
			$b = array();
			$b[0]["value"] = @$_POST["form_edit_key"];
			$b[1]["value"] = _HIVE_MODE_;
			$xm = $object["mysql"]->select("SELECT * FROM "._TABLE_LANG_." WHERE `identificator` = ? AND section = ?", false, $b);
			if(!$xm) { 
				$b = array();
				$b[0]["value"] = @$_POST["form_edit_key"];
				$b[1]["value"] = @$_POST["form_edit_lang"];
				$b[2]["value"] = @$_POST["form_edit_trans"];
				$b[3]["value"] = _HIVE_MODE_;
				$object["mysql"]->query("INSERT INTO "._TABLE_LANG_."(identificator, lang, translation, section) VALUES(?, ?, ?, ?);", $b);
				$object["log"]->info("[CREATION] [TABLE] ".$table_general." [ID] ".$object["mysql"]->insert_id()." [NAME] ".htmlspecialchars(@$_POST["form_edit_key"] ?? '')." [UID] ".$object["user"]->user_id."", "system_translation");
				$object["eventbox"]->ok($object["lang"]->translate("be_listss_exec_iedit"));
				Header("Location: ./?hl1="._HIVE_URL_CUR_[0]."&hl2="._HIVE_URL_CUR_[1]."");
				exit();
			} else {
				$object["eventbox"]->error($object["lang"]->translate("event_error_exists"));
				Header("Location: ./?hl1="._HIVE_URL_CUR_[0]."&hl2="._HIVE_URL_CUR_[1]."");
				exit();
			}
		} else {
			$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));
			Header("Location: ./?hl1="._HIVE_URL_CUR_[0]."&hl2="._HIVE_URL_CUR_[1]."");
			exit();
		}
	}
	
	$delete_confirm = false;
	if(is_numeric(@$_GET["delete_id"])) {
		if(@$_GET["confirmation"] == "true") { 
			if($object["csrf"]->check(@$_POST["token"])) {
				$b = array();
				$b[0]["value"] = _HIVE_MODE_;
				$xm = $object["mysql"]->select("SELECT * FROM "._TABLE_LANG_." WHERE section = ? AND id = ".@$_GET["delete_id"]."", false, $b);
				if(!is_array($xm)) { $xm = array(); }
				$object["log"]->info("[DELETION] [TABLE] ".$table_general." [ID] ".@$_GET["delete_id"]." [NAME] ".htmlspecialchars($xm["identificator"] ?? '')." [UID] ".$object["user"]->user_id."", "system_translation");
				$object["mysql"]->query("DELETE FROM "._TABLE_LANG_." WHERE section = ? AND id = ".@$_GET["delete_id"]."", $b);
				$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_idel"));
				Header("Location: ./?hl1="._HIVE_URL_CUR_[0]."&hl2="._HIVE_URL_CUR_[1]."");
				exit();
			} else {
				$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));
				Header("Location: ./?hl1="._HIVE_URL_CUR_[0]."&hl2="._HIVE_URL_CUR_[1]."");
				exit();
			}
		} else {
			$b = array();
			$b[0]["value"] = _HIVE_MODE_;
			$xm = $object["mysql"]->select("SELECT * FROM "._TABLE_LANG_." WHERE section = ? AND id = ".@$_GET["delete_id"]."", false, $b);
			if(is_array($xm)) { $delete_confirm = true; }
		}
	}

	// CMS Files 
	hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
	hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);	

	
	if($delete_confirm) {
		?>
		<script>
			Swal.fire({
			  title: "",
			  html: "<?php echo $object["lang"]->translate("be_trans_dlrly"); ?><br /><b><?php echo htmlspecialchars($xm["identificator"] ?? ''); ?></b><form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&"._HIVE_URL_GET_[1]."="._HIVE_URL_CUR_[1]."&confirmation=true&delete_id=".@$_GET["delete_id"].""; ?>'><input type='hidden' name='token' value='<?php echo $object["csrf"]->get(); ?>'><br /><input type='submit' class=\"btn btn-danger\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>",
			  showCancelButton: false,
			  showCloseButton: true,
			  showConfirmButton: false,
			  allowOutsideClick: false,
			  willClose: () => {
				window.location.href = '<?php echo hive__url(array("settings")); ?>';
			  }
			});
		</script>
		<?php 	
	}
	
	// Div with Top Margin for Elements!
	echo "<div class='xfpe_margintop15px'></div>"; 
	
	// Div with Top Margin for Elements!
	echo "<h2>".$object["lang"]->translate("be_settings")."</h2>";
	
	// Div with Top Margin for Elements!
	echo "<div class='xfpe_margintop15px'></div>"; 
	
	// Regenerate CSRF for Forms
	$object["var"]->form_start();
	
	// Display the Table!
	hive__volt_box_start($object["lang"]->translate("be_set_header_general"), false);
	
	
	
	
	
	
	
	
	
	
	
	
	hive__volt_box_end();
	
	// Div with Top Margin for Elements!
	echo "<div class='xfpe_margintop15px'></div>"; 
	
	// Display the Table!
	hive__volt_box_start($object["lang"]->translate("be_set_header_mail"), false);
		echo '<div class="row">';
				echo '<div class="col-12 col-sm-6 col-xl-4 mb-4">';
					$object["var"]->form("_SMTP_AUTH_", "select", array(array("SSL", "ssl"), array("TLS", "tls"), array("Keine", "0")), "", "btn btn-primary", "form-control", "Bearbeiten");echo "<br />";
					$object["var"]->form("_SMTP_USER_", "string", array(), "", "btn btn-primary", "form-control", "Bearbeiten");
					$object["var"]->form("_SMTP_PASS_", "string", array(), "", "btn btn-primary", "form-control", "Bearbeiten"); echo "<br />";
					$object["var"]->form("_SMTP_HOST_", "string", array(), "", "btn btn-primary", "form-control", "Bearbeiten");
					$object["var"]->form("_SMTP_PORT_", "int", array(), "", "btn btn-primary", "form-control", "Bearbeiten"); echo "<br />";
			echo "</div>";
			echo '<div class="col-12 col-sm-6 col-xl-4 mb-4">';
					$object["var"]->form("_SMTP_SENDER_MAIL_", "string", array(), "", "btn btn-primary", "form-control", "Bearbeiten");
					$object["var"]->form("_SMTP_SENDER_NAME_", "string", array(), "", "btn btn-primary", "form-control", "Bearbeiten");
					$object["var"]->form("_SMTP_MAILS_IN_HTML_", "select", array(array("1 - HTML Mails", "1"), array("0 - Raw Mails", "0")), "", "btn btn-primary", "form-control", "Bearbeiten"); echo "<br />";
					$object["var"]->form("_SMTP_MAILS_HEADER_", "text", array(), "", "btn btn-primary", "form-control", "Bearbeiten"); echo "<br />";
				echo "</div>";	
				echo '<div class="col-12 col-sm-6 col-xl-4 mb-4">';
					$object["var"]->form("_SMTP_DEBUG_", "select", array(array("0 - Produktiv", "0"), array("1 - Low Debug", "1"), array("2 - Medium Debug", "2"), array("3 - High Debug", "3")), "", "btn btn-primary", "form-control", "Bearbeiten");
					$object["var"]->form("_SMTP_INSECURE_", "select", array(array("1 - Keine SSL Validierung", "1"), array("0 - SSL Validierung", "0")), "", "btn btn-primary", "form-control", "Bearbeiten");
					$object["var"]->form("_SMTP_MAILS_FOOTER_", "text", array(), "", "btn btn-primary", "form-control", "Bearbeiten"); echo "<br />";
				echo "</div>";					
		echo "</div>"; // end row	
	hive__volt_box_end();

	// Regenerate CSRF for Forms
	$object["var"]->form_end();	
	
	// Div with Top Margin for Elements!
	echo "<div class='xfpe_margintop15px'></div>"; 
	
	// Display the Table!
	hive__volt_box_start($object["lang"]->translate("be_set_header_trans"), false);
	
		// Edit an Item
		if(is_numeric(@$_GET["edit_id"])) { 
			$b = array();
			$b[0]["value"] = _HIVE_MODE_;
			$xm = $object["mysql"]->select("SELECT * FROM "._TABLE_LANG_." WHERE section = ? AND id = ".@$_GET["edit_id"]."", false, $b);
			if(is_array($xm)) { 	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

		

				?>
				<form action="" method="post">
					<p>
						<b><?php echo $object["lang"]->translate("be_string_key"); ?></b>: <?php echo htmlentities($xm["identificator"] ?? ''); ?><br />
						<b><?php echo $object["lang"]->translate("be_string_language"); ?></b>: <?php echo $xm["lang"]; ?><br />
					</p> 
					<label for="constant_value"><?php echo $object["lang"]->translate("be_string_translation"); ?></label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" id="constant_value" value="<?php echo htmlentities($xm["translation"] ?? ''); ?>" class="form-control" name="form_edit_trans">
						 </div>
					</div><br />					
					<input type="hidden" name="token" value="<?php echo $object["csrf"]->get(); ?>">
					<input type="hidden" name="edit_id" value="<?php echo $xm["id"]; ?>">
					<button class="btn btn-info" type="submit"><?php echo $object["lang"]->translate("be_trans_button_edit"); ?></button> 
					<a href="<?php echo hive__url(array("settings")); ?>" class="btn btn-danger"><?php echo $object["lang"]->translate("be_cancel"); ?></a>
				</form>
				<?php
			} else {
				echo hive__volt_alert_danger($object["lang"]->translate("string_not_available"));
			}
		} else { 
			// Add an Item
			?>
			<form action="" method="post">
				<label for="constant_name"><?php echo $object["lang"]->translate("be_string_key"); ?></label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="constant_name" value="" class="form-control" name="form_edit_key" required>
					 </div>
				</div>					
				<label for="constant_descr"><?php echo $object["lang"]->translate("be_string_language"); ?></label>
				<div class="form-group">
					<div class="form-line">
						<select class="form-control show-tick" id="constant_descr" name="form_edit_lang">
							<?php
								foreach(_HIVE_LANG_ARRAY_ as $key => $value) {
									echo '<option value="'.$value.'">'.$value.'</option>';
								}
							?>
						</select>
					 </div>
				</div>					
				<label for="constant_value"><?php echo $object["lang"]->translate("be_string_translation"); ?></label>
				<div class="form-group">
					<div class="form-line">
						<input type="text" id="constant_value" value="" class="form-control" name="form_edit_trans" required>
					 </div>
				</div><br />				
				<input type="hidden" name="token" value="<?php echo $object["csrf"]->get(); ?>">
				<input type="hidden" name="add_form_exec" value="1">
				<button class="btn btn-info" type="submit"><?php echo $object["lang"]->translate("be_trans_button_create"); ?></button> 
			</form>
			<?php
		}
		
		
		
		
		// Get Table Values
		$b = array();
		$b[0]["value"] = _HIVE_MODE_;
		$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general." WHERE section = ?", true, $b);
		if(is_array($value_array)) {
			foreach($value_array as $key => $value) {
				$value_array[$key]["identificator"] = @htmlspecialchars($value_array[$key]["identificator"]);
				$value_array[$key]["lang"] = @htmlspecialchars($value_array[$key]["lang"]);
				$value_array[$key]["translation"] = @htmlspecialchars($value_array[$key]["translation"]);
				$value_array[$key]["action"] = "<a href='".hive__url(array("settings"))."&edit_id=".$value_array[$key]["id"]."' class='btn btn-primary'>".$object["lang"]->translate("b_edit")."</a> <a href='".hive__url(array("settings"))."&delete_id=".$value_array[$key]["id"]."' class='btn btn-danger'>".$object["lang"]->translate("b_delete")."</a>";
				unset($value_array[$key]["section"]);
				unset($value_array[$key]["newid"]);
			}
		}		
		echo '<hr><h4>'.$object["lang"]->translate("be_trans_current_ovr").'</h4>';
		// Display the Table!
		$tbl->spawn_table($table_title, $value_array, false, false, false, false, "display");
		echo '<hr><h4>'.$object["lang"]->translate("be_trans_current_active").'</h4>';
		// Load Default Language File			
		$object["lang_tmp_def"] = new x_class_lang(false, false, false, false, $object["path"]."/_core/_lang/en.php");  
		// Load and merge Language
		$tmpl = new x_class_lang(false, false, false, false, _HIVE_SITE_PATH_."/_lang/"._HIVE_LANG_.".php"); 	 
		foreach($object["lang_tmp_def"]->array as $key => $value) {	
			if(@!$tmpl->array[$key]) { $tmpl->array[$key] = $value; }
		} unset($object["lang_tmp_def"]); 
		unset($object["lang_tmp_def"]);
		$list_array = array();
		if(is_array($tmpl->array)) {
			foreach($tmpl->array as $key => $value) {
				array_push($list_array, array("key" => $key, "lang" => _HIVE_LANG_, "value" => $value));
			}
		}
		$table_title   	= array(array("name" => $object["lang"]->translate("be_string_key")),
							    array("name" => $object["lang"]->translate("be_string_language")),
							    array("name" => $object["lang"]->translate("be_string_translation")));
		$tbl->spawn_table($table_title, $list_array, false, false, false, false, "obr_datatable_init_class display");	
	hive__volt_box_end();
	
	// Div with Top Margin for Elements!
	echo "<div class='xfpe_margintop15px'></div>"; 
	
	// Display the Table!
	hive__volt_box_start($object["lang"]->translate("be_set_header_about"), false);
		echo $object["lang"]->translate("be_about_core_info");
		echo " <b>".$object["core_mode"]["version"]."</b>";
		echo "<br />";
		echo $object["lang"]->translate("be_about_fw_info");
		$tmp = new x_class_version();
		echo " <b>".$tmp->version."</b>";
		echo "<br />";
		echo $object["lang"]->translate("be_about_site_info");
		echo " <b>".$object["hive_mode"]["version"]."</b>";
		echo "<br />";
	hive__volt_box_end();