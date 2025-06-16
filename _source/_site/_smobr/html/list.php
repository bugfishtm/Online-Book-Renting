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

		$object["add_top_title"] = $object["lang"]->translate("be_books"); 
		$object["add_head_title"] = $object["add_top_title"];
		
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);	
		////////////////////////////////////////////////////////////////
		// Variables
		////////////////////////////////////////////////////////////////
		$title_general 	= $object["lang"]->translate("be_books");
		$trts_general 	= "book_isbn, book_title, book_autor, book_descr, book_type, book_publisher, book_date_release, book_hide, id";
		$item_general 	= $object["lang"]->translate("be_books");
		$text_general 	= $object["lang"]->translate("be_storage_exp");
		$table_general 	= __OBR_TABLE_BOOK_;
		$table_title   	= array(array("name" => $object["lang"]->translate("in_storage"))); 
		
		// Create Table Object
		$tbl = new x_class_table($object["mysql"], $table_general, "table");

		// Table Edit Arrays and Create
		$tbl->config_rel_url("./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."");
		$create_ar  = array();
		$edit_ar  = array();
		$create_ar[0]["field_name"] 	= "book_isbn";
		$create_ar[0]["field_label"] 	= $object["lang"]->translate("be_booked_isbn");
		$create_ar[0]["field_type"] 	= "string";
		$create_ar[0]["field_ph"] 		= "";
		$create_ar[0]["field_classes"] 	= "form-control";

		$create_ar[1]["field_name"] 		= "book_title";
		$create_ar[1]["field_label"] 		= $object["lang"]->translate("be_booked_title");
		$create_ar[1]["field_type"] 		= "string";
		$create_ar[1]["field_ph"] 			= "";
		$create_ar[1]["field_classes"] 		= "form-control";
		
		$tbl->config_array($create_ar, $edit_ar);			

		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";		
		
		// Create Operation
		if(hive__access($object, "page_books", false)) {
			$output1 =  $tbl->exec_create();
		}
		if($output1 == "created") { 
						if(@$object["mysql"]->insert_id() > 0) {
							$object["log"]->info("[CREATE] [TABLE] ".$table_general." [ID] ".@$object["mysql"]->insert_id()." [UID] ".$object["user"]->user_id."", "books");
							$object["eventbox"]->warning($object["lang"]->translate("be_str_item_created"));
						} else { $object["eventbox"]->error($object["lang"]->translate("be_mailt_err")); } 
									}
		if($output1 == "csrf") { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));}
	
		// Get Table Values
		$value_array = $object["mysql"]->select("SELECT ".$trts_general." FROM ".$table_general."", true);
		if(is_array($value_array)) {
			foreach($value_array as $key => $value) {
				$value_array[$key]["book_isbn"] = @htmlspecialchars($value_array[$key]["book_isbn"] ?? '');
				$value_array[$key]["book_title"] = @htmlspecialchars($value_array[$key]["book_title"] ?? '');
				$value_array[$key]["book_autor"] = @htmlspecialchars($value_array[$key]["book_autor"] ?? '');
				$value_array[$key]["book_descr"] = @htmlspecialchars($value_array[$key]["book_descr"] ?? '');
				$value_array[$key]["book_type"] = @htmlspecialchars($value_array[$key]["book_type"] ?? '');
				$value_array[$key]["book_publisher"] = @htmlspecialchars($value_array[$key]["book_publisher"] ?? '');
				$value_array[$key]["book_date_release"] = @htmlspecialchars($value_array[$key]["book_date_release"] ?? '');
			}
		}

	echo hive__volt_h2($title_general);
	
	if(@$_GET["op"] == "create" AND hive__access($object, "page_books", false)) {
		hive__volt_box_start(false, false);
		echo "<h4>".$object["lang"]->translate("be_book_add")."</h4>";
		$tbl->spawn_create($object["lang"]->translate("be_book_add"), "btn btn-primary");
		echo "<a href='".hive__url(array("list", false, false))."' class='text-danger'>".$object["lang"]->translate("be_edit_abort")."</a>"; 
		hive__volt_box_end();
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";	
	}
	
	// Display the Table!
	if(@$_GET["op"] != "create" AND hive__access($object, "page_books", false)) {
		hive__volt_box_start(false, false);
				echo '<button onclick="window.location.href = \''.hive__url(array("list", false, false)).'&op=create\';" type="button" class="btn btn-primary"><span>'.$object["lang"]->translate("be_book_add").'</span></button>';
		hive__volt_box_end();
	}
	
	// Show Book Items
	if(is_array($value_array)) {
		foreach($value_array as $k => $v) {
			hive__volt_box_start(false, "mt-2");
				echo "<a href='./?hl1=view&id=".$v["id"]."'>";
					echo "<table>";
						echo "<tr>";
							echo "<td>";
								if(file_exists("./_data/"._HIVE_MODE_."/_public/".$v["id"].".jpg")) {
									echo "<img src='./_data/"._HIVE_MODE_."/_public/".$v["id"].".jpg' class='xfpe_maxwidth100px'></img>";
								} else {
									echo "<img src='./_site/"._HIVE_MODE_."/_theme/fallback.png' class='xfpe_maxwidth100px'></img>";
								} 
							echo "</td>";
							echo "<td>";
								echo "<div class='mx-2'>";
									if(@trim($v["book_title"] ?? '') == "") { $v["book_title"] = $object["lang"]->translate("b_nobooktitlelist"); }
									echo "".$v["book_title"]."<br />";
									echo "<small>";
									if(@trim($v["book_autor"] ?? '') != "") { echo ' '.$v["book_autor"].' '; }
									if(@trim($v["book_date_release"] ?? '') != "") { echo ' ['.$v["book_date_release"].']'; }
									if(@trim($v["book_isbn"] ?? '') != "") { echo '<section>'.$v["book_isbn"].'</section>'; }
									//if($v["book_hide"] == 1) { echo ' <span class="badge bg-danger">'.$object["lang"]->translate("b_hidden").'</span>'; }
									echo "</small>";
								echo "</div>";
							echo "</td>";
						echo "</tr>";
					echo "</table>";
				echo "</a>";
			hive__volt_box_end();
		}
	}
