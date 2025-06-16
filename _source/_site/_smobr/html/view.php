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
		if(is_numeric(@$_GET["id"])) { $c = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOK_." WHERE id = '".$_GET["id"]."'", false); }	
		if(!$c or !is_numeric(@$_GET["id"])) { $object["eventbox"]->error($object["lang"]->translate("be_error_booknoexists")); Header("Location: ./"); exit(); }

		if(@$_POST["book_item_op_delete"] == "true" AND is_array(@$c)) {
			if(hive__access($object, "page_books", false)) {
				if($object["csrf"]->check(@$_POST["token"])) {
					$object["log"]->info("[DELETION] [TABLE] ".__OBR_TABLE_BOOK_." [ID] ".$c["id"]." [UID] ".$object["user"]->user_id."", "view");
					$object["mysql"]->query("DELETE FROM ".__OBR_TABLE_BOOK_." WHERE id = ".$c["id"]."");
					$object["mysql"]->query("DELETE FROM ".__OBR_TABLE_BOOKI_." WHERE fk_book = ".$c["id"]."");
					$object["mysql"]->query("DELETE FROM ".__OBR_TABLE_BOOKR_." WHERE fk_book = ".$c["id"]."");
					$uploadDirectory = './_data/'._HIVE_MODE_.'/_public/';
					$safeFileName = $c["id"].".jpg";
					$destinationPath = $uploadDirectory . $safeFileName;
					@unlink($destinationPath);
					$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_idel")); 
					Header("Location: ./?hl1=list"); 
					exit();
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); Header("Location: ./?hl1=view&id=".$c["id"].""); exit(); }
			}
		}
		
		if(@$_POST["book_item_op_ciupl"] == "true" AND is_array(@$c)) {
			if(hive__access($object, "page_books", false)) { 
				if($object["csrf"]->check(@$_POST["token"])) {
					// Check if a file was uploaded and there are no errors
					if (isset($_FILES['file'])) { 

						// Get file information
						$fileTmpPath = $_FILES['file']['tmp_name'];
						$fileName = $_FILES['file']['name'];
						$fileSize = $_FILES['file']['size'];
						$fileType = $_FILES['file']['type'];
						// Specify allowed file types and size limit
						$allowedMimeTypes = ['image/jpeg'];
						@mkdir('./_data/');
						@mkdir('./_data/'._HIVE_MODE_.'/');
						@mkdir('./_data/'._HIVE_MODE_.'/_public/');
						$uploadDirectory = './_data/'._HIVE_MODE_.'/_public/';
						// Validate file type
						if (!in_array($fileType, $allowedMimeTypes)) {
							$object["eventbox"]->error($object["lang"]->translate("be_pp_errimage3")); 
						} else {
							// Sanitize file name to avoid potential security issues
							$safeFileName = $c["id"].".jpg";
							$destinationPath = $uploadDirectory . $safeFileName;
							@unlink($destinationPath);
							// Ensure the uploads directory exists
							if (!is_dir($uploadDirectory)) {
								@mkdir($uploadDirectory, 0755, true);
							}
							// Move the uploaded file to the destination directory
							if (move_uploaded_file($fileTmpPath, $destinationPath)) {
								$object["log"]->info("[CHANGE] [IMAGE] [TABLE] ".__OBR_TABLE_BOOK_." [ID] ".$c["id"]." [UID] ".$object["user"]->user_id."", "view");
								$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_iedit")); 
							} else {
								$object["eventbox"]->error($object["lang"]->translate("be_pp_errimage2")); 
							}
						}
					} else {
						$object["eventbox"]->error($object["lang"]->translate("be_pp_errimage1")); 
					}		
					Header("Location: ./?hl1=view&id=".$c["id"].""); 
					exit();
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); Header("Location: ./?hl1=view&id=".$c["id"].""); exit(); }
			}
		}
		
		if(@$_POST["book_item_op_ch"] == "true" AND is_array(@$c)) {
			if(hive__access($object, "page_books", false)) {
				if($object["csrf"]->check(@$_POST["token"])) {
					$object["log"]->info("[CHANGE] [DATA] [TABLE] ".__OBR_TABLE_BOOK_." [ID] ".$c["id"]." [UID] ".$object["user"]->user_id."", "view");
					$bind = array();
					$bind[0]["value"] = @$_POST["book_v_title"];
					$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_title = ? WHERE id = ".$c["id"]."", $bind);
					$bind[0]["value"] = @$_POST["book_v_autor"];
					$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_autor = ? WHERE id = ".$c["id"]."", $bind);
					$bind[0]["value"] = @$_POST["book_v_descr"];
					$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_descr = ? WHERE id = ".$c["id"]."", $bind);
					$bind[0]["value"] = @$_POST["book_v_type"];
					$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_type = ? WHERE id = ".$c["id"]."", $bind);
					$bind[0]["value"] = @$_POST["book_v_publisher"];
					$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_publisher = ? WHERE id = ".$c["id"]."", $bind);
					$bind[0]["value"] = @$_POST["book_v_isbn"];
					$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_isbn = ? WHERE id = ".$c["id"]."", $bind);
					$bind[0]["value"] = @$_POST["book_v_lang"];
					$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_lang = ? WHERE id = ".$c["id"]."", $bind);
					$bind[0]["value"] = @$_POST["book_v_rel"];
					$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_date_release = ? WHERE id = ".$c["id"]."", $bind);
					if(is_array(@$_POST["book_v_tags"])) {
						$bind[0]["value"] = serialize(@$_POST["book_v_tags"]);
						$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_tag_array = ? WHERE id = ".$c["id"]."", $bind);
					} else {
						$bind[0]["value"] = serialize(array());
						$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_tag_array = ? WHERE id = ".$c["id"]."", $bind);
					}
					$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_iedit")); 
					Header("Location: ./?hl1=view&id=".$c["id"].""); 
					exit();
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); Header("Location: ./?hl1=view&id=".$c["id"].""); exit(); }
			}
		}
		
		if(@$_POST["book_item_op_apisy"] == "true" AND is_array(@$c)) {
			if(hive__access($object, "page_books", false)) {
				if($object["csrf"]->check(@$_POST["token"])) {
					$isbn = trim($c["book_isbn"]);
					$url = "https://openlibrary.org/api/books?bibkeys=ISBN:$isbn&format=json&jscmd=data";
					$response = @file_get_contents($url);
					if ($response === FALSE) {
						$object["eventbox"]->error($object["lang"]->translate("be_pp_sapierr")); 
						Header("Location: ./?hl1=view&id=".$c["id"].""); 
						exit();					
					} 
                    $data = json_decode($response, true);
                    $bookKey = "ISBN:$isbn";
                    if (isset($data[$bookKey])) {
                        $book = $data[$bookKey];

						$bind = array();
						$bind[0]["value"] = @$book['title'];
						$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_title = ? WHERE id = ".$c["id"]."", $bind);
						if(isset($book['authors'])) {
							$bind[0]["value"] =  implode(", ", array_column($book['authors'], 'name'));
							$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_autor = ? WHERE id = ".$c["id"]."", $bind);
						}
						if(isset($book['publishers'])) {
							$bind[0]["value"] = implode(", ", array_column($book['publishers'], 'name'));
							$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_publisher = ? WHERE id = ".$c["id"]."", $bind);
						}
						if(isset($book['publish_date'])) {
							$bind[0]["value"] = @$book['publish_date'];
							$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOK_." SET book_date_release = ? WHERE id = ".$c["id"]."", $bind);
						}
						if(isset($book['cover'])) {
							if(isset($book['cover']["large"])) {
								// URL of the image to download
								$imageUrl = $book['cover']["large"];
								// Directory to save the downloaded image
								$saveDir = './_data/'._HIVE_MODE_.'/_public/';
								$imageName = $c["id"].".jpg";
								$savePath = $saveDir . $imageName;
								// Check if the directory exists, if not, create it
								if (!is_dir($saveDir)) {
									mkdir($saveDir, 0755, true);
								}
								// Download the image and save it
								$imageData = file_get_contents($imageUrl);
								if ($imageData !== false) {
									file_put_contents($savePath, $imageData);
								}	
							}				
						}		
						$object["log"]->info("[CHANGE] [API-SYNC] [TABLE] ".__OBR_TABLE_BOOK_." [ID] ".$c["id"]." [UID] ".$object["user"]->user_id."", "view");					
						$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_iedit")); 
						Header("Location: ./?hl1=view&id=".$c["id"].""); 
						exit();	
                    } else {
						$object["eventbox"]->error($object["lang"]->translate("be_pp_sapierr")); 
						Header("Location: ./?hl1=view&id=".$c["id"].""); 
						exit();						
                    }
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf")); Header("Location: ./?hl1=view&id=".$c["id"].""); exit(); }
			}
		}		
		
		if(hive__access($object, "page_books", false)) {
			if(@$_POST["obr_book_add_item"] == "true") {
				if(@$object["csrf"]->check(@$_POST["token"])) {
					$bind = array();
					$bind[0]["value"] = @$_POST["obr_book_add_itemc"];	
					$object["mysql"]->query("INSERT INTO ".__OBR_TABLE_BOOKI_."(fk_book, book_barcode) VALUES('".$c["id"]."', ?);", $bind);
					$object["log"]->info("[CREATION] [BOOK ITEM] [TABLE] ".__OBR_TABLE_BOOKI_." [ID] ".$object["mysql"]->insert_id()." [UID] ".$object["user"]->user_id."", "view");	
					$object["eventbox"]->ok($object["lang"]->translate("be_str_item_created"));
					Header("Location: ./?hl1=view&id=".$c["id"]."");
					exit();
				} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));
						 Header("Location: ./?hl1=view&id=".$c["id"]."");
						 exit(); }
			}
		}		
		
		if(hive__access($object, "page_books", false)) { 
			if(@is_numeric(@$_POST["x_class_table_exec_deletetable"])) {
				if(@$_POST["book_item_op_rdelete"] == "true") {
					if(@$object["csrf"]->check(@$_POST["token"])) {
						$object["log"]->info("[DELETION] [BOOK ITEM] [TABLE] ".__OBR_TABLE_BOOKI_." [ID] ".@$_POST["x_class_table_exec_deletetable"]." [UID] ".$object["user"]->user_id."", "view");
						$object["mysql"]->query("DELETE FROM ".__OBR_TABLE_BOOKI_." WHERE id = ".@$_POST["x_class_table_exec_deletetable"]."");
						$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOKR_." SET is_returned = 1 WHERE fk_book_item = ".@$_POST["x_class_table_exec_deletetable"]."");
						$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_idel"));
						Header("Location: ./?hl1=view&id=".$c["id"]."");
						exit();
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));
							 Header("Location: ./?hl1=view&id=".$c["id"]."");
							 exit(); }
				}
			}
		}				
		
		if(hive__access($object, "page_deadlines", false)) { 
			if(@is_numeric(@$_POST["x_class_table_exec_deletetable"])) {
				if(@$_POST["book_item_op_rreturn"] == "true") {
					if(@$object["csrf"]->check(@$_POST["token"])) {
						$object["log"]->info("[CHANGE] [BOOK ITEM] [TABLE] ".__OBR_TABLE_BOOKR_." [ID] ".@$_POST["x_class_table_exec_deletetable"]." [UID] ".$object["user"]->user_id."", "view");
						$object["mysql"]->query("UPDATE ".__OBR_TABLE_BOOKR_." SET is_returned = 1, return_date = CURRENT_TIMESTAMP WHERE id = ".@$_POST["x_class_table_exec_deletetable"]."");
						$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_iedit"));
						Header("Location: ./?hl1=view&id=".$c["id"]."");
						exit();
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));
							 Header("Location: ./?hl1=view&id=".$c["id"]."");
							 exit(); }
				}
			}
		}			
		
		if(hive__access($object, "page_deadlines", false)) { 
			if(@is_numeric(@$_POST["x_class_table_exec_deletetable"]) AND @is_numeric(@$_POST["x_class_table_exec_user"])) { 
				if(@$_POST["book_item_op_rrent"] == "true") {
					if(@$object["csrf"]->check(@$_POST["token"])) {
						$cr = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKI_." WHERE id = '".@$_POST["x_class_table_exec_deletetable"]."'", true);
						$runis = false;
						if(is_array($cr)) {	
							foreach($cr as $crk => $crv) {
								$runis = true;
								$cii = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKR_." WHERE fk_book_item = ".$crv["id"]." AND is_returned = 0", false);		
								if(is_array($cii)) {
									$is_returned = 0;
								} else {
									$is_returned = 1;
									@$_POST["x_class_table_exec_bc"] = $crv["book_barcode"];
								}
							}
						} 		
						if(!$is_returned OR !$runis) {
							$object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));
							Header("Location: ./?hl1=view&id=".$c["id"]."");
							exit();
						}			
						$bind = array();
						$bind[0]["value"] = @$_POST["x_class_table_exec_bc"];
						$bind[1]["value"] = @$_POST["x_class_table_exec_date"];
						$bind[2]["value"] = @$_POST["x_class_table_exec_descr"];
						$object["mysql"]->query("INSERT INTO ".__OBR_TABLE_BOOKR_."(fk_user, fk_book, fk_book_item, tmp_barcode, is_returned, due_date, rent_descr) VALUES('".@$_POST["x_class_table_exec_user"]."', '".$c["id"]."', '".@$_POST["x_class_table_exec_deletetable"]."', ?, 0, ?, ?);", $bind);
						$object["log"]->info("[CHANGE] [BOOK ITEM] [TABLE] ".__OBR_TABLE_BOOKR_." [ID] ".@$_POST["x_class_table_exec_deletetable"]." [UID] ".$object["user"]->user_id."", "view");
						$object["eventbox"]->ok($object["lang"]->translate("be_list_exec_iedit"));
						Header("Location: ./?hl1=view&id=".$c["id"]."");
						exit();						
					} else { $object["eventbox"]->error($object["lang"]->translate("hive_login_msg_csrf"));
							 Header("Location: ./?hl1=view&id=".$c["id"]."");
							 exit(); }
				}
			}
		}		
	
		// No Operations Anymore				
		$c = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOK_." WHERE id = '".$_GET["id"]."'", false); 
		$object["add_top_title"] = htmlspecialchars($c["book_title"] ?? ''); 
		$object["add_head_title"] = $object["add_top_title"];		
		hive__volt_header($object, $object["add_head_title"], @$object["add_head_ext"], @$object["add_head_theme"]);
		hive__volt_nav($object, $object["add_nav_title"], $object["add_nav_button_url"]);	
		echo "<div class='xfpe_margintop15px'></div>";		
	?>
		<style>
			.select2-container {
				z-index: 9999 !important; /* Ensure the container is above SweetAlert */
			}
			.swal2-container {
				z-index: 1050 !important; /* SweetAlert default z-index */
			}
		</style>
		<script>
			// Book Operations
			function obr_popup_syncapi() {
				Swal.fire({
				  title: "",
				  html: `<form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&id=".$c["id"].""; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><?php echo $object["lang"]->translate("be_pp_sapi"); ?><br /><input type='hidden' name='x_class_table_exec_deletetable' value='<?php echo @$_POST["x_class_table_exec_deletetable"]; ?>'><input type='hidden' name='token' value='<?php echo @$object["csrf"]->get(); ?>'><input type='hidden' name='book_item_op_apisy' value='true'><br /><input type='submit' class=\"btn btn-primary\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>`,
				  showCancelButton: false,
				  showCloseButton: true,
				  showConfirmButton: false
				});
			}
			function obr_popup_delete() {
				Swal.fire({
				  title: "",
				  html: `<form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&id=".$c["id"].""; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><?php echo $object["lang"]->translate("be_pp_delbook"); ?><br /><input type='hidden' name='x_class_table_exec_deletetable' value='<?php echo @$_POST["x_class_table_exec_deletetable"]; ?>'><input type='hidden' name='token' value='<?php echo @$object["csrf"]->get(); ?>'><input type='hidden' name='book_item_op_delete' value='true'><br /><input type='submit' class=\"btn btn-danger\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>`,
				  showCancelButton: false,
				  showCloseButton: true,
				  showConfirmButton: false
				});
			}
			function obr_popup_ci() { document.getElementById('obr_img_upload_request').click(); }
			function obr_event_ovr(event) { const file = event.target.files[0]; const form = document.getElementById('obr_img_upload_requestform');	form.submit(); }
			
			// Book Renting Operations		
			function obr_popup_rdelete(current_id) {
				Swal.fire({
				  title: "",
				  html: `<form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&id=".$c["id"].""; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><?php echo $object["lang"]->translate("be_pp_sr1"); ?><br /><input type='hidden' name='x_class_table_exec_deletetable' value='`+current_id+`'><input type='hidden' name='token' value='<?php echo @$object["csrf"]->get(); ?>'><input type='hidden' name='book_item_op_rdelete' value='true'><br /><input type='submit' class=\"btn btn-danger\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>`,
				  showCancelButton: false,
				  showCloseButton: true,
				  showConfirmButton: false
				});
			}	
			<?php if(hive__access($object, "page_deadlines", false)) { ?>
			function obr_popup_rrent(current_id) {
				Swal.fire({
				  title: "",
				  html: `<form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&id=".$c["id"].""; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><input type='hidden' name='x_class_table_exec_deletetable' value='`+current_id+`'><input type='hidden' name='token' value='<?php echo @$object["csrf"]->get(); ?>'><br /><?php echo $object["lang"]->translate("b_returndate"); ?><input type='date' name='x_class_table_exec_date' class='form-control' required><?php echo $object["lang"]->translate("b_note"); ?><input type='text' name='x_class_table_exec_descr' class='form-control'><input type='hidden' name='book_item_op_rrent' value='true'><?php echo $object["lang"]->translate("b_user"); ?><select name="x_class_table_exec_user" class="form-control" id="obru-single-select" required><?php
				  $cxu = $object["mysql"]->select("SELECT * FROM "._TABLE_USER_."", true);
				  if($cxu) {
					  echo '<option></option>';
					  foreach($cxu as $cxuk => $cxuv) {
						  echo '<option value="'.$cxuv["id"].'">';
						  if(!$cxuv["user_firstname"]) { $cxuv["user_firstname"] = ""; }
						  $cxuv["user_firstname"] = str_replace("`", "'", $cxuv["user_firstname"]);
						  if(!$cxuv["user_lastname"]) { $cxuv["user_lastname"] = ""; }
						  $cxuv["user_lastname"] = str_replace("", "", $cxuv["user_lastname"]);
						  echo hive__hsc($cxuv["user_mail"])." ".hive__hsc($cxuv["user_firstname"])." ".hive__hsc($cxuv["user_lastname"]);
						  echo '</option>';
					  }
				  }
				  ?></select><br /><br /><input type='submit' class=\"btn btn-primary\" value='<?php echo htmlentities($object["lang"]->translate("b_lendtouser") ?? ''); ?>'></form>`,
				  showCancelButton: false,
				  showCloseButton: true,
				  showConfirmButton: false
				});

				$('#obru-single-select').select2({
					placeholder: "Select an option",
					allowClear: true
				});
			}
			<?php } ?>			
			function obr_popup_rreturn(current_id) {
				Swal.fire({
				  title: "",
				  html: "<form method='post' action='<?php echo "./?"._HIVE_URL_GET_[0]."="._HIVE_URL_CUR_[0]."&id=".$c["id"].""; ?>'><input type='hidden' name='form_csrf' value='<?php echo $object["csrf"]->get(); ?>'><?php echo $object["lang"]->translate("be_pp_sr1ssd"); ?><br /><input type='hidden' name='x_class_table_exec_deletetable' value='"+current_id+"'><input type='hidden' name='token' value='<?php echo @$object["csrf"]->get(); ?>'><input type='hidden' name='book_item_op_rreturn' value='true'><br /><input type='submit' class=\"btn btn-primary\" value='<?php echo htmlentities($object["lang"]->translate("be_yes") ?? ''); ?>'></form>",
				  showCancelButton: false,
				  showCloseButton: true,
				  showConfirmButton: false
				});
			}			
		</script>
		
		<!-- Hidden Upload form for Images -->
		<form action="./?hl1=view&id=<?php echo $c["id"]; ?>" method="post" id="obr_img_upload_requestform" enctype="multipart/form-data">
			<input type="file" name="file" id="obr_img_upload_request" accept=".jpg" style="display: none;"  onchange="obr_event_ovr(event)" />
			<input type='hidden' name='token' value='<?php echo @$object["csrf"]->get(); ?>'>
			<input type='hidden' name='book_item_op_ciupl' value='true'>
		</form>
		
	<?php
		echo hive__volt_h2(htmlspecialchars($c["book_title"] ?? '').' <a href="./?hl1=list" class="btn btn-primary">'.$object["lang"]->translate("b_backtolist").'</a> ');		
		
		echo '<div class="row">';
			echo '<div class="col-12 col-sm-4 col-xl-4 mb-0 mt-2">';
				hive__volt_box_start($object["lang"]->translate("be_vb_header_ima"), false);
				echo '<center>';
				if(file_exists("./_data/"._HIVE_MODE_."/_public/".$c["id"].".jpg")) {
					echo "<img src='./_data/"._HIVE_MODE_."/_public/".$c["id"].".jpg' style='max-width: 100%;'></img>";
				} else {
					echo "<img src='./_site/"._HIVE_MODE_."/_theme/fallback.png' style='max-width: 100%;'></img>";
				} 
				echo '</center>';
				hive__volt_box_end(); 
			echo '</div>';		
			echo '<div class="col-12 col-sm-8 col-xl-8 mb-0 mt-2">';
				hive__volt_box_start($object["lang"]->translate("be_vb_header_det"), false);
				if($c["book_hide"] == 1) {
					echo hive__volt_alert_info($object["lang"]->translate("b_thisitemcurhiddenlist"));
				}			

				$cr = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKI_." WHERE fk_book = '".$c["id"]."'", true);
				$isavl = false;
				if(is_array($cr)) {
					foreach($cr as $crk => $crv) {
						$cii = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKR_." WHERE fk_book_item = ".$crv["id"]." AND is_returned = 0", false);
						if(!is_array($cii)) {
							$isavl = true;
						}
					}
				} 
				if(!$isavl) { 
					echo hive__volt_alert_warning($object["lang"]->translate("b_bookcurrentlyrented"));
				}
						echo '<form method="post" action="./?hl1=view&id='.$c["id"].'">';
						echo "<input type='hidden' name='token' value='".@$object["csrf"]->get()."'><input type='hidden' name='book_item_op_ch' value='true'>";
						echo '<table class="table table-centered table-nowrap mb-0 rounded obr_hovertable">';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("be_booked_title");
								echo '</td>';
								echo '<td class="border-0">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo '<input type="text" name="book_v_title" value="'.htmlentities($c["book_title"] ?? '').'" class="form-control">';
								} else {
									echo hive__hsc(@$c["book_title"]);
								}
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("be_booked_autor");
								echo '</td>';
								echo '<td class="border-0">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo '<input type="text" name="book_v_autor" value="'.htmlentities($c["book_autor"] ?? '').'" class="form-control">';
								} else {
									echo hive__hsc(@$c["book_autor"]);
								
								}
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("be_booked_type");
								echo '</td>';
								echo '<td class="border-0">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo '<select name="book_v_type" value="'.htmlentities($c["book_type"] ?? '').'" class="form-control">';
										$tmp = "";	
										if($c["book_type"] == 1) { $tmp = "selected"; }
										echo '<option value="1" '.$tmp.'>'.$object["lang"]->translate("b_hardback").'</option>';
										$tmp = "";	
										if($c["book_type"] == 2) { $tmp = "selected"; }
										echo '<option value="2" '.$tmp.'>'.$object["lang"]->translate("b_paperback").'</option>';
										$tmp = "";	
										if($c["book_type"] == 3) { $tmp = "selected"; }
										echo '<option value="3" '.$tmp.'>'.$object["lang"]->translate("b_softcover").'</option>';
									echo '</select>';
								} else {
									if(@$c["book_type"] == 1) {
										$c["book_type"] = $object["lang"]->translate("b_hardback");
									}
									if(@$c["book_type"] == 2) {
										$c["book_type"] = $object["lang"]->translate("b_paperback");
									}
									if(@$c["book_type"] == 3) {
										$c["book_type"] = $object["lang"]->translate("b_softcover");
									}
									echo hive__hsc(@$c["book_type"]);
								
								}
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("be_booked_isbn");
								echo '</td>';
								echo '<td class="border-0">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo '<input type="text" name="book_v_isbn" value="'.htmlentities($c["book_isbn"] ?? '').'" class="form-control">';
								} else {
									echo hive__hsc(@$c["book_isbn"]);
								
								}
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("be_booked_lang");
								echo '</td>';
								echo '<td class="border-0">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo '<input type="text" name="book_v_lang" value="'.htmlentities($c["book_lang"] ?? '').'" class="form-control">';
								} else {
									echo hive__hsc(@$c["book_lang"]);
								
								}
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("be_booked_released");
								echo '</td>';
								echo '<td class="border-0">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo '<input type="text" name="book_v_rel" value="'.htmlentities($c["book_date_release"] ?? '').'" class="form-control">';
								} else {
									echo hive__hsc(@$c["book_date_release"]);
								
								}
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("b_tags");
								echo '</td>';
								echo '<td class="border-0">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo '<select name="book_v_tags[]" class="form-control" multiple >';
										$ctag = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_TAG_."", true);
										if(is_array($ctag)) {
											$tar = @unserialize(@$c["book_tag_array"]);
											foreach($ctag as $ctagk => $ctagv) {
												$tmp = "";
												if(is_array($tar)) { if(in_array($ctagv["id"], $tar)) { $tmp = "selected"; } }
												echo '<option value="'.$ctagv["id"].'" '.$tmp.'>';
												echo hive__hsc($ctagv["tag_title"]);
												echo '</option>';
											}
										}
									echo '</select>';
								} else {
									$tar = @unserialize(@$c["book_tag_array"]);
									if(is_array($tar)) { 
										foreach($tar as $tark => $tarv) { 
											$xx = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_TAG_." WHERE id = ".$tarv."", false);
											if(is_array($xx)) {
												echo "<span style='padding: 5px; margin-right: 5px; background: #1F2937; border-radius: 5px; color: white;'>".hive__hsc($xx["tag_title"])."</span> ";
											}
										}
									}
								}
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("be_booked_pub");
								echo '</td>';
								echo '<td class="border-0">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo '<input type="text" name="book_v_publisher" value="'.htmlentities($c["book_publisher"] ?? '').'" class="form-control">';
								} else {
									echo hive__hsc($c["book_publisher"]);
								
								}
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0" colspan="2">';
								if(@$_GET["op"] == "edit" AND hive__access($object, "page_books", false)) {
									echo $object["lang"]->translate("be_booked_descr")."<br />";
									echo '<textarea name="book_v_descr" class="form-control">'.htmlspecialchars($c["book_descr"] ?? '').'</textarea>';
								} else {
									echo  nl2br(hive__hsc($c["book_descr"]));
								
								}
								echo '</td>';
							echo '</tr>'; 
						if(hive__access($object, "page_books", false)) {
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("b_creation");
								echo '</td>';
								echo '<td class="border-0">';
								echo $c["creation"];
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td class="border-0">';
								echo $object["lang"]->translate("b_lastmodification");
								echo '</td>';
								echo '<td class="border-0">';
								echo $c["modification"];
								echo '</td>';
							echo '</tr>';
						}
						echo '</table><br />';
						if(hive__access($object, "page_books", false)) {
							if(@$_GET["op"] != "edit") {
							echo '<a onclick="obr_popup_syncapi()" class="btn btn-primary">'.$object["lang"]->translate("b_apirequest").'</a> ';
							echo '<a onclick="obr_popup_ci()" class="btn btn-primary">'.$object["lang"]->translate("b_changeimage").'</a> ';
							echo '<a href="./?hl1=view&id='.$c["id"].'&op=edit" class="btn btn-primary">'.$object["lang"]->translate("b_edit").'</a> '; 
							if($c["book_hide"] == 1) {
								//echo '<a onclick="obr_popup_unhide()" class="btn btn-primary">'.$object["lang"]->translate("b_unhide").'</a> ';
							} else {
								//echo '<a onclick="obr_popup_hide()" class="btn btn-primary">'.$object["lang"]->translate("b_hide").'</a> ';
							}
							echo '<a onclick="obr_popup_delete()" class="btn btn-danger">'.$object["lang"]->translate("b_delete").'</a>';
							} else {
								echo '<input type="submit" class="btn btn-primary" value="'.hive__hen($object["lang"]->translate("b_edit")).'"> ';
								echo '<a href="./?hl1=view&id='.$c["id"].'" class="btn btn-danger">'.$object["lang"]->translate("be_cancel").'</a>';
							}
						} echo '</form>';
				hive__volt_box_end();				
			echo '</div>';
		echo '</div>';
		
		// Div with Top Margin for Elements!
		echo "<div class='xfpe_margintop15px'></div>";	
		
		// Show Quantity and Allow Rental Operation
		if(hive__access($object, array("page_deadlines", "page_books"), false)) {
			hive__volt_box_start($object["lang"]->translate("be_vb_header_rentc"), false);
			if(hive__access($object, array("page_books"), false)) {
				echo '<form method="post" action="./?hl1=view&id='.$c["id"].'">';
					echo '<input type="hidden" value="true" name="obr_book_add_item"> ';
					echo '<input type="hidden" value="'.$object["csrf"]->get().'" name="token"> ';
					echo '<input type="text" name="obr_book_add_itemc" class="form-control-sm" placeholder="'.$object["lang"]->translate("b_barcode").'" required> ';
					echo '<input type="submit" class="btn btn-primary" value="'.hive__hen($object["lang"]->translate("b_add")).'">';
				echo '</form>';		
			}
			$cr = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKI_." WHERE fk_book = '".$c["id"]."'", true);
			$runis = false;
			if(is_array($cr)) {
				echo '<table class="table table-centered table-nowrap mb-0 rounded obr_hovertable">';
					echo '<tr>';
					echo '<td>'.$object["lang"]->translate("b_id").'</td>';
					echo '<td>'.$object["lang"]->translate("b_barcode").'</td>';
					echo '<td>'.$object["lang"]->translate("b_status").'</td>';
					echo '<td>'.$object["lang"]->translate("b_action").'</td>';
					echo '</tr>';		
				foreach($cr as $crk => $crv) {
					$runis = true;
					echo '<tr>';
					echo '<td>'.$crv["id"].'</td>';
					echo '<td>'.hive__hsc(@$crv["book_barcode"]).'</td>';
					echo '<td>';
					$cii = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKR_." WHERE fk_book_item = ".$crv["id"]." AND is_returned = 0", false);		
					if(is_array($cii)) {
						$is_returned = 0;
						echo '<span class="badge bg-warning">'.$object["lang"]->translate("b_reserved").'</span><br />';
						echo $object["lang"]->translate("b_user").'';
						echo ' <a href="./?hl1=profile&id='.$cii["fk_user"].'">#'.hive__hsc($cii["fk_user"])."</a>";
						echo '<br />';
						echo $object["lang"]->translate("b_until").'';
						echo ' '.adm_date_format($cii["due_date"]);
						echo '<br />';
						echo $object["lang"]->translate("b_note").'';
						echo ' '.hive__hsc($cii["rent_descr"]);
						echo '<br />';
					} else {
						$is_returned = 1;
						echo '<span class="badge bg-success">'.$object["lang"]->translate("b_available").'</span>';
					}
					echo '</td>';
					echo '<td>';
					if(!$is_returned) {
						if(hive__access($object, array("page_deadlines"), false)) { echo '<button onclick="obr_popup_rreturn('.$cii["id"].')" class="btn btn-primary">'.$object["lang"]->translate("b_return").'</button> '; }
					} else {
						if(hive__access($object, array("page_deadlines"), false)) { echo '<button onclick="obr_popup_rrent('.$crv["id"].')" class="btn btn-primary">'.$object["lang"]->translate("b_lend").'</button> '; }
					}
					if(hive__access($object, array("page_books"), false)) { echo '<button onclick="obr_popup_rdelete('.$crv["id"].')" class="btn btn-danger">'.$object["lang"]->translate("b_delete").'</button>'; }
					echo '</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			if(!$runis) { echo "<br />".hive__volt_alert_warning($object["lang"]->translate("b_nolistcurrent")); }
			hive__volt_box_end();	
			// Div with Top Margin for Elements!
			echo "<div class='xfpe_margintop15px'></div>";	
		}
		
		// Show Log of old Rents of this Book.
		if(hive__access($object, array("page_deadlines", "page_books"), false)) {
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// Log Show Old Returnals
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$value_array = $object["mysql"]->select("SELECT fk_book, fk_book_item, due_date, rent_descr, is_returned, return_date, fk_user, id FROM ".__OBR_TABLE_BOOKR_." WHERE fk_book = ".$c["id"]." AND is_returned = 1", true);
				hive__volt_box_start($object["lang"]->translate("be_vb_header_log"), false);
				echo "<table class='obr_datatable_init_class'>";
					echo "<thead>";
						echo "<tr>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_user"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_barcode"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_returndate"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("be_table_header_duedate"))."</th>";
							echo "<th>".hive__hsc($object["lang"]->translate("b_description"))."</th>";
						echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
				if(is_array($value_array)) {
					foreach($value_array as $k => $v) {
						$b = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOK_." WHERE id = ".$v["fk_book"]."");
						$bi = $object["mysql"]->select("SELECT * FROM ".__OBR_TABLE_BOOKI_." WHERE id = ".$v["fk_book_item"]."");
						echo "<tr>";
							echo "<td><a href='./?hl1=profile&id=".$v["fk_user"]."'>UID#".hive__hsc($v["fk_user"])."</a></td>";
							echo "<td>".hive__hsc(@$bi["book_barcode"])."</td>";
							if(@$v["return_date"]) { echo "<td>".adm_date_format($v["return_date"])."</td>"; }
								else { echo "<td>"."</td>"; }
							echo "<td>".adm_date_format($v["due_date"])."</td>";
							echo "<td>".hive__hsc($v["rent_descr"])."</td>";
						echo "</tr>";
					}
				}
				echo "</table>";
				echo "</tbody>";
				hive__volt_box_end();	
		}
		
