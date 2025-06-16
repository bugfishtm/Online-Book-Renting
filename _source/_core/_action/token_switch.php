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
		
	*/ if(file_exists("../../settings.php")) { require_once("../../settings.php"); } else { @http_response_code(404); Header("Location: ../"); exit(); }
	
	$favi_code = '<link rel="icon" href="data:image/x-icon;base64,AAABAAMAEBAAAAEAIABoBAAANgAAACAgAAABACAAKBEAAJ4EAAAwMAAAAQAgAGgmAADGFQAAKAAAABAAAAAgAAAAAQAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOt/mkyrP/zM63//zKs//8zrP//M6z//zOs//8zrP//M6z//zOt//9DhNvjT2jB8E1lvz8BAAEAAQEAAAABAAAyrP7zM6z//zOs//8zrP//Mqz//zOs/v8zrP//M63+/zOt//8zrP//SHjO/09pwP9OacDdAAAAAAEAAAAAAAAAM6z+/zKs//8yrP//M63+/zOs/v8zrP//M6z//zOs//8zrf//Mqz//0h3zv9PacH/T2nCmwAAAAAAAAAAAAEBADKt/v8zrP//M6z+/zOs//8zrP//M6z+/zOs//8zrP//M63//zKs//9Id87/T2nB/09owOIAAQAAAAEBAAABAAAzrP//M6z+/zOs/v8zrP//M6z//zOs//8zrP//M63//zOs//8zrP//SHfO/09pwf9OacCZAAAAAAAAAQAAAAAAM6z//zOs//8zrf7/M6z//zKs/v8zrP//M6z//zOs//8zrP//M6z+/0l2zv9PacD/T2nBlQAAAQABAAAAAAAAADOs//8zrP//Mqz//zOs//8zrP//M6z+/zOs//8zrf//Mq3+/zOt//9Id8//T2nB/09pwOIBAAAAAAABAAAAAAAzrP7tM6z+/zOt//8zrP//M63//zOs/v8zrP//M6z//zKs/v8yrP//SHbP/09pwf9OacHiAAAAAAAAAQAAAQAAMq7/UkCt9+xCrPX/NK3+5jOs/+IzrP/iM63/4jKs/+I8rPryPpDl/01txf9PacD/TmnB+E9qwXhAQL4EAAAAAAAAAQDCt6qrwriq/8G5ph0AAAAAAAAAAAAAAQAAAAEAYXW9pU5pwP9OacH/T2nB/09pwf9PacH/T2nApQABAAAAAAEAwrmqqMO4qv+/uKskAAEAAAABAAAAAQAATGbBJU9owf1PacH/T2jB/09pwf9PacH/T2nB/09pwf9NacM/AAABAMK3q3nCuKr/wLiodgAAAAABAQAAAAABAExowGZPaMD/T2nB/09owf9OacH/TmnB/09pwf9OacD/TmjAggEAAADIvKYXwrmq78K4qvnDuap1vLWoJsK6qTuFjrfET2nB/09owf9PaMH/T2nA/05owP9PacH/TmnB/09owIEAAAAAAAAAAMO3p0PCuKvvwriq/8K5qv/CuKr/sK2t/1BowP9PacH/T2jA6ExmvmNOaMHaT2jB/09pwP9Oa8A+AAEBAAAAAAAAAQAAvLCmF8K5qnfDuaumw7momMS3qk5QacCNTmnA/09pw8MAAf8BTmjAqU5owf9PacGlAAEBAAAAAAAAAQAAAQEBAAEAAAABAAAAAAAAAAABAQABAAAAAQH/AU9ovmtOacDYT2nB609pwN9PacJ6QIC+BAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKAAAACAAAABAAAAAAQAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAxrP9TM6z/0jKs//0zrP//M6z//zOs//8zrP//M6z//zKs//8zrf//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP/+M6r+201vx7NOacH3TmjBzU1mvygAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAMaz/UzOs//4zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z+/zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8+kOT/TmnB/09pwf9PacH/TmjBxFVmuw8AAAAAAAEAAAAAAAAAAAAAAAAAAAAAAAAzrP/TM6z//zOt//8zrP//M6z+/zOs//8zrP7/M63+/zOs/v8zrP7/M6z//zOt//8zrP7/M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//0KH3f9PacH/TmnB/09pwP9PacH/T2jBtQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADKs//0zrP//M6z+/zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Qobc/09owf9PacH/T2nB/09pwf9OaMHBAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAM6z//zOs//8zrP//M6z//zKs//8zrP//M6z//zOs//8zrP//M6z+/zOs//8zrP//Mqz//zOs/v8zrP//M63//zOs/v8zrP//M6z//zOs//9Chtz/T2jB/09pwP9PacH/T2nB70xnwzIAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAzrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zKs/v8zrP//M6z//zOs//8zrP//M6z//0KG3P9PacH/T2nB/09pwf9PacP1Tmm/WAAAAAAAAAAAAAAAAAEAAAAAAAAAAAAAADOs//8yrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Qobc/09pwf9PacH/T2nB/09pwf9PacHFAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAM6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//9Chtz/T2nB/05pwf9PacD/T2nB/09owcYAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAzrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M63//zOs//8zrP//M6z+/zOs//8zrP//M6z//zOs//8yrf//M6z//0KH3P9PacH/T2jB/09pwf9PacD8TmnAhgAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAADKs//8zrP//M6z//zOs//8zrf//M6z+/zOs//8zrP//Mqz//zOs//8zrP//M6z+/zOs//8zrf//M6z//zOs//8zrf//M6z//zKs//8zrP//Qobc/09pwf9PacH/T2nB/09pweIAAAAAAAEAAAABAAAAAQAAAAAAAAEAAAAAAAAAM6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8yrP//M63//zKs//9Chtz/T2nB/09owf9PacH/TmnA5AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAzrP//M6z+/zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP7/M6z+/zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP7/Mqz//0KG3P9PacH/T2nB/09pwf9PacH/TmjBcwAAAAAAAQAAAAABAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zKs//8zrP7/M63+/zOs//8zrP//M6z//zOs//8zrf//Qobc/09owf9OacH/T2nB/05pwf9OaMLDAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAM6z//zOs//8zrP//M6z//zKs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOt//8zrf//M6z//zOs//8zrP//M6z//zOs//9Chtz/T2nB/09pwf9PacH/T2nB/09owcYAAAAAAAEBAAAAAAAAAAAAAAAAAAEAAAAzrP/5M6z//zOs//8zrP//M6z//zOt//8zrP//M6z+/zKs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z+/zOs//8zrP//M6z//0KG3P9PacH/T2nA/09pwf9PacH/T2jBxgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs/74zrP//Mqz//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOt//8zrP//M6z//zOs//8zrP7/M6z//zOs//8zrP//Q4bc/09pwf9PacH/T2nB/09pwf9PaMHGAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAM63/MjOs//IzrP//M6z//zOs//8zrf//M63//zOs//8zrP//M6z+/zOs//8zrP//M6z//zKs//8zrP//M6z//zOs//8zrP//M6z//zei9v9IedD/T2jB/09pwf9PacH/T2nB/09pweJPasE6AAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAL67/Jkeu9LRVruv/Uq7s/1Ou7P87rfrTMqv/xjKr/8Yyq//GM6v/xjKr/8Yyq//GMqv/xjKr/8Yyqv/GN6z8zFGs7P9Cid7/TmrC/09owf9PacH/TmnA/05pwf9PacH/T2nB/09pwv5Oa8GpVWbMDwAAAAAAAAAAAAAAAAEAAAAAAAAAwbiqV8K4qv/CuKv/wriq/762qDsAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAQAAAAAAAAAAAACyqqobdYO4/09p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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAKAAAADAAAABgAAAAAQAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAkkv8HNaz/MTOs/58zrf/nMqz//jOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//DKr/9c6m/GAT2vEm09pwu1PaMHoTmnBj05vvBcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACqq/wYyrP9lM6v/6DOs//8zrf//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zWo+/9FgNb/T2rC/09pwf9PacH/T2nB/09pwLJRa7wTAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAADSs/zEzq//oM6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zif9P9ObMP/T2nB/09pwf9PacH/T2nB/09pwfJOacByVFWqCQAAAAAAAAAAAQAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAADOs/58zrP//M6z//zOs/v8zrP//Mqz//zOs/v8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqb7v9PacH/T2nB/09pwf9PacH/T2nB/09pwf9PacH+TmjBcwAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs/+czrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PacH/T2nB/09pwf9PacH/TmjBoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAADOs//4zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrf//M6z//zqa7/9PacH/T2nB/09pwf9PacH/T2nB/09pwf9PacH/TmjBkwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PacH/T2nB/09pwfxOacLDUWvDJgAAAQAAAQAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PacH/T2nB/05pwfdPacBxVVWqAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAADOs//8zrP//M6z//zOs//8zrP//Mqz//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PacH/T2nB/09pwf5PacHnTWm/UAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAADOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PacH/T2nB/09pwP9PaMH/TWnCngAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrf//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PacH/TmnB/09pwf9PacH/TmnBoAAAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwP9PacH/T2nB/09pwf9PaMH/TmnBoAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrf//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zqa7/9PaMH/TmnB/09pwP9PacH/T2nB/09pwP9PacH2TmnCeQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PaMH/T2nB/09pwvlPacCVR2O4EgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//Mqz//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/TmnB/09pwP9PaMH/T2nB/09pwvVNZ8FjAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/TmnB/09pwP9PacH/T2nB/09pwfZQasFjAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zqa7/9PacH/T2nB/09pwf9PacH/TmnB/09pwftOacKWVWq/DAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zqa7/9PacH/T2nB/09pwP9PacH/TmnB/09pwf9PacL1TmrBUgAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zqa7/9PaMH/T2nB/09pwf9PacH/T2nB/09pwf9PacH/TmnBmQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zqa7/9PacH/T2nB/09pwP9PacH/T2nB/09pwf9PacH/TmnBoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PaMH/T2nB/09pwf9PacH/T2nB/09pwf9PacH/TmnBoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAAADOs//szrP//M6z//zOs//8zrf//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zqa7/9PacH/TmnB/09pwf9PacH/T2nB/09pwP9PacH/TmnBoAAAAQAAAAAAAAAAAAAAAQAAAAAAAAAAAAAAAQAAAQAAAAAAADKr/tUzrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PacH/T2nB/09pwP9PacH/TmnBoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADOs/3gzrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrf//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zqa7/9PacH/T2nB/09pwf9PacH/T2nB/09pwf9PacH/TmnBoAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC+q/xszrf/IMqz//jOs/v8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrf//M6z//zOs//8zrP//M6z//zOs/v8zrP//Mqz//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//Mqz//zOs//8zrP//Naf6/z2T5/9PacH/T2nB/09pwf9PacH/T2nB/09pwf9PacH/TmnBsU5sxBozZswFAAAAAAAAAAAAAAAAAAAAAAAAAQAAAAAAAAAAAACA/wIwq/86Mqz/uDOr//wzrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs//8zrP//M6z//zOs/v8zrP//M6z//zOs//8zrP//M6z//zSp/P89lOn/R3zT/05rw/9PacH/T2nB/09pwf9PacH/T2nB/09pwf9PacH/T2nB/U5owc1PacN3Smq/GAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//8BM7P/FEuu8FVtsN3naLDf/2ew3/9nsN//Z7Df/06t7sUzrP+gM6z/oDOs/qAzrP+gM6z/oDOs/qAzrP+gM6z/oDOs/6AzrP+gM6z/oDOs/6AzrP+gM6z/oDWs/aNYr+jaY63g/0aC1/9NbcT/T2nB/09pwf9PacH/T2nB/09pwf9PacH/TmnB/09pwf9PacH/T2nB/09pwP9PacH3T2rBy01rxCsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA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">';

	// Output Empty Array if Current Website Error
	if(defined("_HIVE_CRIT_ER_")) {
		hive__default_volt_header($object, "Error", $favi_code, "dark");
		?>
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <div class="row justify-content-center form-bg-image" > <!-- data-background-lg="../../assets/img/illustrations/signin.svg"-->
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
							There is an critical error on this site module, so you are currently not able to execute any operation!
                        </div>
                    </div>
                </div>
            </div>
        </section>					
		<?php 
		hive__default_volt_footer($object, "");
		exit();
	}
	if(!_HIVE_ALLOW_TOKEN_) { hive__error("Access Error", "Token use is deactivated in ruleset.php! Enable _HIVE_ALLOW_TOKEN_ in ruleset.php or in any module with this functionality to enable this files execution!", "", true, 401); } 
	?><!DOCTYPE html>
