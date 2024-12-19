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

		$object["add_top_title"] = $object["lang"]->translate("be_books"); 
		$object["add_head_title"] = $object["add_top_title"];
		
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);	
		////////////////////////////////////////////////////////////////
		// Variables
		////////////////////////////////////////////////////////////////
		$title_general 	= $object["lang"]->translate("Kategorien");
		$trts_general 	= "tag_title, id";
		$item_general 	= $object["lang"]->translate("Kategorien");
		$text_general 	= $object["lang"]->translate("Hier können Kategorien verwaltet werden!");
		$table_general 	= __OBR_TABLE_BOOK_;
		$table_title   	= array(array("name" => $object["lang"]->translate("Kategorie"))); 
		
		
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";		
		
		// Delete Item Operations
		if(is_numeric(@$_POST["x_class_table_exec_deletetable"])) {
			if(@$_GET["confirm"] != "confirmed") { ?>
						<script>
					Swal.fire({
					  title: "<?php echo $object["lang"]->translate("Kategorie löschen?"); ?>",
					  html: "<form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&confirm=confirmed"; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><input type='hidden' name='x_class_table_exec_deletetable' value='<?php echo @$_POST["x_class_table_exec_deletetable"]; ?>'><input type='hidden' name='x_class_table_exec_csrftable' value='<?php echo @$tbl->csrfobj->get(); ?>'><input type='hidden' name='x_class_table_exec_del_submittable' value='1'><input type='submit' class=\"btn btn-danger\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>",
					  showCancelButton: false,
					  showCloseButton: true,
					  showConfirmButton: false
					});
				</script> <?php
			} else {	
				$output1 =  $tbl->exec_delete();
				if($output1 == "deleted") { $object["eventbox"]->warning($object["lang"]->translate("be_list_exec_idel"));
											$object["mysql"]->query("DELETE FROM "._IT_TABLE_COUNT." WHERE fk_storage = ".@$_POST["x_class_table_exec_deletetable"]."");
											$object["log"]->info("[DELETION] [TABLE] ".$table_general." [ID] ".@$_POST["x_class_table_exec_deletetable"]." [UID] ".$object["user"]->user_id."", "tag");}
				if($output1 == "csrf") { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));}
			}
		}
		
		
		////////////////////////////////////////////////////////////////
		// Get Table Values
		////////////////////////////////////////////////////////////////
		$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general."", true);
		if(is_array($value_array)) {
			foreach($value_array as $key => $value) {
				$value_array[$key]["tag_title"] = @htmlspecialchars($value_array[$key]["tag_title"]);
			}
		}
		
		echo hive__volt_h2($title_general);
		if(is_numeric($_GET["id"])) { $c = $object["mysql"]->select("SELECT * FROM ".$trts_general." WHERE id = '".$_GET["id"]."'", false); }
		echo '<div class="row">';
			echo '<div class="col-12 col-sm-4 col-xl-4 mb-2">';
				hive__volt_box_start($object["lang"]->translate("be_vb_header_ima"), false);
					echo "<img src='./_site/_obr/getimage.php?id=".$c["id"]."' class='xfpe_maxwidth200px'></img>";
				hive__volt_box_end();	
			echo '</div>';
			echo '<div class="col-12 col-sm-8 col-xl-8 mb-2">';
				hive__volt_box_start($object["lang"]->translate("be_vb_header_det"), false);
				
						if(@trim($c["book_title"] ?? '') == "") { $c["book_title"] = "ERROR"; }
						echo "<a href='./?hl1=view&id=".$c["id"]."'>".$c["book_title"]."</a><br />".$c["book_descr"];
				
				hive__volt_box_end();				
			echo '</div>';
		echo '</div>';
		
		
		hive__volt_box_start($object["lang"]->translate("be_vb_header_rentc"), false);
		
		
		hive__volt_box_end();	


		hive__volt_box_start($object["lang"]->translate("be_vb_header_log"), false);
		
		
		hive__volt_box_end();	
		
