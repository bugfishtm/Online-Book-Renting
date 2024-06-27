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
	*/
	if(!is_array(@$object)) { Header("Location: ../"); exit(); }		
	#############################################################################################################################################
	// Buildup Elements
	#############################################################################################################################################
	function hive__adminbsb_end($object) { return '</div></section>'; }	
	function hive__adminbsb_start($object) { return '<section class="content" id="adminbsb_content_start"><div class="container-fluid">'; } 
	function hive__adminbsb_footer($object) { return '</body></html>'; }


	
	function hive__adminbsb_header($object, $tabtitle = "", $metaextensions = "", $defaultclasses = true) { 
		// Change Theme Operation for a User
		$change_mtheme = false;
		if(@$_GET["hive__db_theme"]) { $change_mtheme = @$_GET["hive__db_theme"]; } 
		if($change_mtheme) {
			if($object["user"]->user_loggedIn) {
				hive__user_theme_set($object, $object["user"]->user_id, _HIVE_MODE_, $change_mtheme);
			}	
			@$_SESSION[_HIVE_SITE_COOKIE_."hive_theme"] = $change_mtheme;
			// Program to display URL of current page.
			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
			{$link = "https";}
			else
			{$link = "http";}
			// Here append the common URL characters.
			$link .= "://";
			// Append the host(domain name, ip) to the URL.
			$link .= $_SERVER['HTTP_HOST'];
			// Append the requested resource location to the URL
			$link .= $_SERVER['REQUEST_URI'];
			$link = substr($link, 0, strpos($link, "&hive__db_theme"));
			$object["eventbox"]->ok($object["lang"]->translate("admin_top_t_theme_changed"));
			Header("Location: ".$link);  
			exit();
		} 	
		// Change Language Operation for a User
		$change_lang = false;
		if(@in_array(@$_GET["hive__change_lang"], _HIVE_LANG_ARRAY_)) { $change_lang = @$_GET["hive__change_lang"];  } 
		if($change_lang) {  
			if($object["user"]->user_loggedIn) {
				hive__user_lang_set($object, $object["user"]->user_id, _HIVE_MODE_, $change_lang);			
			} $_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = $change_lang; 
			
			// Program to display URL of current page.
			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
			{$link = "https";}
			else
			{$link = "http";}
			// Here append the common URL characters.
			$link .= "://";
			// Append the host(domain name, ip) to the URL.
			$link .= $_SERVER['HTTP_HOST'];
			// Append the requested resource location to the URL
			$link .= $_SERVER['REQUEST_URI'];
			$link = substr($link, 0, strpos($link, "&hive__change_lang"));
			$object["eventbox"]->ok($object["lang"]->translate("admin_top_t_lang_changed"));
			Header("Location: ".$link);
			exit();			
		} 	?><!DOCTYPE html>
		<html>
		<head>
			<!-- Charset -->
			<meta charset="UTF-8">
			<!-- XUA Meta -->
			<meta http-equiv="X-UA-Compatible" content="IE=Edge">
			<!-- Initial Scale -->
			<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			<!-- Initial Meta -->
			<title><?php echo $tabtitle; ?><?php if(_HIVE_TITLE_SPACER_ != false) { echo _HIVE_TITLE_SPACER_; } ?><?php if(is_string(_HIVE_TITLE_)) { echo _HIVE_TITLE_; } ?></title>
			
			<?php if($defaultclasses) { ?>
			<!-- Materialize Font Loader Css -->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_site/<?php echo _HIVE_MODE_; ?>/_theme/css_materialize.css" rel="stylesheet">
			<!-- Materialize Core Css -->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_site/<?php echo _HIVE_MODE_; ?>/_theme/css_materialize_main.css" rel="stylesheet">
			<!-- Bootstrap Core Css -->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bootstrap3/css/bootstrap.css" rel="stylesheet">
			<!-- Waves Effect Css -->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/node-waves/waves.css" rel="stylesheet" />
			<!-- Animation Css -->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/animate-css/animate.css" rel="stylesheet" />
			<!-- Morris Css-->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/morrisjs/morris.css" rel="stylesheet" />
			<!-- Morris Css-->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_site/<?php echo _HIVE_MODE_; ?>/_theme/css_adminbsb.css" rel="stylesheet" />
			<!-- Morris Css-->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_site/<?php echo _HIVE_MODE_; ?>/_theme/css_mainstyle.css" rel="stylesheet" />
			<!-- Datatables Css-->
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/jq.datatables.css">
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/skin/bootstrap/css/dataTables.bootstrap.css">
			<!-- Bugfish Sortselect Css-->
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-jquery-sortselect/jquery.multiselect.sortable.js.css">
			<!-- SweetAlert Css-->
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/sweetalert2/sweetalert2.min.css">
			
			<!-- Jquery Core Js -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/jquery/jquery.min.js"></script>
			<!-- Bootstrap Core Js -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bootstrap3/js/bootstrap.js"></script>
			<!-- Slimscroll Plugin Js -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/jquery-slimscroll/jquery.slimscroll.js"></script>
			<!-- Waves Effect Plugin Js -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/node-waves/waves.js"></script>
			<!-- Jquery CountTo Plugin Js -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/jquery-countto/jquery.countTo.js"></script>
			<!-- Raphael Plugin Js -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/raphael/raphael.min.js"></script>
			<!-- Morris Plugin Js -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/morrisjs/morris.js"></script>
			<!-- ChartJs -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/chartjs/Chart.bundle.js"></script>
			<!-- Resumable JS -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/resumable/resumable.js"></script>	
			<!-- Datatables JS -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/jq.datatables.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/skin/bootstrap/js/dataTables.bootstrap.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/extensions/export/dataTables.buttons.min.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/extensions/export/buttons.flash.min.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/extensions/export/jszip.min.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/extensions/export/pdfmake.min.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/extensions/export/vfs_fonts.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/extensions/export/buttons.html5.min.js"></script>	
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/extensions/export/buttons.print.min.js"></script>	
			<!-- TinyMCE JS -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/tinymce/tinymce.min.js"></script>	
			<!-- Sweetalert JS -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/sweetalert2/sweetalert2.all.min.js"></script>	
			<?php } ?>
			
			<!-- User Defined Meta Extensions -->
			<?php echo $metaextensions; ?>
			
			<!-- Framework Javascript Loader -->
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/javascript.php"></script>
			<!-- Framework Stylesheet Loader -->
			<link href="<?php echo _HIVE_URL_REL_; ?>/_core/stylesheet.php"  rel="stylesheet">
		</head>

		<body class="theme-<?php echo _HIVE_THEME_; ?>">
			<!-- Page Loader -->
			<div class="page-loader-wrapper">
				<div class="loader">
					<div class="preloader">
						<div class="spinner-layer pl-red">
							<div class="circle-clipper left">
								<div class="circle"></div>
							</div>
							<div class="circle-clipper right">
								<div class="circle"></div>
							</div>
						</div>
					</div>
					<p>Please wait...</p>
				</div>
			</div>		
			<!-- #END# Page Loader -->
			<!-- Overlay For Sidebars -->
			<div class="overlay"></div>
			<!-- #END# Overlay For Sidebars -->		
	<?php }
	function hive__adminbsb_nav($object, $pfm = false, $footertext = false, $hideuserarea = false, $userimg = "/_core/_image/user_image.png") {  ?>
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
			<?php if(!$hideuserarea) { ?>
            <div class="user-info" style="background: url(./_core/_image/user-admin-background.jpg);">
                <div class="image">
                    <img src="<?php echo _HIVE_URL_REL_.$userimg; ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $object["lang"]->translate("admin_top_t_ident"); ?>: #<?php echo htmlspecialchars($object["user"]->user["id"]); ?></div>
                    <div class="email"><?php echo htmlspecialchars($object["user"]->user["user_mail"]); ?></div>
					<?php if(is_array($pfm)) { ?>	
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
							<?php foreach($pfm as $key => $value) { ?>	
								<li><a href="<?php echo $value["nav_loc"]; ?>"><i class="material-icons"><?php echo $value["nav_img"]; ?></i><?php echo $value["nav_title"]; ?></a></li>
								<!--<li role="seperator" class="divider"></li>-->
							<?php } ?>
                        </ul>
                    </div>
					<?php } ?>
                </div>
            </div>
			<?php } ?>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">	
					<?php foreach($object["nav"] as $key => $value) { ?>	
						<?php if(is_array(@$value["nav_sub"])) {  ?>
							<li class="<?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "active"; } ?>">	
								<a href="javascript:void(0);" class="menu-toggle">
									<i class="material-icons"><?php echo $value["nav_img"]; ?></i>
									<span><?php echo $value["nav_title"]; ?></span>
								</a>
								<ul class="ml-menu" <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo " style=\"display: block;\"	"; } ?>>				
									<?php foreach($value["nav_sub"] as $key => $valuex) { ?>	
										<li class="<?php if(_HIVE_URL_CUR_[1] == $valuex["nav_act"] AND _HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "active";} ?>">
											<a href="<?php echo $valuex["nav_loc"]; ?>"><?php echo $valuex["nav_title"]; ?></a>
										</li>
									<?php } ?>
								</ul>
							</li>	
						<?php } elseif(@$value["nav_header"]) { ?>
							<li class="header">
									<?php echo $value["nav_title"]; ?>
								</a>
							</li>	
						<?php } else {  ?>
							<li class="<?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "active";} ?>">
								<a href="<?php echo $value["nav_loc"]; ?>">
									<i class="material-icons"><?php echo $value["nav_img"]; ?></i>
									<span><?php echo $value["nav_title"]; ?></span>
								</a>
							</li>	
						<?php }  ?>
						
						<?php }  ?>
                    </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <?php
					echo $footertext; 
				?>
            </div>
            <!-- #Footer -->
        </aside>
    </section>	  
	<?php }
	
	function hive__adminbsb_topbar($object, $title = "", $theme_changer = false, $lang_ar = false, $notify_ar = false, $modulechooser = false, $cal_ar = false, $search = false) {  ?>
		<nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars" style="display: none;"></a>
                <a class="navbar-brand" href="#"><?php echo $title; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- To Top Arrow  -->
                    <li class="dropdown">
                        <a href="#" onclick="window.scrollTo({top: 0,behavior: 'smooth'});" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <i class="material-icons">keyboard_arrow_up</i>
                        </a>
                    </li> 
                    <!-- #END# To Top Arrow -->
					<?php if($search) {  ?>
                    <!-- Search  -->
                    <li class="dropdown">
                        <a href="#" onclick="window.scrollTo({top: 0,behavior: 'smooth'});" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <i class="material-icons">search</i>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="header"><?php echo $object["lang"]->translate("admin_top_t_search"); ?></li>
                            <li class="body">
                                <ul class="menu" style="overflow: hidden; width: auto; height: 100px;padding: 15px;">

                                    <li>
										<form method="get">
										<input type="hidden" name="<?php echo _HIVE_URL_GET_[0]; ?>" value="<?php echo $search; ?>">
										<input type="text" class="form-control" name="search" style="margin-bottom: 5px;" placeholder="<?php echo $object["lang"]->translate("admin_top_t_search_submit"); ?>">
										<input type="submit" class="btn btn-primary" value="<?php echo $object["lang"]->translate("admin_top_t_search_submit"); ?>">
										</form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> 
                    <!-- #END# Search -->
					<?php }  ?>
					<?php if(is_array($notify_ar)) {  ?>
                    <!-- Notifications  -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <i class="material-icons">notifications</i>
                            <span class="label-count"><?php echo count($notify_ar); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo $object["lang"]->translate("admin_top_t_notify"); ?></li>
                            <li class="body">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 204px;"><ul class="menu" style="overflow: hidden; width: auto; height: 254px;">
									<?php foreach($notify_ar as $key => $value) { ?>
                                    <li>
                                        <a href="<?php echo @$value["url"]; ?>" class=" waves-effect waves-block">
                                            <div class="menu-info">
                                                <h4><?php echo @$value["name"]; ?></h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> <?php echo @$value["time"]; ?>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
									<?php } ?>
									<?php if(count($notify_ar) == 0) { ?>
                                    <li>
                                        <a href="#" class=" waves-effect waves-block">
                                            <div class="menu-info">
                                                <h4><?php echo $object["lang"]->translate("admin_top_t_nolist"); ?></h4>
                                            </div>
                                        </a>
                                    </li>
									<?php } ?>
                                </ul><div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 180.212px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                            <li class="footer">
                                <a href="<?php echo $object["lang"]->translate("admin_top_t_notify_url"); ?>" class=" waves-effect waves-block"><?php echo $object["lang"]->translate("admin_top_t_notify_a"); ?></a>
                            </li>
                        </ul>
                    </li> 
                    <!-- #END# Notifications -->
					
					<?php }  ?>
					
					<?php if(is_array($cal_ar)) {  ?>
                    <!-- Notifications  -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <i class="material-icons">calendar_month</i>
                            <span class="label-count"><?php echo count($cal_ar); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo $object["lang"]->translate("admin_top_t_cal"); ?></li>
                            <li class="body">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 204px;"><ul class="menu" style="overflow: hidden; width: auto; height: 254px;">
									<?php foreach($cal_ar as $key => $value) { ?>
                                    <li>
                                        <a href="<?php echo @$value["url"]; ?>" class=" waves-effect waves-block">
                                            <div class="menu-info">
                                                <h4><?php echo @$value["name"]; ?></h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> <?php echo @$value["time"]; ?>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
									<?php } ?>
									<?php if(count($cal_ar) == 0) { ?>
                                    <li>
                                        <a href="#" class=" waves-effect waves-block">
                                            <div class="menu-info">
                                                <h4><?php echo $object["lang"]->translate("admin_top_t_nolist"); ?></h4>
                                            </div>
                                        </a>
                                    </li>
									<?php } ?>
                                </ul><div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 180.212px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                            <li class="footer">
                                <a href="<?php echo $object["lang"]->translate("admin_top_t_cal_url"); ?>" class=" waves-effect waves-block"><?php echo $object["lang"]->translate("admin_top_t_cal_a"); ?></a>
                            </li>
                        </ul>
                    </li> 
                    <!-- #END# Notifications -->
					
					<?php }  ?>
                    <!-- Tasks -->
					<?php 
						if(!isset($_SESSION[_HIVE_SITE_COOKIE_."section_admin_change"])) { $_SESSION[_HIVE_SITE_COOKIE_."section_admin_change"] = "*"; }
						if($modulechooser) {  
						if(in_array(@$_GET["hive__change_tmode"], _HIVE_MODE_ARRAY_)) { 
							$_SESSION[_HIVE_SITE_COOKIE_."section_admin_change"] = @$_GET["hive__change_tmode"];
							$object["eventbox"]->ok($object["lang"]->translate("admin_top_t_mod_changed"));
						} else {
							$_SESSION[_HIVE_SITE_COOKIE_."section_admin_change"] = "*";
						}
					
					?>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <i class="material-icons">category</i>
							<?php if($_SESSION[_HIVE_SITE_COOKIE_."section_admin_change"] != "*") { ?>  <span class="label-count">!</span> <?php } ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo $object["lang"]->translate("admin_top_t_mod"); ?></li>
                            <li class="body">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 204px;"><ul class="menu tasks" style="overflow-y: scroll; width: auto; height: 254px;">

                                    <li>
                                        <a href="<?php echo './?'._HIVE_URL_GET_[0].'='._HIVE_URL_CUR_[0].'&'._HIVE_URL_GET_[1].'='._HIVE_URL_CUR_[1].'&hive__change_tmode=*'; ?>" class=" waves-effect waves-block">
                                            <div class="menu-info">
                                                <?php echo "*"; ?>
												<?php if("*" == $_SESSION[_HIVE_SITE_COOKIE_."section_admin_change"]) { ?><p><?php echo $object["lang"]->translate("admin_top_t_cur"); ?></p><?php } ?>
                                            </div>
                                        </a>
                                    </li>
		
								<?php foreach(_HIVE_MODE_ARRAY_ as $key => $value) {  ?>
                                    <li>
                                        <a href="<?php echo './?'._HIVE_URL_GET_[0].'='._HIVE_URL_CUR_[0].'&'._HIVE_URL_GET_[1].'='._HIVE_URL_CUR_[1].'&hive__change_tmode='.$value; ?>" class=" waves-effect waves-block">
                                            <div class="menu-info">
                                                <?php echo $value; ?>
												<?php if($value == $_SESSION[_HIVE_SITE_COOKIE_."section_admin_change"]) { ?><p><?php echo $object["lang"]->translate("admin_top_t_cur"); ?></p><?php } ?>
                                            </div>
                                        </a>
                                    </li>
								<?php }  ?>



                                </ul><div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 252.016px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                        </ul>
                    </li>
					<?php }  ?>
					<?php if($lang_ar) {  ?>
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <i class="material-icons">flag</i>
							<span class="label-count"><?php echo _HIVE_LANG_; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo $object["lang"]->translate("admin_top_t_lang"); ?></li>
                            <li class="body">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 204px;"><ul class="menu tasks" style="overflow-y: scroll; width: auto; height: 254px;">

		
								<?php foreach($lang_ar as $key => $value) {  ?>
                                    <li>
                                        <a href="<?php echo './?'._HIVE_URL_GET_[0].'='._HIVE_URL_CUR_[0].'&'._HIVE_URL_GET_[1].'='._HIVE_URL_CUR_[1].'&hive__change_lang='.$value["ident"]; ?>" class=" waves-effect waves-block">
                                            <div class="icon-circle">
                                                <img src="<?php echo $value["img"]; ?>">
                                            </div>
                                            <div class="menu-info">
                                                <?php echo $value["name"]; ?>
												<?php if($value["ident"] == _HIVE_LANG_) { ?><p><?php echo $object["lang"]->translate("admin_top_t_cur"); ?></p><?php } ?>
                                            </div>
                                        </a>
                                    </li>
								<?php }  ?>



                                </ul><div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 252.016px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                        </ul>
                    </li>
					<?php }  ?>
					<?php if($theme_changer) { ?>
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                            <i class="material-icons">draw</i>
                        </a>
                        <ul class="dropdown-menu"> 
                            <li class="header"><?php echo $object["lang"]->translate("admin_top_t_theme"); ?></li>
                            <li class="body">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 204px;"><ul class="menu tasks " style="overflow-y: scroll; width: auto; height: 254px;">

		
								<?php foreach(_HIVE_THEME_ARRAY_ as $key => $value) {   
                                   echo ' <li data-theme="'.$value.'" style="cursor:pointer;padding-top: 5px; padding-bottom: 5px;" class="bg-'.$value.' waves-effect waves-block" onclick="window.location.href=\'./?'._HIVE_URL_GET_[0].'='._HIVE_URL_CUR_[0].'&'._HIVE_URL_GET_[1].'='._HIVE_URL_CUR_[1].'&hive__db_theme='.$value.'\';">'; ?>
                                            <div class="menu-info">
                                                <span><?php echo $value; ?></span>
												<?php if($value == _HIVE_THEME_) { ?><p class="bg-white" style="padding: 2px; border-radius: 2px;"><?php echo $object["lang"]->translate("admin_top_t_cur"); ?></p><?php } ?>
                                            </div>
                                    </li>
								<?php }  ?>


                                </ul><div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 252.016px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                        </ul>
                    </li>
					<?php } ?>
                </ul>
            </div>
        </div>
    </nav>
	
	<?php }        
	#############################################################################################################################################
	// Label Boxes
	#############################################################################################################################################
	function hive__adminbsb_label_danger($message, $classes = "") { return '<span class="label label-danger '.$classes.'">'.$message.'</span>';	}
	function hive__adminbsb_label_success($message, $classes = "") { return '<span class="label label-success '.$classes.'">'.$message.'</span>'; }
	function hive__adminbsb_label_warning($message, $classes = "") { return '<span class="label label-warning '.$classes.'">'.$message.'</span>'; }
	function hive__adminbsb_label_info($message, $classes = "") { return '<span class="label label-info '.$classes.'">'.$message.'</span>'; }
	function hive__adminbsb_label_primary($message, $classes = "") { return '<span class="label label-primary bg-'._HIVE_THEME_.' '.$classes.'">'.$message.'</span>'; }
	function hive__adminbsb_label_secondary($message, $classes = "") { return '<span class="label label-secondary '.$classes.'">'.$message.'</span>'; }
	#############################################################################################################################################
	// Heading Elements
	#############################################################################################################################################
	function hive__adminbsb_h1($message, $classes = "") { return '<h1 class="'.$classes.'">'.$message.'</h1>'; }
	function hive__adminbsb_h2($message, $classes = "") { return '<h2 class="'.$classes.'">'.$message.'</h2>'; }
	function hive__adminbsb_h3($message, $classes = "") { return '<h3 class="'.$classes.'">'.$message.'</h3>'; }
	function hive__adminbsb_h4($message, $classes = "") { return '<h4 class="'.$classes.'">'.$message.'</h4>'; }
	function hive__adminbsb_h5($message, $classes = "") { return '<h5 class="'.$classes.'">'.$message.'</h5>'; }
	#############################################################################################################################################
	// Modal Elements
	#############################################################################################################################################
	function hive__adminbsb_modal($text, $title = false, $icon = "info", $closebutton = "true") { ?>
		<script>
			$( document ).ready(function() {
				Swal.fire({
				 <?php if($title) { ?> title: '<?php echo $title; ?>', <?php } ?>
				  <?php if($icon) { ?>icon: '<?php echo $icon; ?>',<?php } ?>
				  html:
					`<?php echo str_replace("`", "\\`", $text); ?>`,
				  showCloseButton: <?php echo $closebutton; ?>
				});
			});
		</script>
	<?php }			
	#############################################################################################################################################
	// Alert Boxes
	#############################################################################################################################################
	function hive__adminbsb_alert_danger($message, $classes = "") { return '<div class="alert alert-danger '.$classes.'">'.$message.'</div>';	}
	function hive__adminbsb_alert_success($message, $classes = "") { return '<div class="alert alert-success '.$classes.'">'.$message.'</div>'; }
	function hive__adminbsb_alert_warning($message, $classes = "") { return '<div class="alert alert-warning '.$classes.'">'.$message.'</div>'; }
	function hive__adminbsb_alert_info($message, $classes = "") { return '<div class="alert alert-info '.$classes.'">'.$message.'</div>'; }
	function hive__adminbsb_alert_primary($message, $classes = "") { return '<div class="alert alert-primary bg-'._HIVE_THEME_.' '.$classes.'">'.$message.'</div>'; }
	function hive__adminbsb_alert_secondary($message, $classes = "") { return '<div class="alert alert-secondary '.$classes.'">'.$message.'</div>'; }
	#############################################################################################################################################
	// Badge Boxes
	#############################################################################################################################################
	function hive__adminbsb_badge_danger($message, $classes = "") { return '<span class="badge badge-danger '.$classes.'">'.$message.'</span>';	}
	function hive__adminbsb_badge_success($message, $classes = "") { return '<span class="badge badge-success '.$classes.'">'.$message.'</span>'; }
	function hive__adminbsb_badge_warning($message, $classes = "") { return '<span class="badge badge-warning '.$classes.'">'.$message.'</span>'; }
	function hive__adminbsb_badge_info($message, $classes = "") { return '<span class="badge badge-info '.$classes.'">'.$message.'</span>'; }
	function hive__adminbsb_badge_primary($message, $classes = "") { return '<span class="badge badge-primary bg-'._HIVE_THEME_.' '.$classes.'">'.$message.'</span>'; }
	function hive__adminbsb_badge_secondary($message, $classes = "") { return '<span class="badge badge-secondary '.$classes.'">'.$message.'</span>'; }
	#############################################################################################################################################
	// Box Elements
	#############################################################################################################################################
	function hive__adminbsb_box_start($header = false, $mainclass = "", $headerclass = "", $bodyclass = "") { 
		if($headerclass == false) { $headerclass = ""; }
		if($bodyclass == false) { $bodyclass = ""; }
		if($mainclass == false) { $mainclass = ""; }
       $output =  '<div class="card '.$mainclass.'">';
		    if($header) { 
				$output .=  '<div class="header '.$headerclass.'">'.$header.'</div>';
			} 
		$output .=  '<div class="body '.$bodyclass.'">';	
		return $output; }
	function hive__adminbsb_box_end() { return '</div></div>'; }	
	function hive__adminbsb_box($text, $header = false, $mainclass = "", $headerclass = "", $bodyclass = "") { 
		if($headerclass == false) { $headerclass = ""; }
		if($bodyclass == false) { $bodyclass = ""; }
		if($mainclass == false) { $mainclass = ""; }
       $output =  '<div class="card '.$mainclass.'">';
		    if($header) { 
				$output .=  '<div class="header '.$headerclass.'">'.$header.'</div>';
			} 
			$output .=  '<div class="body '.$bodyclass.'">';	
			$output .=  $text;	
			$output .=  '</div>';	
		$output .=  '</div>';	
		return $output; }	
	#############################################################################################################################################
	// Button Elements
	#############################################################################################################################################
	function hive__adminbsb_button_danger($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-danger '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_success($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-success '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_warning($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-warning '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_info($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-info '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_primary($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-primary '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	function hive__adminbsb_button_secondary($text , $type = "button", $name = "", $js = "", $classes = "") { 
		if($type == false) { $type = "button"; }
		if($classes == false) { $classes = ""; }
		if($js == false) { $js = ""; }
		if($name == false) { $name = ""; }
		return '<button class="btn btn-secondary '.$classes.'" name="'.$name.'" onClick="'.$js.'" type="'.$type.'">'.$text.'</button>';	}
	#############################################################################################################################################
	// Error Elements
	#############################################################################################################################################
	function hive__adminbsb_404($object, $text = "The requested page does not exist.", $title = "<h2>ERROR 404</h2>", $mainclass = "", $headerclass = "", $bodyclass = "") { 
		if($headerclass == false) { $headerclass = ""; }
		if($bodyclass == false) { $bodyclass = ""; }
		if($mainclass == false) { $mainclass = ""; }
		return hive__adminbsb_box($text, $title, $mainclass, $headerclass, $bodyclass); }	
	function hive__adminbsb_401($object, $text = "You do not have permission to view this page! :(", $title = "ERROR 401", $mainclass = "", $headerclass = "", $bodyclass = "") { 
		if($headerclass == false) { $headerclass = ""; }
		if($bodyclass == false) { $bodyclass = ""; }
		if($mainclass == false) { $mainclass = ""; }
		return hive__adminbsb_box($text, $title, $mainclass, $headerclass, $bodyclass); }	