<html>
    <head>
        <title>Site Token Switch - CMS</title>
		<meta name="robots" content="noindex, nofollow">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php echo $favi_code; ?>
        <style type="text/css">
            body { text-align: center; padding: 5%; font: 20px Helvetica, sans-serif; color: #333; background: #EEEEEE; }
            h1 { font-size: 32px; margin: 0; }
            article { display: block; text-align: left; max-width: 650px; margin: 0 auto; }
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
				padding: 5px; 
				background: red; 
				color: white;
				font-weight: normal;
				border-radius: 5px;
				margin-bottom: 5px;
				margin-top: 5px;
			}
			.containererrorg {
				padding: 5px; 
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
        <article><div class="card">
            <h1>Site Token Switch</h1>
				<p>You may have been invited to visit a page, which is hidden on this platform! If you came here by mistake you can leave <a href="../../">here</a>. Currently you are active on site module: <b><?php echo htmlspecialchars(_HIVE_MODE_ ?? ""); ?></b></p>
				<?php
					if(@$_POST["token_change_page"]) { 
						if(trim(@$_POST["token_for_view"] ?? "") == "") {
							echo '<font color="red">You have to enter the provided access token!</font>';
						} else {
							$bind[0]["value"] = $_POST["token_for_view"];
							$x = $object["mysql"]->select("SELECT * FROM "._TABLE_TOKEN_." WHERE token_key = ?", false, $bind);
							if($x) {
								if(in_array($x["site_mode"], _HIVE_MODE_ARRAY_)) {
									$_SESSION[_HIVE_COOKIE_."hive_mode"] = $x["site_mode"];
									echo "<script>window.location.href = '../../';</script>";
								} else {
									echo '<font color="red">The content you have requested is not available anymore. It may has been deleted and needs to be redeployed for you to view this website!</font>';
								}
							} else {
								$object["ipbl"]->increase();
								echo '<font color="red">The provided access code has not been found or is expired!</font>';
							}
						}
					}
				?>
				<form method="post" action="./token_switch.php">
					<input type="password" name="token_for_view" value="<?php echo htmlentities(@$_GET["token"] ?? ""); ?>" placeholder="Enter your Token" /><br />
					<input type="hidden" value="1" name="token_change_page"><br />
					<input type="submit" value="Change Site" name="token_change_page" class="btn"> <a href="../../" class="btn">Back to Home</a>
				</form>
        </div></article>
    </body>
</html>
