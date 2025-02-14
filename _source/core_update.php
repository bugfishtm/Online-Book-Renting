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
		
		File Description:
			File to update current executed site module if required.
		
	*/ if(file_exists("./settings.php")) { require_once("./settings.php"); } else { @http_response_code(404); Header("Location: ./"); exit(); }
	$version = explode('.', PHP_VERSION);
	if($version[0] <= 7) {  
		hive__error("Critical Error", "This software does need at least PHP8.X to run properly!", "Your system is running PHP ".$version[0].", which is NOT supported!", true, 503);		
		exit(); 
	} unset($version);
	if(!$object["user"]->user_loggedIn OR $object["user"]->user["user_initial"] != "1") { hive__error("Access Denied", "", "You need to be logged in as the initial superuser!", true, 401); exit(); }
	if(_HIVE_MODE_ != "_administrator") { hive__error("Access Denied", "", "You need to have the administrator module initialized to update this cms!", true, 401); exit(); }
	if(defined("_HIVE_IS_IN_DOCKER_")) {if(_HIVE_IS_IN_DOCKER_) { hive__error("Dockerized", "", "You cannot use this script in a docker environment!", true, 401); exit(); }}
	$object["csrf"] = new x_class_csrf(_HIVE_SITE_COOKIE_."core_update");
	?><!DOCTYPE html>
