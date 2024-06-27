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
	*/ if(!is_array(@$object)) { @http_response_code(@404); @Header("Location: ../"); exit(); }			
	#############################################################################################################################################
	// Header Elements
	#############################################################################################################################################	
	function hive__volt_footer($object, $footer = "", $classes = "bg-white rounded shadow p-5 mb-3 mt-3", $end_div = true) { ?>
			<?php if($end_div) { ?></div><?php } ?>
			<!-- End of modal backdrop -->
			<?php if($footer != "" AND $footer != false) { ?><footer id="web_footer" class="<?php echo $classes; ?>">
				<?php echo $footer; ?>
				</footer>
				<?php } ?>
				 </main>
		  </body>
		</html>	
	<?php }	
	function hive__volt_header($object, $tabtitle = "", $metaextensions = "", $theme_default = "dark", $mainclass = "", $defaultclasses = true) { 
		if(!isset($_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"])) {
			$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] = $theme_default; 
			if($object["user"]->user_loggedIn) {
				if(isset($object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] )) {
					if($object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] == "dark" OR $object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"] == "false") {
						$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] = $object["user"]->user["hive_extradata"][_HIVE_MODE_]["theme_sub"];
					}
				}
			}
		}		
				
		$change_theme = false;
		if(@$_GET["hive__db_cst"] == "dark") { $change_theme = "dark"; }
		if(@$_GET["hive__db_cst"] == "light") { $change_theme = "false"; }    
		if($change_theme) {
			if($object["user"]->user_loggedIn) {
				hive__user_theme_sub_set($object, $object["user"]->user_id, _HIVE_MODE_, $change_theme);
			}	
			$_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] = $change_theme;
			
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

			$link = substr($link, 0, strpos($link, "&hive__db_cst"));
			$object["eventbox"]->info($object["lang"]->translate("g_themetesu"));

			Header("Location: ".$link);   
			exit();
		} 
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
			$object["eventbox"]->info($object["lang"]->translate("g_themete"));

			Header("Location: ".$link);  
			exit();
		} 	
		$change_mctheme = false;
		if(@$_GET["hive__db_color"]) { $change_mctheme = @$_GET["hive__db_color"]; } 
		if($change_mctheme) {
			if($object["user"]->user_loggedIn) {
				hive__user_color_set($object, $object["user"]->user_id, _HIVE_MODE_, $change_mctheme);
			}	
			@$_SESSION[_HIVE_SITE_COOKIE_."hive_color"] = $change_mctheme;
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

			$link = substr($link, 0, strpos($link, "&hive__db_color"));
			$object["eventbox"]->info($object["lang"]->translate("g_themeco"));
			Header("Location: ".$link);  
			exit();
		} 						
		$change_lang = false;
		if(@in_array(@$_GET["hive__change_lang"], _HIVE_LANG_ARRAY_)) { $change_lang = @$_GET["hive__change_lang"];  } 
		if($change_lang) {  
			if($object["user"]->user_loggedIn) {
				hive__user_lang_set($object, $object["user"]->user_id, _HIVE_MODE_, $change_lang); 
			}	
			$_SESSION[_HIVE_SITE_COOKIE_."hive_language"] = $change_lang; 
			

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

			$object["eventbox"]->info($object["lang"]->translate("g_themela"));
			Header("Location: ".$link);
			exit();			
		} 
		if($_SESSION[_HIVE_SITE_COOKIE_."hive_dashboard_subtheme"] == "dark") {$now_theme = "dark";} else {$now_theme = "false";} ?>
		<!DOCTYPE html>
		<html lang="en">
		<head> 
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta charset="UTF-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta name="title" content="<?php echo htmlentities($tabtitle); ?><?php if(_HIVE_TITLE_SPACER_ != false) { echo _HIVE_TITLE_SPACER_; } ?><?php if(is_string(_HIVE_TITLE_)) { echo @htmlentities(_HIVE_TITLE_); } ?>">
			<title><?php echo $tabtitle; ?><?php if(_HIVE_TITLE_SPACER_ != false) { echo _HIVE_TITLE_SPACER_; } ?><?php if(is_string(_HIVE_TITLE_)) { echo _HIVE_TITLE_; } ?></title>
			
			<?php if($defaultclasses) { ?>
				<!-- Default CSS Includes -->
				<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/notyf/notyf.min.css">
				<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/boxicons/boxicons.css">
				<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/volt/volt.css">
				<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-jquery-sortselect/jquery.multiselect.sortable.js.css">
				
				<!-- Default Javascript Includes -->
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/jquery/jq.3.6.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/@popperjs/core/dist/umd/popper.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bootstrap5/dist/js/bootstrap.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/onscreen/dist/on-screen.umd.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/sweetalert2/sweetalert2.all.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/datatables/jq.datatables.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/tinymce/tinymce.min.js"></script>	
				<script src='<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/bugfish-jquery-sortselect/jquery.multiselect.sortable.js' defer></script>		
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/resumable/resumable.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/nouislider/dist/nouislider.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/simplebar/dist/simplebar.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/notyf/notyf.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/momentjs/moment.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/githubbuttons/buttons.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/chartist/dist/chartist.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>	
				<script src="<?php echo _HIVE_URL_REL_; ?>/_core/_vendor/volt/volt.js"></script>	
			<?php } ?>
			
			<!-- Include Extensions from Function -->
			<?php echo $metaextensions; ?>			
			
			<link rel="stylesheet" href="<?php echo _HIVE_URL_REL_; ?>/_core/stylesheet.php">
			<script src="<?php echo _HIVE_URL_REL_; ?>/_core/javascript.php"></script> 
		
		</head>		
		  <body class="<?php echo $mainclass; ?>">
	<?php }	
	function hive__volt_topbar($object, $profile_menu = false, $theme_menu = false, $search = false, $title = false, $img = "", $lang_ar = false, $noty_ar = false, $notify_url_all = "", $user_name = "User Profile") {  ?>
	            <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
  <div class="container-fluid px-0">
    <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
      <div class="d-flex align-items-center">
	<?php if($search) {  ?>
        <!-- Search form -->
        <form class="navbar-search form-inline" id="navbar-search-main" action="<?php echo $search; ?>">
          <div class="input-group input-group-merge search-bar">
              <span class="input-group-text" id="topbar-addon">
                <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
              </span>
              <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="topbar-addon">
          </div>
        </form>
        <!-- / Search form -->
	<?php }  ?>
      </div>
      <!-- Navbar links -->
      <ul class="navbar-nav align-items-center">
		 <?php if(is_array($lang_ar)) {  ?>
        <li class="nav-item dropdown ms-lg-3">
          <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="media d-flex align-items-center">
              <img class="avatar rounded-circle hive__volt_image_language" alt="Image placeholder" style="object-fit: cover;" src="<?php echo $lang_ar[0]["current_img"]; ?>">
              <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
              </div>
            </div>
          </a>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
		  <?php foreach($lang_ar as $key => $value) { ?>	
            <a class="dropdown-item d-flex align-items-center" href="<?php echo hive_get_url_rel(array(_HIVE_URL_CUR_[0], _HIVE_URL_CUR_[1], _HIVE_URL_CUR_[2])); ?>&hive__change_lang=<?php echo htmlspecialchars($value["ident"]); ?>">
              <img src='<?php echo $value["img"]; ?>' class='xfpe_marginright5px'>
              <?php echo $value["name"]; ?>
            </a>
		<?php } ?>
          </div>
        </li>
			  <?php } ?>
		 <?php if(is_array($noty_ar)) {  ?>
        <li class="nav-item dropdown  ">
          <a class="nav-link text-dark notification-bell unread dropdown-toggle" data-unread-notifications="true" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
            <svg class="icon icon-sm text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0 rounded-top">
            <div class="list-group list-group-flush rounded-top">
               <!-- <a href="#" class="text-center text-primary fw-bold border-bottom border-light py-3">Notifications</a> -->
			<?php foreach($noty_ar as $key => $value) { ?>
              <a href="<?php echo @$value["url"]; ?>" class="list-group-item list-group-item-action border-bottom ">
                <div class="row align-items-center">
                    <div class="col-auto">
                      <!-- Avatar
                      <img alt="Image placeholder" src="../../assets/img/team/profile-picture-1.jpg" class="avatar-md rounded"> -->
                    </div>
                    <div class="col ps-0 ms-2">
                      <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="h6 mb-0 text-small"><?php echo @$value["object"]; ?></h4>
                          </div>
                         <!-- <div class="text-end">
                            <small class="text-danger"><?php echo @$value["time"]; ?></small>
                          </div> -->
                      </div>
                      <p class="font-small mt-1 mb-0"><?php echo @$value["text"]; ?></p>
                    </div>
                </div>
              </a>
			<?php } ?>
              <a href="<?php echo $notify_url_all; ?>" class="dropdown-item text-center fw-bold rounded-bottom py-3">
                <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                View all
              </a>
            </div>
          </div>
        </li>
		<?php } ?>	
		 <?php if(is_array($profile_menu)) {  ?>
        <li class="nav-item dropdown ms-lg-3">
          <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="media d-flex align-items-center">
              <img class="avatar rounded-circle" alt="Image placeholder" src="<?php echo $img; ?>">
              <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                <span class="mb-0 font-small fw-bold text-gray-900"><?php echo $user_name; ?></span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
		  <?php foreach($profile_menu as $key => $value) { ?>	
            <a class="dropdown-item d-flex align-items-center" href="<?php echo $value["nav_loc"]; ?>">
              <i class='dropdown-icon text-gray-400 me-2 <?php echo $value["nav_img"]; ?>' ></i> 
              <?php echo $value["nav_title"]; ?>
            </a>
		<?php } ?>
          </div>
        </li>
	   <?php } ?>
      </ul>
    </div>
  </div>
</nav>
	<?php }	
	function hive__volt_nav($object, $title = "", $button = false, $logo_url = false, $user_login = false) {  ?>
		<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
			<a class="navbar-brand me-lg-5" href="../../index.html">
				<?php if($logo_url) { ?><img class="navbar-brand-dark" src="<?php echo @$logo_url; ?>" alt="Volt logo" /> <img class="navbar-brand-light" src="<?php echo @$logo_url; ?>" /><?php } ?>
			</a>
			<div class="d-flex align-items-center">
				<button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
			</div>
		</nav>	
		<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
		  <div class="sidebar-inner px-4 pt-3">
			<ul class="nav flex-column pt-3 pt-md-0">
			  <li class="nav-item">
				<!-- <a href="../../index.html" class="nav-link d-flex align-items-center"> -->
				  <span class="sidebar-icon">
					<?php if($logo_url) { ?><img src="<?php echo @$logo_url; ?>" height="20" width="20"><?php } ?>
				  </span>
				  <span class="mt-1 ms-1 sidebar-text"><?php echo $title; ?></span>
				<!--</a>-->
			  </li>
				<?php foreach($object["nav"] as $key => $value) { ?>	
					<?php if(is_array($value["nav_sub"])) { ?>
					
						  <li class="nav-item <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "active";} ?>">
							<span
							  class="nav-link  <?php if(_HIVE_URL_CUR_[0] != $value["nav_act"]) { echo "collapsed";} ?>  d-flex justify-content-between align-items-center"
							  data-bs-toggle="collapse" data-bs-target="#submenu-app">
							  <span>
								<span class="sidebar-icon">
								  <i class='icon icon-xs me-2 <?php echo $value["nav_img"]; ?>'></i>
								</span> 
								<span class="sidebar-text"><?php echo $value["nav_title"]; ?></span>
							  </span>
							  <span class="link-arrow">
								<svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
							  </span>
							</span>
							<div class="multi-level collapse <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "show";} ?>"
							  role="list" id="submenu-app" aria-expanded="true">
							  <ul class="flex-column nav">
								  <?php foreach($value["nav_sub"] as $key => $valuex) { ?>
									<li class="nav-item <?php if(_HIVE_URL_CUR_[1] == $valuex["nav_act"] AND _HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "active";} ?>">
									  <a class="nav-link" href="<?php echo $valuex["nav_loc"]; ?>" >
										<span class="sidebar-text"><?php echo $valuex["nav_title"]; ?></span>
									  </a>
									</li>
								  <?php } ?>
							  </ul>
							</div>
						  </li>					
					
					<?php } else { ?>	
					
						  <li class="nav-item  <?php if(_HIVE_URL_CUR_[0] == $value["nav_act"]) { echo "active";} ?> ">
							<a href="<?php echo $value["nav_loc"]; ?>" class="nav-link" <?php if(@$value["nav_target"]) { echo " target='".$value["nav_target"]."' "; } ?>>
							  <span class="sidebar-icon">
								<i class='icon icon-xs me-2 <?php echo $value["nav_img"]; ?>'></i>
							  </span> 
							  <span class="sidebar-text"><?php echo $value["nav_title"]; ?></span>
							</a>
						  </li>			
					<?php } ?>	
				<?php } ?>	
			
				
				<?php if(is_array($button)) { ?>
				  <li class="nav-item">
					<a href="<?php echo $button[0]; ?>"
					  class="btn btn-secondary d-flex align-items-center justify-content-center btn-upgrade-pro">
					  <span class="sidebar-icon d-inline-flex align-items-center justify-content-center">
						<!--<svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>-->
					  </span> 
					  <span><?php echo $button[1]; ?></span>
					</a>
				  </li>
				<?php } ?>	
  
			</ul>
		  </div>
		</nav>

		<main class="content">		
	<?php }
	function hive__volt_downbar($object, $buttontext, $text) { ?>
	
<div class="theme-settings card bg-gray-800 pt-2 collapse" id="theme-settings">
    <div class="card-body bg-gray-800 text-white pt-4">
        <button type="button" class="btn-close theme-settings-close" aria-label="Close" data-bs-toggle="collapse"
            href="#theme-settings" role="button" aria-expanded="false" aria-controls="theme-settings"></button>
        <?php echo $text; ?>
    </div>
</div>

<div class="card theme-settings bg-gray-800 theme-settings-expand" id="theme-settings-expand">
    <div class="card-body bg-gray-800 text-white rounded-top p-3 py-2">
        <span class="fw-bold d-inline-flex align-items-center h6">
            <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
            <?php echo $buttontext; ?>
        </span>
    </div>
</div>
	<?php
	}		
	#############################################################################################################################################
	// Heading Elements
	#############################################################################################################################################
	function hive__volt_h1($text, $classes = "h1") {
		return '<h1 class="'.$classes.'">'.$text.'</h1>';
	}	
	function hive__volt_h2($text, $classes = "h2") {
		return '<h2 class="'.$classes.'">'.$text.'</h2>';
	}	
	function hive__volt_h3($text, $classes = "h3 ") {
		return '<h3 class="'.$classes.'">'.$text.'</h3>';
	}	
	function hive__volt_h4($text, $classes = "h4 ") {
		return '<h4 class="'.$classes.'">'.$text.'</h4>';
	}	
	function hive__volt_h5($text, $classes = "h5 ") {
		return '<h5 class="'.$classes.'">'.$text.'</h5>';
	}	
	#############################################################################################################################################
	// Modal Elements
	#############################################################################################################################################
	function hive__volt_modal($text, $title = false, $icon = "info") { ?>
		<script>
			$( document ).ready(function() {
				Swal.fire({
				 <?php if($title) { ?> title: '<?php echo $title; ?>', <?php } ?>
				  <?php if($icon) { ?>icon: '<?php echo $icon; ?>',<?php } ?>
				  html:
					'<?php echo str_replace("'", "\\'", $text); ?>',
				});
			});
		</script>
	<?php }	
	#############################################################################################################################################
	// Main Elements
	#############################################################################################################################################
	function hive__volt_404($object, $text = "This page has not been found! :(", $title = "ERROR 404", $classes = false) { 
		hive__volt_box_full($text, $classes);
	 }	
	function hive__volt_401($object, $text = "You do not have permission to view this page! :(", $title = "ERROR 401", $classes = false) { 
		hive__volt_box_full($text, $classes);
	 }	
	#############################################################################################################################################
	// Box Elements
	#############################################################################################################################################
	function hive__volt_box_start($header = false, $classes = "", $headerclasses = "", $subtitle = false) { ?>
	  <?php if($header) {  ?>     
			<div class="d-flex justify-content-between w-100 flex-wrap">
				<div class="mb-3 mb-lg-0">
					<h1 class="h4 <?php echo $headerclasses; ?>"> <?php echo $header; ?></h1>
				   <?php if($subtitle) {  ?> <p class="mb-0"><?php echo $subtitle; ?></p>  <?php } ?>
				</div>
			</div>
	  <?php } ?>
			
		<div class="card <?php echo $classes; ?>">
			  <div class="card-body"> 
	<?php }
	function hive__volt_box_end() { ?>
		  </div>		
		</div>		
	<?php }	
	function hive__volt_box_full($text, $classes = "") { ?>
		<div class="card <?php echo $classes; ?>">
            <div class="card-body"> 
			<?php echo $text; ?>
		  </div>		
		</div>		
	<?php }		
	function hive__volt_box($text, $classes = "") { ?>
		<div class="card <?php echo $classes; ?>">
            <div class="card-body"> 
			<?php echo $text; ?>
		  </div>		
		</div>		
	<?php }	
	#############################################################################################################################################
	// Alert Boxes
	#############################################################################################################################################
	function hive__volt_alert_danger($message, $classes = "alert alert-danger") {
		return '<div class="'.$classes.'" role="alert">'.$message.'</div>';
	}
	function hive__volt_alert_success($message, $classes = "alert alert-success") { 
		return '<div class="'.$classes.'" role="alert">'.$message.'</div>';
	}
	function hive__volt_alert_warning($message, $classes = "alert alert-warning") { 
		return '<div class="'.$classes.'" role="alert">'.$message.'</div>';
	}
	function hive__volt_alert_info($message, $classes = "alert alert-info") { 
		return '<div class="'.$classes.'" role="alert">'.$message.'</div>';
	 }
	function hive__volt_alert_primary($message, $classes = "alert alert-primary") { 
		return '<div class="'.$classes.'" role="alert">'.$message.'</div>';
	}
	function hive__volt_alert_secondary($message, $classes = "alert alert-secondary") { 
		return '<div class="'.$classes.'" role="alert">'.$message.'</div>';
	}
	function hive__volt_alert_light($message, $classes = "alert alert-light") { 
		return '<div class="'.$classes.'" role="alert">'.$message.'</div>';
	}