<html>
    <head>
        <title>Upgrade - CMS</title>
		<meta name="robots" content="noindex, nofollow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="data:image/x-icon;base64,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4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f+yrab/PDcx/z03Mf89NjH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/npmS/+zo4f/s6OH/7ejg/+3o4f/t6OD/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3p4f/t6OH/7ejh/+zo4f/t6OH/7ejh/+3o4f/t6OH/7ejh/7Kspv89NzH/PTcx/z03Mf89NzH/PTcx/z02Mf88NzH/PTcx/z03Mf+emZL/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3p4f/s6OH/7ejh/+3o4f/t6OD/7enh/+3o4f/t6OH/7enh/+3o4f/t6OH/7ejh/+3p4f/t6eH/sqym/z03Mf89NzH/PTcw/z03Mf88NzH/PTcx/z03Mf89NzD/PTcx/56Zkv/t6OH/7ejh/+zo4f/t6OH/7enh/+3o4f/t6eH/7Ojh/+3o4f/t6OH/7ejh/+3o4P/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f+zrKb/PTcx/zw3Mf88NzH/PTYx/z03MP89NjH/PTcx/z03Mf89NzH/npmS/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OD/7ejh/+3o4f/t6OD/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OD/7Ojh/7Kspv88NzH/PTcx/z02Mf89NzD/PTcx/z03Mf89NzH/PTYx/z03MP+emZL/7ejh/+3o4f/t6OH/7enh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eD/7ejh/+3o4P/t6OH/sqym/z03Mf88NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PDcx/56Zkv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f+zrKb/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/npmS/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/s6OH/7ejh/+3o4f/t6OH/7ejh/+zo4f/s6OH/7ejh/+3o4f/t6OH/7enh/+3o4f/t6OH/7ejg/7Kspv89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/zw3Mf+emZL/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejg/+3o4f/s6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/sqym/z03Mf89NzH/PTcx/z03Mf88NzH/PTcx/z03Mf89NzH/PTcx/56Zkv/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6eH/7ejg/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+zo4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f+yrKb/PTYx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/npmS/+3o4f/t6OH/7ejh/+3o4f/s6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+zo4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3p4f/t6OH/7ejh/7Kspv89NjH/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf+ee03/7bFj/+yxY//ssWP/7LFj/+yxY//ssWP/7LFj/+yxY//ssWP/7LFj/+yxYv/ssWP/7LFj/+ywY//ssWP/7LFj/+yxY//ssWP/7LFj/+yxY//ssWP/sohS/z03Mf89NzH/PTcx/z03MP88NzH/PTcx/z03Mf89NzH/PTcx/41sQf/urFX/7qxV/+6sVP/urFX/7qxV/++sVf/urFX/76xV/+6sVP/urFX/7qxV/+6sVf/urFX/7qxU/+6sVf/urFX/76xV/+6sVf/vrFX/7qxV/+6sVf+heUX/PDcx/zw2Mf89NzH/PTcx/z03Mf88NzH/PTcx/z03Mf89NzH/Rj0y/6uAR//GkU3/xpFM/8aRTP/GkEz/xpFM/8aRTP/GkU3/xpFM/8eRTP/GkUz/xpFN/8aRTP/GkUz/xpFM/8aRTP/GkUz/xpFM/8aRTP/GkUz/soRI/05CNP88NzH/PTcx/z03Mf89NzD/PTYx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTYx/z03MP89NzH/PTcx/z03Mf89NzD/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcw/z03Mf89NzH/PTcx/z03Mf89NzH/PTYx/z03Mf89NjH/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcw/z03Mf89NzD/enRu/4uGgP+LhoD/i4aA/4qGgP+LhoD/i4eA/4uGgP+LhoD/i4aA/4uGgP+LhoD/i4aA/4uGgP+LhoD/i4aA/4uFf/9YU0z/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/05IQv/t6OH/7ejh/+zo4f/t6OH/7ejg/+3o4f/t6OH/7ejh/+3o4f/t6OH/wby1/4uGgf+LhoD/i4aA/4uGgP/t6OH/7ejh/6+po/89NzD/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/UUpE/+zo4P/t6OH/7ejh/+3p4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f+emZL/PTcx/z03Mf89NzH/PTcx/+zn4P/t6OH/sqym/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzD/PTYx/z03Mf88NzH/PDcx/z03Mf9QSkT/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7enh/+3p4f/t6eH/7ejh/56Zkv89NzH/PTcx/z03MP89NzH/7Ofg/+3o4f+yrKb/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTYx/1BKRP/t6OD/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OD/7Ojh/+3o4f/t6OH/npmS/z03Mf89NzH/PTcx/z03Mf/s5+D/7ejh/7Kspv88NzD/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/zw3Mf89NzH/UEpE/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f+emZL/PTcx/z03Mf89NzD/PTcx/+3n4P/s6OH/sq2m/z03Mf89NzH/PTcx/z02Mf89NzH/PTcx/z03Mf88NjH/PTcx/z03MP89NzH/PTcx/z03MP9QSkT/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/s6OH/7ejh/56Z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4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/5uLb/3Zxav89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcwnj03Mek9NjH/PTcx/z03Mf89NzH/PTcx/1tVT//h3NX/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/83Iwf9JQz3/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx4z03Mf09NzH/PTcx/z03Mf89NjH/PTcx/2ljXf/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9ZU03/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PDcx/j03MP89NzH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/z03MP89NjH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03MP89NjH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6eH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzP9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2pkX//t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03MP89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/9nUzf9aVE7/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzP9aVE7/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NjH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PDcx/z03Mf89NjH/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/2pkXv/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2peUP/sz6n/7M+p/+zPqf/sz6n/7c+p/+zPqP/szqn/7M+p/+zPqP/sz6n/7M+p/+zPqP/sz6n/7M+p/+zPqf/sz6n/7M+p/+zPqf/sz6n/7M+p/+zPqf/sz6n/7c+p/+zPqf/sz6n/7M+p/+zPqf/sz6n/7M+p/+zPqf/sz6n/7M+p/9i+m/9aUEX/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2pWPf/urlr/7a5a/+2uWv/trlr/7a5a/+2uWv/trlr/7a5a/+2uW//trlr/7a5a/+2uWv/trlr/7a5a/+2uWv/trlr/7a5a/+2uWv/trlr/7a5a/+2uW//trlr/7K5a/+2uWv/trlr/7a5a/+2uWv/trlr/7a5a/+2uW//trlr/7a5a/9qgVP9aSjj/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/2FPOP/qqVT/7qxV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVP/urFX/7qxV/+6sVf/urFX/76xV/+6sVf/urFX/7qxV/+6sVP/urFX/7qxV/+6sVf/urFX/7qxV/+6sVP/urFX/7qxV/+6sVf/urFX/76xV/+6sVf/urFX/7qxV/9acUP9SRTX/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/0tBNP++jEv/7atV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVf/urFX/7qxV/+6sVP/urFX/7atV/593Rf8/ODH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z44Mf9VRzb/k29D/6uASP+rgEf/q4BH/6uAR/+rgEf/q4BH/6uAR/+rgEf/q4BH/6uAR/+rgEf/q4BH/6uAR/+rgUf/qoBH/6uAR/+rgEf/q4BH/6uAR/+rgUf/q4BH/6uAR/+rgEf/q4BH/6uAR/+rgEf/q4BH/6yAR/+nfUb/fGE9/0Y9M/89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/z03Mf9jXVf/s66n/8C6tP/Au7T/wLq0/8C6tP/Au7T/wLq0/8C6tP/AurT/wLq0/8C6tP/AurT/wLq0/8C6tP/AurT/wLq0/8C6tP/AurT/wLq0/8C6tP/AurT/wLq0/8C6tP/AurT/vrmy/4aAev8+ODL/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/0I8Nv+kn5j/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/y8a//8C6tP/AurT/wLq0/8C6tP/AurT/wbq0/+3o4f/t6OH/7ejh/9fSy/9VT0n/PTcx/z03Mf89NzH/PTcx/z03MP89NjH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/0Q+OP+oo5z/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4f/t6OH/amRe/z03Mf89NzH/PTcx/z03Mf89NjH/PDcx/+zn4P/t6OH/7ejh/9nUzf9aVE7/PDcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/0Q+OP+oo5z/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/amRe/z03MP89NzH/PTcx/z03MP89NzH/PTcx/+zn4P/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PDcx/0Q+OP+oo5z/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/amRe/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/+zn4P/t6OH/7Ojh/9nUzf9aVE7/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/0Q+OP+oo5z/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/amRe/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/+zn4P/t6OH/7Ojh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/0Q+OP+oo5z/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4P/t6OH/7ejh/+3o4P/t6OH/amRe/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/+zn4P/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/0Q+OP+oo5z/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/amRe/z03MP89NzH/PTcx/z03MP89NzH/PTcx/+zn4P/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03MP89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/0Q+OP+oo5z/7Ojh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/a2Re/z03Mf89NzH/PTcx/z03Mf89NzH/PDcx/+zn4P/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/0Q+OP+oo5z/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/amRe/z03MP89NzH/PTcx/z03Mf89NzH/PTcx/+zn4P/t6OH/7ejh/9nUzP9aVE7/PDcx/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/0Q+OP+oopz/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/amRe/z03Mf89NzH/PDcx/z03Mf89NzH/PTcx/+zn4f/t6OH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NjH/PTcx/z03Mf89NjH/PDcx/j03Mf89NzH/PTcx/z03Mf89NzH/PTcx/z03Mf89NjH/PTcx/z03Mf89NzH/PTcx/0Q+OP+oo5z/7ejh/+3o4f/t6OH/7ejh/+3o4P/t6eH/7ejh/+3o4f/t6OH/7ejh/+3o4f/t6OH/7Ojh/+3o4P/t6OH/amRe/z03Mf89NzH/PTcx/z03Mf89NzH/PTcx/+zn4f/t6eH/7ejh/9nUzf9aVE7/PTcx/z03Mf89NzH/PTcx/z03Mf89NzH/PDYy4j03MP89NzH/PTcx/z03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">
        <style type="text/css">
            body { text-align: center; padding: 5%; font: 20px Helvetica, sans-serif; color: #333; background: #EEEEEE;  padding-top: 0px; padding-bottom: 25px;  }
            h1 { font-size: 32px; margin: 0; }
            article { display: block; text-align: left; max-width: 650px; margin: 0 auto; padding-top: 15px; margin-top: 15px;}
            a { color: #FF5707; text-decoration: none; }
            a:hover { color: #333; text-decoration: none; }
            @media only screen and (max-width : 480px) {
                h1 { font-size: 26px; }
            }
			.card {
				box-sizing: border-box;
				background: #FFFFFF;
				border-radius: 5px;
				padding: 15px;
				font-size: 14px;
				margin-bottom: 15px;
			}
			
			.btn {
				background: #FF5707;
				background: #EEEEEE;
				color: black;
				padding: 15px;
				border-radius: 5px;
				cursor: pointer;
				border: none;
			}
			
			.btn:hover {
				background: black;
				color: white;
			}
			
			.btn-fr {
				float: right;
			}
			
			table {
				width: 100%;
				border: none;
			}
			table td {
				width: 100%;
			}
			
			table tr:last-child td {
				border-bottom: 0px;
			}
			
			input[type="text"], input[type="number"], input[type="password"] {
				box-sizing: border-box;
				width: 100%;
				border-radius: 5px;
				border-color: #CCCCCC;
				border-style: solid;
				border: 1px solid #CCCCCC;
				padding: 5px;
			}
			
			.containererror {
				padding: 15px; 
				background: red; 
				color: white;
				font-weight: normal;
				border-radius: 5px;
				margin-bottom: 5px;
				margin-top: 5px;
			}
			.containererrorg {
				padding: 15px; 
				background: green; 
				color: white;
				font-weight: normal;
				border-radius: 5px;
				margin-bottom: 5px;
				margin-top: 5px;
			}
        </style>
    </head>
    <body>
        <article>
			<div class="card">
				<b style='font-size:36px; padding-bottom: 10px;'>Upgrade</b>
				
				
				
				<!-- Information -->
				<p>
					<b>Information:</b>
					<ul>
						<li>Current Core Version: <?php $error = false; echo $object["core_mode"]["version"]; ?></li>
						<li>Current Module Version: <?php echo $object["hive_mode"]["version"]; ?></li>
						<li>Update Server: <?php echo _HIVE_SERVER_CORE_; ?></li>
					</ul>
				</p>
				
				<!-- Prepare -->
				<p>
					<b>Preparing:</b>
					<ul>
						<li>Creating Rollback Folder (__rollback): <?php if(is_dir("./__rollback")) { echo "<font color='green'>OK</font>"; } else { mkdir("./__rollback"); if(is_dir("./__rollback")) { echo "<font color='green'>OK</font>"; } else { echo "<font color='red'>Error</font>"; $error = true; } } ?></li>
						<li>Creating Cache Folder (__cache): <?php if(is_dir("./__cache")) { echo "<font color='green'>OK</font>"; } else { mkdir("./__cache"); if(is_dir("./__cache")) { echo "<font color='green'>OK</font>"; } else { echo "<font color='red'>Error</font>"; $error = true; } } ?></li>
					</ul>
				</p>

				<!-- List Versions -->
				<?php

					if(!function_exists("adm_store_curl_string")) { 
						function adm_store_curl_string($url) {
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $url);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
							$response = curl_exec($ch);
							if(curl_errno($ch)){
								return false;
							}
							curl_close($ch);
							if ($response === false) {
								return false;
							} else {
								return $response;
							}
						}
					}
					$x = adm_store_curl_string(_HIVE_SERVER_CORE_."/_store/core_fetch_latest.php");
					if(!$x) {
						?>
						<div class="containererror">
							The Online Server is not reachable or does not provide a valid latest release!
						</div>
						<?php
						$error = true;
					}
					if(!is_string($x)) {
						?>
						<div class="containererror">
							The Online Server is not reachable or does not provide a valid latest release!
						</div>
						<?php
						$error = true;
					}
					if(!$error) {
						$version1 = $object["hive_mode"]["version"];
						$version2 = substr($x, 0, -4);
						$result = version_compare($version1, $version2);
						if ($result < 0) {
							if(file_exists("./__cache/".$x) AND @$_GET["updt"] == 1 AND $object["csrf"]->check(@$_GET["token"])) {
								if(is_dir("./__cache/".substr($x, 0, -4)."")) {
									x_rmdir("./__cache/".substr($x, 0, -4)."");
								}
								$object["zip"]->unzip("./__cache/".$x."", "./__cache/".substr($x, 0, -4)."");
								$foldertmp = "./__cache/".substr($x, 0, -4)."/";
								// Copy and Replace Folders and Files
								function copyFilesAndFolders($sourceFolder, $destinationFolder) {
									$items = scandir($sourceFolder);
									if (!is_dir($destinationFolder)) {
										mkdir($destinationFolder, 0777, true);
									}
									foreach ($items as $item) {
										if ($item == '.' || $item == '..') { continue; }
										$sourcePath = $sourceFolder . DIRECTORY_SEPARATOR . $item;
										$destinationPath = $destinationFolder . DIRECTORY_SEPARATOR . $item;
										if (is_dir($sourcePath)) {
											copyFilesAndFolders($sourcePath, $destinationPath);  // Recursively copy subdirectories
										} else {
											copy($sourcePath, $destinationPath);
										}
									}
								}
								$sourceFolder = "./__cache/" . substr($x, 0, -4) . "/";
								$destinationFolder = $object["path"]."/";
								x_rmdir($object["path"]."/_core");
								x_rmdir($object["path"]."/_site/_administrator");
								copyFilesAndFolders($sourceFolder, $destinationFolder); 
								x_rmdir("./__cache/".substr($x, 0, -4)."");
								unlink("./__cache/".$x.""); ?>
								<div class="containererrorg">
									Upgrade successfull - <?php echo $x; ?>!
								</div>
								<?php
							} elseif(@$_GET["updt"] == 1) {
								$fileUrl = _HIVE_SERVER_CORE_."/_store/_core/_release/".$x;
								$savePath = './__cache/'.$x;
								$fp = fopen($savePath, 'w');
								$ch = fopen($fileUrl, 'rb');
								if ($ch === false) {
									$errorx = true;
								} else {
									$errorx = false;
								}
								while (!feof($ch)) {
									$data = fread($ch, 8192); 
									fwrite($fp, $data);
								}
								fclose($ch);
								fclose($fp);
								if ($ch === false) {
									?>
									<div class="containererror">
										Error while downloading the upgrade!
									</div>
									<?php
								} else { ?>
									<div class="containererrorg" style="background: yellow; color: black;">
										The upgrade has been downloaded - <?php echo $x; ?>!
									</div>
									<?php
									echo '<br /><a href="./core_update.php?updt=1&token='.$object["csrf"]->get().'" class="btn">Install Upgrade</a><br />';
								}
							} else {
								?>
								<div class="containererrorg" style="background: yellow; color: black;">
									An upgrade is available - <?php echo $x; ?>!
								</div>
								<?php
								echo '<br /><a href="./core_update.php?updt=1" class="btn">Start Upgrade</a><br />';
							}
						} elseif ($result > 0) {
							?>
							<div class="containererror">
								You are running an unknown version of this software!
							</div>
							<?php
						} else {
							?>
							<div class="containererrorg">
								You are up to date!
							</div>
							<?php
						}		
					} else {
						?>
						<div class="containererror">
							Please solve all shown issues to upgrade this cms!
						</div>
						<?php
					}
				?>				
				<br /><br />Click <a href="./">here</a> to go back to homepage!
			</div>	
				<center><font size="-1"><?php echo _HIVE_CREATOR_; ?></font></center>
			</article>
    </body>
</html>